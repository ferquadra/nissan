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
 */

// ------------------------------------------------------------------------

if (!defined('APP_DEFAULT_CONTROLLER')) {
	/**
	 * Controlador por defecto.
	 *
	 */
	define('APP_DEFAULT_CONTROLLER',					'controlador');
}

if (!defined('APP_DEFAULT_METHOD')) {
	/**
	 * Método predeterminado del controlador.
	 *
	 */
	define('APP_DEFAULT_METHOD',						'index');
}

if (!defined('APP_DATABASE_CHARSET')) {
	/**
	 * Juego de caracteres del motor de base de datos.
	 *
	 */
	define('APP_DATABASE_CHARSET',					'utf8mb4');
}

if (!defined('APP_DATABASE_COLLATE')) {
	/**
	 * Colección de caracteres usada por el motor de base de datos.
	 *
	 */
	define('APP_DATABASE_COLLATE',					'utf8mb4_general_ci');
}

if (!defined('APP_DATABASE_HOST')) {
	/**
	 * Host de acceso a la base de datos.
	 * <i>[ HOST:PORT ]</i>
	 *
	 */
	define('APP_DATABASE_HOST',						'127.0.0.1:3306');
}

if (!defined('APP_DATABASE_USER')) {
	/**
	 * Usuario de acceso a la base de datos.
	 *
	 */
	define('APP_DATABASE_USER',						'root');
}

if (!defined('APP_DATABASE_PASS')) {
	/**
	 * Clave de acceso a la base de datos.
	 *
	 */
	define('APP_DATABASE_PASS',						'');
}

if (!defined('APP_DATABASE_PERSISTENT')) {
	/**
	 * Define si se usa conexión persistente a la base de datos.
	 *
	 */
	define('APP_DATABASE_PERSISTENT',				false);
}

if (!defined('APP_DATABASE_NAME')) {
	/**
	 * Nombre de la base de datos.
	 *
	 */
	die('No se ha definido el nombre de la base de datos. general.php linea 85');
	define('APP_DATABASE_NAME',						'test');
}

if (!defined('APP_DATABASE_DRIVER')) {
	/**
	 * Nombre del driver utilizado para la conexión.
	 *
	 */
	define('APP_DATABASE_DRIVER',						'MySql');
}

if (!defined('APP_DATABASE_QUERYLOG')) {
	/**
	 * Log de consultas SQL.
	 *
	 */
	define('APP_DATABASE_QUERYLOG',					APP_APPLICATION_PATH.'/query.log');
}

if (!defined('APP_DATABASE_WIN32ALERT')) {
	/**
	 * Especifica si se deben mostrar errores críticos como alertas de Win32.
	 * Requiere DynamicWrapper (DynaWrap.dll).
	 *
	 * @uses Win32
	 */
	define('APP_DATABASE_WIN32ALERT',				false);
}

if (!defined('APP_APPLICATION_URL')) {
	/**
	 * URL principal de la aplicación.
	 *
	 */
	define('APP_APPLICATION_URL',						'http://localhost');
}

if (!defined('APP_APPLICATION_NAME')) {
	/**
	 * Nombre de la aplicación.
	 *
	 */
	define('APP_APPLICATION_NAME',						'ClassLib');
}

if (!defined('APP_APPLICATION_LANGUAGE')) {
	/**
	 * Paquete de idioma utilizado por la aplicación.
	 *
	 */
	define('APP_APPLICATION_LANGUAGE',						'es-ar');
}

if (!defined('APP_SYSTEM_ERRORLOG')) {
	/**
	 * Path hacia el archivo donde se almacena el log de errores.
	 * Si se deja vacía esta constante o el path es incorrecto,
	 * el log de errores no se guarda.
	 *
	 */
	define('APP_SYSTEM_ERRORLOG',						APP_APPLICATION_PATH.'/error.log');
}

if (!defined('APP_SYSTEM_ERRORLOGURL')) {
	/**
	 * URL donde debe enviar los errores cuando se produzcan.
	 * Si se deja vacía esta constante no se envía.
	 *
	 */
	define('APP_SYSTEM_ERRORLOGURL',					'');
}

if (!defined('APP_SYSTEM_SHOWERRORS')) {
	/**
	 * Indica si se deben mostrar los errores por la salida estándar.
	 *
	 */
	define('APP_SYSTEM_SHOWERRORS',					true);
}

if (!defined('APP_SYSTEM_EXTENDERRORS')) {
	/**
	 * Indica se debe almacenar información adicional cuando se produce un error.
	 *
	 */
	define('APP_SYSTEM_EXTENDERRORS',				false);
}

if (!defined('APP_SUPPORT_EMAIL')) {
	/**
	 * Email de soporte técnico.
	 * Es usado por la clase de error para enviar el error via email,
	 * si se define a falso el reporte no es enviado.
	 *
	 */
	define('APP_SUPPORT_EMAIL',						false);
}

if (!defined('APP_LOCALE')) {
	/**
	 * Definición de localidad del servidor.
	 * Usado por funciones internas de PHP.
	 *
	 */
	define('APP_LOCALE',									'Spanish_Argentina.65001'); // español de arg en utf8
}

if (!defined('APP_DATABASE_ADDSLASHES')) {
	/**
	 * Indica si se deben agregar barras invertidas a todo lo que viene desde
	 * el motor de bases de datos.
	 *
	 */
	define('APP_DATABASE_ADDSLASHES',				false);
}
?>