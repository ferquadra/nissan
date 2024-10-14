<?
class ProductoCtl extends Controller {
	
	/**
	 * @desc
	 * Productos.
	 *
	 * @var Productos
	 */
	private $Productos;
	
	function __construct() {
		parent::__construct();
		$this->Productos = new Productos();
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
			$this->Productos->TerminoBusqueda = $_GET['general'];
		}
		if (isset($_GET['id_categoria']) && $_GET['id_categoria']) {
			$this->Productos->IdCategoria = $_GET['id_categoria'];
		}
		if (isset($_GET['id_marca']) && $_GET['id_marca']) {
			$this->Productos->IdMarca = $_GET['id_marca'];
		}
		
		if (isset($_GET['publicado']) && $_GET['publicado'] !== '') {
			$this->Productos->Publicado = $_GET['publicado'];
		}
		if (isset($_GET['oferta']) && $_GET['oferta'] !== '') {
			$this->Productos->Oferta = $_GET['oferta'];
		}
		if (isset($_GET['destacado']) && $_GET['destacado'] !== '') {
			$this->Productos->Destacado = $_GET['destacado'];
		}
		
		$this->Productos->Page = @$_GET['pg'];
		$this->Productos->OrderBy = 'nombre';
		$this->Buffer['listado'] = $this->Productos->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Productos->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('productos/listado.tpl.php', $this->Buffer);
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
		$this->Productos->IdProducto = $_GET['id_producto'];
		$this->Buffer['datos'] = $this->Productos->Obtener();
		
