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
 * DbDriver_PDO
 * 
 * Driver de conexión a motores de bases de datos con entorno PDO.
 * 
 * Utiliza el patrón de diseño <i>Singleton</i>.
 * 
 * @package ClassLib
 * @subpackage Database
 * @author Gabriel Luraschi
 * @since Version 5r91
 * @uses IDbDriver
 * @property mixed $CurrentField Contiene el registro actual.
 * @property mixed $TransactionErrors Contiene un array con errores ocurridos durante una transacción.
 * @property mixed $StartedTransaction Indica si hay una transacción abierta.
 */
class DbDriver_PDO implements IDbDriver {
	
	/**
	 * Propiedad estática con las instancias creadas.
	 *
	 * @var array
	 */
	private static $Instances=array();
	
	/**
	 * Link de conexión a la base de datos.
	 *
	 * @var PDO
	 */
	private $Link;
	
	/**
	 * Link de resultado de base de datos.
	 *
	 * @var PDOStatement
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

	public function Open($cBaseName=APP_DATABASE_NAME) {
		return true;
	}
	
	/**
	 * Es singleton, no se puede clonar la clase.
	 *
	 */
	private function __clone() {}
	
	/**
	 * Inicializa el motor y conecta a la DB.
	 * 
	 * EJ: Initialize("mysql:server=localhost;port=3306", "root", "", "nombre_db");
	 *
	 * @param string $cDSN
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 * @param array $aOptions
	 * @return bool
	 */
	private function Initialize($cDSN, $cUser, $cPass, $cDbName, $aOptions=null) {
		
		// La constante de conexión persistente se agrega al array de opciones.
		$aOptions[PDO::ATTR_PERSISTENT] = APP_DATABASE_PERSISTENT;
		if (APP_DATABASE_CHARSET) {
			$aOptions[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES '".APP_DATABASE_CHARSET."'";
		}
		
		// Agrega el nombre de la base de datos al DNS, no está ahí por compatibilidad con los drivers nativos.
		$cDSN .= ";dbname={$cDbName}";
		
		// Realiza la conexión.
		try {
			$this->Link = new PDO($cDSN, $cUser, $cPass, $aOptions);
		}
		catch (Exception $e) {
			$this->RuntimeError(1);
			
			if (APP_DATABASE_WIN32ALERT) {
				require_once(APP_SYSTEM_PATH.'/libraries/Win32.php');
				Win32::MsgBox('Error', "Se perdió conexión con el servidor, aguarde unos segundos e intente nuevamente.\n\nEn caso de persistir el problema será necesario revisar la conexión de la red local.", Win32::MSGBOX_BUTTON_OK | Win32::MSGBOX_ICON_ERROR | Win32::MSGBOX_DEFBUTTON_1 | Win32::MSGBOX_MODAL_SYSTEM | Win32::MSGBOX_SERVICE_NOTIFICATION | Win32::MSGBOX_TOPMOST);
			}
			
			return false;
		}
		
		return true;
	}
	
	/**
	 * Método interno para reportar errores.
	 *
	 * @param int $nErrNo
	 */
	private function RuntimeError($nErrNo) {
		$aArgs = func_get_args();
		
		if ($this->Link) {
			$aError = @$this->Link->errorInfo();
		}
		else {
			$aError[2] = 'No se puede obtener informacion de depuracion';
		}
		
		switch ($nErrNo) {
			case 1:
				echo 'Imposible establecer conexion con el servidor.<br />'.$aError[2];
				die;
				break;
				
			case 2:
				break;
				
			case 3:
				break;
				
			case 4:
				break;
				
			case 5:
				error::Raise(E_WARNING, 'Se produjo una falla en la instruccion '.$aArgs[1].'<br />'.$aError[2]);
				break;
				
			case 6:
				error::Raise(E_WARNING, 'La columna <u>'.$aArgs[1].'</u> no existe en el resultado de la consulta.');
				break;
				
			case 7:
				error::Raise(E_WARNING, 'No se puede obtener la cantidad de registros devueltos por la ultima consulta SQL.<br />'.$aError[2]);
				break;
				
			case 8:
				error::Raise(E_WARNING, 'No se pudo realizar con exito la transaccion<br />'.$aError[2]);
				break;
				
			case 9:
				break;
				
			case 10:
				error::Raise(E_WARNING, 'Error al obtener la cantidad de filas afectadas en la ultima consulta SQL.<br />'.$aError[2]);
				break;
				
			case 11:
				error::Raise(E_WARNING, 'Error al obtener un registro.<br />'.$aError[2]);
				break;
				
			case 12:
				error::Raise(E_WARNING, "La propiedad {$aArgs[1]} no existe.");
				break;
				
			case 13:
				error::Raise(E_WARNING, "Metodo <u>{$aArgs[1]}</u> no disponible.");
				break;
				
			case 14:
				error::Raise(E_WARNING, "No hay un resultado de consulta para obtener datos.");
				break;
				
			default:
				error::Raise(E_ERROR, 'Error de PDO indefinido.<br />'.$aError[2]);
				
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
	 * Ejecuta una sentencia SQL.
	 *
	 * @param string $cSql
	 * @return bool
	 */
	public function Query($cSql) {
		$this->CurrentField = null;
		
		// Para evitar error cierra el cursor de la consulta anterior antes de ejecutar la próxima.
		if ($this->Result) {
			$this->Result->closeCursor();
		}
		
		// Ejecuta la consulta.
		$this->Result = @$this->Link->query($cSql);
		
		if ($this->StartedTransaction && !$this->Result) {
			$this->TransactionErrors[] = @$this->Link->errorInfo();
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
	 * Ejecuta una sentencia SQL.
	 * 
	 * Devuelve el ID autonumérico de la última fila insertada.
	 * Utilizar este método únicamente para sentencias INSERT.
	 *
	 * @param string $cSql
	 * @return int
	 */
	public function QueryInsert($cSql) {
		$this->Query($cSql);
		return @$this->Link->lastInsertId();
	}
	
	/**
	 * Devuelve una fila del resultado de una consulta en forma de array asociativo.
	 * Si se especifica el parametro <i>$cCol</i>, sólo devuelve el valor del campo indicado.
	 *
	 * @param string $cCol
	 * @return mixed
	 */
	public function Field($cCol=null) {
		// Si no hay datos devuelve un array vacío e informa del error.
		if (!$this->Result) {
			$this->RuntimeError(14);
			return array();
		}
		
		$aField = @$this->Result->fetch(PDO::FETCH_ASSOC);
		
		if ($aField === false) {
			return $this->CurrentField = false;
		}
		
		if($cCol === null) {
			$this->CurrentField = $aField;
			
			if (APP_DATABASE_ADDSLASHES) {
				array_walk_recursive($this->CurrentField, 'addslashesref');
			}
		}
		elseif(array_key_exists($cCol, $aField)) {
			$this->CurrentField = $aField[$cCol];
			
			if (APP_DATABASE_ADDSLASHES) {
				$this->CurrentField = addslashes($this->CurrentField);
			}
    	}
		else {
			$this->RuntimeError(6, $cCol);
			$this->CurrentField = false;
    	}
    	
		return $this->CurrentField;
	}
	
	/**
	 * Devuelve la cantidad de registros de la última consulta.
	 *
	 * @return int
	 */
	public function Count() {
		// Si no hay datos devuelve un array vacío e informa del error.
		if (!$this->Result) {
			$this->RuntimeError(14);
			return array();
		}
		
		$nCount = @$this->Result->rowCount();
		
		if ($nCount !== false) {
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
		// Si no hay datos devuelve un array vacío e informa del error.
		if (!$this->Result) {
			$this->RuntimeError(14);
			return array();
		}
		
		$nRet = @$this->Result->rowCount();
		if ($nRet === false) {
			$this->RuntimeError(10);
		}
		
		return $nRet;
	}
	
	/**
	 * Método no disponible en DbDriver_PDO
	 * 
	 * @param string $cTabla
	 * @return false
	 */
	public function NextInsertID($cTabla) {
		$this->RuntimeError(13, 'DbDriver_PDO::NextInsertID');
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
		// Si no hay datos devuelve un array vacío e informa del error.
		if (!$this->Result) {
			$this->RuntimeError(14);
			return array();
		}
		
    	// Obtiene resultados.
    	if($cCol === null) {
    		$aRet = @$this->Result->fetchAll(PDO::FETCH_ASSOC);
		}
		else {
			$nColumnas = @$this->Result->columnCount();
			
			$nError = true;
			for ($i=0; $i<$nColumnas; ++$i) {
				$aCol = @$this->Result->getColumnMeta($i);
				if ($aCol['name'] == $cCol) {
					$aRet = @$this->Result->fetchAll(PDO::FETCH_COLUMN, $i);
					$nError = false;
					break;
				}
			}
			
			if ($nError) {
				$this->RuntimeError(6, $cCol);
				return false;
			}
		}
		
		if (APP_DATABASE_ADDSLASHES) {
			array_walk_recursive($aRet, 'addslashesref');
		}
		
		return $aRet;
	}
	
	/**
	 * Limpia el buffer de almacenamiento temporal.
	 *
	 * @return void
	 */
	public function Clear() {
		if ($this->Result) {
			$this->CurrentField = null;
			@$this->Result->closeCursor();
		}
	}
	
	/**
	 * Comienza una transacción.
	 *
	 * @return bool
	 */
	public function Begin() {
		try {
			$this->StartedTransaction = $this->Link->beginTransaction();
		}
		catch (Exception $e) {
			$this->RuntimeError(8);
			return false;
		}
		
		return true;
	}
	
	/**
	 * Comcreta la transacción abierta.
	 *
	 * @return bool
	 */
	public function Commit() {
		try {
			$this->Link->commit();
		}
		catch (Exception $e) {
			$this->RuntimeError(8);
			return false;
		}
		
		$this->StartedTransaction = false;
		return true;
	}
	
	/**
	 * Cancela la transacción abierta.
	 *
	 * @return bool
	 */
	public function Rollback() {
		try {
			$this->Link->rollBack();
		}
		catch (Exception $e) {
			$this->RuntimeError(8);
			return false;
		}
		
		$this->StartedTransaction = false;
		return true;
	}
	
	/**
	 * Devuelve el último mensaje de error.
	 *
	 * @return string
	 */
	public function GetLastError() {
		if ($this->Link) {
			$aError = @$this->Link->errorInfo();
			return $aError[2];
		}
		else {
			return '';
		}
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
			return null;
		}
	}
}
?>