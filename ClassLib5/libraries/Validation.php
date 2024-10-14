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
 * Error
 * 
 * Validación de datos de formularios.
 * 
 * @package		ClassLib
 * @subpackage 	Libraries
 * @author Gabriel Luraschi
 */
class Validation {
	/**
	 * Formato de validación.
	 *
	 * @var string
	 */
	public static
		$VALIDATION_FORMAT_INTEGER =				'/^[0-9]*$/',
		$VALIDATION_FORMAT_INTEGER_S =				'/^[\-]?[0-9]*$/',
		$VALIDATION_FORMAT_DECIMAL =				'/^[0-9]*([\,\.][0-9]+)?$/',
		$VALIDATION_FORMAT_DECIMAL_S =				'/^[\-]?[0-9]*([\,\.][0-9]+)?$/',
		$VALIDATION_FORMAT_HOUR =					'/^[0-9]{1,2}([\:][0-9]{1,2}){0,2}$/',
		$VALIDATION_FORMAT_CUIT =					'/^[0-9]{2}\-[0-9]{5,8}\-[0-9]{1}$/',
		$VALIDATION_FORMAT_DATE =					'/^([0-9]{1,2})[\-\/]([0-9]{1,2})[\-\/]([0-9]{4})$/',
		$VALIDATION_FORMAT_EMAIL =					'/^(.*@[^.]*\..+)$/',
		$VALIDATION_FILEEXT_IMAGES =				'jpg,jpeg,gif,png',
		$VALIDATION_FILEEXT_CSV =					'csv';
	
	/**
	 * Contiene los datos a validar por la clase.
	 *
	 * @var array
	 */
	public $Data;
	
	/**
	 * Validar archivos que se suban por un form.
	 *
	 * @var array
	 */
	public $Files;
	
	/**
	 * Contiene los mensajes de error generados en la ultima validación.
	 *
	 * @var array
	 */
	public $Errors=array();
	
	/**
	 * Constructor de Validation.
	 * 
	 */
	public function __construct() { }
	
	/**
	 * Agrega un mensaje de error al buffer de salida.
	 *
	 * @param string $cField
	 * @param string $cErrStr
	 * @return void
	 */
	public function AddError($cField, $cErrStr) {
		$this->Errors[] = array('field' => $cField, 'errstr' => $cErrStr);
	}
	
	/**
	 * Validación de campos requeridos.
	 *
	 * @param string $cField
	 * @param string $cMessage
	 * @return bool
	 */
	public function Required($cField, $cMessage) {
		if (!isset($this->Data[$cField]) || trim($this->Data[$cField]) === '') {
			$this->AddError($cField, $cMessage);
			return false;
		}
		
		return true;
	}
	
