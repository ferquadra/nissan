<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Core
 * @author		Gabriel Luraschi
 * @since		Versión 1
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
//	require_once(APP_SYSTEM_PATH.'/libraries/Error.php');

// Carga la configuracion de la aplicacion.
	if (file_exists(APP_APPLICATION_PATH.'/config/config.php')) {
		require_once(APP_APPLICATION_PATH.'/config/config.php');
	}
	require_once(APP_SYSTEM_PATH.'/config/general.php');

// Establece el manipulador de errores, si se esta depurando lo omite.
	//if (!isset($_COOKIE['debug_host'])) {
//		set_error_handler(array('Error', 'Handler'), error_reporting());
	//}

// Carga el procesador del entorno MVC y cede el control.
	require_once(APP_SYSTEM_PATH.'/system/model.php');
	require_once(APP_SYSTEM_PATH.'/system/controller.php');

/* #################### PARSER DE URL #################### */

	// Si se especifica el URLPARSER usa ese en vez del que viene por defecto.
	// Por ello sale del manager una vez cargue el urlparser.
	if (file_exists(APP_APPLICATION_PATH.'/urlparser.php')) {
		include(APP_APPLICATION_PATH.'/urlparser.php');
		return;
	}


	

// Define el controlador y metodo que se intenta cargar.
	$CONTROLLER = APP_DEFAULT_CONTROLLER;
	$METHOD = APP_DEFAULT_METHOD;

	if (isset($_GET['p'])) {
		$aTmp = explode('|', $_GET['p']);
		$CONTROLLER = $aTmp[0];
		if (isset($aTmp[1]) && $aTmp[1]) {
			$METHOD = $aTmp[1];
		}
	}
	if (isset($_GET['m'])) {
		$METHOD = $_GET['m'];
	}

// El metodo no puede empezar por guion bajo.
	if (@$METHOD[0] == '_') {
		$METHOD = APP_DEFAULT_METHOD;
	}


// Si el controlador o el metodo tienen caracteres no permitidos los manda al default.
	if (strpos($CONTROLLER, '.') !== false || strpos($CONTROLLER, '/') !== false  || strpos($CONTROLLER, '\\') !== false) {
		$CONTROLLER = APP_DEFAULT_CONTROLLER;
	}
	if (strpos($METHOD, '.') !== false || strpos($METHOD, '/') !== false  || strpos($METHOD, '\\') !== false) {
		$CONTROLLER = APP_DEFAULT_METHOD;
	}

	if(@isset($_GET['phpinfoquadra'])){
		phpinfo();
		die;
	}
// Si hay un archivo de pre-load lo carga antes que el controlador.
	if (file_exists(APP_APPLICATION_PATH.'/preload.php')) {
		require_once(APP_APPLICATION_PATH.'/preload.php');
	}
	

// Carga el controlador para que se encargue del procesamiento.
// Si no encuentra el controlador solicitado busca el predefinido.
// Si tampoco encuentra el predefinido da error.
	if (file_exists(APP_APPLICATION_PATH."/controllers/{$CONTROLLER}.ctl.php")) {
		require_once(APP_APPLICATION_PATH."/controllers/{$CONTROLLER}.ctl.php");
	}
	else {
		if (file_exists(APP_APPLICATION_PATH.'/controllers/'.APP_DEFAULT_CONTROLLER.'.ctl.php')) {
			require_once(APP_APPLICATION_PATH.'/controllers/'.APP_DEFAULT_CONTROLLER.'.ctl.php');
		} else {
			echo "No se encontró el archivo ".APP_APPLICATION_PATH."/controllers/{$CONTROLLER}.ctl.php";
			die;
		}
	}
?>
