<?
class RegistrosCtl extends Controller {
	
	/**
	 * @desc
	 * Modelo de Listados
	 *
	 * @var Listados
	 */
	private $Listados;
	
	/**
	 * @desc
	 * Modelo de Campos_listado.
	 *
	 * @var Campos_listado
	 */
	private $Campos_listado;
	
	/**
	 * @desc
	 * Modelo de Registros.
	 *
	 * @var Registros
	 */
	private $Registros;
	
	/**
	 * @desc
	 * Modelo de Registros_listado.
	 *
	 * @var Registros_listado
	 */
	private $Registros_listado;
	
	function __construct() {
		parent::__construct();
		
		$this->Listados = new Listados();
		if (isset($_GET['id_listado'])) {
			$this->Listados->IdListado = $_GET['id_listado'];
			$this->Buffer['listado_dinamico'] = $this->Listados->Obtener();
		}
		
		$this->Campos_listado = new Campos_listado();
		if (isset($_GET['id_listado'])) {
			$this->Campos_listado->IdListado = $_GET['id_listado'];
			$this->Campos_listado->OrderBy = 'orden';
			$this->Campos_listado->LimitCant = null;
			$this->Buffer['campos_listado'] = $this->Campos_listado->Buscar();
		}
		
		$this->Registros = new Registros();
		$this->Registros_listado = new Registros_listado();
	}
	
