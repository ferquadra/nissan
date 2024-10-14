<?
class PaginasCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Paginas.
	 *
	 * @var Paginas
	 */
	private $Paginas;
	
	function __construct() {
		parent::__construct();
		$this->Paginas = new Paginas();
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
			$this->Paginas->IdPagina = $_GET['general'];
		}
		
		/*
		if (isset($_GET['activo']) && $_GET['activo'] !== '') {
			$this->Paginas->Activo = $_GET['activo'];
		}
		*/
		
		$this->Paginas->Page = @$_GET['pg'];
		$this->Paginas->OrderBy = 'id_pagina';
		$this->Buffer['listado'] = $this->Paginas->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Paginas->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('paginas/listado.tpl.php', $this->Buffer);
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
		$this->Paginas->IdPagina = $_GET['id_pagina'];
		$this->Buffer['datos'] = $this->Paginas->Obtener();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('paginas/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Paginas->IdPagina = $_POST['id_pagina'];
		$this->Paginas->Obtener();
		$this->Paginas->Identificador = @$_POST['identificador'];
		$this->Paginas->Maqueta = @$_POST['maqueta'];
		$this->Paginas->Nombre = @$_POST['nombre'];
		$this->Paginas->Titulo = @$_POST['titulo'];
		$this->Paginas->Descripcion = @$_POST['descripcion'];
		$this->Paginas->Texto = @$_POST['texto'];
		$this->Paginas->Mapa = @$_POST['mapa'];
		$this->Paginas->Guardar();
		
		if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
		else { header("Location: ?p=paginas"); }
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Paginas->IdPagina = $_POST['id'];
		$aData = $this->Paginas->Obtener();
		$this->Paginas->Activo = !$this->Paginas->Activo;
		$this->Paginas->Guardar();
		
		$aData['activo'] = $this->Paginas->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Paginas->IdPagina = $_POST['id'];
		if ($this->Paginas->Eliminar()) {
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
		
		// Si se trata de campos adicionales del producto.
		parse_str(urldecode($_POST['extras']), $aExtras);
		$aExtras = $aExtras['extras'];
		
		$this->Paginas->IdPagina = $_POST['id'];
		$this->Paginas->Obtener();
		$this->Paginas->IdImagen = $_POST['id_imagen'];
		$this->Paginas->Guardar();
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('paginas/menu-lateral.tpl.php');
	}
}

$oCont = new PaginasCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
