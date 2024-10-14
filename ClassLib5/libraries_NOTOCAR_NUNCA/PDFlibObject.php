<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author		Gabriel Luraschi
 * @since		Version 5.0
 */

// ------------------------------------------------------------------------

/**
 * PDFlibObject
 * 
 * Generador de archivos PDF.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi
 */
class PDFlibObject {
	
	/**
	 * Recurso PDF.
	 *
	 * @var stream
	 */
	private $PDF			= null;
	
	/**
	 * Propiedades varias del documento.
	 *
	 * @var string
	 */
	public $Creator		= null,
		$Author			= null,
		$Title			= null,
		$FileName		= 'noname.pdf';
	
	/**
	 * Propiedades de configuraciones de papel y documento.
	 *
	 * @var mixed
	 */
	private $Scale			= 'mm',
		$Dpi			= 72,
		$Paper			= 'a4',
		$ScaleValue		= array(),
		$Fonts 			= array(),
		$FileLength	= 0;
		
	/**
	 * Indica si el documento ya está preparado para dibujado.
	 *
	 * @var bool
	 */
	private $Prepared		= false;
	
	/**
	 * Buffer de almacenamiento temporal.
	 *
	 * @var mixed
	 */
	private $Buffer 		= null;
	
	
	/**
	 * Tamaños de papel estándar.
	 *
	 * @var array
	 */
	private $PaperSizes	= array(
		'a0' => array(841, 1189),
		'a1' => array(594, 841),
		'a2' => array(420, 954),
		'a3' => array(297, 420),
		'a4' => array(210, 297),
		'a5' => array(148, 210),
		'a6' => array(105, 148),
		'a7' => array(74, 105),
		'a8' => array(52, 74),
		'a9' => array(37, 52),
		'a10' => array(26, 37),
		'b0' => array(1000, 1414),
		'b1' => array(707, 1000),
		'b2' => array(500, 707),
		'b3' => array(353, 500),
		'b4' => array(250, 353),
		'b5' => array(176, 250),
		'b6' => array(125, 176),
		'b7' => array(88, 125),
		'b8' => array(62, 88),
		'b9' => array(44, 62),
		'b10' => array(31, 44),
		'c0' => array(917, 1297),
		'c1' => array(648, 917),
		'c2' => array(458, 648),
		'c3' => array(324, 458),
		'c4' => array(229, 324),
		'c5' => array(162, 229),
		'c6' => array(114, 162),
		'c7/6' => array(81, 162),
		'c7' => array(81, 114),
		'c8' => array(57, 81),
		'c9' => array(40, 57),
		'c10' => array(28, 40),
		'dl' => array(110, 220),
		'letter' => array(216, 279),
		'legal' => array(37, 1008),
		'ledger' => array(432, 279),
		'tabloid' => array(279, 432),
		);
	
