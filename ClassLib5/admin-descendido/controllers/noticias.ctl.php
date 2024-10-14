<?
class NoticiasCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Noticias.
	 *
	 * @var Noticias
	 */
	private $Noticias;
	
	function __construct() {
		parent::__construct();
		$this->Noticias = new Noticias();
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
			$this->Noticias->Nombre = $_GET['general'];
		}
		
		if (isset($_GET['publicado']) && $_GET['publicado'] !== '') {
			$this->Noticias->Publicado = $_GET['publicado'];
		}
		
		$this->Noticias->Page = @$_GET['pg'];
		$this->Noticias->OrderBy = 'nombre';
		$this->Buffer['listado'] = $this->Noticias->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Noticias->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('noticias/listado.tpl.php', $this->Buffer);
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
		$this->Noticias->IdNoticias = $_GET['id_noticias'];
		$this->Buffer['datos'] = $this->Noticias->Obtener();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('noticias/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Noticias->IdNoticias = $_POST['id_noticias'];
		$this->Noticias->Obtener();
		$this->Noticias->Nombre = @$_POST['nombre'];
		//$this->Noticias->FechaAlta = date2mysql($_POST['fecha_alta']);
		$this->Noticias->Publicado = @$_POST['publicado'];
		$this->Noticias->Notas = @$_POST['notas'];
		$this->Noticias->Descripcion = @$_POST['descripcion'];
		$this->Noticias->Guardar();
		
		if (@$_GET['devolver']) {
			$aData = $this->Noticias->Obtener();
			$aData['id'] = $this->Noticias->IdNoticias;
			echo json_encode($aData);
			die;
		}
		else {
			if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
			else { header("Location: ?p=noticias"); }
			die;
		}
	}
		
	/**
	 * @desc
	 * Marca un registro como publicado o despublicado.
	 *
	 */
	public function x_publicar() {
		$this->Noticias->IdNoticias = $_POST['id'];
		$aData = $this->Noticias->Obtener();
		$this->Noticias->Publicado = !$this->Noticias->Publicado;
		$this->Noticias->Guardar();
		
		$aData['publicado'] = $this->Noticias->Publicado;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Noticias->IdNoticias = $_POST['id'];
		if ($this->Noticias->Eliminar()) {
			
			$oUbicacion = new Ubicaciones_noticias();
			$oUbicaciones->IdNoticias = $this->Noticias->IdNoticias;
			$oUbicacion->Eliminar();
			
			$oArchivos = new Archivos();
			$oArchivos->EliminarTodos(SECTOR_NOTICIAS, $this->Noticias->IdNoticias);
			
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
		$this->Noticias->IdNoticias = $nId;
		$this->Noticias->Obtener();
		return $this->Noticias->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve código para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Noticias->Nombre = @$_GET['q'];
		$this->Noticias->OrderBy = 'nombre';
		$this->Noticias->LimitCant = null;
		$aDatos = $this->Noticias->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_noticias']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('noticias/menu-lateral.tpl.php');
	}
}

$oCont = new NoticiasCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
