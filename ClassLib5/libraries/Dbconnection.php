<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author		Gabriel Luraschi
 * @since		Versión 5
 */

// ------------------------------------------------------------------------

/**
 * Dbconnection
 * 
 * Conexiones a motores de bases de datos.
 * 
 * Utiliza los patrones de diseño <i>Singleton</i> y <i>Factory</i>.
 * 
 * Desde la revisión 69 está optimizada para obtener un rendimiento un 60% mayor
 * al usar el método Dbconnection::factory(); en vez de instanciar la clase.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi
 * @uses DbDriver_Ibase
 * @uses DbDriver_MsSql
 * @uses DbDriver_MySql
 * @uses DbDriver_SqlSrv
 * @uses IDbDriver
 */
class Dbconnection {
	
	/**
	 * Mantiene referencia al Driver para efectuar las consultas.
	 *
	 * @var IDbDriver
	 */
	private $DbDriver;
	
	/**
	 * Contiene el registro actual.
	 * Puede ser un array (fila entera) o un dato (celda).
	 *
	 * @var mixed
	 */
	public $CurrentField;
	
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
	 * Instancia el objeto Dbconnection.
	 *
	 * @param string $cHost
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 * @param string $cDriver
	 * @deprecated Usar el método <i>factory()</i> en vez de instanciar este objeto.
	 */
	function __construct($cHost=APP_DATABASE_HOST, $cUser=APP_DATABASE_USER, $cPass=APP_DATABASE_PASS, $cDbName=APP_DATABASE_NAME, $cDriver=APP_DATABASE_DRIVER) {
		$this->DbDriver = $this->_factory($cDriver, $cHost, $cUser, $cPass, $cDbName);
	}
	
	/**
	 * Devuelve el Singleton del Driver específico segun la cadena de conexión.
	 * 
	 * @param string $cHost
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 * @param string $cDriver
	 * @return IDbDriver
	 */
	private function _factory($cDriverName, $cHost, $cUser, $cPass, $cDbName) {
		return self::factory($cHost, $cUser, $cPass, $cDbName, $cDriverName);
	}
	
	/**
	 * Método estático para obtener un Singleton de la clase de conexión al motor usado.
	 * Utilizar este método mejora la performance en lugar de instanciar la clase <i>Dbconnection</i>.
	 *
	 * @param string $cHost
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 * @param string $cDriver
	 * @return IDbDriver
	 */
	public static function factory($cHost=APP_DATABASE_HOST, $cUser=APP_DATABASE_USER, $cPass=APP_DATABASE_PASS, $cDbName=APP_DATABASE_NAME, $cDriver=APP_DATABASE_DRIVER) {
		// Si es un driver soportado por ClassLib lo carga dinámicamente.
		$cClass = "DbDriver_{$cDriver}";
		
		if (file_exists(APP_SYSTEM_PATH."/database/{$cClass}.php")) {
			require_once(APP_SYSTEM_PATH."/database/{$cClass}.php");
			return call_user_func("{$cClass}::_getInstance", $cHost, $cUser, $cPass, $cDbName);
		}
		else {
			Error::Raise(1, "ClassLib no soporta el uso del driver {$cDriverName}", '', 0, array());
			return null;
		}
	}
	
	/**
	 * Abre una base de datos.
	 *
	 * @param string $cBaseName
	 * @return bool
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Open($cBaseName=null) {
		return $this->DbDriver->Open($cBaseName);
	}
	
	/**
	 * Ejecuta una consulta SQL.
	 *
	 * @param string $cSql
	 * @return int
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Query($cSql) {
		/* DESCOMENTAR PARA SU USO 
		$sFp = fopen(APP_DATABASE_QUERYLOG, 'a+');
		fwrite($sFp, "{$cSql}\n\n");
		fclose($sFp);
		*/
		$this->CurrentField = null;
		$nRet = $this->DbDriver->Query($cSql);
		
