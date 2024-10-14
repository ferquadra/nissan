<?
class AnunciosCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Anuncios.
	 *
	 * @var Anuncios
	 */
	private $Anuncios;
	
	function __construct() {
		parent::__construct();
		$this->Anuncios = new Anuncios();
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
			$this->Anuncios->Nombre = $_GET['general'];
		}
		
		if (isset($_GET['publicado']) && $_GET['publicado'] !== '') {
			$this->Anuncios->Publicado = $_GET['publicado'];
		}
		
		$this->Anuncios->Page = @$_GET['pg'];
		$this->Anuncios->OrderBy = 'nombre';
		$this->Buffer['listado'] = $this->Anuncios->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Anuncios->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('anuncios/listado.tpl.php', $this->Buffer);
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
		$this->Anuncios->IdAnuncio = $_GET['id_anuncio'];
		$this->Buffer['datos'] = $this->Anuncios->Obtener();
		
		$oUbicacion = new Ubicaciones_anuncio();
		$oUbicacion->LimitCant = null;
		$oUbicacion->IdAnuncio = $_GET['id_anuncio'];
		$this->Buffer['ubicaciones_grabadas'] = $oUbicacion->Buscar();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('anuncios/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Anuncios->IdAnuncio = $_POST['id_anuncio'];
		$this->Anuncios->Obtener();
		$this->Anuncios->Nombre = @$_POST['nombre'];
		$this->Anuncios->Url = @$_POST['url'];
		$this->Anuncios->Target = @$_POST['target'];
		//$this->Anuncios->FechaAlta = date2mysql($_POST['fecha_alta']);
		$this->Anuncios->VigenciaDesde = date2mysql($_POST['vigencia_desde']);
		$this->Anuncios->VigenciaHasta = date2mysql($_POST['vigencia_hasta']);
		$this->Anuncios->Impresiones = @$_POST['impresiones'];
		$this->Anuncios->ContadorImpresiones = @$_POST['contador_impresiones'];
		$this->Anuncios->Clicks = @$_POST['clicks'];
		$this->Anuncios->ContadorClicks = @$_POST['contador_clicks'];
		$this->Anuncios->Notas = @$_POST['notas'];
		$this->Anuncios->Publicado = @$_POST['publicado'];
		$this->Anuncios->Guardar();
		
		$oUbicacion = new Ubicaciones_anuncio();
		
		foreach ((array) @$_POST['ubicacion'] as $key => $value) {
			$oUbicacion->IdAnuncio = $this->Anuncios->IdAnuncio;
			$oUbicacion->Sector = $key;
			$oUbicacion->Ubicacion = $value;
			$oUbicacion->Guardar();
			$oUbicacion->Limpiar();
		}
		
		if (@$_GET['devolver']) {
			$aData = $this->Anuncios->Obtener();
			$aData['id'] = $this->Anuncios->IdAnuncio;
			echo json_encode($aData);
			die;
		}
		else {
			if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
			else { header("Location: ?p=anuncios"); }
			die;
		}
	}
		
	/**
	 * @desc
	 * Marca un registro como publicado o despublicado.
	 *
	 */
	public function x_publicar() {
		$this->Anuncios->IdAnuncio = $_POST['id'];
		$aData = $this->Anuncios->Obtener();
		$this->Anuncios->Publicado = !$this->Anuncios->Publicado;
		$this->Anuncios->Guardar();
		
		$aData['publicado'] = $this->Anuncios->Publicado;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Anuncios->IdAnuncio = $_POST['id'];
		if ($this->Anuncios->Eliminar()) {
			
			$oUbicacion = new Ubicaciones_anuncio();
			$oUbicaciones->IdAnuncio = $this->Anuncios->IdAnuncio;
			$oUbicacion->Eliminar();
			
			$oArchivos = new Archivos();
			$oArchivos->EliminarTodos(SECTOR_ANUNCIOS, $this->Anuncios->IdAnuncio);
			
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
		$this->Anuncios->IdAnuncio = $nId;
		$this->Anuncios->Obtener();
		return $this->Anuncios->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve código para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Anuncios->Nombre = @$_GET['q'];
		$this->Anuncios->OrderBy = 'nombre';
		$this->Anuncios->LimitCant = null;
		$aDatos = $this->Anuncios->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_anuncio']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('anuncios/menu-lateral.tpl.php');
	}
}

$oCont = new AnunciosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>