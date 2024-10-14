<?
/* ========== CONFIGURACIÓN EDITABLE ========== */
	// Definición de reportes de errores.
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		error_reporting(E_ALL);
		//error_reporting(E_ERROR & E_WARNING);
		ini_set('display_errors', true);
	} else {
		//error_reporting(E_ALL);
		//error_reporting(E_ERROR & E_WARNING);
		error_reporting(E_ERROR | E_PARSE);
		ini_set('display_errors', true);
	}

	/*** LEVANTA VARIABLES DE ENTORNO  ***********/
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		
	} else {
	
		require_once '/var/www/ianus/vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::createImmutable('/var/www');
		$dotenv->load();
	}
 

		// instancia
		if(isset($_SESSION['instancia'])){
			$instancia = $_SESSION['instancia'];
		} else {
			die('Necesitio el parámetro "c" con el nombre de la instancia.');
		}

		if($_SERVER['SERVER_NAME'] == 'localhost'){

			//C:\xampp\htdocs\transparent\i
			$root					= "C:/xampp2/htdocs/nissan2"; // Establecer al DOCUMENT_ROOT de apache.
			$root_url				= "http://localhost/nissan2"; // Establecer al URL ROOT.

		} else {

			$root					= "/var/www/nissan2"; // Establecer al DOCUMENT_ROOT de apache.
			$root_url				= "https://".$_SERVER['SERVER_NAME']; // Establecer al URL ROOT.

		}

		$app_rel_path			= ""; // Carpeta relativa a la aplicación.
		$app_rel_url			= ""; // Ubicación relativa al URL (por si el document root )

		////////////////////////////////////////////////////
		// Incluyo los wrappers de MySQL legacy
		require_once($root.'/mysqlfunctions/MySQL_Definitions.php');
		require_once($root.'/mysqlfunctions/MySQL.php');
		require_once($root.'/mysqlfunctions/MySQL_Functions.php');

		// Definición de acceso a base de datos.
		// SERVIDOR DE BASE DE DATOS VPS BUZZ
		if($_SERVER['SERVER_NAME'] == 'localhost'){
			/****** LOCALHOST ****/
			
			define('APP_DATABASE_HOST',					'127.0.0.1');
			define('APP_DATABASE_NAME',					'quadra_nissan');
			define('APP_DATABASE_USER',					'root');
			define('APP_DATABASE_PASS',					"");
			
			
		} else {
			/*** Viejo servidor - VPS1 BUZZ - 03/02/2022 - Migrado por: Fernando Cuadrado / J.P. Romano.
			define('APP_DATABASE_HOST',					'5.226.171.14');
			define('APP_DATABASE_NAME',					'transpar_'.$instancia);
			define('APP_DATABASE_USER',					'root');
			define('APP_DATABASE_PASS',					"tr4nsp4r3nt");
			***/

			define('APP_DATABASE_HOST',					$_ENV['BBDD_HOST']);
			define('APP_DATABASE_NAME',					'quadra_nissan');
			define('APP_DATABASE_USER',					$_ENV['BBDD_USER']);
			define('APP_DATABASE_PASS',					$_ENV['BBDD_PASS']);
			
		}


		define('APP_DATABASE_ADDSLASHES',			true);

		// Nombre de la aplicación para mostrar en el panel.
		$nombre_aplicacion	= 'TRANSPARENT-FRONTEND';
		define('APP',	$nombre_aplicacion);
		// API KEY de Google Maps.
		define('GOOGLEMAPS_API_KEY',			'');