	/**
	 * Indica que los textos que se van a pasar en argumentos están en UTF8.
	 *
	 * @var bool
	 */
	public $TextToAnsi = true;
	
	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		$this->PDF = PDF_new();
	}
	
	/**
	 * Aplica la unidad de medida a utilizar en el documento.
	 * El valor predeterminado es milímetros.
	 * Los valores permitidos son
	 * mm: milímetros
	 * in: pulgadas
	 * ppp: puntos por pulgada
	 *
	 * @param string $cScale
	 * @return void
	 */
	public function SetScale($cScale='mm') {
		switch ($cScale) {
			case 'mm':
			case 'ppp':
			case 'in':
				$this->Scale = $cScale;
				break;
				
			default:
				trigger_error("Tipo de escala \"{$cScale}\" desconocido", E_USER_WARNING);
		}
	}
	
	/**
	 * Cambia los DPI del documento.
	 * El valor predeterminado es 72 (resolución de pantalla)
	 *
	 * @param int $nDpi
	 * @return bool
	 */
	public function SetDpi($nDpi=72) {
		if ($this->Prepared) {
			trigger_error("No se puede cambiar el DPI con el documento inicializado.", E_USER_WARNING);
			return false;
		}
		
		$this->Dpi = $nDpi;
		return true;
	}
	
	/**
	 * Establece el tipo de papel.
	 * El valor predeterminado es A4
	 *
	 * @param string $cPaper
	 * @return void
	 */
	public function SetPaper($cPaper='a4', $nWidth=null, $nHeight=null) {
		if ($cPaper == 'user') {
			$this->PaperSizes['user'] = array($nWidth, $nHeight);
		}
		
		if (isset($this->PaperSizes[$cPaper])) {
			$this->Paper = $cPaper;
		}
		else {
			trigger_error("No se reconoce el tipo de hoja \"{$cPaper}\".", E_USER_WARNING);
		}
	}
	
	/**
	 * Prepara el documento.
	 *
	 * @return void
	 */
	public function Prepare() {
		PDF_open_file($this->PDF, '');
		
		PDF_set_info($this->PDF, 'Creator', $this->Creator);
		PDF_set_info($this->PDF, 'Author', $this->Author);
		PDF_set_info($this->PDF, 'Title', $this->Title);
		
		$this->ScaleValue['mm'] = 25.4 / $this->Dpi;
		$this->ScaleValue['in'] = 1 / $this->Dpi;
		$this->ScaleValue['ppp'] = 1;
		
		$this->Prepared = true;
	}
	
	/**
	 * Establece un parámetro general del documento.
	 *
	 * @param string $cParameter
	 * @param string $cValue
	 * @return int
	 */
	public function SetParameter($cParameter, $cValue) {
		return PDF_set_parameter($this->PDF, $cParameter, $cValue);
	}
	
	/**
	 * Devuelve un parámetro general del documento.
	 *
	 * @param string $cParameter
	 * @return string
	 */
	public function GetParameter($cParameter) {
		return PDF_get_parameter($this->PDF, $cParameter);
	}
	
	/**
	 * Comienza una nueva página.
	 *
	 * @return void
	 */
	public function BeginPage() {
		if (!$this->Prepared) {
			$this->Prepare();
		}
		
		PDF_begin_page($this->PDF, $this->PaperSizes[$this->Paper][0] / $this->ScaleValue[$this->Scale], $this->PaperSizes[$this->Paper][1] / $this->ScaleValue[$this->Scale]);
	}
	
	/**
	 * Cierra la págia activa.
	 *
	 * @return void
	 */
	public function ClosePage() {
		PDF_end_page($this->PDF);
	}
	
	/**
	 * Carga una fuente desde un archivo externo y la deja disponible para usar en el documento.
	 *
	 * @param string $cFontName
	 * @param string $cFontFile
	 * @return void
	 */
	public function LoadFont($cFontName, $cFontFile) {
		PDF_set_parameter($this->PDF, 'FontOutline', "{$cFontName}={$cFontFile}");
	}
	
	/**
	 * Escribe texto en el documento.
	 * 
	 * @param string $cText
	 * @param PDFlibTextOptions $oPdfText
	 * @return void
	 */
	public function WriteText($cText, PDFlibTextOptions $oPdfText=null) {
		if ($oPdfText === null) {
			$oPdfText = new PDFlibTextOptions();
		}
		
		// Si aun no creo la fuente lo hace ahora.
		if (!isset($this->Fonts["{$oPdfText->Font}|{$oPdfText->Encoding}"])) {
			$this->Fonts["{$oPdfText->Font}|{$oPdfText->Encoding}"] = PDF_load_font($this->PDF, $oPdfText->Font, 'winansi', '');
		}
		
		// Setea la fuente.
		PDF_setfont($this->PDF, $this->Fonts["{$oPdfText->Font}|{$oPdfText->Encoding}"], $oPdfText->Size*$this->Dpi / 72);
		PDF_setcolor($this->PDF, 'fill', 'rgb', $oPdfText->Color['r'] / 255, $oPdfText->Color['g'] / 255, $oPdfText->Color['b'] / 255, 0);
		
		// Lo pasa a ansi si se indica.
		if ($this->TextToAnsi) {
			$cText = utf8_decode($cText);
		}
		
		// Escribe el texto.
		PDF_fit_textline($this->PDF, $cText, $oPdfText->X / $this->ScaleValue[$this->Scale], $oPdfText->Y / $this->ScaleValue[$this->Scale], $oPdfText->Parameters);
	}
	
	/**
	 * Escribe texto en el documento.
	 * Lo hace dentro de una caja, para ello se tienen que establecer las
	 * propiedades Width, Height y Alignment de una instancia de PDFlibTextOptions ($oPdfText).
	 * Tener en cuenta que la altura es de la parte inferior de la caja, es decir
	 * que si se coloca en una posición vertical determinada va a cambiar la posición
	 * en el documento si se cambia el alto de la caja.
	 * 
	 * @param string $cText
	 * @param PDFlibTextOptions $oPdfText
	 * @return void
	 */
	public function WriteTextBox($cText, PDFlibTextOptions $oPdfText=null) {
		if ($oPdfText === null) {
			$oPdfText = new PDFlibTextOptions();
		}
		
		// Si aun no creo la fuente lo hace ahora.
		if (!isset($this->Fonts["{$oPdfText->Font}|{$oPdfText->Encoding}"])) {
			$this->Fonts["{$oPdfText->Font}|{$oPdfText->Encoding}"] = PDF_load_font($this->PDF, $oPdfText->Font, 'winansi', '');
		}
		
		// Setea la fuente.
		PDF_setfont($this->PDF, $this->Fonts["{$oPdfText->Font}|{$oPdfText->Encoding}"], $oPdfText->Size*$this->Dpi / 72);
		PDF_setcolor($this->PDF, 'fill', 'rgb', $oPdfText->Color['r'] / 255, $oPdfText->Color['g'] / 255, $oPdfText->Color['b'] / 255, 0);
		
		// Lo pasa a ansi si se indica.
		if ($this->TextToAnsi) {
			$cText = utf8_decode($cText);
		}
		
		if ($oPdfText->Width !== null) {
			$nWidth = PDF_show_boxed($this->PDF, $cText, $oPdfText->X / $this->ScaleValue[$this->Scale], $oPdfText->Y / $this->ScaleValue[$this->Scale], $oPdfText->Width / $this->ScaleValue[$this->Scale], $oPdfText->Height / $this->ScaleValue[$this->Scale], $oPdfText->Alignment, '');
		}
		else {
			// Escribe el texto en una sola línea.
			PDF_fit_textline($this->PDF, $cText, $oPdfText->X / $this->ScaleValue[$this->Scale], $oPdfText->Y / $this->ScaleValue[$this->Scale], $oPdfText->Parameters);
		}
	}
	
	/**
	 * Dibuja una línea.
	 *
	 * @param PDFlibLineOptions $oPdfLine
	 * @return void
	 */
	public function DrawLine(PDFlibLineOptions $oPdfLine) {
		PDF_setcolor($this->PDF, 'both', 'rgb', $oPdfLine->Color['r'] / 255, $oPdfLine->Color['g'] / 255, $oPdfLine->Color['b'] / 255, 0);
		
		PDF_setlinewidth($this->PDF, $oPdfLine->Width / $this->ScaleValue[$this->Scale]);
		
		PDF_moveto($this->PDF, $oPdfLine->FromX / $this->ScaleValue[$this->Scale], $oPdfLine->FromY / $this->ScaleValue[$this->Scale]);
		PDF_lineto($this->PDF, $oPdfLine->ToX / $this->ScaleValue[$this->Scale], $oPdfLine->ToY / $this->ScaleValue[$this->Scale]);
		
		PDF_closepath_stroke($this->PDF);
	}
	
	/**
	 * Dibuja una línea horizontal.
	 * Sólo necesita las opciones de inicio y longitud.
	 *
	 * @param PDFlibLineOptions $oPdfLine
	 * @return void
	 */
	public function DrawHLine(PDFlibLineOptions $oPdfLine) {
		$oPdfLine->ToX = $oPdfLine->FromX + $oPdfLine->Length;
		$oPdfLine->ToY = $oPdfLine->FromY;
		
		$this->DrawLine($oPdfLine);
	}
	
	/**
	 * Dibuja una línea vertical.
	 * Sólo necesita las opciones de inicio y longitud.
	 *
	 * @param PDFlibLineOptions $oPdfLine
	 * @return void
	 */
	public function DrawVLine(PDFlibLineOptions $oPdfLine) {
		$oPdfLine->ToY = $oPdfLine->FromY + $oPdfLine->Length;
		$oPdfLine->ToX = $oPdfLine->FromX;
		
		$this->DrawLine($oPdfLine);
	}
	
	/**
	 * Inserta una imagen en el documento.
	 *
	 * @param string $cImage
	 * @param PDFlibImageOptions $oPdfImage
	 * @return void
	 */
	public function PlaceImage($cImage=null, PDFlibImageOptions $oPdfImage=null) {
		if ($oPdfImage === null) {
			$oPdfImage = new PDFlibImageOptions();
		}
		
		$aData = getimagesize($cImage);
		$cType = str_replace('image/', '', $aData['mime']);
		
		$sImage = PDF_load_image($this->PDF, $cType, $cImage, '');
		$nScale = $this->Dpi / 72;
		
		$nScale *= $oPdfImage->Scale;
		
		PDF_fit_image($this->PDF, $sImage, $oPdfImage->X / $this->ScaleValue[$this->Scale], $oPdfImage->Y / $this->ScaleValue[$this->Scale], "scale {$nScale}");
	}
	
	/**
	 * Genera y guarda en el Buffer el documento.
	 *
	 * @return void
	 */
	private function Generate() {
		PDF_close($this->PDF);
		
		$this->Buffer = PDF_get_buffer($this->PDF);
		$this->FileLength = strlen($this->Buffer);
		
		PDF_delete($this->PDF);
	}
	
	/**
	 * Genera el documento y lo descarga.
	 *
	 * @return void
	 */
	public function Stroke() {
		if ($this->Buffer === null) {
			$this->Generate();
		}
		
		$aFileName = pathinfo($this->FileName);
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
		header("Content-Description: File Transfer");
		header("Content-Length: {$this->FileLength}");
		header("Content-Disposition: attachment; filename=\"".basename($this->FileName).'"');
		
		print $this->Buffer;
	}
	
	/**
	 * Genera el documento y lo guarda.
	 *
	 * @return void
	 */
	public function Save($cFile=null) {
		if ($cFile === null) {
			$cFile = $this->FileName;
		}
		
		$aDatos = pathinfo($cFile);
		
		if ($this->Buffer === null) {
			$this->Generate();
		}
		
		if ($aDatos['filename'] == '') {
			$aDatos['basename'] = $this->FileName;
		}
		
		file_put_contents("{$aDatos['dirname']}/{$aDatos['basename']}", $this->Buffer);
	}
	
}

