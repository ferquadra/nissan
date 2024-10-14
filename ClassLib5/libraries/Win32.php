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
 * Win32
 * 
 * Comunicación con APIs de Windows.
 * 
 * Clase abstracta no instanciable.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi
 * @uses DynamicWrapper
 */
abstract class Win32 {
	
	/**
	 * Constante de opciones de botones para el método MsgBox.
	 *
	 */
	const 
		MSGBOX_BUTTON_OK						= 0x00000000,
		MSGBOX_BUTTON_OKCANCEL					= 0x00000001,
		MSGBOX_BUTTON_ABORTRETRYIGNORE			= 0x00000002,
		MSGBOX_BUTTON_YESNOCANCEL	 			= 0x00000003,
		MSGBOX_BUTTON_YESNO						= 0x00000004,
		MSGBOX_BUTTON_RETRYCANCEL				= 0x00000005,
		MSGBOX_BUTTON_CANCELRETRYCONTINUE		= 0x00000006;
	
	/**
	 * Constante de opciones de íconos para el método MsgBox.
	 *
	 */
	const 
		MSGBOX_ICON_ERROR						= 0x00000010,
		MSGBOX_ICON_QUESTION					= 0x00000020,
		MSGBOX_ICON_EXCLAMATION					= 0x00000030,
		MSGBOX_ICON_INFORMATION					= 0x00000040;
	
	/**
	 * Constante de opciones de botones predeterminados para el método MsgBox.
	 *
	 */
	const 
		MSGBOX_DEFBUTTON_1						= 0x00000000,
		MSGBOX_DEFBUTTON_2						= 0x00000100,
		MSGBOX_DEFBUTTON_3						= 0x00000200,
		MSGBOX_DEFBUTTON_4						= 0x00000300;
	
	/**
	 * Constante de modos de ventana para el MsgBox.
	 *
	 */
	const 
		MSGBOX_MODAL_APP						= 0x00000000,
		MSGBOX_MODAL_SYSTEM						= 0x00001000,
		MSGBOX_MODAL_TASK						= 0x00002000;
	
	/**
	 * Opciones predeterminadas para el MsgBox.
	 * MSGBOX_BUTTON_OK | MSGBOX_ICON_INFORMATION | MSGBOX_DEFBUTTON_1 | MSGBOX_MODAL_SYSTEM
	 *
	 */
	const MSGBOX_OPTIONS						= 0x00001040;
	
	/**
	 * Hace un llamado a la función MessageBoxA de la librería User32.dll.
	 *
	 * @see http://msdn.microsoft.com/en-us/library/windows/desktop/ms645505(v=vs.85).aspx
	 * @param string $cTitulo
	 * @param string $cTexto
	 * @param int $nOptions
	 * @return int
	 */
	public static function MsgBox($cTitulo, $cTexto, $nOptions=self::MSGBOX_OPTIONS) {
		$oCom = new COM("DynamicWrapper");
		// i=ll (cantidad de parámetros que recibe la función, 2 long)
		// f=s tipo de llamada
		// r=tipo de dato de retorno
		$oCom->Register("User32.dll", "MessageBoxA", "i=hssu", "f=s", "r=l");
		$cTexto = utf8_decode($cTexto);
		$cTitulo = utf8_decode($cTitulo);
		return $oCom->MessageBoxA(null, $cTexto, $cTitulo, $nOptions);
	}
	
	/**
	 * Clase abstracta no instanciable.
	 *
	 */
	private final function __construct() {}
}
?>