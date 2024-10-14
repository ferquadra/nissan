<?php
/**
 * @desc
 * Driver de coneccion a motores de bases de datos a través de ODBC.
 *
 */
class DbDriver_ODBC {
	
	/**
	 * @desc
	 * Link de conexion a la base de datos.
	 *
	 * @var Resource
	 */
	private $Link;
	
	/**
	 * @desc
	 * Link de resultado de base de datos.
	 *
	 * @var Resource
	 */
	private $Result;
	
	/**
	 * Constructor.
	 *
	 * @return DbDriver_ODBC
	 */
	function __construct() {}
	
	function __destruct() {
		odbc_close($this->Link);
	}
	
	/**
	 * Inicializa el motor comun de ejecucion.
	 *
	 * @param string $DSN
	 */
	public function Initialize($DSN) {
		$this->Link = odbc_connect($DSN);
		return true;
	}
	
	/**
	 * Abre una base de datos.
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
	 * Ejecuta una consulta SQL.
	 *
	 * @param string $cSql
	 * @return int
	 */
	public function Query($cSql) {
		$this->Result = @mysql_query($cSql, $this->Link);
		
		if ($this->Result) {
			return true;
		}
		else {
			$this->RuntimeError(5, $cSql);
			return false;
		}
	}
	
	/**
	 * @desc
	 * Ejecuta una consulta SQL y devuelve el ID de la columna autonumerica
	 * del registro insertado.
	 *
	 * @param string $cSql
	 * @return int
	 */
	public function QueryInsert($cSql) {
		$this->Query($cSql);
		return mysql_insert_id($this->Link);
	}
	
	/**
	 * @desc
	 * Extrae una fila del resultado de una consulta y la devuelve
	 * en forma de array.
	 * Si se especifica el parametro <i>$vCampo</i>, solo se devuelve el
	 * valor del campo indicado.
	 *
	 * @param mixed $vCampo
	 * @return array
	 */
	public function Field($vCampo=null) {
		$aField = mysql_fetch_array($this->Result, MYSQL_ASSOC);
		
		if($aField === false) {
			return false;
		}
		
		if($vCampo === null) {
			return $aField;
		}
		
		if(array_key_exists($vCampo, $aField)) {
			return $aField[$vCampo];
    	}
		else {
			$this->RuntimeError(6, $vCampo);
			return false;
    	}
	}
	
	/**
	 * Devuelve la cantidad de registros de la ultima consulta.
	 *
	 * @return int
	 */
	public function Count() {
		$nCount = mysql_num_rows($this->Result);
		
		if ($nCount !== null) {
			return $nCount;
		}
		else {
			$this->RuntimeError(7);
			return null;
		}
		
	}
	
	/**
	 * Comienza una transaccion.
	 *
	 * @return bool
	 */
	public function Begin() {
		return $this->Query('START TRANSACTION');
	}
	
	/**
	 * Comcreta o envia la transaccion comenzada.
	 *
	 * @return bool
	 */
	public function Commit() {
		return $this->Query('COMMIT');
	}
	
	/**
	 * Cancela la transaccion comenzada.
	 *
	 * @return bool
	 */
	public function Rollback() {
		$nRet = $this->Query('ROLLBACK');
		if ($nRet === false) {
			$this->RuntimeError(8);
		}
	}
	
	/**
	 * Devuelve el proximo ID de la columna autonumerica de la tabla $cTabla.
	 *
	 * @param string $cTabla
	 * @return int
	 */
	public function NextInsertID($cTabla) {
		// Hace la consulta para obtener los datos.
		$cSql = "SHOW TABLE STATUS LIKE '$cTabla'";
		$sResult = mysql_query($cSql, $this->Link);
		
		// Si la consulta devolvio error lo genera.
		if (!$sResult) {
			$this->RuntimeError(9, $cTabla);
			return null;
		}
		
		// Si la consulta fue satisfactoria devuelve el proximo ID.
		if (mysql_num_rows($sResult)) {
			$aData = mysql_fetch_array($sResult, MYSQL_BOTH);
			if (!@$aData[0]) {
				$this->RuntimeError(9, $cTabla);
				return null;
			}
			else {
				return $aData['Auto_increment'];
			}
		}
		else {
			$this->RuntimeError(9, $cTabla);
			return null;
		}
	}
	
