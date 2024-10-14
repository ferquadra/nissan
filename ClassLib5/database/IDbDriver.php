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
 * IDbDriver
 * 
 * Interface de Drivers para bases de datos.
 * 
 * @package ClassLib
 * @subpackage Database
 * @author Gabriel Luraschi
 */
interface IDbDriver {
	/**
	 * Devuelve una instancia de la clase de conexión a la base de datos.
	 * 
	 * Utiliza el patrón de diseño <i>Singleton</i>.
	 *
	 * @param string $cHost
	 * @param string $cUser
	 * @param string $cPass
	 * @param string $cDbName
	 * @return IDbDriver
	 */
	public static function _getInstance($cHost, $cUser, $cPass, $cDbName);
	
	/**
	 * Abre una base de datos.
	 * La conexión debe estar abierta.
	 *
	 * @param string $cBaseName
	 * @return bool
	 */
	public function Open($cBaseName=APP_DATABASE_NAME);
	
	/**
	 * Ejecuta una sentencia SQL.
	 *
	 * @param string $cSql
	 * @return bool
	 */
	public function Query($cSql);
	
	/**
	 * Ejecuta una sentencia SQL.
	 * Devuelve el ID autonumérico de la última fila insertada.
	 * Utilizar este método únicamente para sentencias INSERT.
	 *
	 * @param string $cSql
	 * @return int
	 */
	Public function QueryInsert($cSql);
	
	/**
	 * Devuelve una fila del resultado de una consulta en forma de array asociativo.
	 * Si se especifica el parametro <i>$cCol</i>, sólo devuelve el valor del campo indicado.
	 *
	 * @param string $cCol
	 * @return mixed
	 */
	public function Field($cCol=null);
	
	
	/**
	 * Devuelve la cantidad de registros de la última consulta.
	 *
	 * @return int
	 */
	public function Count();
	
	/**
	 * Devuelve la cantidad de registros alterados en la última consulta.
	 *
	 * @return int
	 */
	public function AffectedRows();
	
	
	/**
	 * Devuelve el próximo ID de la columna autonumérica de la tabla $cTabla.
	 * 
	 * <b>ATENCIÓN:</b> No disponible en todos los motores de bases de datos.
	 * 
	 * @param string $cTabla
	 * @return int
	 */
	public function NextInsertID($cTabla);
	
	/**
	 * Devuelve el recordset completo de la última consulta efectuada.
	 * Si se espeficica la columna se devuelve un array con sólo esa columna.
	 *
	 * @param string $cCol
	 */
	public function GetRecordset($cCol=null);
	
	
	/**
	 * Limpia el buffer de almacenamiento temporal.
	 *
	 * @return void
	 */
	public function Clear();
	
	/**
	 * Comienza una transacción.
	 *
	 * @return bool
	 */
	public function Begin();
	
	/**
	 * Comcreta o la transaccion abierta.
	 *
	 * @return bool
	 */
	public function Commit();
	
	/**
	 * Cancela la transacción abierta.
	 *
	 * @return bool
	 */
	public function Rollback();
	
	/**
	 * Devuelve el último mensaje de error.
	 *
	 * @return string
	 */
	public function GetLastError();
	
	/**
	 * Getter.
	 * 
	 * @param string $cProp
	 * @return mixed
	 */
	public function __get($cProp);
}
?>