<?
class PartidosCtl extends Controller {
	
	function __construct() {
		parent::__construct();
		$this->Usuarios = new Usuarios();
		$this->Ami = new Amigos();
		$this->Par = new Partidos();
		$this->Tra = new Traza();
	}
	
	/**
	 * @desc
	 * Controlador predeterminado.
	 *
	 */
	public function index() {
		$this->listado();
	}
	
	/**
	 * @desc
	 * Listado.
	 *
	 */
	public function listado() {
		
		$this->menu_lateral();
		
		if (isset($_GET['general']) && $_GET['general']) {
			$this->Par->lugar = $_GET['general'];
		}
		
		$this->Par->id_user = @$_GET['id_user'];
		
		$this->Par->Page = @$_GET['pg'];
		$this->Par->OrderBy = 'id_partido DESC';
		$this->Buffer['listado'] = $this->Par->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Par->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado-partidos.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('usuarios/menu-lateral.tpl.php');
	}
}

$oCont = new PartidosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
