<?
class ImagenesCtl extends Controller {
	
	/**
	 * @desc
	 * Imagenes.
	 *
	 * @var Imagenes
	 */
	private $Imagenes;
	
	/**
	 * @desc
	 * Constructor.
	 *
	 */
	function __construct() {
		parent::__construct();
		$this->Imagenes = new Imagenes();
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
		
		$this->Imagenes->Sector = $_POST['sector'];
		$this->Imagenes->IdElemento = $_POST['id_elemento'];
		
		for ($i=0; $i<$nCant; ++$i) {
			$aImg = getimagesize($_FILES['archivo']['tmp_name'][$i]);
			
			if ($aImg == false) {
				$nError = 1;
				continue;
			}
			
			if ($aImg[0] <= 2048 && $aImg[1] <= 2048) {
				
				$nId = $this->Imagenes->Guardar(
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
			else {
				$nError =3;
				continue;
			}
		}
		
		if ($nError) {
			if ($nCant > 1) {
				return 'Ocurrió un error al subir alguna de las imágenes seleccionadas.';
			}
			else {
				switch ($nError) {
					case 1:
						return 'El formato de la imagen seleccionada es incorrecto.';
						break;
						
					case 2:
						return 'El formato de la imagen seleccionada es incorrecto.';
						break;
						
					case 3:
						return 'La imagen seleccionada es demasiado grande.';
						break;
				}
			}
		}
		else {
			return false;
		}
	}
	
	/**
	 * @desc
	 * Método que es llamado por el controlador UPLOAD para buscar los archivos.
	 *
	 */
	public function x_buscar_archivos($nSector, $nIdElemento) {
		$this->Imagenes->Sector = $nSector;
		$this->Imagenes->IdElemento = $nIdElemento;
		$this->Imagenes->LimitCant = null;
		return $this->Imagenes->Buscar();
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
		
		return $this->Template->Load('imagenes/x-listado.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Zoom de la imagen
	 *
	 */
	public function x_zoom() {
		$this->Buffer['id_imagen'] = $_GET['id_imagen'];
		
		echo $this->Template->Load('imagenes/x-zoom.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Elimina la imagen.
	 *
	 */
	public function x_eliminar() {
		$this->Imagenes->Eliminar($_POST['id_imagen']);
	}
	
	/**
	 * @desc
	 * Formulario para recortar imagenes.
	 *
	 */
	public function x_recortar() {
		$this->Buffer['id_imagen'] = $_GET['id_imagen'];
		$this->Buffer['sector'] = $_GET['sector'];
		$this->Buffer['id_elemento'] = $_GET['id_elemento'];
		
		echo $this->Template->Load('imagenes/x-recortar.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Realiza el recorte de la imagen.
	 *
	 */
	public function x_efectuar_recorte() {
		$jpeg_quality = 85;
		
		$src = APP_PATH_IMAGENES."/{$_POST['id_imagen']}/imagen.jpg";
		$img_r = imagecreatefromjpeg($src);
		$dst_r = imagecreatetruecolor($_POST['ancho'], $_POST['alto']);
		
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
		$_POST['ancho'],$_POST['alto'],$_POST['w'],$_POST['h']);
		
		//header('Content-type: image/jpeg');
		imagejpeg($dst_r, APP_PATH_IMAGENES."/{$_POST['id_imagen']}/imagen_{$_POST['ancho']}x{$_POST['alto']}.jpg", $jpeg_quality);
	}
}

$oCont = new ImagenesCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>