		if ($this->StartedTransaction && !$nRet) {
			$this->TransactionErrors[] = $this->DbDriver->GetLastError();
		}
		
		return $nRet;
	}
	
  	/**
  	 * Ejecuta una consulta SQL sobre la base de datos abierta.
  	 * Este método es identico a Query(), con la diferencia que devuelve
  	 * el ID de la columna autonumérica de la éltima consulta INSERT efectuada.
  	 *
  	 * @param string $cSql
  	 * @return int
  	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
  	 */
	public function QueryInsert($cSql) {
		$this->CurrentField = null;
		$nRet = $this->DbDriver->QueryInsert($cSql);
		
		if ($this->StartedTransaction && !$nRet) {
			$this->TransactionErrors[] = $this->DbDriver->GetLastError();
		}
		
		return $nRet;
	}
	
	/**
	 * Extrae una fila del resultado de una consulta y la devuelve en forma de array asociativo.
	 * Si se especifica el parametro <i>$campo</i>, sólo se devuelve el valor del campo indicado.
	 *
	 * @param mixed $vCampo
	 * @return mixed
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Field($vCampo=null) {
		// Primero se vuelca el registro en la propiedad y despues se devuelve
		// el dato solicitado.
		$this->CurrentField = $this->DbDriver->Field($vCampo);
		
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
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Count() {
		return $this->DbDriver->Count();
	}
	
	/**
	 * Comienza una transacción.
	 *
	 * @return bool
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Begin() {
		$this->StartedTransaction = true;
		$this->TransactionErrors = array();
		return $this->DbDriver->Begin();
	}
	
	/**
	 * Comcreta la transacción abierta.
	 *
	 * @return bool
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Commit() {
		$this->StartedTransaction = false;
		return $this->DbDriver->Commit();
	}
	
	/**
	 * Cancela la transacción abierta.
	 *
	 * @return bool
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function Rollback() {
		$this->StartedTransaction = false;
		return $this->DbDriver->Rollback();
	}
	
	/**
	 * Devuelve el proximo ID de la columna autonumérica de la tabla $cTabla.
	 *
	 * @param string $cTabla
	 * @return int
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function NextInsertID($cTabla) {
		return $this->DbDriver->NextInsertID($cTabla);
	}
	
	/**
	 * Devuelve el recordset completo de la última consulta efectuada.
	 * Si se espeficica la columna se devuelve sólo esa columna.
	 *
	 * @param string $cCol
	 * @return array
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
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
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	private function Clear() {
		$this->CurrentField = null;
		$this->DbDriver->Clear();
	}
	
	/**
	 * Devuelve la cantidad de filas afectadas en la última consulta SQL.
	 *
	 * @return int
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function AffectedRows() {
		return $this->DbDriver->AffectedRows();
	}
	
	/**
	 * Agrega barras invertidas a $mData ya sea una cadena o un array.
	 *
	 * @param mixed $mData
	 * @return mixed
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	private function AddSlashes($mData) {
		if (is_array($mData)) {
			$mData = array_map('addslashes', $mData);
		}
		elseif ($mData !== false) {
			$mData = addslashes($mData);
		}
		
		return $mData;
	}
	
	/**
	 * Devuelve el último mensaje de error ocurrido o una cadena vacía en caso de no haber error.
	 *
	 * @return string
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	public function GetLastError() {
		return $this->TransactionErrors;
	}
	
	/**
	 * Método interno para reportar errores.
	 *
	 * @param int $nErrNo
	 * @deprecated Este método es usado en instancias de Dbconnection, se recomienda utilizar <i>factory()</i> en su lugar.
	 */
	private function RuntimeError($nErrNo) {
		$aArgs = func_get_args();
		switch ($nErrNo) {
			case 6:
				error::Raise(E_WARNING, 'La columna <u>'.$aArgs[1].'</u> no existe en el resultado de la consulta.');
				break;
		}
	}
}
?>