/* ========== FIN CONFIGURACIÓN EDITABLE ========== */
	// Estas variables se crean automáticamente según la configuración estándar.
		if($_SERVER['SERVER_NAME'] == 'localhost'){
			
			$system_folder			= $root."/ClassLib5";
			$system_url 			= $root_url."/ClassLib5";

		} else {

			$system_folder			= "/var/www/nissan2/ClassLib5";
			$system_url 			= 	"https://nissan2.transparent.global/ClassLib5";

		}

		$application_folder 	= "{$root}{$app_rel_path}".(ADMIN ? '' : '');
		$models_folder 		= "{$root}{$app_rel_path}/models";

		// INSTANCIA
		$webfiles_root			= "{$root}{$app_rel_path}/webfiles/{$instancia}";
		$webfiles_url			= "{$root_url}{$app_rel_url}/webfiles/{$instancia}";

		define('APP_APPLICATION_URL',				"{$root_url}{$app_rel_url}".(ADMIN ? '' : ''));

		define('APP_URL_WEBFILES',					"{$webfiles_url}");
		define('APP_PATH_WEBFILES',					"{$webfiles_root}");

	// Define constantes y variables del MVC.
		define('APP_DEFAULT_CONTROLLER',				'home');
		define('APP_DEFAULT_METHOD',					'index');
		define('APP_APPLICATION_NAME',				preg_replace("/[^a-zA-Z]/", "", $nombre_aplicacion).(ADMIN ? '-super' : ''));
		define('APP_MYSQL_LIMIT',						20);
		define('SECTOR_DATOS',							1);
		define('SECTOR_MARCAS',							2);
		define('SECTOR_CATEGORIAS',						3);
		define('SECTOR_PRODUCTOS',						4);
		define('SECTOR_CAMPOS_PRODUCTO',				5);
		define('SECTOR_PAGINAS',						6);
		define('SECTOR_ANUNCIOS',						7);
		define('SECTOR_CAMPOS_REGISTRO',				8);
		define('SECTOR_PAGINAS_HEAD',					9);
		define('SECTOR_SLIDER',							10);

		// Sitio Web Institucional.
		define('SECTOR_INICIO_SLIDER',					11);
		define('SECTOR_INICIO_DESTACADO',				12);
		define('SECTOR_INICIO_VARIOS',					13);

		define('SECTOR_GALERIAS',					14);
		define('SECTOR_EVENTOS',					15);

		define('SECTOR_LOGO',						20);


	// Datos del dueño de la Web.
		if (file_exists('.svn/entries')) {
			$aDatos = file('.svn/entries');
			define('APP_SITE_LONGNAME',					'Elephant 3r'.$aDatos[3]);
			unset($aDatos);
		}
		else {
			define('APP_SITE_LONGNAME',					$nombre_aplicacion);
		}

	// Define datos de la configuración en la base de datos.
		// Generales
		define('CONFIGURACION_META_TITLE',					'meta_title');
		define('CONFIGURACION_META_DESCRIPTION',			'meta_description');
		define('CONFIGURACION_META_KEYWORDS',				'meta_keywords');
		define('CONFIGURACION_MOSTRAR_PRECIOS',			'mostrar_precios');
		define('CONFIGURACION_FORMA_PEDIDO',				'forma_pedido');
		define('CONFIGURACION_LEYENDA_PRECIO',				'leyenda_precio');
		// Contacto
		define('CONFIGURACION_EMAIL_ADMIN',					'email');
		define('CONFIGURACION_DIRECCION',					'direccion');
		define('CONFIGURACION_TELEFONO',						'telefono');
		define('CONFIGURACION_TEXTO_CONTACTO',				'texto_contacto');
		define('CONFIGURACION_TEXTO_AGRADEC',				'texto_agradecimiento');
		// Catálogo
		define('CONFIGURACION_PRODUCTOS_HOME',				'productos_home');
		define('CONFIGURACION_PRODUCTOS_DESTACADOS',		'productos_destacados');
		define('CONFIGURACION_PRODUCTOS_OFERTAS',			'productos_ofertas');
		define('CONFIGURACION_PRODUCTOS_OFERTAS_HOME',	'productos_ofertas_home');
		define('CONFIGURACION_PRODUCTOS_LISTADO',			'productos_listado');
		// Avanzada
		define('CONFIGURACION_USAR_CKEDITOR',				'usar_ckeditor');
		define('CONFIGURACION_GOOGLE_ANALYTICS',			'google_analytics');

		define('SECTOR_DATOS_IMAGEN',							5);

		define('FORMAPEDIDO_SIN_CARRO',						1);
		define('FORMAPEDIDO_SOLO_PEDIDOS',					2);
		define('FORMAPEDIDO_COMPRA_DIRECTA',				3);
		define('FORMAPEDIDO_CARRITO',							4);

