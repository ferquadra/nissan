<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Database
 * @author		Gabriel Luraschi
 * @since		Version 5r86
 */

// ------------------------------------------------------------------------

/**
 * Interface IDbDriver requerida.
 */
require_once('IDbDriver.php');

/**
 * DbDriver_dBase
 * 
 * Driver de conexión a bases de datos dBase.
 * 
 * Utiliza el patrón de diseño <i>Singleton</i>.
 * 
 * <b>NO admite consultas SQL, sólo abrir tablas y obtener registros de forma secuencial.</b>
 * En la revisión 86 de ClassLib admite aperturas como sólo lectura.
 * 
 * @package ClassLib
 * @subpackage Database
 * @author Gabriel Luraschi
 * @uses IDbDriver
 * @property mixed $CurrentField Contiene el registro actual.
 */
class DbDriver_dBase implements IDbDriver {
	
	/**
	 * Propiedad estática con las instancias creadas.
	 *
	 * @var array
	 */
	private static $Instances=array();
	
	/**
	 * Modo sólo lectura.
	 * <i>Predeterminado</i>
	 *
	 */
	const MODE_R	= 0;
	
	/**
	 * Modo sólo escritura.
	 *
	 */
	const MODE_W	= 1;
	
	/**
	 * Modo lectura y escritura.
	 *
	 */
	const MODE_RW	= 2;
	
	/**
	 * Link de conexión a la base de datos.
	 *
	 * @var string
	 */
	private $Link;
	
	/**
	 * Link de resultado de base de datos.
	 *
	 * @var Resource
	 */
	private $Result;
	
	/**
	 * Contiene la posición del registro actual.
	 *
	 * @var int
	 */
	private $CurrentField;
	
	/**
	 * Contiene la cantidad total de registros.
	 *
	 * @var int
	 */
	private $TotalFields;
	
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
		if (!is_dir($cHost)) {
			$this->RuntimeError(1);
		}
		
		// Establece en el link el path hacia la carpeta donde están las bases de datos.
		$this->Link = $cHost;
		
