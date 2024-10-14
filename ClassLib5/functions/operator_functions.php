<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage 	Helpers
 * @author		Gabriel Luraschi
 * @since		Versión 5
 */

// ------------------------------------------------------------------------

/**
 * Operator
 * 
 * Operadores lógicos avanzados.
 * 
 * @package ClassLib
 * @subpackage Helpers
 * @author Gabriel Luraschi
 */
abstract class Operator {
	/**
	 * Comparacion logica AND.
	 *
	 * @param mixed $aParams
	 * @return bool
	 */
	public static function op_and($aParams) {
		$aParams = func_get_args();
		
		foreach ($aParams as $item) {
			if ($item == false) {
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Comparacion logica OR.
	 *
	 * @param mixed $aParams
	 * @return bool
	 */
	public static function op_or($aParams) {
		$aParams = func_get_args();
		
		foreach ($aParams as $item) {
			if ($item == true) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Negacion OR.
	 *
	 * @param mixed $aParams
	 * @return bool
	 */
	public static function op_nor($aParams) {
		$aParams = func_get_args();
		
		foreach ($aParams as $item) {
			if ($item == true) {
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Comparacion logica AND.
	 * <b>Operador UNARIO</b>.
	 *
	 * @param mixed $aParam
	 * @return bool
	 */
	public static function op_not($aParam) {
		return !$aParam;
	}
	
	/**
	 * Operacion XOR (o exclusivo).
	 * <b>Operador BINARIO</b>.
	 *
	 * @param mixed $mParam1
	 * @param mixed $mParam2
	 * @return bool
	 */
	public static function op_xor($mParam1, $mParam2) {
		return $mParam1 xor $mParam2;
	}
	
	/**
	 * Negacion del o exlcusivo.
	 * <b>Operador BINARIO</b>.
	 *
	 * @param mixed $mParam1
	 * @param mixed $mParam2
	 * @return bool
	 */
	public static function op_xnor($mParam1, $mParam2) {
		return !Operator::op_xor($mParam1, $mParam2);
	}
	
	/**
	 * Negacion alternativa.
	 * Equivale a NOT AND.
	 *
	 * @param mixed $aParams
	 * @return bool
	 */
	public static function op_nand($aParams) {
		$aParams = func_get_args();
		
		foreach ($aParams as $item) {
			if ($item == false) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Implica.
	 * <b>Operador BINARIO</b>.
	 *
	 * @param mixed $mParam1
	 * @param mixed $mParam2
	 * @return bool
	 */
	public static function op_imp($mParam1, $mParam2) {
		return Operator::op_nand($mParam1, !$mParam2);
	}
	
	/**
	 * No implica.
	 * <b>Operador BINARIO</b>.
	 *
	 * @param mixed $mParam1
	 * @param mixed $mParam2
	 * @return bool
	 */
	public static function op_nimp($mParam1, $mParam2) {
		return !Operator::op_imp($mParam1, $mParam2);
	}
	
	/**
	 * Implicacion inversa.
	 * <b>Operador BINARIO</b>.
	 *
	 * @param mixed $mParam1
	 * @param mixed $mParam2
	 * @return bool
	 */
	public static function op_cimp($mParam1, $mParam2) {
		return Operator::op_nand(!$mParam1, $mParam2);
	}
	
	/**
	 * No implica (inversa).
	 * <b>Operador BINARIO</b>.
	 *
	 * @param mixed $mParam1
	 * @param mixed $mParam2
	 * @return bool
	 */
	public static function op_cnimp($mParam1, $mParam2) {
		return Operator::op_nand($mParam1, !$mParam2);
	}
}
?>