/* ========== CONFIGURACIÓN DE CROPS ========== */
	// Para todos los registros del sector.
	$nProporcion = 4/3;

	$CROPS[SECTOR_INICIO_SLIDER]['sector'][] = array('ancho' => 1920, 'alto' => 1080, 'descripcion' => 'Imagen Principal');

	$CROPS[SECTOR_INICIO_DESTACADO]['sector'][] = array('ancho' => 1920, 'alto' => 1080, 'descripcion' => 'Imagen Fondo Separador');

	$CROPS[SECTOR_INICIO_VARIOS]['sector'][] = array('ancho' => 300, 'alto' => 221, 'descripcion' => 'Destacado #1');
	$CROPS[SECTOR_INICIO_VARIOS]['sector'][] = array('ancho' => 300, 'alto' => 300, 'descripcion' => 'Destacado #2');
	$CROPS[SECTOR_INICIO_VARIOS]['sector'][] = array('ancho' => 700, 'alto' => 406, 'descripcion' => 'Destacado #3');

	$CROPS[SECTOR_DATOS]['sector'][] = array('ancho' => 1170, 'alto' => 204, 'descripcion' => 'Encabezado de Página');

	$CROPS[SECTOR_PRODUCTOS]['sector'][] = array('ancho' => 800, 'alto' => 600, 'descripcion' => 'Detalle producto');
	$CROPS[SECTOR_PRODUCTOS]['sector'][] = array('ancho' => 450, 'alto' => 300, 'descripcion' => 'Miniatura (Home)');

	$CROPS[SECTOR_CATEGORIAS]['sector'][] = array('ancho' => 1920, 'alto' => 258, 'descripcion' => 'Encabezado');

	$CROPS[SECTOR_PAGINAS]['sector'][] = array('ancho' => 700, 'alto' => 400, 'descripcion' => 'Pagina Inicio (Home)');
	$CROPS[SECTOR_PAGINAS]['sector'][] = array('ancho' => 900, 'alto' => 500, 'descripcion' => 'Detalle');
	$CROPS[SECTOR_PAGINAS_HEAD]['sector'][] = array('ancho' => 1920, 'alto' => 258, 'descripcion' => 'Encabezado');

	$CROPS[SECTOR_SLIDER]['sector'][] = array('ancho' => 960, 'alto' => 412, 'descripcion' => 'Slider');

	$CROPS[SECTOR_GALERIAS]['sector'][] = array('ancho' => 640, 'alto' => 480, 'descripcion' => 'Detalle producto');

	$CROPS[SECTOR_EVENTOS]['sector'][] = array('ancho' => 400, 'alto' => 302, 'descripcion' => 'Destacados Home');
	$CROPS[SECTOR_EVENTOS]['sector'][] = array('ancho' => 300, 'alto' => 300, 'descripcion' => 'Servicios Home');
	$CROPS[SECTOR_EVENTOS]['sector'][] = array('ancho' => 900, 'alto' => 420, 'descripcion' => 'Detalle');
	$CROPS[SECTOR_EVENTOS]['sector'][] = array('ancho' => 1920, 'alto' => 258, 'descripcion' => 'Encabezado Detalle');
	$CROPS[SECTOR_EVENTOS]['sector'][] = array('ancho' => 400, 'alto' => 250, 'descripcion' => 'Listado');

	// Para un elemento especifico de un sector en particular.
	$CROPS[SECTOR_DATOS]['elem'][SECTOR_DATOS_IMAGEN][] = array('ancho' => 75, 'alto' => 75, 'descripcion' => 'Miniatura');
?>
