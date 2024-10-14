<?
class CanchasCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Canchas.
	 *
	 * @var Canchas
	 */
	private $Canchas;
	
	function __construct() {
		
		parent::__construct();
		$this->Canchas = new Canchas();
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
			$this->Canchas->general = $_GET['general'];
		}
		
		/*
		if (isset($_GET['activo']) && $_GET['activo'] !== '') {
			$this->Canchas->Activo = $_GET['activo'];
		}
		*/
		
		$this->Canchas->Page = @$_GET['pg'];
		$this->Canchas->OrderBy = 'id_cancha';
		$this->Buffer['listado'] = $this->Canchas->Buscar();
		
		$this->Canchas->Page = null;
		$this->Canchas->LimitCant = null;
		$this->Buffer['todas'] = $this->Canchas->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Canchas->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('canchas/listado.tpl.php', $this->Buffer);
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
		$this->Canchas->id = $_GET['id'];
		$this->Buffer['datos'] = $this->Canchas->Obtener();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('canchas/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		
		if(@$_POST['id']){
			$this->Canchas->id = $_POST['id'];
			$this->Canchas->Obtener();
		}
		
		$this->Canchas->nombre = @$_POST['nombre'];
		$this->Canchas->direccion = @$_POST['direccion'];
		$this->Canchas->telefono = @$_POST['telefono'];
		$this->Canchas->celular = @$_POST['celular'];
		$this->Canchas->email = @$_POST['email'];
		$this->Canchas->lat = @$_POST['lat'];
		$this->Canchas->lng = @$_POST['lng'];
		$this->Canchas->notas = @$_POST['notas'];
		$this->Canchas->Guardar();
		
		if (isset($_POST['guardarycargar'])){
			header("Location: ?p=canchas&m=nuevo");
		}
		else { header("Location: ?p=canchas"); }
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		/*
		$this->Canchas->IdPagina = $_POST['id'];
		$aData = $this->Canchas->Obtener();
		$this->Canchas->Activo = !$this->Canchas->Activo;
		$this->Canchas->Guardar();
		
		$aData['activo'] = $this->Canchas->Activo;
		
		echo json_encode($aData);*/
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Canchas->id = $_POST['id'];
		if ($this->Canchas->Eliminar()) {
			$aData['eliminado'] = 1;
		}
		else {
			$aData['eliminado'] = 0;
		}
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Establece la imagen predeterminada del registro por AJAX.
	 *
	 */
	public function x_predeterminar_imagen() {
		
		
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('canchas/menu-lateral.tpl.php');
	}
}

$oCont = new CanchasCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