		// Abre la base de datos indicada.
		if ($cDbName) {
			$this->Open($cDbName);
			return true;
		}
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
	 * Método interno para reportar errores.
	 *
	 * @param int $nErrNo
	 */
	private function RuntimeError($nErrNo) {
		$aArgs = func_get_args();
		switch ($nErrNo) {
			case 1:
				error::Raise(E_WARNING, 'Imposible establecer conexion con el servidor.');
				break;
				
			case 2:
				break;
				
			case 3:
				break;
				
			case 4:
				error::Raise(E_WARNING, 'No se puede abrir la base de datos '.$aArgs[1]);
				break;
				
			case 5:
				error::Raise(E_WARNING, 'Se produjo una falla en la instruccion '.$aArgs[1].'<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error()));
				break;
				
			case 6:
				error::Raise(E_WARNING, 'La columna <u>'.$aArgs[1].'</u> no existe en el resultado de la consulta.');
				break;
				
			case 7:
				error::Raise(E_WARNING, 'No se puede obtener la cantidad de registros.');
				break;
				
			case 8:
				break;
				
			case 9:
				break;
				
			case 10:
				break;
				
			case 11:
				error::Raise(E_WARNING, 'Error al obtener un registro.');
				break;
				
			case 12:
				error::Raise(E_WARNING, "La propiedad {$aArgs[1]} no existe.");
				break;
				
			case 13:
				error::Raise(E_WARNING, "Método <u>{$aArgs[1]}</u> no disponible.");
				break;
				
			case 14:
				error::Raise(E_WARNING, "Unicamente se admite el modo SOLO LECTURA.");
				break;
				
			default:
				error::Raise(E_ERROR, 'Error de dBase indefinido.');
				
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
	 * @return DbDriver_MySql
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
	 * Abre una base de datos.
	 * La conexión debe estar abierta.
	 * 
	 * Se puede especificar el modo de apertura, de forma predeterminada es sólo lectura.
	 *
	 * @param string $cBaseName
	 * @param int $nMode
	 * @return bool
	 */
	public function Open($cBaseName=APP_DATABASE_NAME, $nMode=self::MODE_R) {
		if ($nMode != self::MODE_R) {
			return false;
		}
		
		if ($this->Result = @dbase_open("{$this->Link}/{$cBaseName}", $nMode)) {
			$this->CurrentField = 1;
			$this->TotalFields = dbase_numrecords($this->Result);
			return true;
		}
		else {
			$this->RuntimeError(4, "{$this->Link}/{$cBaseName}");
			return false;
		}
	}
	
	/**
	 * Ejecuta una sentencia SQL.
	 *
	 * @param string $cSql
	 * @return bool
	 */
	public function Query($cSql) {
		$this->RuntimeError(13, 'DbDriver_dBase::Query');
		return false;
		/*
		$this->CurrentField = null;
		$this->Result = @mysql_query($cSql, $this->Link);
		
		if ($this->StartedTransaction && !$this->Result) {
			$this->TransactionErrors[] = @mysql_error($this->Link);
		}
		
		if ($this->Result) {
			return true;
		}
		else {
			$this->RuntimeError(5, $cSql);
			return false;
		}
		*/
	}
	
	/**
	 * Ejecuta una sentencia SQL.
	 * 
	 * Devuelve el ID autonumérico de la última fila insertada.
	 * Utilizar este método únicamente para sentencias INSERT.
	 *
	 * @param string $cSql
	 * @return int
	 */
	public function QueryInsert($cSql) {
		$this->RuntimeError(13, 'DbDriver_dBase::QueryInsert');
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
		if ($this->CurrentField >= $this->TotalFields) {
			return array();
		}
		
		$aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField);
		
		if ($aField === false) {
			return array();
		}
		
		if (APP_DATABASE_ADDSLASHES) {
			return $this->AddSlashes($aField);
		}
		else {
			return $aField;
		}
	}
	
	/**
	 * Devuelve la cantidad de registros de la última consulta.
	 *
	 * @return int
	 */
	public function Count() {
		$nCount = @dbase_numrecords($this->Result);
		
		if ($nCount !== false) {
			return $nCount;
		}
		else {
			$this->RuntimeError(7);
			return false;
		}
	}
	
	/**
	 * Método no disponible en DbDriver_dBase
	 *
	 * @return false
	 */
	public function AffectedRows() {
		$this->RuntimeError(13, 'DbDriver_dBase::AffectedRows');
		return false;
	}
	
	/**
	 * Método no disponible en DbDriver_dBase
	 * 
	 * @param string $cTabla
	 * @return false
	 */
	public function NextInsertID($cTabla) {
		$this->RuntimeError(13, 'DbDriver_dBase::NextInsertID');
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
    	
    	// Ciclo por todos los registros, si especifico $col obtengo solo
    	// esa columna, checkeando que exista.
    	if($cCol === null) {
    		// El if para ver si tiene que escapar lo hace por fuera del bucle para mejorar la performance.
    		if (APP_DATABASE_ADDSLASHES) {
				while($aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField)) { $aRet[] = $this->AddSlashes($aField); }
    		}
    		else {
				while($aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField)) { $aRet[] = $aField; }
    		}
		}
		else {
    		// El if para ver si tiene que escapar lo hace por fuera del bucle para mejorar la performance.
    		if (APP_DATABASE_ADDSLASHES) {
    			// Primero busca si está la columna, una sola vez, para mejorar la performance.
    			$aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField);
    			
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
    			} while($aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField));
    		}
    		else {
    			// Primero busca si está la columna, una sola vez, para mejorar la performance.
    			$aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField);
    			
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
    			} while($aField = @dbase_get_record_with_names($this->Result, ++$this->CurrentField));
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
		@dbase_close($this->Result);
		$this->TotalFields = 0;
		$this->CurrentField = 0;
	}
	
	/**
	 * Método no disponible en DbDriver_dBase
	 *
	 * @return false
	 */
	public function Begin() {
		$this->RuntimeError(13, 'DbDriver_dBase::Begin');
		return false;
	}
	
	/**
	 * Método no disponible en DbDriver_dBase
	 *
	 * @return false
	 */
	public function Commit() {
		$this->RuntimeError(13, 'DbDriver_dBase::Commit');
		return false;
	}
	
	/**
	 * Método no disponible en DbDriver_dBase
	 *
	 * @return bool
	 */
	public function Rollback() {
		$this->RuntimeError(13, 'DbDriver_dBase::Rollback');
		return false;
	}
	
	/**
	 * Método no disponible en DbDriver_dBase
	 *
	 * @return false
	 */
	public function GetLastError() {
		$this->RuntimeError(13, 'DbDriver_dBase::GestLastError');
		return false;
	}
	
	/**
	 * Getter.
	 * 
	 * Sólo permite usarse con:
	 * - CurrentField
	 *
	 * @param string $cProp
	 * @return mixed
	 */
	public function __get($cProp) {
		if ($cProp == 'CurrentField') {
			if (APP_DATABASE_ADDSLASHES) {
				return $this->AddSlashes(dbase_get_record_with_names($this->Result, $this->CurrentField-1));
			}
			else {
				return dbase_get_record_with_names($this->Result, $this->CurrentField-1);
			}
		}
		else {
			$this->RuntimeError(12, $cProp);
		}
	}
}
?>