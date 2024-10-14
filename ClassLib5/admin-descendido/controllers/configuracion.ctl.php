<?
class ConfiguracionCtl extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @desc
	 * Formulario y grabacion del cambio de clave de acceso.
	 * 
	 * @uses Operadores
	 *
	 */
	public function cambiar_clave() {
		$this->menu_lateral();
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$oOperador = new Operadores();
			$oVal = new Validation();
			$oVal->Data = $_POST;
			
			// La contraseña actual debe ser igual a la de la sesion.
			$oVal->Value('actual', '==', $_SESSION['operador']['clave'], 'La contraseña actual es incorrecta.');
			
			$oVal->Value('repita', '==', $_POST['nueva'], 'La contraseña nueva es diferente de su repetición de seguridad.');
			
			if ($oVal->Errors) {
				$this->Buffer['errores'][] = $oVal->Errors[0];
			}
			else {
				$oOperador->CambiarClave($_SESSION['operador']['id_operador'], $_POST['nueva']);
				header('Location: ?p=home|logout');
				die;
			}
		}
		
		$this->Buffer['body'] = $this->Template->Load('configuracion/cambiar-clave.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
		
	}
	
	public function index() {
		$this->menu_lateral();
		
		$oConfiguracion = new Configuracion();
		
		$oConfiguracion->LimitCant = null;
		$oConfiguracion->OrderBy = 'orden';
		$this->Buffer['configuracion'] = $oConfiguracion->BuscarCategorizado();
		
		$this->Buffer['body'] = $this->Template->Load('configuracion/datos-institucionales.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	public function guardar() {
		$oConfiguracion = new Configuracion();
		
		foreach ((array) @$_POST['configuracion'] as $id => $valor) {
			switch ($_POST['tipo'][$id]) {
				// Mapa de google, lo baja y lo deja en el servidor.
				case Configuracion::TIPO_GOOGLEMAP:
					$oConfiguracion->IdConfiguracion = $id;
					$oConfiguracion->Obtener();
					
					preg_match('/width=([0-9]+)/', $oConfiguracion->Extra, $aSpt);
					$cWidth = $aSpt[1];
					preg_match('/height=([0-9]+)/', $oConfiguracion->Extra, $aSpt);
					$cHeight = $aSpt[1];
					
					$aMapa = explode('&', str_replace(array('(', ')', ' '), array('', '', ''), $valor));
					$sOrigen = fopen("http://maps.google.com/maps/api/staticmap?maptype=G_NORMAL_MAP&center={$aMapa[1]}&zoom={$aMapa[2]}&size={$cWidth}x{$cHeight}&format=png&maptype=roadmap&markers={$aMapa[0]}&sensor=false&key=".GOOGLEMAPS_API_KEY, 'rb');
					$sDestino = fopen(APP_PATH_VARIOS.'/mapa_contacto.png', 'wb');
					// Para no sobrecargar la memoria copia el streaming directamente al disco.
					stream_copy_to_stream($sOrigen, $sDestino);
					fclose($sOrigen); fclose($sDestino);
					break;
			}
			
			$oConfiguracion->IdConfiguracion = $id;
			$oConfiguracion->Valor = $valor;
			$oConfiguracion->Actualizar();
		}
		
		header('Location: ?p=menu');
	}
	
	public function listado() {}
	
	public function nuevo() {}
	
	public function editar() {}
	
	public function json_obtener($cMetodo=null) {}
	
	public function json_enviar($cMetodo=null, $vDatos=null) {
		if ($cMetodo) {
			return json_encode($this->$cMetodo($vDatos));
		}
		else {
			echo json_encode($this->$_GET['metodo']($_POST));
		}
	}
	
	public function html_ajax($asd=null) {}
	
	public function x_autocompletar() {}
	
	private function j_guardar_clave($data) {
		$oOperadores = new Operadores();
		$oOperadores->Usuario = $_SESSION['operador']['usuario'];
		$oOperadores->Clave = $_POST['nueva'];
		$oOperadores->GuardarClave();
		
		return array('success' => 1);
	}
	
	/**
	 * @desc
	 * Establece la imagen predeterminada del registro por AJAX.
	 *
	 */
	public function x_predeterminar_imagen() {
		$oConfiguracion = new Configuracion();
		
		$oConfiguracion->IdConfiguracion = $_POST['id'];
		$oConfiguracion->Obtener();
		$oConfiguracion->Valor = $_POST['id_imagen'];
		$oConfiguracion->Guardar();
	}
	
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('configuracion/menu-lateral.tpl.php');
	}
}

$oCont = new ConfiguracionCtl();
if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>