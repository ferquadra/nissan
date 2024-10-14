<?
class UploadCtl extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @desc
	 * Muestra la pantalla para subir un archivo.
	 *
	 */
	public function index() {
		$this->Buffer['contenedor'] = isset($_GET['contenedor']) ? $_GET['contenedor'] : null;
		$this->Buffer['origen'] = isset($_GET['origen']) ? $_GET['origen'] : null;
		$this->Buffer['destino'] = isset($_GET['destino']) ? $_GET['destino'] : null;
		$this->Buffer['sector'] = isset($_GET['sector']) ? $_GET['sector'] : null;
		$this->Buffer['id_elemento'] = isset($_GET['id_elemento']) ? $_GET['id_elemento'] : null;
		$this->Buffer['limite'] = isset($_GET['limite']) ? $_GET['limite'] : null;
		$this->Buffer['extras'] = isset($_GET['extras']) ? $_GET['extras'] : array();
		$this->Buffer['error'] = isset($_GET['error']) ? $_GET['error'] : null;
		
		$AUTORUN = false;
		require_once("controllers/{$this->Buffer['origen']}.ctl.php");
		$this->Buffer['body'] = $oCont->x_listado($this->Buffer['sector'], $this->Buffer['id_elemento'], $this->Buffer['contenedor'], $this->Buffer['extras']);
		
		echo $this->Template->Load('upload/cuadro.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Inicia la carga del archivo.
	 *
	 */
	public function guardar() {
		// Llama al metodo de destino para guardar el archivo.
		$AUTORUN = false;
		require_once("controllers/{$_POST['destino']}.ctl.php");
		$error = $oCont->x_guardar_archivo();
		
		// Una vez guardado el archivo redirecciona pasando todos los argumentos como venian en el post.
		if ($error) {
			header("Location: ?p=upload&error=".urlencode($error)."&".http_build_query($_POST, null, "&"));
		}
		else {
			header("Location: ?p=upload&".http_build_query($_POST, null, "&"));
		}
	}
}

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

$oCont = new UploadCtl();
if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>