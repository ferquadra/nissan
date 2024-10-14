<?
class ArchivosCtl extends Controller {
	
	/**
	 * @desc
	 * Archivos.
	 *
	 * @var Archivos
	 */
	private $Archivos;
	
	/**
	 * @desc
	 * Constructor.
	 *
	 */
	function __construct() {
		parent::__construct();
		$this->Archivos = new Archivos();
	}
	
	/**
	 * @desc
	 * Método predeterminado.
	 *
	 */
	public function index() {
		
	}
	
	/**
	 * @desc
	 * Método que es llamado por el controlador UPLOAD para guardar un archivo.
	 *
	 * @return false o error
	 */
	public function x_guardar_archivo() {
		$nCant = count($_FILES['archivo']['tmp_name']);
		
		$nError = false;
		
		$this->Archivos->Sector = $_POST['sector'];
		$this->Archivos->IdElemento = $_POST['id_elemento'];
		
		for ($i=0; $i<$nCant; ++$i) {
			
			$cExt = strtolower(pathinfo($_FILES['archivo']['name'][$i], PATHINFO_EXTENSION));
			if (!in_array($cExt, array('jpg', 'gif', 'png', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'rtf', 'txt', 'csv', 'swf', 'fla'))) {
				$nError = 1;
				continue;
			}
			
			
			$nId = $this->Archivos->Guardar(
				array(
					'error'=>$_FILES['archivo']['error'][$i],
					'name'=>$_FILES['archivo']['name'][$i],
					'size'=>$_FILES['archivo']['size'][$i],
					'tmp_name'=>$_FILES['archivo']['tmp_name'][$i],
					'type'=>$_FILES['archivo']['type'][$i]
				), @$_POST['descripcion']);
				
				if ($nId == false) {
					$nError = 2;
					continue;
				}
		}
		
		if ($nError) {
			if ($nCant > 1) {
				return 'Ocurrió un error al subir alguno de los archivos seleccionados.';
			}
			else { // Revisar mensajes de error, tamaño máximo del archivo, etc.
				switch ($nError) {
					case 1:
						return 'Por razones de seguridad no se admite el tipo de archivo seleccionado.';
						break;
						
					case 2:
						return 'Ocurrió un error al subir el archivo seleccionado.';
						break;
				}
			}
		}
		
		return false;
	}
	
	/**
	 * @desc
	 * Método que es llamado por el controlador UPLOAD para buscar los archivos.
	 *
	 */
	public function x_buscar_archivos($nSector, $nIdElemento) {
		$this->Archivos->Sector = $nSector;
		$this->Archivos->IdElemento = $nIdElemento;
		$this->Archivos->LimitCant = null;
		return $this->Archivos->Buscar();
	}
	
	/**
	 * @desc
	 * Método que es llamado por el controlador UPLOAD para listar los archivos.
	 *
	 */
	public function x_listado($nSector, $nIdElemento, $cContenedor=null, $aExtras=array()) {
		$this->Buffer['sector'] = $nSector;
		$this->Buffer['id_elemento'] = $nIdElemento;
		$this->Buffer['contenedor'] = $cContenedor;
		$this->Buffer['extras'] = $aExtras;
		
		$this->Buffer['archivos'] = $this->x_buscar_archivos($nSector, $nIdElemento);
		
		return $this->Template->Load('archivos/x-listado.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Descarga del archivo
	 *
	 */
	public function x_descargar() {
		$aArchivo = $this->Archivos->Obtener($_GET['id_archivo']);
		
		$cFileName = APP_PATH_ARCHIVOS."/{$aArchivo['id_archivo']}/archivo.dat";
		$nExiste = file_exists($cFileName);
		
		header('Content-Type: application/x-download');
		header('Content-Length: '.filesize($cFileName));
		header('Content-Disposition: attachment; filename="'.$aArchivo['nombre'].'"');
		header('Cache-Control: private, max-age=0, must-revalidate');
		header('Pragma: public');
		ini_set('zlib.output_compression','0');
		readfile($cFileName);
	}
	
	/**
	 * @desc
	 * Elimina el archivo.
	 *
	 */
	public function x_eliminar() {
		$this->Archivos->Eliminar($_POST['id_archivo']);
	}
}

$oCont = new ArchivosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>