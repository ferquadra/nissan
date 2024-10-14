<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Core
 * @author		Gabriel Luraschi
 * @since		Versión 5
 * @ignore
 */

// ------------------------------------------------------------------------

// Define las constantes requeridas.
	/**
	 * Path hacia ClassLib.
	 *
	 */
	define('APP_SYSTEM_PATH', 				$system_folder);
	
	/**
	 * URL hacia ClassLib.
	 *
	 */
	define('APP_SYSTEM_URL',				@$system_url);
	
	/**
	 * Path hacia la carpeta <i>addons</i> dentro de ClassLib.
	 *
	 */
	define('APP_ADDONS_PATH', 				$system_folder.'/addons');
	
	/**
	 * Path hacia la carpeta <i>functions</i> dentro de ClassLib.
	 *
	 */
	define('APP_FUNCTIONS_PATH',			$system_folder.'/functions');
	
	/**
	 * Path hacia la aplicación.
	 *
	 */
	define('APP_APPLICATION_PATH', 		$application_folder);
	
	/**
	 * Path hacia la carpeta de modelos de la aplicación.
	 *
	 */
	define('APP_MODELS_PATH', 				@$models_folder);
	
// Carga el procesador de controlador y librerias indispensables.
	require_once(APP_SYSTEM_PATH.'/system/main.php');
	require_once(APP_SYSTEM_PATH.'/libraries/Error.php');
	
// Carga la configuracion de la aplicacion.
	if (file_exists(APP_APPLICATION_PATH.'/config/config.php')) {
		require_once(APP_APPLICATION_PATH.'/config/config.php');
	}
	require_once(APP_SYSTEM_PATH.'/config/general.php');
	
// Establece el manipulador de errores, si se esta depurando lo omite.
	if (!isset($_COOKIE['debug_host'])) {
		set_error_handler(array('Error', 'Handler'), error_reporting());
	}
	
// Carga el procesador del entorno MVC y cede el control.
	require_once(APP_SYSTEM_PATH.'/system/model.php');
	require_once(APP_SYSTEM_PATH.'/system/controller.php');
?>