/**
 * PDFlibTextOptions
 * 
 * Opciones para textos de <i>PDFlibObject</i>.
 * 
 * @package ClassLib
 * @subpackage Libraries
 * @category Libraries
 * @author Gabriel Luraschi
 */
class PDFlibTextOptions {
	/**
	 * Fuente.
	 * 
	 * - Courier
	 * - Courier-Bold
	 * - Courier-Oblique
	 * - Courier-BoldOblique
	 * - Helvetica
	 * - Helvetica-Bold
	 * - Helvetica-Oblique
	 * - Helvetica-BoldOblique
	 * - Times-Roman
	 * - Times-Bold
	 * - Times-Italic
	 * - Times-BoldItalic
	 * - Symbol
	 * - ZapfDingbats
	 *
	 * @var string
	 */
	public $Font			= 'Helvetica';
	
	/**
	 * Tamaño.
	 * 
	 * @var float
	 */
	public $Size			= 14;
	
	/**
	 * Color RGB.
	 *
	 * @var array
	 */
	public $Color			= array('r'=>0, 'g'=>0, 'b'=>0);
	
	/**
	 * Codificación de caracteres.
	 *
	 * @var string
	 */
	public $Encoding		= 'winansi';
	
	/**
	 * Parámetros adicionales de la fuente.
	 *
	 * @var string
	 */
	public $Parameters	= '';
	
