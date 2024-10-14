<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author		Gabriel Luraschi
 * @since		Versión 5
 */

// ------------------------------------------------------------------------

/**
 * Template
 * 
 * Gestor de plantillas.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi, Fernando Cuadrado 09-10-2013
 */
class Template {
	
	/**
	 * Path hacia la carpeta con vistas.
	 *
	 * @var string
	 */
	public $ViewsPath;
	
	/**
	 * Path ALTERNATIVO hacia la carpeta con vistas del usuario.
	 *
	 * @var string
	 */
	public $ViewsPathUser;
	
	/**
	 * Archivo que carga finalmente. Fer. 21-10-2015. BACK TO THE FUTURE.
	 *
	 * @var string
	 */
	public $TemplateFile;
	
	
	/**
	 * Constructor.
	 *
	 */
	public function __construct() {
		$this->ViewsPath = APP_APPLICATION_PATH.'/views/';
		$this->ViewsPathUser = APP_APPLICATION_PATH.'/views_user/';
	}
	
	/**
	 * @desc
	 * Procesa la plantilla $cTemplateFile y devuelve la cadena con el resultado.
	 * El parámetro $aVars debe ser un array con variables que se pasen a la plantilla.
	 * El parámetro $nReturn indica si se debe devolver el string o enviarlo directamente a la salida.
	 *
	 * @param string $cTemplateFile
	 * @param array $aVars
	 * @param bool $nReturn
	 * @return string or void
	 */
	public function Load($cTemplateFile, $aVars=array(), $nReturn=true) {
		global $CONTROLLER, $METHOD;
		
		// Captura el buffer de salida.
		if ($nReturn) {
			ob_start();
		}
		
		// Extrae variables en el ámbito local.
		if (is_array($aVars)) {
			extract($aVars, EXTR_OVERWRITE);
		}
		
		// Carga la plantilla
		if(file_exists($this->ViewsPathUser.$cTemplateFile)){
			$this->TemplateFile = $this->ViewsPathUser.$cTemplateFile;
			include($this->ViewsPathUser.$cTemplateFile);
		} else {
			$this->TemplateFile = $this->ViewsPath.$cTemplateFile;
			include($this->ViewsPath.$cTemplateFile);
		}
		
		// Obtiene el resultado y cierra el buffer de salida.
		if ($nReturn) {
			$cReturn = ob_get_contents();
			ob_end_clean();
			return $cReturn;
		}
	}
}
?>