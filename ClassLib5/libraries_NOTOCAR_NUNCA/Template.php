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
 * Template
 * 
 * Gestor de plantillas.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi
 */
class Template {
	
	/**
	 * Path hacia la carpeta con vistas.
	 *
	 * @var string
	 */
	public $ViewsPath;
	
	/**
	 * Constructor.
	 *
	 */
	public function __construct() {
		$this->ViewsPath = APP_APPLICATION_PATH.'/views/';
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
		include($this->ViewsPath.$cTemplateFile);
		
		// Obtiene el resultado y cierra el buffer de salida.
		if ($nReturn) {
			$cReturn = ob_get_contents();
			ob_end_clean();
			return $cReturn;
		}
	}
}
?>