<?php
/**
 * Framework ClassLib
 *
 * Entorno de trabajo para desarrollo de aplicaciones MVC para PHP 5.3.x o superior.
 *
 * @package		ClassLib
 * @subpackage	Helpers
 * @author		Gabriel Luraschi
 * @since		Versión 5
 */

// ------------------------------------------------------------------------

if (! function_exists('paginator_data')) {
	/**
	 * Paginator Data
	 *
	 * Devuelve un array con informacion para usar en un paginador.
	 * 
	 * <b>pagina</b>: Pagina actual.
	 * <b>paginas</b>: Total de paginas.
	 * <b>atras</b>: Indica si se puede retroceder.
	 * <b>adelante</b>: Indica si se puede avanzar.
	 * <b>anterior</b>: Pagina anterior.
	 * <b>siguiente</b>: Pagina siguiente.
	 *
	 * @access	public
	 * @param int $total
	 * @param  int $limit
	 * @param int $page
	 * @return	array
	 */
	function paginator_data($total, $limit, $page=1) {
		// Evita que vaya a un numero de pagina invalido.
		if ($page < 1) {
			$page = 1;
		}
		$aRet['pagina'] = $page; // Pagina actual.
		
		$aRet['paginas'] = null;
		
		// Evita que vaya a un numero de pagina invalido.
		if($limit > 0){
			$aRet['paginas'] = ceil($total / $limit); // Cantidad de paginas.
		}
		if ($aRet['paginas'] == 0) {
			$aRet['paginas'] = 1;
		}
		
		if ($aRet['pagina'] > $aRet['paginas']) {
			$aRet['pagina'] = $aRet['paginas'];
		}
		
		// Para retroceder.
		$aRet['atras'] = $aRet['pagina'] > 1;
		$aRet['anterior'] = $aRet['pagina'] - 1 > 0 ? $aRet['pagina'] - 1 : 1;
		
		// Para avanzar.
		$aRet['adelante'] = $aRet['pagina'] < $aRet['paginas'];
		$aRet['siguiente'] = $aRet['adelante'] ? $aRet['pagina'] + 1 : $aRet['pagina'];
		
		return $aRet;
	}
}

if (! function_exists('paginator_range')) {
	/**
	 * Paginator Range
	 *
	 * Devuelve un rango de paginas para enlaces de un paginador.
	 * Los valores de retorno son los mismos que la funcion paginator_data
	 * mas un adicional con el rango:
	 * 
	 * <b>rago</b>: Array numerico con numeros de paginas.
	 * 
	 *
	 * @access	public
	 * @param int $nTotal
	 * @param  int $nLimite
	 * @param int $nPagina
	 * @param int $nRango
	 * @return	array
	 */
	function paginator_range($nTotal, $nLimite, $nPagina=1, $nRango=5) {
		// Busca datos necesarios a traves de otra funcion de utileria.
		// Esta variable tambien es usada como retorno.
		$aDatos = paginator_data($nTotal, $nLimite, $nPagina);
		$aDatos['registros'] = $nTotal;
		
		// Calcula la cantidad de elementos hacia atras y adelante.
		$nAnteriores = floor(($nRango - 1) / 2);
		$nSiguientes = ceil(($nRango - 1) / 2);
		
		// Posiciones previas de inicio y final del rango.
		$nInicio = $aDatos['pagina'] - $nAnteriores;
		$nFinal = $aDatos['pagina'] + $nSiguientes;
		
		// Si el inicio se fue de rango lo acomoda y corre el final.
		if ($nInicio < 1) {
			$nFinal += 1 - $nInicio;
			$nInicio = 1;
		}
		
		// Si el final excede la cantidad de paginas lo acomoda.
		if ($nFinal > $aDatos['paginas']) {
			$nDif = $nFinal - $aDatos['paginas'];
			
			// Corre el inicio si es posible.
			if ($nInicio - $nDif > 0) {
				$nInicio -= $nDif;
			}
			else {
				$nInicio = 1;
			}
			
			$nFinal -= $nDif;
		}
		
		// Crea el rango de datos para devolver.
		$aDatos['rango'] = range($nInicio, $nFinal);
		
		return $aDatos;
	}
}

/**
 * Trunca una cadena por la longitud $length y le pone un sufijo $cEnd
 *
 * @param unknown_type $string
 * @param unknown_type $length
 * @param unknown_type $cEnd
 * @return unknown
 */
function truncateString($string, $length, $cEnd = '')
{
	$i = 0;
	$full_length = $length + strlen($cEnd);
	// first check if the string length is already correct
	if (strlen($string) > $full_length)
	{
		// strip whitespaces from beggining and end of the string 
		$work = trim($string);
		// if the string is still longer than the desired length...
		if (strlen($work) > $full_length)
		{
			$work2 = '';
			// truncate the string
			for ($i = 0; $i <= ($length - 1); $i++)
			{
				$work2 .= $work[$i];
			}
			return $work2 . $cEnd;
		}
		else
		{
			return $work;
		}
	}
	else
	{
		return $string;
	}
}


/**
 * Devuelve el dia de la semana.
 * $vDate puede ser un timestamp o una cadena con formato de fecha (como en MySql)
 *
 * @param mixed $vDate
 * @return string
 */
function returnDay($vDate)
{
	if (is_numeric($vDate))
	{
		$nTimestamp = $vDate;
	}
	else
	{
		$nTimestamp = strtotime($vDate);
	}
	
	$aDays = array('Domingo','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', '');
	return $aDays[date('w', $nTimestamp)];
}

/**
 * Devuelve una cadena que representa el numero ordinal $nNumber.
 *
 * @param int $nNumber
 * @return string
 */
function getOrdinalNumber($nNumber) {
	switch ($nNumber) {
		case 1: return 'primera';
		case 2: return 'segunda';
		case 3: return 'tercera';
		case 4: return 'cuarta';
		case 5: return 'quinta';
		case 6: return 'sexta';
		case 7: return 's&eacute;ptima';
		case 8: return 'octava';
		case 9: return 'novena';
		case 10: return 'd&eacute;cima';
		case 11: return 'und&eacute;cima';
		case 12: return 'duod&eacute;cima';
		case 13: return 'decimotercera';
		case 14: return 'decimocuarta';
		case 15: return 'decimoquinta';
		case 16: return 'decimosexta';
		case 17: return 'decimos&eacute;ptima';
		case 18: return 'decimoctava';
		case 19: return 'decimonovena';
		case 20: return 'vig&eacute;sima';
	}
}

/**
 * Devuelve un print_r precedido por un <pre>.
 * Ideal para debuggear. Fer.
 *
 * @param misc $anything
 * @return print_r
 */
function wowdie($anything){
	echo "<pre>";
	print_r($anything);
}
?>