	public function listado() {
		$this->menu_lateral();
		
		$this->Registros->IdListado = $_GET['id_listado'];
		$this->Registros->OrderBy = trim("{$this->Buffer['listado_dinamico']['id_campoorden']} {$this->Buffer['listado_dinamico']['campo_orden_direccion']}");
		$this->Registros->Page = @$_GET['pg'];
		$this->Buffer['listado'] = $this->Registros->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Registros->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('registros/listado.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	public function nuevo() {
		$this->menu_lateral();
		
		$this->formulario();
	}
	
	public function editar() {
		$this->menu_lateral();
		
		$this->Registros->IdRegistro = $_GET['id_registro'];
		$this->Buffer['datos'] = $this->Registros->Obtener();
		
		$this->formulario();
	}
	
	private function formulario() {
		$this->Buffer['body'] = $this->Template->Load('registros/formulario.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	public function guardar() {
		$this->Registros->IdRegistro = $_POST['id_registro'];
		$this->Registros->Obtener();
		$this->Registros->IdListado = $_GET['id_listado'];
		$this->Registros->Publicado = @$_POST['publicado'];
		$this->Registros->Guardar();
		
		$oCL = new Campos_listado();
		
		// Cicla por todos los campos que debe guardar.
		foreach ($this->Buffer['campos_listado'] as $item) {
			$oCL->IdCampolistado = $item['id_campolistado'];
			$oCL->Obtener();
			
			$this->Registros_listado->Limpiar();
			$this->Registros_listado->IdRegistrolistado = $_POST['id_registrolistado'][$item['id_campolistado']];
			$this->Registros_listado->Obtener();
			$this->Registros_listado->IdCampolistado = $item['id_campolistado'];
			$this->Registros_listado->Tipo = $oCL->Tipo;
			$this->Registros_listado->IdRegistro = $this->Registros->IdRegistro;
			$this->Registros_listado->Valor = @$_POST['registros'][$item['id_campolistado']];
			$this->Registros_listado->Guardar();
		}
		
		// Si viene de CTRL + G.
		if ($_POST['x_volver'] == 'last') {
			header("Location: ?p=registros|editar&id_registro={$this->Registros->IdRegistro}&id_listado={$this->Registros->IdListado}");
			die;
		}
		
		if (@$_GET['devolver']) {
			$aData = $this->Registros->Obtener();
			$aData['id'] = $this->Registros->IdRegistro;
			echo json_encode($aData);
		}
		else {
			header("Location: ?p=registros|listado&id_listado={$this->Registros->IdListado}");
		}
	}
	
	/**
	 * @desc
	 * Establece la imagen predeterminada del registro por AJAX.
	 *
	 */
	public function x_predeterminar_imagen() {
		$this->Registros_listado->IdRegistrolistado = $_POST['id'];
		$this->Registros_listado->Obtener();
		$this->Registros_listado->Valor = $_POST['id_imagen'];
		$this->Registros_listado->Tipo = Campos_listado::TIPO_NUMERO_ENTERO;
		$this->Registros_listado->Guardar();
	}
	
	/**
	 * @desc
	 * Marca un registro como publicado o despublicado.
	 *
	 */
	public function x_publicar() {
		$this->Registros->IdRegistro = $_POST['id'];
		$aData = $this->Registros->Obtener();
		$this->Registros->Publicado = !$this->Registros->Publicado;
		$this->Registros->Guardar();
		
		$aData['publicado'] = $this->Registros->Publicado;
		
		echo json_encode($aData);
	}
	
	public function x_eliminar() {
		//$this->Registros_listado
		
		$this->Registros_listado->IdRegistro = $_POST['id'];
		$this->Registros_listado->LimitCant = null;
		$aRL = $this->Registros_listado->Buscar();
		
		foreach ($aRL as $item) {
			switch ($item['tipo']) {
				case Campos_listado::TIPO_ARCHIVO:
					$oArc = new Archivos();
					$oArc->EliminarTodos(SECTOR_CAMPOS_REGISTRO, $item['id_registrolistado']);
					break;
					
				case Campos_listado::TIPO_GOOGLE_MAP:
					break;
					
				case Campos_listado::TIPO_IMAGEN:
					$oImg = new Imagenes();
					$oImg->EliminarTodas(SECTOR_CAMPOS_REGISTRO, $item['id_registrolistado']);
					break;
			}
		}
		
		$this->Registros_listado->Eliminar();
		
		$this->Registros->IdRegistro = $_POST['id'];
		
		if ($this->Registros->Eliminar()) {
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
		$this->Buffer['menu_lateral'] = $this->Template->Load('registros/menu-lateral.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Devuelve el nombre del registro segun el ID pasado como argumento.
	 *
	 * @param int $nId
	 * @return string
	 */
	public function x_obtener_nombre($nId, $nIdListado=null) {
		if ($nId == null) {
			return '';
		}
		
		if ($nIdListado == null) {
			$nIdCampo = $this->Buffer['listado_dinamico']['id_campobusqueda'];
		}
		else {
			$this->Listados->IdListado = $nIdListado;
			$this->Listados->Obtener();
			$nIdCampo = $this->Listados->IdCampoBusqueda;
		}
		
		$oRL = new Registros_listado();
		$oRL->IdRegistro = $nId;
		$oRL->IdCampolistado = $nIdCampo;
		$oRL->LimitCant = 1;
		$aRet = $oRL->Buscar();
		if ($aRet) {
			return $aRet[0]['texto'] | $aRet[0]['entero'] | $aRet[0]['decimal'] | $aRet[0]['fecha'];
		}
		else {
			return '';
		}
	}
	
	/**
	 * @desc
	 * Devuelve codigo para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Registros->IdListado = $_GET['id_listado'];
		$this->Registros->OrderBy = trim("{$this->Buffer['listado_dinamico']['id_campoorden']} {$this->Buffer['listado_dinamico']['campo_orden_direccion']}");
		$this->Registros->Busqueda = @$_GET['q'];
		
		$this->Registros->LimitCant = 50;
		$aDatos = $this->Registros->Buscar();
		
		$oRL = new Registros_listado();
		foreach($aDatos as $item) {
			$oRL->IdRegistro = $item['id_registro'];
			$oRL->IdCampolistado = $this->Buffer['listado_dinamico']['id_campobusqueda'];
			$aRegistro = $oRL->Obtener();
			
			echo str_replace('|', '', $aRegistro['valor'])."|{$item['id_registro']}\n";
		}
	}
}

$oCont = new RegistrosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>