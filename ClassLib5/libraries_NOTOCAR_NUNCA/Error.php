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
 * Error
 * 
 * Capturadora de errores PHP.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi
 */
abstract class Error {
	/**
	 * Punto de entrada al producirse un error en PHP.
	 * 
	 * @param int $nErrNo
	 * @param string $cErrStr
	 * @param string $cPath
	 * @param int $nLine
	 * @param mixed $vData
	 * @return void
	*/
	public static function Handler($nErrNo, $cErrStr, $cPath, $nLine, $vData) {
		// Si el tipo de error lleva un @ delante.
		if(error_reporting() == 0) return false;
		
		Error::Raise($nErrNo, $cErrStr, $cPath, $nLine, $vData);
	}
	
	/**
	 * Reporta un error.
	 * 
	 * <i>Constantes de configuración:</i>
	 * - APP_SYSTEM_ERRORLOG: Path hacia el archivo con el log de errores.
	 * - APP_SYSTEM_EXTENDERRORS: Almacenar información extendida de depuración.
	 * - APP_SUPPORT_EMAIL: Email donde enviar el log.
	 * - APP_SYSTEM_ERRORLOGURL: URL donde enviar datos del log.
	 * - APP_SYSTEM_SHOWERRORS: Enviar detalle del log al buffer de salida.
	 *
	 * @param int $nErrNo
	 * @param string $cErrStr
	 * @param string $cPath
	 * @param int $nLine
	 * @param mixed $vData
	 * @return void
	 * @uses APP_SYSTEM_ERRORLOG, APP_SYSTEM_EXTENDERRORS, APP_SUPPORT_EMAIL, APP_SYSTEM_ERRORLOGURL, APP_SYSTEM_SHOWERRORS
	 */
	public static function Raise($nErrNo, $cErrStr, $cPath='', $nLine=0, $vData=null) {
		
		$aErrType[1] = 'ERROR';
		$aErrType[2] = 'WARNING';
		$aErrType[8] = 'NOTICE';
		
		if (is_dir(dirname(APP_SYSTEM_ERRORLOG))) {
			$sFp = @fopen(APP_SYSTEM_ERRORLOG, 'a+');
			
			if ($sFp) {
				fwrite($sFp, "Fecha: ".date('d/m/Y H:i:s')."\n");
				fwrite($sFp, 'Error: '.(isset($aErrType[$nErrNo]) ? $aErrType[$nErrNo] : $nErrNo)."\n");
				fwrite($sFp, "Mensaje: {$cErrStr}\n");
				fwrite($sFp, "Archivo: {$cPath}\n");
				fwrite($sFp, "Linea: {$nLine}\n");
				
				if (APP_SYSTEM_EXTENDERRORS) {
					fwrite($sFp, "VARIABLES LOCALES:\n");
					fwrite($sFp, print_r(@$vData, true)."\n");
					fwrite($sFp, "VARIABLES DE ENTORNO:\n");
					fwrite($sFp, "Request URI: ".@$_SERVER['REQUEST_URI']."\n");
					fwrite($sFp, "GET: \n".print_r(@$_GET, true)."\n");
					fwrite($sFp, "POST: \n".print_r(@$_POST, true)."\n");
					fwrite($sFp, "SESSION: \n".print_r(@$_SESSION, true)."\n");
					fwrite($sFp, "COOKIE: \n".print_r(@$_COOKIE, true)."\n");
					fwrite($sFp, "FILES: \n".print_r(@$_FILES, true)."\n");
					
					ob_start();
					debug_print_backtrace();
					$aTrz = ob_get_contents();
					ob_end_clean();
					
					fwrite($sFp, "BACKTRACE: \n".print_r(@$aTrz, true)."\n");
				}
				
				fwrite($sFp, "===================================================================================================\n\n");
				fclose($sFp);
			}
		}
		
		if (APP_SUPPORT_EMAIL) {
			@mail(APP_SUPPORT_EMAIL, APP_APPLICATION_NAME.' - '.APP_APPLICATION_URL, @file_get_contents(APP_SYSTEM_ERRORLOG));
			$nSize = @filesize(APP_SYSTEM_ERRORLOG);
			if ($nSize > 250000) {
				@copy(APP_SYSTEM_ERRORLOG, APP_SYSTEM_ERRORLOG.'.bak');
				$sFp = @fopen(APP_SYSTEM_ERRORLOG, 'w');
				@fclose($sFp);
			}
		}
		
		if (APP_SYSTEM_ERRORLOGURL) {
			$cMensaje = "host={$_SERVER['SERVER_NAME']}".
				"&errnum={$nErrNo}".
				'&errstr='.urlencode($cErrStr).
				"&file={$cPath}&line={$nLine}&uri=".urlencode($_SERVER['REQUEST_URI']);
				
			@file_get_contents(APP_SYSTEM_ERRORLOGURL.$cMensaje);
		}
		
		if (APP_SYSTEM_SHOWERRORS) {
			if (file_exists(APP_APPLICATION_PATH.'/views/classlib/error.tpl.php')) {
				include(APP_APPLICATION_PATH.'/views/classlib/error.tpl.php');
			}
			else {
				include(APP_SYSTEM_PATH.'/templates/error.tpl.php');
			}
		}
	}
}
?>