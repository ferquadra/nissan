<?
class HomeCtl extends Controller {
	
	function __construct() {
		parent::__construct();
		$this->Actividad = new Actividad();
		$this->Usuarios = new Usuarios();
	}
	
	public function index() {
		if (isset($_SESSION['operador'])) {
			$this->menu();
		}
		else {
			session_destroy();
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === false) {
				$vista = $this->Template->Load('login/requiere-chrome.tpl.php');
				echo $vista;
			}
			else {
				$vista = $this->Template->Load('login/login.tpl.php');
				echo $vista;
			}
		}
	}
	
	public function login() {
		// Busca el operador.
		$oOperadores = new Operadores();
		$oOperadores->Usuario = @$_POST['usuario'];
		$oOperadores->LimitCant = 1;
		$aBusqueda = $oOperadores->Buscar();
		
		if (count($aBusqueda) < 1 || $aBusqueda[0]['clave'] != @$_POST['clave']) {
			$vista = $this->Template->Load('login/login.tpl.php', array('error'=>true));
			echo $vista;
			return;
		}
		else {
			$_SESSION['operador'] = $aBusqueda[0];
			header("Location: ?p=home");
			return;
		}
	}
	
	public function logout() {
		unset($_SESSION['operador']);
		session_destroy();
		header("Location: ?p=home");
	}
	
	public function menu() {
		$this->Buffer['actividad'] = $this->Actividad->Todas();
		$this->Buffer['valoraciones'] = $this->Usuarios->ValoracionesTodas();
		$this->Buffer['body'] = $this->Template->Load('menu.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
}

$oCont = new HomeCtl();
if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>