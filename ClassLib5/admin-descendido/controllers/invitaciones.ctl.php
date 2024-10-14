<?
class InvitacionesCtl extends Controller {
	
	function __construct() {
		parent::__construct();
		$this->Usuarios = new Usuarios();
		$this->Ami = new Amigos();
		$this->Inv = new Invitaciones();
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

		$this->Inv->Page = @$_GET['pg'];
		$this->Inv->OrderBy = 'id_invitacion DESC';
		$this->Inv->LimitCant = null;
		$this->Buffer['listado'] = $this->Inv->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Par->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado-invitaciones.tpl.php', $this->Buffer);
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

$oCont = new InvitacionesCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
