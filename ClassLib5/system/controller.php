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
 * Clase base Controller
 *
 * Esta clase abstracta es de donde deben heredar las clases <i>controladores</i> de la aplicación.
 *
 * @package		ClassLib
 * @subpackage 	System
 * @author		Gabriel Luraschi
 * @since		Version 5.0
 */
abstract class Controller {
	/**
	 * Propiedad para gestionar las plantillas.
	 *
	 * @var Template
	 */
	protected $Template;
	
	/**
	 * Propiedad con el buffer para compartir datos entre los distintos métodos del controlador.
	 * Generalmente es un array.
	 * 
	 *
	 * @var mixed
	 */
	protected $Buffer;
	
	/**
	 * Constructor de Controller.
	 * 
	 */
	protected function __construct() {
		$this->Template = new Template();
	}
}
?>