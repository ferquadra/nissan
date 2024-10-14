<?
class PedidosCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Pedidos.
	 *
	 * @var Pedidos
	 */
	private $Pedidos;
	
	function __construct() {
		parent::__construct();
		$this->Pedidos = new Pedidos();
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
		$this->cargar_estados();
		
		if (isset($_GET['general']) && $_GET['general']) {
			$this->Pedidos->Usuario = $_GET['general'];
		}
		
		if (!isset($_GET['id_estado'])) {
			$_GET['id_estado'] = 1;
		}
		
		if (isset($_GET['id_estado']) && $_GET['id_estado'] !== '') {
			$this->Pedidos->IdEstado = $_GET['id_estado'];
		}
		
		$this->Pedidos->Page = @$_GET['pg'];
		$this->Pedidos->OrderBy = 'id_pedido DESC';
		$this->Buffer['listado'] = $this->Pedidos->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Pedidos->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('pedidos/listado.tpl.php', $this->Buffer);
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
		$this->Pedidos->IdPedido = $_GET['id_pedido'];
		$this->Buffer['datos'] = $this->Pedidos->Obtener();
		
		$oProductosPedido = new Productos_pedido();
		$oProductosPedido->IdPedido = $this->Pedidos->IdPedido;
		$oProductosPedido->LimitCant = null;
		$this->Buffer['productos'] = $oProductosPedido->Buscar();
		
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
		$this->cargar_estados();
		
		$this->Buffer['body'] = $this->Template->Load('pedidos/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Pedidos->IdPedido = $_POST['id_pedido'];
		$this->Pedidos->Obtener();
		//$this->Pedidos->Fecha = date2mysql($_POST['fecha']);
		//$this->Pedidos->IdUsuario = @$_POST['id_usuario'];
		//$this->Pedidos->Comentario = @$_POST['comentario'];
		$this->Pedidos->Nota = @$_POST['nota'];
		$this->Pedidos->IdEstado = @$_POST['id_estado'];
		//$this->Pedidos->CantidadTotal = @$_POST['cantidad_total'];
		//$this->Pedidos->ImporteTotal = @$_POST['importe_total'];
		$this->Pedidos->Guardar();
		
		if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
		else { header("Location: ?p=pedidos"); }
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Pedidos->IdPedido = $_POST['id'];
		$aData = $this->Pedidos->Obtener();
		$this->Pedidos->Activo = !$this->Pedidos->Activo;
		$this->Pedidos->Guardar();
		
		$aData['activo'] = $this->Pedidos->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Pedidos->IdPedido = $_POST['id'];
		if ($this->Pedidos->Eliminar()) {
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
		$this->Buffer['menu_lateral'] = $this->Template->Load('pedidos/menu-lateral.tpl.php');
	}
	
	private function cargar_estados() {
		$oEstadosPedido = new Estados_pedido();
		$oEstadosPedido->LimitCant = null;
		$oEstadosPedido->OrderBy = 'nombre';
		$this->Buffer['estados'] = $oEstadosPedido->Buscar();
	}
}

$oCont = new PedidosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>