	/**
	 * Posición horizontal.
	 *
	 * @var float
	 */
	public $X				= 100;
	
	/**
	 * Posición vertical.
	 * La posición se cuenta desde abajo hacia arriba.
	 *
	 * @var float
	 */
	public $Y				= 100;
	
	/**
	 * Ancho.
	 * Para texto con alineación y multilíneas.
	 *
	 * @var float
	 */
	public $Width			= null;
	
	/**
	 * Ancho.
	 * Para texto con alineación y multilíneas.
	 *
	 * @var float
	 */
	public $Height			= null;
	
	/**
	 * Alineación de texto.
	 * Para texto con alineación y multilíneas.
	 *
	 * @var float
	 */
	public $Alignment		= null;
}

/**
 * PDFlibLineOptions
 * 
 * Opciones para líneas de <i>PDFlibObject</i>.
 * 
 * @package ClassLib
 * @subpackage Libraries
 * @category Libraries
 * @author Gabriel Luraschi
 */
class PDFlibLineOptions {
	
	/**
	 * Color RGB.
	 *
	 * @var array
	 */
	public $Color			= array('r'=>0, 'g'=>0, 'b'=>0);
	
	/**
	 * Anchura.
	 * 
	 * @var float
	 */
	public $Width			= 1;
	
	/**
	 * Punto de inicio horizontal.
	 *
	 * @var float
	 */
	public $FromX			= 100;
	
	/**
	 * Punto de inicio vertical.
	 *
	 * @var float
	 */
	public $FromY			= 100;
	
	/**
	 * Punto de destino horizontal.
	 *
	 * @var float
	 */
	public $ToX				= 500;
	
	/**
	 * Punto de destino vertical.
	 *
	 * @var float
	 */
	public $ToY				= 500;
	
	/**
	 * Longitud de la línea.
	 * Solo aplicable para los metodos DrawHLine y DrawVLine.
	 *
	 * @var string
	 */
	public $Length			= '';
}

/**
 * PDFlibImageOptions
 * 
 * Opciones para imágenes de <i>PDFlibObject</i>.
 * 
 * @package ClassLib
 * @subpackage Libraries
 * @category Libraries
 * @author Gabriel Luraschi
 */
class PDFlibImageOptions {
	/**
	 * Índice de escala de la imagen.
	 *
	 * @var float
	 */
	public $Scale			= 1;
	
	/**
	 * Posición X en el documento.
	 *
	 * @var float
	 */
	public $X				= 100;
	
	/**
	 * Posición Y en el documento.
	 *
	 * @var float
	 */
	public $Y				= 100;
}
?>