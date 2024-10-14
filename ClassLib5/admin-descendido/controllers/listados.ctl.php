<?
class ListadosCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Listados.
	 *
	 * @var Listados
	 */
	private $Listados;
	
	function __construct() {
		parent::__construct();
		$this->Listados = new Listados();
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
			$this->Listados->IdListado = $_GET['general'];
		}
		
		$this->Listados->LimitCant = null;
		$this->Listados->OrderBy = 'titulo';
		$this->Buffer['listado'] = $this->Listados->Buscar();
		
		$this->Buffer['body'] = $this->Template->Load('listados/listado.tpl.php', $this->Buffer);
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
		$this->Listados->IdListado = $_GET['id_listado'];
		$this->Buffer['datos'] = $this->Listados->Obtener();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('listados/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Listados->IdListado = $_POST['id_listado'];
		$this->Listados->Obtener();
		$this->Listados->Controlador = @$_POST['controlador'];
		$this->Listados->Titulo = @$_POST['titulo'];
		$this->Listados->IdCampoBusqueda = @$_POST['id_campobusqueda'];
		$this->Listados->IdCampoOrden = @$_POST['id_campoorden'];
		$this->Listados->CampoOrdenDireccion = @$_POST['campo_orden_direccion'];
		$this->Listados->Bloqueado = @$_POST['bloqueado'];
		$this->Listados->Guardar();
		
		if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
		else { header("Location: ?p=listados"); }
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Listados->IdListado = $_POST['id'];
		$aData = $this->Listados->Obtener();
		$this->Listados->Activo = !$this->Listados->Activo;
		$this->Listados->Guardar();
		
		$aData['activo'] = $this->Listados->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Listados->IdListado = $_POST['id'];
		if ($this->Listados->Eliminar()) {
			$aData['eliminado'] = 1;
		}
		else {
			$aData['eliminado'] = 0;
		}
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Devuelve código para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Listados->Titulo = @$_GET['q'];
		$this->Listados->OrderBy = 'titulo';
		$this->Listados->LimitCant = null;
		$aDatos = $this->Listados->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['titulo'])."|{$item['id_listado']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('listados/menu-lateral.tpl.php');
	}
}

$oCont = new ListadosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>