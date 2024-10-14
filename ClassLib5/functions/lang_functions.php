<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Helpers
 * @author		Gabriel Luraschi
 * @since		Versión 5
 * @ignore 
 */

// ------------------------------------------------------------------------

/**
 * Funciones de idioma ClassLib 
 *
 * @package		ClassLib
 * @subpackage	Helpers
 * @author		Gabriel Luraschi
 */

// ------------------------------------------------------------------------

if (! function_exists('LANG')) {
	/**
	 * Devuelve una etiqueta de idioma.
	 *
	 * @access	public
	 * @return	string
	 */
	function LANG($cTexto) {
		if (isset($GLOBALS['LANGUA'][$cTexto])) {
			return $GLOBALS['LANGUA'][$cTexto];
		}
		else {
			return $cTexto;
		}
	}
}

// ------------------------------------------------------------------------
?>