	/**
	 * @desc
	 * Devuelve el recordset completo de la ultima consulta efectuada.
	 * Si se espeficica la columna se devuelve solo esa columna.
	 *
	 * @param string $cCol
	 * @return array
	 * @deprecated Este metodo se dejara de usar.
	 */
	public function GetRecordset($cCol=null) {
		$aRet = array();
    	
    	// Ciclo por todos los registros, si especifico $col obtengo solo
    	// esa columna, checkeando que exista.
    	
    	if($cCol !== null) {
			while($aux = $this->Field()) {
				
				if(!isset($aux[$cCol])) {
					$this->RuntimeError(6, $cCol);
					return false;
				}
				
				$aRet[] = @$aux[$cCol];
			}
		}
		else {
			while($aux = $this->Field()) {
				$aRet[] = $aux;
			}
		}
      
    	return $aRet;
	}
	
	/**
	 * Limpia el buffer de almacenamiento temporal.
	 *
	 * @access private
	 */
	public function Clear() {
		mysql_free_result($this->Link);
	}
	
	/**
	 * Devuelve la cantidad de filas afectadas en la ultima consulta.
	 *
	 * @return int
	 */
	public function AffectedRows() {
		$nRet = mysql_affected_rows($this->Link);
		if ($nRet === null) {
			$this->RuntimeError(10);
		}
		
		return $nRet;
	}
	
	/**
	 * Devuelve el ultimo mensaje de error ocurrido o una cadena vacia
	 * en caso de no haber error.
	 *
	 * @return string
	 */
	public function GetLastError() {
		return mysql_error($this->Link);
	}
	
	/**
	 * @desc
	 * Funcion interna para reportar errores.
	 *
	 * @param int $nErrNo
	 */
	private function RuntimeError($nErrNo) {
		$aArgs = func_get_args();
		switch ($nErrNo) {
			case 1:
				error::Raise(E_WARNING, "Imposible establecer conexion con el servidor.<br >MySql Dice: ".mysql_error($this->Link));
				break;
				
			case 2:
				error::Raise(E_WARNING, 'No se ha podido establecer la codificaci&oacute;n '.APP_DATABASE_CHARSET.' para la variable '.$aArgs[1].'<br />'.mysql_error($this->Link));
				break;
				
			case 3:
				error::Raise(E_WARNING, 'No se ha podido establecer la colaci&oacute;n '.APP_DATABASE_COLLATE.' para la variable '.$aArgs[1].'<br />'.mysql_error($this->Link));
				break;
				
			case 4:
				error::Raise(E_WARNING, 'No se puede abrir la base de datos '.$aArgs[1].'<br />'.mysql_error($this->Link));
				break;
				
			case 5:
				error::Raise(E_WARNING, 'Se produjo una falla en la instruccion '.$aArgs[1].'<br />'.mysql_error($this->Link));
				break;
				
			case 6:
				error::Raise(E_WARNING, 'La columna <u>'.$aArgs[1].'</u> no existe en el resultado de la consulta.');
				break;
				
			case 7:
				error::Raise(E_WARNING, 'No se puede obtener la cantidad de registros devueltos por la ultima consulta SQL.<br />'.mysql_error($this->Link));
				break;
				
			case 8:
				error::Raise(E_WARNING, 'No se pudo realizar con exito la transaccion<br />'.mysql_error($this->Link));
				break;
				
			case 9:
				error::Raise(E_WARNING, 'Error al buscar el proximo ID autonumero en la tabla <u>'.$aArgs[1].'</u><br />'.mysql_error($this->Link));
				break;
				
			case 10:
				error::Raise(E_WARNING, 'Error al obtener la cantidad de filas afectadas en la ultima consulta SQL.<br />'.mysql_error($this->Link));
				break;
				
			default:
				error::Raise(E_ERROR, 'Error de MySql indefinido.<br />'.mysql_error($this->Link));
				
		}
	}
}
?>