		// Llama al metodo de destino para guardar el archivo.
		$AUTORUN = false;
		require_once("controllers/categorias_producto.ctl.php");
		$_POST['id'] = $this->Productos->IdCategoria; // Para compatibilidad con el siguiente metodo.
		$this->Buffer['body_campos'] = $oCont->x_lista_campos($this->Productos->IdProducto);
		
		
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
		$this->Buffer['body'] = $this->Template->Load('productos/formulario.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Guarda y vuelve al listado.
	 *
	 */
	public function guardar() {
		$this->Productos->IdProducto = $_POST['id_producto'];
		$this->Productos->Obtener();
		$this->Productos->Codigo = $_POST['codigo'];
		$this->Productos->Nombre = $_POST['nombre'];
		$this->Productos->IdCategoria = $_POST['id_categoria'];
		$this->Productos->IdMarca = $_POST['id_marca'];
		$this->Productos->Descripcion = $_POST['descripcion'];
		$this->Productos->Texto = $_POST['texto'];
		$this->Productos->Precio = $_POST['precio'];
		$this->Productos->Precio1 = $_POST['precio1'];
		$this->Productos->Precio2 = $_POST['precio2'];
		$this->Productos->Precio3 = $_POST['precio3'];
		$this->Productos->Precio4 = $_POST['precio4'];
		$this->Productos->Precio5 = $_POST['precio5'];
		$this->Productos->Publicado = @$_POST['publicado'];
		$this->Productos->Oferta = @$_POST['oferta'];
		$this->Productos->Destacado = @$_POST['destacado'];
		$this->Productos->Guardar();
		
		$oValores = new Valores_campoproducto();
		$oValores->IdProducto = $this->Productos->IdProducto;
		
		foreach ((array) @$_POST['campos_id'] as $pos => $nId) {
			$oValores->IdCampocategoria = $nId;
			$oValores->Valor = @$_POST['campos'][$nId];
			$oValores->Guardar();
		}
		
		if (@$_GET['devolver']) {
			$aData = $this->Productos->Obtener();
			$aData['id'] = $this->Productos->IdProducto;
			echo json_encode($aData);
		}
		else {
			header("Location: ?p=productos");
		}
	}
	
	/**
	 * @desc
	 * Importador de productos.
	 *
	 */
	public function importar() {
		$this->menu_lateral();
		
		$cFilename = APP_PATH_ARCHIVOS."/tmp_importar/data";
		$cFileStatus = './productos-importacion.dat';
		
		// Como máximo aguarda 60 minutos subiendo el archivo.
		set_time_limit(60*60);
		
		try {
			// Si está ejecutando la importación de datos
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_GET['datos']) {
				$this->Productos->Importar();
			}
			// Si se está enviando un archivo.
			elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_FILES['archivo']['size']) {
				$aFile = pathinfo($_FILES['archivo']['name']);
				
				// Se admiten sólo archivos csv, en caso contrario: ERROR.
				if (strtolower($aFile['extension']) != 'csv') {
					throw new Exception('Por favor, seleccione únicamente un archivo CSV.');
				}
				
				@mkdir(APP_PATH_ARCHIVOS."/tmp_importar");
				move_uploaded_file($_FILES['archivo']['tmp_name'], $cFilename);
				
				// Abre el archivo CSV y lee la primera línea para pasarla al form.
				$sFp = @fopen($cFilename, 'r');
				if (!$sFp) {
					throw new Exception('Ocurrió un error inesperado al subir el archivo.');
				}
				
				$cLinea = fgets($sFp, 1024);
				
				$aComa = explode(',', $cLinea);
				$aPuntoComa = explode(';', $cLinea);
				$this->Buffer['separador'] = count($aComa) > count($aPuntoComa) ? ',' : ';';
				unset($aComa, $aPuntoComa);
				$this->Buffer['columnas'] = explode($this->Buffer['separador'], $cLinea);
			}
		} catch (Exception $e) {
			$this->Buffer['error'] = $e->getMessage();
		}
		
		
		$this->Buffer['body'] = $this->Template->Load('productos/importar.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Marca un registro como publicado o despublicado.
	 *
	 */
	public function x_publicar() {
		$this->Productos->IdProducto = $_POST['id'];
		$aData = $this->Productos->Obtener();
		$this->Productos->Publicado = !$this->Productos->Publicado;
		$this->Productos->Guardar();
		
		$aData['publicado'] = $this->Productos->Publicado;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Marca un registro como destacado o no.
	 *
	 */
	public function x_destacar() {
		$this->Productos->IdProducto = $_POST['id'];
		$aData = $this->Productos->Obtener();
		$this->Productos->Destacado = !$this->Productos->Destacado;
		$this->Productos->Guardar();
		
		$aData['destacado'] = $this->Productos->Destacado;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Marca un registro como en oferta o no.
	 *
	 */
	public function x_ofertar() {
		$this->Productos->IdProducto = $_POST['id'];
		$aData = $this->Productos->Obtener();
		$this->Productos->Oferta = !$this->Productos->Oferta;
		$this->Productos->Guardar();
		
		$aData['oferta'] = $this->Productos->Oferta;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Productos->IdProducto = $_POST['id'];
		if ($this->Productos->Eliminar()) {
			
			$oValores = new Valores_campoproducto();
			$oValores->IdProducto = $this->Productos->IdProducto;
			$oValores->Eliminar();
			
			$oImagenes = new Imagenes();
			$oImagenes->EliminarTodas(SECTOR_PRODUCTOS, $this->Productos->IdProducto);
			
			$oArchivos = new Archivos();
			$oArchivos->EliminarTodos(SECTOR_PRODUCTOS, $this->Productos->IdProducto);
			
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
		
		if (isset($aExtras['id_campocategoria'])) {
			$oValores = new Valores_campoproducto();
			$oValores->IdProducto = $_POST['id'];
			$oValores->IdCampocategoria = $aExtras['id_campocategoria'];
			$oValores->Valor = $_POST['id_imagen'];
			$oValores->Guardar();
		}
		else {
			$this->Productos->IdProducto = $_POST['id'];
			$this->Productos->Obtener();
			$this->Productos->IdImagen = $_POST['id_imagen'];
			$this->Productos->Guardar();
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
		$this->Productos->IdProducto = $nId;
		$this->Productos->Obtener();
		return $this->Productos->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve codigo para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Productos->Nombre = @$_GET['q'];
		$this->Productos->OrderBy = 'nombre';
		$this->Productos->LimitCant = 50;
		$aDatos = $this->Productos->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_producto']}\n";
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

$oCont = new ProductoCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
