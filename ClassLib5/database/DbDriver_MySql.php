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
 * DbDriver_MySql
 *
 * Driver de conexión a motores de bases de datos MySql.
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
class DbDriver_MySql implements IDbDriver {

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
	 * Nombre de la base de datos.
	 */
	private $Base;

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
		if (APP_DATABASE_PERSISTENT) $this->Link = @mysql_pconnect($cHost, $cUser, $cPass);
		else $this->Link = @mysql_connect($cHost, $cUser, $cPass);

		if ($this->Link === false) {
			$this->RuntimeError(1);

			if (APP_DATABASE_WIN32ALERT) {
				require_once(APP_SYSTEM_PATH.'/libraries/Win32.php');
				Win32::MsgBox('Error', "Se perdió conexión con el servidor, aguarde unos segundos e intente nuevamente.\n\nEn caso de persistir el problema será necesario revisar la conexión de la red local.");
				return false;
			}
		}

		// Si se especifico una codificacion determinada, se revisan TODAS las variables de codificacion en busca de
		// alguna que tenga otra codificacion
		// Si encuentra algo mal lo corrige
		if (APP_DATABASE_CHARSET) {
			// Revisa codificacion.
			$cSql = "SHOW VARIABLES LIKE 'character\_set\_%'";
			$sRes = @mysql_query($cSql, $this->Link);
			while ($aCharacter = @mysql_fetch_array($sRes)) {
				if ($aCharacter['Value'] != APP_DATABASE_CHARSET) {
					$aCharacter['Variable_name'].'<br>';
					$cSql = "SET {$aCharacter['Variable_name']} ='".APP_DATABASE_CHARSET."'";
					/*** Elimino porque esta variable de configuracion es de solo lectura y siempre da error.
					 * Fer 02/02/2022 :. Ticket en Webhostingbuzz 
					 * https://my.webhostingbuzz.com/viewticket.php?number=AFA-318321&token=89b6863ed80ac9b2c9ef78cd5af5fc0f9f9c2a13
					 * ****************************************
					if (!@mysql_query($cSql, $this->Link)) {
						$this->RuntimeError(2, $aCharacter['Variable_name']);
					}
					***/
				}

			}

			// Revisa colacion.
			$cSql = "SHOW VARIABLES LIKE 'collation%'";
			$sRes = @mysql_query($cSql, $this->Link);
			while ($aCharacter = @mysql_fetch_array($sRes)) {
				if ($aCharacter['Value'] != APP_DATABASE_COLLATE) {
					$aCharacter['Variable_name'].'<br>';
					$cSql = "SET {$aCharacter['Variable_name']} ='".APP_DATABASE_COLLATE."'";
					/*** Elimino porque esta variable de configuracion es de solo lectura y siempre da error.
					 * Fer 02/02/2022 :. Ticket en Webhostingbuzz 
					 * https://my.webhostingbuzz.com/viewticket.php?number=AFA-318321&token=89b6863ed80ac9b2c9ef78cd5af5fc0f9f9c2a13
					 * ****************************************
					if (!@mysql_query($cSql, $this->Link)) {
						$this->RuntimeError(3, $aCharacter['Variable_name']);
					}
					***/
				}

			}

			// Adicional
			@mysql_query("SET NAMES '".APP_DATABASE_CHARSET."';", $this->Link);
			@mysql_query("SET CHARACTER SET '".APP_DATABASE_COLLATE."';", $this->Link);
			@mysql_query("SET SESSION character_set_results = 'UTF8'", $this->Link);
		}

