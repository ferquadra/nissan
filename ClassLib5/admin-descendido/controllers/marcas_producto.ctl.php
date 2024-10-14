<?
class MarcasProductoCtl extends Controller {
	
	/**
	 * @desc
	 * Marcas.
	 *
	 * @var Marcas_producto
	 */
	private $Marcas;
	
	function __construct() {
		parent::__construct();
		$this->Marcas = new Marcas_producto();
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
		
		$this->Buffer['listado'] = $this->Marcas->Buscar();
		
		//$this->Marcas->Page = @$_GET['pg'];
		$this->Marcas->OrderBy = 'nombre';
		$this->Marcas->LimitCant = null;
		$this->Buffer['listado'] = $this->Marcas->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Marcas->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('marcas_producto/listado.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Prepara y muestra el formulario.
	 *
	 */
	public function nuevo() {
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Carga datos y muestra el formulario.
	 *
	 */
	public function editar() {
		$this->Marcas->IdMarcaproducto = $_GET['id_marcaproducto'];
		$this->Buffer['datos'] = $this->Marcas->Obtener();
		
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Muestra el formulario.
	 * Método privado, independiente de si se está editando o añadiendo.
	 *
	 */
	private function formulario() {
		$this->menu_lateral();
		$this->Buffer['body'] = $this->Template->Load('marcas_producto/formulario.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Guarda y vuelve al listado.
	 *
	 */
	public function guardar() {
		$this->Marcas->IdMarcaproducto = $_POST['id_marcaproducto'];
		$this->Marcas->Obtener();
		$this->Marcas->Codigo = $_POST['codigo'];
		$this->Marcas->Nombre = $_POST['nombre'];
		$this->Marcas->Descripcion = $_POST['descripcion'];
		$this->Marcas->Texto = $_POST['texto'];
		$this->Marcas->Publicado = @$_POST['publicado'];
		$this->Marcas->Guardar();
		
		if (@$_GET['devolver']) {
			$aData = $this->Marcas->Obtener();
			$aData['id'] = $this->Marcas->IdMarcaproducto;
			echo json_encode($aData);
		}
		else {
			header("Location: ?p=marcas_producto");
		}
	}
	
	/**
	 * @desc
	 * Marca un registro como publicado o despublicado.
	 *
	 */
	public function x_publicar() {
		$this->Marcas->IdMarcaproducto = $_POST['id'];
		$aData = $this->Marcas->Obtener();
		$this->Marcas->Publicado = !$this->Marcas->Publicado;
		$this->Marcas->Guardar();
		
		$aData['publicado'] = $this->Marcas->Publicado;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Marcas->IdMarcaproducto = $_POST['id'];
		if ($this->Marcas->Eliminar()) {
			
			$oImagenes = new Imagenes();
			$oImagenes->EliminarTodas(SECTOR_MARCAS, $this->Marcas->IdMarcaproducto);
			
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
		$this->Marcas->IdMarcaproducto = $_POST['id'];
		$this->Marcas->Obtener();
		$this->Marcas->IdImagen = $_POST['id_imagen'];
		$this->Marcas->Guardar();
	}
	
	/**
	 * @desc
	 * Devuelve el nombre del registro segun el ID pasado como argumento.
	 *
	 * @param int $nId
	 * @return string
	 */
	public function x_obtener_nombre($nId) {
		$this->Marcas->IdMarcaproducto = $nId;
		$this->Marcas->Obtener();
		return $this->Marcas->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve codigo para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Marcas->Nombre = @$_GET['q'];
		$this->Marcas->OrderBy = 'nombre';
		$this->Marcas->LimitCant = 50;
		$aDatos = $this->Marcas->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_marcaproducto']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('productos/menu-lateral.tpl.php');
	}
}

$oCont = new MarcasProductoCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>