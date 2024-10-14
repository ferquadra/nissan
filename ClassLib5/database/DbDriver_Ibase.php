<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Database
 * @author		Gabriel Luraschi
 * @since		Versión 5
 */

// ------------------------------------------------------------------------

/**
 * Interface IDbDriver requerida.
 */
require_once('IDbDriver.php');

/**
 * DbDriver_Ibase
 * 
 * Driver de conexión a motores de bases de datos Interbase/Firebird.
 * 
 * Utiliza el patrón de diseño <i>Singleton</i>.
 * 
 * @package ClassLib
 * @subpackage Database
 * @author Gabriel Luraschi
 * @uses IDbDriver
 * @property mixed $CurrentField Contiene el registro actual.
 * @property mixed $TransactionErrors Contiene un array con errores ocurridos durante una transacción.
 * @property mixed $StartedTransaction Indica si hay una transacción abierta.
 */
class DbDriver_Ibase implements IDbDriver {
	
	/**
	 * Propiedad estática con las instancias creadas.
	 *
	 * @var array
	 */
	private static $Instances=array();
	
	/**
	 * Link de conexión a la base de datos.
	 *
	 * @var Resource
	 */
	private $Link;
	
	/**
	 * Link de resultado de base de datos.
	 *
	 * @var Resource
	 */
	private $Result;
	
	/**
	 * Contiene el registro actual.
	 *
	 * @var array
	 */
	private $CurrentField;
	
	/**
	 * Contiene un array con errores ocurridos durante una transacción.
	 *
	 * @var array
	 */
	private $TransactionErrors;
	
	/**
	 * Indica si hay una transacción abierta.
	 *
	 * @var bool
	 */
	private $StartedTransaction = false;
	
	/**
	 * Se declara privado porque no se puede instanciar directamente esta clase.
	 *
	 */
	private function __construct() {}
	
	/**
	 * Es singleton, no se puede clonar la clase.
	 *
	 */
	private function __clone() {}
	
