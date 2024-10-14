<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	System
 * @author		Gabriel Luraschi
 * @since		Versión 5
 */

// ------------------------------------------------------------------------

/**
 * Clase base Model
 *
 * Esta clase abstracta es de donde deben heredar las clases <i>modelos</i> de la aplicación.
 *
 * @package		ClassLib
 * @subpackage 	System
 * @author		Gabriel Luraschi
 * @since		Version 5.0
 */
abstract class Model {
	/**
	 * Objeto para conexiones a bases de datos.
	 *
	 * @var Dbconnection
	 */
	protected $DB;
	
	/**
	 * Constructor de Model.
	 * 
	 */
	protected function __construct() {
		$this->DB = Dbconnection::factory();
	}
}
?>