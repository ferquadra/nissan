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
 * Función global de autocarga de clases.
 * Funciona con clases de ClassLib y modelos de la aplicación.
 *
 * @param string $cClase
 * @return void
 */

spl_autoload_register(function($cClase) {
	// Si la clase se encuentra en los objetos de ClassLib la carga desde su respectivo path.
	if (file_exists(APP_MODELS_PATH."/{$cClase}.mdl.php")) {
		require_once(APP_MODELS_PATH."/{$cClase}.mdl.php");
	}
	elseif (file_exists(APP_SYSTEM_PATH."/libraries/{$cClase}.php")) {
		require_once(APP_SYSTEM_PATH."/libraries/{$cClase}.php");
	}
	elseif (substr($cClase, -3) == 'Wgt') {
		$cArchivo = strtolower(substr($cClase, 0, -3)).'.wgt.php';
		if (file_exists(APP_APPLICATION_PATH."/widgets/{$cArchivo}")) {
			require_once(APP_APPLICATION_PATH."/widgets/{$cArchivo}");
		}
	}
});

/**
 * Función similar a addslashes() con la diferencia que toma un argumento por referencia.
 *
 * @param string & $cData
 * @return void
 */
function addslashesref(&$cData) {
	$cData = addslashes($cData);
}

// Este bloque de codigo es para proteger los scripts de inyeccion de codigo SQL.
/***
if (!get_magic_quotes_gpc()) {
	array_walk_recursive($_GET, 'addslashesref');
	array_walk_recursive($_POST, 'addslashesref');
	array_walk_recursive($_COOKIE, 'addslashesref');
}
****/
?>
