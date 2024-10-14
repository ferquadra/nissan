<?
class Campos_listadoCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Campos_listado.
	 *
	 * @var Campos_listado
	 */
	private $Campos_listado;
	
	/**
	 * @desc
	 * Modelo de Listados.
	 *
	 * @var Listados
	 */
	private $Listados;
	
	function __construct() {
		parent::__construct();
		$this->Campos_listado = new Campos_listado();
		$this->Buffer['tipos'] = $this->Campos_listado->Tipos();
		
		$this->Listados = new Listados();
		if (isset($_GET['id_listado'])) {
			$this->Listados->IdListado = $_GET['id_listado'];
			$this->Buffer['listado_dinamico'] = $this->Listados->Obtener();
		}
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
		
		$this->Campos_listado->IdListado = $_GET['id_listado'];
		
		$this->Campos_listado->LimitCant = null;
		$this->Campos_listado->OrderBy = 'orden';
		$this->Buffer['listado'] = $this->Campos_listado->Buscar();
		
		$this->Buffer['body'] = $this->Template->Load('campos_listado/listado.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Prepara y muestra el formulario de alta.
	 *
	 */
	public function nuevo() {
		// Busca el número de orden predeterminado (el más alto más 10 según el modelo).
		$this->Campos_listado->IdListado = $_GET['id_listado'];
		$this->Buffer['datos']['orden'] = $this->Campos_listado->OrdenSiguiente();
		
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Carga datos y muestra el formulario de modificación.
	 *
	 */
	public function editar() {
		$this->Campos_listado->IdCampolistado = $_GET['id_campolistado'];
		$this->Buffer['datos'] = $this->Campos_listado->Obtener();
		
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
		
		$this->Buffer['body'] = $this->Template->Load('campos_listado/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	/**
	 * @desc
	 * Guarda un registro.
	 *
	 */
	public function guardar() {
		$this->Campos_listado->IdCampolistado = $_POST['id_campolistado'];
		$this->Campos_listado->Obtener();
		$this->Campos_listado->IdListado = @$_POST['id_listado'];
		$this->Campos_listado->Titulo = @$_POST['titulo'];
		$this->Campos_listado->Tipo = @$_POST['tipo'];
		$this->Campos_listado->Extra = @$_POST['extra'];
		$this->Campos_listado->Orden = @$_POST['orden'];
		$this->Campos_listado->Ayuda = @$_POST['ayuda'];
		$this->Campos_listado->Requerido = @$_POST['requerido'];
		$this->Campos_listado->Guardar();
		
		if (@$_POST['x-volver']) { header("Location: {$_POST['x-volver']}"); }
		else { header("Location: ?p=campos_listado&id_listado={$_GET['id_listadp']}"); }
		die;
	}
		
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Campos_listado->IdCampolistado = $_POST['id'];
		$aData = $this->Campos_listado->Obtener();
		$this->Campos_listado->Activo = !$this->Campos_listado->Activo;
		$this->Campos_listado->Guardar();
		
		$aData['activo'] = $this->Campos_listado->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Campos_listado->IdCampolistado = $_POST['id'];
		if ($this->Campos_listado->Eliminar()) {
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
		$this->Campos_listado->Titulo = @$_GET['q'];
		$this->Campos_listado->IdListado = @$_GET['id_listado'];
		$this->Campos_listado->OrderBy = 'titulo';
		$this->Campos_listado->LimitCant = null;
		$aDatos = $this->Campos_listado->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['titulo'])."|{$item['id_campolistado']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('campos_listado/menu-lateral.tpl.php');
	}
}

$oCont = new Campos_listadoCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>