<?
class CategoriasProductoCtl extends Controller {
	
	/**
	 * @desc
	 * Categorias.
	 *
	 * @var Categorias_producto
	 */
	private $Categorias;
	
	function __construct() {
		parent::__construct();
		$this->Categorias = new Categorias_producto();
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
		
		$this->Buffer['listado'] = $this->Categorias->Buscar();
		
		//$this->Categorias->Page = @$_GET['pg'];
		$this->Categorias->OrderBy = 'nombre';
		$this->Categorias->LimitCant = null;
		$this->Buffer['listado'] = $this->Categorias->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Categorias->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('categorias_producto/listado.tpl.php', $this->Buffer);
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
	 * Prepara y muestra el formulario para AJAX.
	 *
	 */
	public function x_nuevo() {
		echo $this->Template->Load('categorias_producto/formulario.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Carga datos y muestra el formulario.
	 *
	 */
	public function editar() {
		$this->Categorias->IdCategoriaproducto = $_GET['id_categoriaproducto'];
		$this->Buffer['datos'] = $this->Categorias->Obtener();
		
		$oCampos = new Campos_categoriaproducto();
		$oCampos->IdCategoria = $this->Categorias->IdCategoriaproducto;
		$oCampos->OrderBy = 'orden';
		$oCampos->LimitCant = null;
		$this->Buffer['campos'] = $oCampos->Buscar();
		
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Carga datos y muestra el formulario para AJAX.
	 *
	 */
	public function x_editar() {
		$this->Categorias->IdCategoriaproducto = $_GET['id_categoriaproducto'];
		$this->Buffer['datos'] = $this->Categorias->Obtener();
		
		$oCampos = new Campos_categoriaproducto();
		$oCampos->IdCategoria = $this->Categorias->IdCategoriaproducto;
		$oCampos->OrderBy = 'orden';
		$oCampos->LimitCant = null;
		$this->Buffer['campos'] = $oCampos->Buscar();
		
		echo $this->Buffer['body'] = $this->Template->Load('categorias_producto/formulario.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Muestra el formulario.
	 * Método privado, independiente de si se está editando o añadiendo.
	 *
	 */
	private function formulario() {
		$this->menu_lateral();
		$this->Buffer['body'] = $this->Template->Load('categorias_producto/formulario.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Guarda y vuelve al listado.
	 *
	 */
	public function guardar() {
		$this->Categorias->IdCategoriaproducto = $_POST['id_categoriaproducto'];
		$this->Categorias->Obtener();
		$this->Categorias->Codigo = $_POST['codigo'];
		if (isset($_POST['id_padre'])) {
			$this->Categorias->IdPadre = $_POST['id_padre'];
		}
		$this->Categorias->Nombre = $_POST['nombre'];
		$this->Categorias->Descripcion = $_POST['descripcion'];
		$this->Categorias->Publicado = @$_POST['publicado'];
		$this->Categorias->Guardar();
		
		$oCampos = new Campos_categoriaproducto();
		foreach ($_POST['campos_id'] as $pos => $item) {
			if (!$_POST['campos_nombre'][$pos]) continue;
			
			$oCampos->IdCampocategoria = $item;
			$oCampos->Obtener();
			
			$oCampos->IdCategoria = $this->Categorias->IdCategoriaproducto;
			$oCampos->Nombre = $_POST['campos_nombre'][$pos];
			
			if (!$item) { // Al modificar no se puede cambiar el tipo de campo.
				$oCampos->Tipo = $_POST['campos_tipo'][$pos];
			}
			
			$oCampos->Extra = $_POST['campos_extra'][$pos];
			$oCampos->Orden = $pos;
			$oCampos->Guardar();
		}
		
		if (@$_GET['devolver']) {
			$aData = $this->Categorias->Obtener();
			$aData['id'] = $this->Categorias->IdCategoriaproducto;
			echo json_encode($aData);
		}
		else {
			header("Location: ?p=categorias_producto");
		}
	}
	
	/**
	 * @desc
	 * Marca un registro como publicado o despublicado.
	 *
	 */
	public function x_publicar() {
		$this->Categorias->IdCategoriaproducto = $_POST['id'];
		$aData = $this->Categorias->Obtener();
		$this->Categorias->Publicado = !$this->Categorias->Publicado;
		$this->Categorias->Guardar();
		
		$aData['publicado'] = $this->Categorias->Publicado;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Categorias->IdCategoriaproducto = $_POST['id'];
		if ($this->Categorias->Eliminar()) {
			
			$oImagenes = new Imagenes();
			$oImagenes->EliminarTodas(SECTOR_CATEGORIAS, $this->Categorias->IdCategoriaproducto);
			
			$oCampos = new Campos_categoriaproducto();
			$oCampos->IdCategoria = $_POST['id'];
			$oCampos->Eliminar();
			
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
		$this->Categorias->IdCategoriaproducto = $_POST['id'];
		$this->Categorias->Obtener();
		$this->Categorias->IdImagen = $_POST['id_imagen'];
		$this->Categorias->Guardar();
	}
	
	/**
	 * @desc
	 * Carga la plantilla con la lista de campos de la categoría dada.
	 *
	 */
	public function x_lista_campos($nIdProducto=null) {
		$oCampos = new Campos_categoriaproducto();
		$oCampos->IdCategoria = $_POST['id'];
		if ($nIdProducto) {
			$this->Buffer['id_producto'] = $oCampos->IdProducto = $nIdProducto;
		}
		$oCampos->OrderBy = 'orden';
		$oCampos->LimitCant = null;
		
		$this->Buffer['campos'] = $oCampos->Buscar();
		if ($nIdProducto) {
			return $this->Template->Load('categorias_producto/lista-campos.tpl.php', $this->Buffer);
		}
		else {
			echo $this->Template->Load('categorias_producto/lista-campos.tpl.php', $this->Buffer);
		}
	}
	
	/**
	 * @desc
	 * Devuelve el nombre del registro segun el ID pasado como argumento.
	 *
	 * @param int $nId
	 * @return string
	 */
	public function x_obtener_nombre($nId) {
		$this->Categorias->IdCategoriaproducto = $nId;
		$this->Categorias->Obtener();
		return $this->Categorias->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve codigo para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Categorias->Nombre = @$_GET['q'];
		$this->Categorias->OrderBy = 'nombre';
		$this->Categorias->LimitCant = 50;
		$aDatos = $this->Categorias->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_categoriaproducto']}\n";
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

$oCont = new CategoriasProductoCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>