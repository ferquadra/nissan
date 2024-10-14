<?class Estados_pedidoCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Estados_pedido.
	 *
	 * @var Estados_pedido
	 */
	private $Estados_pedido;
	
	function __construct() {
		parent::__construct();
		$this->Estados_pedido = new Estados_pedido();
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
			$this->Estados_pedido->Nombre = $_GET['general'];
		}
		
		/*
		if (isset($_GET['activo']) && $_GET['activo'] !== '') {
			$this->Estados_pedido->Activo = $_GET['activo'];
		}
		*/
		
		$this->Estados_pedido->Page = @$_GET['pg'];
		$this->Estados_pedido->OrderBy = 'nombre';
		$this->Buffer['listado'] = $this->Estados_pedido->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Estados_pedido->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('estados_pedido/listado.tpl.php', $this->Buffer);
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
		$this->Estados_pedido->IdEstadopedido = $_GET['id_estadopedido'];
		$this->Buffer['datos'] = $this->Estados_pedido->Obtener();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('estados_pedido/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Estados_pedido->IdEstadopedido = $_POST['id_estadopedido'];
		$this->Estados_pedido->Obtener();
		$this->Estados_pedido->Nombre = @$_POST['nombre'];
		$this->Estados_pedido->Guardar();
		
		header("Location: {$_POST['x-volver']}");
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Estados_pedido->IdEstadopedido = $_POST['id'];
		$aData = $this->Estados_pedido->Obtener();
		$this->Estados_pedido->Activo = !$this->Estados_pedido->Activo;
		$this->Estados_pedido->Guardar();
		
		$aData['activo'] = $this->Estados_pedido->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Estados_pedido->IdEstadopedido = $_POST['id'];
		if ($this->Estados_pedido->Eliminar()) {
			$aData['eliminado'] = 1;
		}
		else {
			$aData['eliminado'] = 0;
		}
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Devuelve el nombre del registro segun el ID pasado como argumento.
	 *
	 * @param int $nId
	 * @return string
	 */
	public function x_obtener_nombre($nId) {
		$this->Estados_pedido->IdEstadopedido = $nId;
		$this->Estados_pedido->Obtener();
		return $this->Estados_pedido->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve código para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Estados_pedido->Nombre = @$_GET['q'];
		$this->Estados_pedido->OrderBy = 'nombre';
		$this->Estados_pedido->LimitCant = null;
		$aDatos = $this->Estados_pedido->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_estadopedido']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('estados_pedido/menu-lateral.tpl.php');
	}
}

$oCont = new Estados_pedidoCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>