		// Abre la base de datos indicada.
		$this->Open($cDbName);
		$this->Base = $cDbName;
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
	 * Método interno para reportar errores.
	 *
	 * @param int $nErrNo
	 */
	private function RuntimeError($nErrNo) {
		$aArgs = func_get_args();
		switch ($nErrNo) {
			case 1:
				echo 'Imposible establecer conexion con el servidor.<br />'.@mysql_error();
				die;
				break;

			case 2:
				echo 'No se ha podido establecer la codificacion '.APP_DATABASE_CHARSET.' para la variable '.$aArgs[1].'<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
				die;
				break;

			case 3:
				echo 'No se ha podido establecer la colacion '.APP_DATABASE_COLLATE.' para la variable '.$aArgs[1].'<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
				die;
				break;

			case 4:
				echo 'No se puede abrir la base de datos '.$aArgs[1].'<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
				die;
				break;

			case 5:
				echo 'Se produjo una falla en la instruccion '.$aArgs[1].'<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
				die;
				break;

			case 6:
				echo 'La columna <u>'.$aArgs[1].'</u> no existe en el resultado de la consulta.';
				die;
				break;

			case 7:
				 	echo 'No se puede obtener la cantidad de registros devueltos por la ultima consulta SQL.<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
					die;
				break;

			case 8:
				 	echo 'No se pudo realizar con exito la transaccion<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
					die;
				break;

			case 9:
				 	echo 'Error al buscar el proximo ID autonumero en la tabla <u>'.$aArgs[1].'</u><br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
					die;
				break;

			case 10:
				 	echo 'Error al obtener la cantidad de filas afectadas en la ultima consulta SQL.<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
					die;
				break;

			case 11:
				 	echo 'Error al obtener un registro.<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
					die;
				break;

			case 12:
				 	echo "La propiedad {$aArgs[1]} no existe.";
					die;
				break;

			default:
				echo 'Error de MySql indefinido.<br />'.($this->Link ? @mysql_error($this->Link) : @mysql_error());
				die;

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
	 * @param string $cBaseName
	 * @return bool
	 */
	public function Open($cBaseName=APP_DATABASE_NAME) {
		if(@mysql_select_db($cBaseName, $this->Link)) {
			return true;
		}
		else {
			$this->RuntimeError(4, $cBaseName);
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
		
		$aClaves = array('CONCAT(', 'UNION SELECT','UNION ALL', ' CHAR(', 'name_const', 'unhex');

		foreach($aClaves as $item){
			if(stristr($cSql, $item)) {
				$log = date("Y-m-d H:i:s")."== ".$item. " ================================================\n";
				$log .= $_SERVER['REMOTE_ADDR']."\n";
				$log .= "BASE: ".$this->Base."\n";
				$log .= $cSql."\n\n";
				file_put_contents('consultas_maliciosas.txt', $log, FILE_APPEND);
				BloquearIP("Consulta SQL maliciosa: ".$cSql);
				return false;
			}
		}

		$this->CurrentField = null;
		$this->Result = @mysql_query($cSql, $this->Link);

		if ($this->StartedTransaction && !$this->Result) {
			$this->TransactionErrors[] = @mysql_error($this->Link);
		}

		if ($this->Result) {
			return true;
		}
		else {
			//$this->RuntimeError(5, $cSql);
			//echo "ERROR ".$cSql;
			$log = date("Y-m-d H:i:s")."============================================================\n";
			$log .= $_SERVER['REMOTE_ADDR']."  ================\n";
			$log .= "BASE: ".$this->Base."\n";
			$log .= $cSql."\n";
			file_put_contents('log_error_DbDriver_MySql.txt', $log, FILE_APPEND);
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
		return @mysql_insert_id($this->Link);
	}

	/**
	 * Devuelve una fila del resultado de una consulta en forma de array asociativo.
	 * Si se especifica el parametro <i>$cCol</i>, sólo devuelve el valor del campo indicado.
	 *
	 * @param string $cCol
	 * @return mixed
	 */
	public function Field($cCol=null) {
		$aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC);

		if ($aField === null) {
			$this->RuntimeError(11);
			return $this->CurrentField = false;
		}

		if($aField === false) {
			return $this->CurrentField = false;
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
		$nCount = @mysql_num_rows($this->Result);

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
		$nRet = @mysql_affected_rows($this->Link);
		if ($nRet === null) {
			$this->RuntimeError(10);
		}

		return $nRet;
	}

	/**
	 * Devuelve el próximo ID de la columna autonumérica de la tabla $cTabla.
	 *
	 * <b>ATENCIÓN:</b> No disponible en todos los motores de bases de datos.
	 *
	 * @param string $cTabla
	 * @return int
	 * @todo Hacer reingeniería y captura de errores.
	 */
	public function NextInsertID($cTabla) {
		// Hace la consulta para obtener los datos.
		$cSql = "SHOW TABLE STATUS LIKE '$cTabla'";
		$sResult = mysql_query($cSql, $this->Link);

		// Si la consulta devolvio error lo genera.
		if (!$sResult) {
			$this->RuntimeError(9, $cTabla);
			return false;
		}

		// Si la consulta fue satisfactoria devuelve el proximo ID.
		if (@mysql_num_rows($sResult)) {
			$aData = @mysql_fetch_array($sResult, MYSQL_BOTH);
			if (!@$aData[0]) {
				$this->RuntimeError(9, $cTabla);
				return false;
			}
			else {
				return $aData['Auto_increment'];
			}
		}
		else {
			$this->RuntimeError(9, $cTabla);
			return false;
		}
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
				while($aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC)) { $aRet[] = $this->AddSlashes($aField); }
    		}
    		else {
				while($aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC)) { $aRet[] = $aField; }
    		}
		}
		else {
    		// El if para ver si tiene que escapar lo hace por fuera del bucle para mejorar la performance.
    		if (APP_DATABASE_ADDSLASHES) {
    			// Primero busca si está la columna, una sola vez, para mejorar la performance.
    			$aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC);

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
    			} while($aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC));
    		}
    		else {
    			// Primero busca si está la columna, una sola vez, para mejorar la performance.
    			$aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC);

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
    			} while($aField = @mysql_fetch_array($this->Result, MYSQL_ASSOC));
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
		@mysql_free_result($this->Result);
	}

	/**
	 * Comienza una transacción.
	 *
	 * @return bool
	 */
	public function Begin() {
		$this->StartedTransaction = true;
		return $this->Query('START TRANSACTION');
	}

	/**
	 * Comcreta la transacción abierta.
	 *
	 * @return bool
	 */
	public function Commit() {
		$this->StartedTransaction = false;
		return $this->Query('COMMIT');
	}

	/**
	 * Cancela la transacción abierta.
	 *
	 * @return bool
	 */
	public function Rollback() {
		$this->StartedTransaction = false;
		$nRet = $this->Query('ROLLBACK');
	}

	/**
	 * Devuelve el último mensaje de error.
	 *
	 * @return string
	 */
	public function GetLastError() {
		$total = 0;
		if(is_array($this->TransactionErrors)){
			$total = count($this->TransactionErrors)-1;
		}
		if(!is_array($this->TransactionErrors)){
			$this->TransactionErrors = array(0 => false);
		}
		return $this->TransactionErrors[$total];
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