	/**
	 * Validación de casillas de email.
	 *
	 * @param string $cField
	 * @param string $cMessage
	 * @return bool
	 */
	public function EMail($cField, $cMessage) {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			if (!preg_match(self::$VALIDATION_FORMAT_EMAIL, $this->Data[$cField])) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	/**
	 * Validación por valor.
	 * Compara el valor del campo $cField asegurándose que sea
	 * $cComp [>, <, >=, <=, ==, !=, ===, !==] a $vValue (un dato)
	 *
	 * @param string $cField
	 * @param string $cComp
	 * @param mixed $vValue
	 * @param string $cMessage
	 * @return bool
	 */
	public function Value($cField, $cComp, $vValue, $cMessage) {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			
			switch ($cComp) {
				case '>':
					$nOk = $this->Data[$cField] > $vValue;
					break;
					
				case '>=':
					$nOk = $this->Data[$cField] >= $vValue;
					break;
					
				case '<':
					$nOk = $this->Data[$cField] < $vValue;
					break;
					
				case '<=':
					$nOk = $this->Data[$cField] <= $vValue;
					break;
					
				case '==':
					$nOk = $this->Data[$cField] == $vValue;
					break;
					
				case '!=':
					$nOk = $this->Data[$cField] != $vValue;
					break;
					
				case '===':
					$nOk = $this->Data[$cField] === $vValue;
					break;
					
				case '!==':
					$nOk = $this->Data[$cField] !== $vValue;
					break;
					
				default:
					error::Raise(E_WARNING, "El operador {$cComp} no es un operador de comparacion valido.");
			}
			
			if (!$nOk) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Valida que el campo $cField cumpla con el formato $cFormat específico.
	 * <b>$cFormat</b> es una expresión regular.
	 * 
	 * Ver las constantes predefinidas de formatos de validación para ayuda.
	 * 
	 * @param string $cField
	 * @param string $cFormat
	 * @param string $cMessage
	 * @return bool
	 */
	public function Format($cField, $cFormat, $cMessage) {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			if (!preg_match($cFormat, $this->Data[$cField])) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Valida un campo captcha.
	 * Busca el valor del captcha en la variable de sesión $cSessionVarName.
	 * Se puede indicar que haga validación sensible a mayusculas/minusculas a través
	 * del argumento $nCaseSensitive. Por defecto no es sensible.
	 *
	 * @param string $cField
	 * @param string $cMessage
	 * @param bool $nCaseSensitive
	 * @param string $cSessionVarName
	 * @return bool
	 */
	public function Captcha($cField, $cMessage, $nCaseSensitive = false, $cSessionVarName = 'php_captcha') {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			
			// Si no es case-sensitive compara todo en mayusculas.
			$cValue = $nCaseSensitive ? $this->Data[$cField] : strtoupper($this->Data[$cField]);
			$cCaptcha = $nCaseSensitive ? @$_SESSION[$cSessionVarName] : strtoupper(@$_SESSION[$cSessionVarName]);
			
			if ($cValue !== $cCaptcha) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Validación por tamaño máximo.
	 * Si el campo $cField tiene más de $nMaxLength caracteres se produce un error de validación.
	 *
	 * @param string $cField
	 * @param int $nMaxLength
	 * @param string $cMessage
	 * @return bool
	 */
	public function MaxLength($cField, $nMaxLength, $cMessage) {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			if (strlen($this->Data[$cField]) > $nMaxLength) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Validación por tamaño mínimo.
	 * Si el campo $cField tiene menos de $nMaxLength caracteres se produce un error de validación.
	 *
	 * @param string $cField
	 * @param int $nMinLength
	 * @param string $cMessage
	 * @return bool
	 */
	public function MinLength($cField, $nMinLength, $cMessage) {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			if (strlen($this->Data[$cField]) < $nMinLength) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Validación de fechas.
	 * Si el campo $cField no es una fecha válida en el calendario gregoriano se produce un error de validación.
	 *
	 * @param string $cField
	 * @param string $cMessage
	 * @param string $cFormat
	 * @return bool
	 */
	public function Date($cField, $cMessage, $cFormat=VALIDATION_FORMAT_DATE) {
		if (isset($this->Data[$cField]) && trim($this->Data[$cField]) !== '') {
			if (!preg_match($cFormat, $this->Data[$cField], $aRegs)) {
				$this->AddError($cField, $cMessage);
				return false;
			}
			else {
				if(!checkdate($aRegs[2], $aRegs[1], $aRegs[3])) {
					$this->AddError($cField, $cMessage);
					return false;
				}
			}
		}
		
		return true;
	}
	
	/**
	 * Verifica que el archivo $cField se haya subido correctamente.
	 * - Si ocurrió algún problema al subir el archivo o este es inseguro devuelve falso.
	 * - Si no se subió el archivo devuelve 1 (se puede evaluar a true ya que no es un error).
	 * - Si se subió correctamente devuelve verdadero.
	 *
	 * @param string $cField
	 * @param string $cMessage
	 * @return mixed
	 */
	public function FileIsUploaded($cField, $cMessage) {
		if (isset($this->Files[$cField]) && $this->Files[$cField]['error'] !== UPLOAD_ERR_NO_FILE) {
			// El nombre de archivo no puede contener barras (inyeccion de codigo).
			if (strpos($this->Files[$cField]['name'], '/') !== false || strpos($this->Files[$cField]['name'], '\\') !== false) {
				$this->AddError($cField, $cMessage);
				return false;
			}
			
			// Corrobora que el archivo temporal se haya subido via HTTP.
			if (!is_uploaded_file($this->Files[$cField]['tmp_name'])) {
				$this->AddError($cField, $cMessage);
				return false;
			}
			
			// Busca algun mensaje de error extra.
			if ($this->Files[$cField]['error'] !== UPLOAD_ERR_OK) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		else {
			// Si el archivo nunca se subio al servidor devuelve 1 que se puede
			// evaluar como verdadero ya que no aparenta haber ocurrido algun error.
			return 1;
		}
		
		return true;
	}
	
	/**
	 * Validación de tipos de archivos.
	 * Valida que el archivo $cField esté correctamente subido
	 * por un formulario y que sea de alguna de las extensiones permitidas en
	 * $cAllowedExtensions, cuyo valor es una cadena de extensiones separadas por
	 * comas (no por espacios).
	 *
	 * @param string $cField
	 * @param string $cAllowedExtensions
	 * @param string $cMessage
	 * @return bool
	 */
	public function FileType($cField, $cAllowedExtensions, $cMessage) {
	
		if (isset($this->Files[$cField]) && $this->Files[$cField]['error'] !== UPLOAD_ERR_NO_FILE) {
			$cEregi = '\.('.str_replace(',', '|', $cAllowedExtensions).')$';
			if (!preg_match($cEregi, $this->Files[$cField]['name'])) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Validación de tipos de archivos no permitidos.
	 * Valida que el archivo $cField no sea de alguna de las extensiones
	 * indicadas en $cDeniedExtensions, cuyo valor es una cadena de extensiones
	 * separadas por comas (no por espacios).
	 *
	 * @param string $cField
	 * @param string $cDeniedExtensions
	 * @param string $cMessage
	 * @return bool
	 */
	public function FileExtDenied($cField, $cDeniedExtensions, $cMessage) {
		if (isset($this->Files[$cField]) && $this->Files[$cField]['error'] !== UPLOAD_ERR_NO_FILE) {
			$cEregi = '\.('.str_replace(',', '|', $cDeniedExtensions).')$';
			if (preg_match($cEregi, $this->Files[$cField]['name'])) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Validación de tipos de archivos permitidos.
	 * Valida que el archivo $cField sea de alguna de las extensiones
	 * indicadas en $cAcceptedExtensions, cuyo valor es una cadena de extensiones
	 * separadas por comas (no por espacios).
	 *
	 * @param string $cField
	 * @param string $cAcceptedExtensions
	 * @param string $cMessage
	 * @return bool
	 */
	public function FileExtAccepted($cField, $cAcceptedExtensions, $cMessage) {
		if (isset($this->Files[$cField]) && $this->Files[$cField]['error'] !== UPLOAD_ERR_NO_FILE) {
			$cEregi = '\.('.str_replace(',', '|', $cAcceptedExtensions).')$';
			if (!eregi($cEregi, $this->Files[$cField]['name'])) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Valida si el tamaño del archivo $cField es mayor al máximo $nSize permitido.
	 *
	 * @param string $cField
	 * @param int $nSize
	 * @param string $cMessage
	 * @return bool
	 */
	public function FileSize($cField, $nSize, $cMessage) {
		if (isset($this->Files[$cField]) && $this->Files[$cField]['error'] !== UPLOAD_ERR_NO_FILE) {
			if ($this->Files[$cField]['size'] > $nSize) {
				$this->AddError($cField, $cMessage);
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Valida si no se subió el archivo.
	 *
	 * @param string $cField
	 * @param string $cMessage
	 * @return bool
	 */
	public function FileRequired($cField, $cMessage) {
		if (!(isset($this->Files[$cField]) && $this->Files[$cField]['error'] !== UPLOAD_ERR_NO_FILE)) {
			$this->AddError($cField, $cMessage);
		}
		
		return true;
	}
}
?>