	/**
	 * Inicializa el motor y conecta a la DB.
	 *
	 * @param string $cHost
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 */
	private function Initialize($cHost, $cUser, $cPass, $cDbName) {
		// Realiza la conexión.
		if (APP_DATABASE_PERSISTENT) $this->Link = @ibase_pconnect($cHost, $cUser, $cPass);
		else $this->Link = @ibase_connect($cHost, $cUser, $cPass);
		
		if ($this->Link === false) {
			$this->RuntimeError(1);
			
			if (APP_DATABASE_WIN32ALERT) {
				require_once(APP_SYSTEM_PATH.'/libraries/Win32.php');
				Win32::MsgBox('Error', "Se perdió conexión con el servidor, aguarde unos segundos e intente nuevamente.\n\nEn caso de persistir el problema será necesario revisar la conexión de la red local.");
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Agrega barras invertidas a $mData ya sea una cadena o un array.
	 *
	 * @param mixed $mData
	 * @return mixed
	 */
	private function AddSlashes($mData) {
		if (is_array($mData)) {
			return array_map('addslashes', $mData);
		}
		elseif ($mData !== false) {
			return addslashes($mData);
		}
		
		return $mData;
	}
	
	/**
	 * @desc
	 * Método interno para reportar errores.
	 *
	 * @param int $nErrNo
	 */
	private function RuntimeError($nErrNo) {
		$aArgs = func_get_args();
		switch ($nErrNo) {
			case 1:
				error::Raise(E_WARNING, "Imposible establecer conexion con el servidor.<br >Ibase Dice: ".@ibase_errmsg());
				break;
				
			case 5:
				error::Raise(E_WARNING, 'Se produjo una falla en la instruccion '.$aArgs[1].'<br />'.@ibase_errmsg());
				break;
				
			case 6:
				error::Raise(E_WARNING, "La columna <u>{$aArgs[1]}</u> no existe en el resultado de la consulta.");
				break;
				
			case 7:
				error::Raise(E_WARNING, 'No se puede obtener la cantidad de registros devueltos por la ultima consulta SQL.<br />'.@ibase_errmsg());
				break;
				
			case 10:
				error::Raise(E_WARNING, 'Error al obtener la cantidad de filas afectadas en la ultima consulta SQL.<br />'.@ibase_errmsg());
				break;
				
			case 11:
				error::Raise(E_WARNING, 'Error al obtener un registro.<br />'.@ibase_errmsg());
				break;
				
			case 12:
				error::Raise(E_WARNING, "La propiedad {$aArgs[1]} no existe.");
				break;
				
			case 13:
				error::Raise(E_ERROR, "Método <u>{$aArgs[1]}</u> no disponible.");
				break;
				
			default:
				error::Raise(E_ERROR, 'Error de Ibase indefinido.<br />'.@ibase_errmsg());
				
		}
	}
	
	/**
	 * Devuelve una instancia de la clase de conexión a la base de datos.
	 * 
	 * Utiliza el patrón de diseño <i>Singleton</i>.
	 *
	 * @param string $cHost
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 * @return DbDriver_Ibase
	 */
	public static function _getInstance($cHost, $cUser, $cPass, $cDbName) {
		// Busca una instancia a la base de datos especificada, si no la encuentra la crea.
		// Este singleton mantiene una instancia por cada base de datos (permitiendo diversas instancias a diferentes bases, cada una con sus recursos).
		if (!isset(self::$Instances["{$cHost}|{$cUser}|{$cDbName}"])) {
			self::$Instances["{$cHost}|{$cUser}|{$cDbName}"] = new self();
			self::$Instances["{$cHost}|{$cUser}|{$cDbName}"]->Initialize($cHost, $cUser, $cPass, $cDbName);
		}
		return self::$Instances["{$cHost}|{$cUser}|{$cDbName}"];
	}
	
	/**
	 * <b>Método Open() no implementado en DbDriver_Ibase</b>.
	 * 
	 * @param string $cBaseName
	 * @return false
	 */
	public function Open($cBaseName=APP_DATABASE_NAME) {
		$this->RuntimeError(13, 'DbDriver_Ibase::Open()');
		return false;
	}
	
	/**
	 * Ejecuta una sentencia SQL.
	 *
	 * @param string $cSql
	 * @return bool
	 */
	public function Query($cSql) {
		$this->CurrentField = null;
		$this->Result = @ibase_query($this->Link, $cSql);
		
		if ($this->StartedTransaction && !$this->Result) {
			$this->TransactionErrors[] = @ibase_errmsg();
		}
		
		if ($this->Result) {
			return true;
		}
		else {
			$this->RuntimeError(5, $cSql);
			return false;
		}
	}
	
	/**
	 * <b>Método QueryInsert() no implementado en DbDriver_Ibase</b>.
	 *
	 * @param string $cSql
	 * @return int
	 */
	public function QueryInsert($cSql) {
		$this->RuntimeError(13, 'DbDriver_Ibase::QueryInsert()');
		return false;
	}
	
	/**
	 * Devuelve una fila del resultado de una consulta en forma de array asociativo.
	 * Si se especifica el parametro <i>$cCol</i>, sólo devuelve el valor del campo indicado.
	 *
	 * @param string $cCol
	 * @return mixed
	 */
	public function Field($cCol=null) {
		$aField = @ibase_fetch_assoc($this->Result);
		
		if ($aField === null) {
			$this->RuntimeError(11);
			return $this->CurrentField = false;
		}
		
		if($aField === false) {
			return false;
		}
		
		if($cCol === null) {
			$this->CurrentField = $aField;
		}
		elseif(array_key_exists($cCol, $aField)) {
			$this->CurrentField = $aField[$cCol];
    	}
		else {
			$this->RuntimeError(6, $cCol);
			$this->CurrentField = false;
    	}
    	
		if (APP_DATABASE_ADDSLASHES) {
			return $this->AddSlashes($this->CurrentField);
		}
		else {
			return $this->CurrentField;
		}
	}
	
	/**
	 * Devuelve la cantidad de registros de la última consulta.
	 *
	 * @return int
	 */
	public function Count() {
		$nCount = @ibase_num_fields($this->Result);
		
		if ($nCount !== null) {
			return $nCount;
		}
		else {
			$this->RuntimeError(7);
			return false;
		}
		
	}
	
	/**
	 * Devuelve la cantidad de registros alterados en la última consulta.
	 *
	 * @return int
	 */
	public function AffectedRows() {
		$nRet = @ibase_affected_rows($this->Link);
		if ($nRet === null) {
			$this->RuntimeError(10);
		}
		
		return $nRet;
	}
	
	/**
	 * <b>Método Open() no implementado en DbDriver_Ibase</b>.
	 * 
	 * @param string $cTabla
	 * @return int
	 */
	public function NextInsertID($cTabla) {
		$this->RuntimeError(13, 'DbDriver_Ibase::NextInsertID()');
		return false;
	}
	
	/**
	 * Devuelve el recordset completo de la última consulta efectuada.
	 * Si se espeficica la columna se devuelve un array con sólo esa columna.
	 *
	 * @param string $cCol
	 * @return array
	 */
	public function GetRecordset($cCol=null) {
		$aRet = array();
    	
    	// Ciclo por todos los registros, si especifico $cCol obtengo sólo esa columna, checkeando que exista.
    	if($cCol === null) {
    		// El if para ver si tiene que escapar lo hace por fuera del bucle para mejorar la performance.
    		if (APP_DATABASE_ADDSLASHES) {
				while($aField = @ibase_fetch_assoc($this->Result)) { $aRet[] = $this->AddSlashes($aField); }
    		}
    		else {
				while($aField = @ibase_fetch_assoc($this->Result)) { $aRet[] = $aField; }
    		}
		}
		else {
    		// El if para ver si tiene que escapar lo hace por fuera del bucle para mejorar la performance.
    		if (APP_DATABASE_ADDSLASHES) {
    			// Primero busca si está la columna, una sola vez, para mejorar la performance.
    			$aField = @ibase_fetch_assoc($this->Result);
    			
    			// Si no encontró registros devuelve un array vacío.
    			if ($aField === false) {
    				return array();
    			}
    			
    			// Ahora si corrobora si está la columna.
				if(!isset($aField[$cCol])) {
					$this->RuntimeError(6, $cCol);
					return false;
				}
    			
				// Si está la columna sigue con el bucle normalmente.
    			do {
    				$aRet[] = $this->AddSlashes($aField[$cCol]);
    			} while($aField = @ibase_fetch_assoc($this->Result));
    		}
    		else {
    			// Primero busca si está la columna, una sola vez, para mejorar la performance.
    			$aField = @ibase_fetch_assoc($this->Result);
    			
    			// Si no encontró registros devuelve un array vacío.
    			if ($aField === false) {
    				return array();
    			}
    			
    			// Ahora si corrobora si está la columna.
				if(!isset($aField[$cCol])) {
					$this->RuntimeError(6, $cCol);
					return false;
				}
    			
				// Si está la columna sigue con el bucle normalmente.
    			do {
    				$aRet[] = $aField[$cCol];
    			} while($aField = @ibase_fetch_assoc($this->Result));
    		}
		}
		
		return $aRet;
	}
	
	/**
	 * Limpia el buffer de almacenamiento temporal.
	 *
	 * @return void
	 */
	public function Clear() {
		$this->CurrentField = null;
		@ibase_free_result($this->Result);
	}
	
	/**
	 * Comienza una transacción.
	 *
	 * @return bool
	 */
	public function Begin() {
		@ibase_trans(null, $this->Link);
		return true;
	}
	
	/**
	 * Comcreta la transacción abierta.
	 *
	 * @return bool
	 */
	public function Commit() {
		@ibase_commit($this->Link);
		return true;
	}
	
	/**
	 * Cancela la transacción abierta.
	 *
	 * @return bool
	 */
	public function Rollback() {
		@ibase_rollback($this->Link);
		return true;
	}
	
	/**
	 * Devuelve el último mensaje de error.
	 *
	 * @return string
	 */
	public function GetLastError() {
		return @ibase_errmsg();
	}
	
	/**
	 * Getter.
	 * 
	 * Sólo permite usarse con:
	 * - CurrentField
	 * - TransactionErrors
	 * - StartedTransaction
	 *
	 * @param string $cProp
	 * @return mixed
	 */
	public function __get($cProp) {
		if (in_array($cProp, array('CurrentField', 'TransactionErrors', 'StartedTransaction'))) {
			return $this->$cProp;
		}
		else {
			$this->RuntimeError(12, $cProp);
		}
	}
}
?>