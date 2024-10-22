<?

// Carga librerias de funciones generales.

	//require_once(APP_FUNCTIONS_PATH.'/string_functions.php');
	//require_once(APP_FUNCTIONS_PATH.'/text_functions.php');
	//require_once(APP_FUNCTIONS_PATH.'/date_functions.php');
	//require_once(APP_FUNCTIONS_PATH.'/url_functions.php');
	//require_once(APP_ADDONS_PATH.'/json.php');

	$oConfig = new Configuracion();

	$oConfig->LimitCant = null;
	$aConfig = $oConfig->Buscar();

	foreach($aConfig as $item){
		$GLOBALS['config'][$item['nombre']] = $item['valor'];
	}

// Identifica el idioma y lo carga.

// Define informacion de localidad.
	if (PHP_OS == 'WINNT') {
		setlocale(LC_TIME, 'Spanish_Spain.1252');
		setlocale(LC_CTYPE, 'Spanish_Spain.1252');
		setlocale(LC_COLLATE , 'Spanish_Spain.1252');
	}
	else {
		setlocale(LC_TIME, 'es_ES.UTF-8');
		setlocale(LC_CTYPE, 'es_ES.UTF-8');
		setlocale(LC_COLLATE , 'es_ES.UTF-8');
	}

// Si no hay un operador logeado va al controlador de login.
	if (isset($_SESSION['operador'])) {
		// Continua.
	}
	else {
		if ($CONTROLLER == 'home' && $METHOD == 'index') {
			// Continua.
		}
		elseif ($CONTROLLER == 'home' && $METHOD == 'login') {
			// Continua.
		}
		else {
			//header("Location: ?p=home");
			//die;
		}
	}

?>
