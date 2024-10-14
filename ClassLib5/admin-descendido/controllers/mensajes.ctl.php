<?
class MensajesCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Mensajes.
	 *
	 * @var Mensajes
	 */
	private $Mensajes;
	
	function __construct() {
		parent::__construct();
		$this->Mensajes = new Mensajes();
	}
	
	/**
	 * @desc
	 * Método predeterminado.
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
			$this->Mensajes->IdMensaje = $_GET['general'];
		}
		
		/*
		if (isset($_GET['activo']) && $_GET['activo'] !== '') {
			$this->Mensajes->Activo = $_GET['activo'];
		}
		*/
		
		$this->Mensajes->Page = @$_GET['pg'];
		$this->Mensajes->OrderBy = 'id_mensaje DESC';
		$this->Buffer['listado'] = $this->Mensajes->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Mensajes->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('mensajes/listado.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Prepara y muestra el formulario de alta.
	 *
	 */
	public function nuevo() {
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Carga datos y muestra el formulario de modificación.
	 *
	 */
	public function editar() {
		$this->Mensajes->IdMensaje = $_GET['id_mensaje'];
		$this->Buffer['datos'] = $this->Mensajes->Obtener();
		
		// Lo marca como visto.
		$this->Mensajes->Visto = 1;
		$this->Mensajes->Guardar();
		
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Muestra el formulario.
	 * Método privado, independiente de si se está modificando o añadiendo.
	 *
	 */
	private function formulario() {
		$this->menu_lateral();
		
		$this->Buffer['body'] = $this->Template->Load('mensajes/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Mensajes->IdMensaje = $_POST['id_mensaje'];
		$this->Mensajes->Obtener();
		$this->Mensajes->Nota = @$_POST['nota'];
		$this->Mensajes->Guardar();
		
		if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
		else { header("Location: ?p=mensajes"); }
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Mensajes->IdMensaje = $_POST['id'];
		$aData = $this->Mensajes->Obtener();
		$this->Mensajes->Activo = !$this->Mensajes->Activo;
		$this->Mensajes->Guardar();
		
		$aData['activo'] = $this->Mensajes->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Mensajes->IdMensaje = $_POST['id'];
		if ($this->Mensajes->Eliminar()) {
			$aData['eliminado'] = 1;
		}
		else {
			$aData['eliminado'] = 0;
		}
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('mensajes/menu-lateral.tpl.php');
	}
}

$oCont = new MensajesCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>