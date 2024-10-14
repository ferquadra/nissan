<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @subpackage 	Helpers
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Date Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/date_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('mdate')) {
	/**
	 * Convert MySQL Style Datecodes
	 *
	 * This function is identical to PHPs date() function,
	 * except that it allows date codes to be formatted using
	 * the MySQL style, where each code letter is preceded
	 * with a percent sign:  %Y %m %d etc...
	 *
	 * The benefit of doing dates this way is that you don't
	 * have to worry about escaping your text letters that
	 * match the date codes.
	 *
	 * @access	public
	 * @param	string
	 * @param	integer
	 * @return	integer
	 */
	function mdate($datestr, $time = false)	{
		if ($time == false) {
			$time = time();
		}
		
		$datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
		return date($datestr, $time);
	}
}

// ------------------------------------------------------------------------

if (! function_exists('days_in_month')) {
	/**
	 * Number of days in a month
	 *
	 * Takes a month/year as input and returns the number of days
	 * for the given month/year. Takes leap years into consideration.
	 *
	 * @access	public
	 * @param	integer a numeric month
	 * @param	integer	a numeric year
	 * @return	integer
	 */
	function days_in_month($month = false, $year = false) {
		if ($month === false) {
			$month = date('n');
		}
		
		if ($month < 1 OR $month > 12) {
			return false;
		}
		
		if ( ! is_numeric($year) || strlen($year) != 4) {
			$year = date('Y');
		}
		
		if ($month == 2) {
			if ($year % 400 == 0 || ($year % 4 == 0 AND $year % 100 != 0)) {
				return 29;
			}
		}
		
		$days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		return $days_in_month[$month - 1];
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('local_to_gmt')) {
	/**
	 * Converts a local Unix timestamp to GMT
	 *
	 * @access	public
	 * @param	integer Unix timestamp
	 * @return	integer
	 */
	function local_to_gmt($time = false) {
		if ($time == '') {
			$time = time();
		}
	
		return mktime( gmdate("H", $time), gmdate("i", $time), gmdate("s", $time), gmdate("m", $time), gmdate("d", $time), gmdate("Y", $time));
	}
}

// ------------------------------------------------------------------------

if (! function_exists('gmt_to_local')) {
	/**
	 * Converts GMT time to a localized value
	 *
	 * Takes a Unix timestamp (in GMT) as input, and returns
	 * at the local value based on the timezone and DST setting
	 * submitted
	 *
	 * @access	public
	 * @param	integer Unix timestamp
	 * @param	string	timezone
	 * @param	bool	whether DST is active
	 * @return	integer
	 */	
	function gmt_to_local($time = false, $timezone = 'UTC', $dst = FALSE) {
		if ($time == false) {
			$time = local_to_gmt();
		}
		
		$time += timezones($timezone) * 3600;
		
		if ($dst == TRUE) {
			$time += 3600;
		}
		
		return $time;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('mysql_to_unix')) {
	/**
	 * Converts a MySQL Timestamp to Unix
	 *
	 * @access	public
	 * @param	integer Unix timestamp
	 * @return	integer
	 */
	function mysql_to_unix($time) {
		// We'll remove certain characters for backward compatibility
		// since the formatting changed with MySQL 4.1
		// YYYY-MM-DD HH:MM:SS
	
		$time = str_replace('-', '', $time);
		$time = str_replace(':', '', $time);
		$time = str_replace(' ', '', $time);
	
		// YYYYMMDDHHMMSS
		return  mktime(
						substr($time, 8, 2),
						substr($time, 10, 2),
						substr($time, 12, 2),
						substr($time, 4, 2),
						substr($time, 6, 2),
						substr($time, 0, 4)
						);
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('unix_to_mysql')) {
	/**
	 * Unix to "MySql"
	 *
	 * Convierte una fecha en formato Unix a MySql
	 *
	 * @access	public
	 * @param	integer Unix timestamp
	 * @param	bool	whether to show seconds
	 * @return	string
	*/
	function unix_to_mysql($time = FALSE, $seconds = TRUE) {
		if ($time === false) {
			$time = time();
		}
		
		if ($seconds) {
			return date('Y-m-d H:i:s', $time);
		}
		else {
			return date('Y-m-d', $time);
		}
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('timezones')) {
	/**
	 * Timezones
	 *
	 * Returns an array of timezones.  This is a helper function
	 * for various other ones in this library
	 *
	 * @access	public
	 * @param	string	timezone
	 * @return	string
	 */
	function timezones($tz = false) {
		// Note: Don't change the order of these even though
		// some items appear to be in the wrong order
		
		$zones = array(
						'UM12' => -12,
						'UM11' => -11,
						'UM10' => -10,
						'UM9'  => -9,
						'UM8'  => -8,
						'UM7'  => -7,
						'UM6'  => -6,
						'UM5'  => -5,
						'UM4'  => -4,
						'UM25' => -2.5,
						'UM3'  => -3,
						'UM2'  => -2,
						'UM1'  => -1,
						'UTC'  => 0,
						'UP1'  => +1,
						'UP2'  => +2,
						'UP3'  => +3,
						'UP25' => +2.5,
						'UP4'  => +4,
						'UP35' => +3.5,
						'UP5'  => +5,
						'UP45' => +4.5,
						'UP6'  => +6,
						'UP7'  => +7,
						'UP8'  => +8,
						'UP9'  => +9,
						'UP85' => +8.5,
						'UP10' => +10,
						'UP11' => +11,
						'UP12' => +12
					);
				
		if ($tz == false) {
			return $zones;
		}
	
		if ($tz == 'GMT') {
			$tz = 'UTC';
		}
		
		return ( ! isset($zones[$tz])) ? false : $zones[$tz];
	}
}

if (! function_exists('spanish_date')) {
	/**
	 * Deuvelve la fecha en formato <i>$cFormat</i>.
	 * %A = Lunes, Martes, etc
	 * %e = dia del mes 1~31
	 * %B = Enero, Febrero, etc
	 * %Y = Año
	 *
	 * @param int $FechaStamp
	 * @return string
	 */
	function spanish_date($cFormat='%A, %e de %B de %Y', $nTimestamp=null, $cLocale = APP_LOCALE) {
		
		// Establece informacion de localidad.
		setlocale(LC_TIME, $cLocale);
		
		// Si no se paso la marca de tiempo pone una por defecto.
		if ($nTimestamp === null) {
			$nTimestamp = time();
		}
		
		// Mapeo para argumentos NO-WINDOWS
		$aMapping = array(
			'%C' => sprintf("%02d", date("Y", $nTimestamp) / 100),
			'%D' => '%m/%d/%y',
			'%e' => sprintf("%' 2d", date("j", $nTimestamp)),
			'%h' => '%b',
			'%n' => "\n",
			'%r' => date("h:i:s", $nTimestamp) . " %p",
			'%R' => date("H:i", $nTimestamp),
			'%t' => "\t",
			'%T' => '%H:%M:%S',
			'%u' => ($w = date("w", $nTimestamp)) ? $w : 7
		);
		$cFormat = str_replace(array_keys($aMapping), array_values($aMapping), $cFormat);
		
		// Fecha de salida.
		$cFecha = strftime($cFormat, $nTimestamp);
		return $cFecha;
	}
}

if (! function_exists('english_to_mysql')) {
	/**
	 * Deuvelve la fecha para MySql.
	 * El parametro $cFecha recibe YYYY/DD/MM (formato ingles)
	 *
	 * @param string $cFecha
	 * @return string
	 */
	function english_to_mysql($cFecha) { 
		$aFecha = explode('/', $cFecha);
		
		return "{$aFecha[0]}-{$aFecha[2]}-{$aFecha[1]}";
	}
}

if (! function_exists('mysql_to_english')) {
	/**
	 * Deuvelve la fecha en formato ingles.
	 * El parametro $cFecha recibe YYYY-MM-DD (mysql)
	 *
	 * @param string $cFecha
	 * @return string
	 */
	function mysql_to_english($cFecha) { 
		$aFecha = explode('-', $cFecha);
		
		return "{$aFecha[0]}/{$aFecha[2]}/{$aFecha[1]}";
	}
}

if (! function_exists('prepare_mysql_hour')) {
	/**
	 * Formatea una hora para poder usarla en MySql.
	 * El parametro $cHora puede ser algo como esto:
	 * <i>4</i>, <i>15:50</i>
	 * 
	 * El parametro $nForce es para forzar la hora a cero
	 * en caso que $cHora corresponda a un horario incorrecto, EJ:
	 * <i>36:98:45</i>
	 *
	 * @param string $cHora
	 * @param bool $nForce
	 * @return string
	 */
	function prepare_mysql_hour($cHora, $nForce=false) { 
		$aHora = explode(':', $cHora);
		
		if (@$aHora[0] < 0 || @$aHora[0] > 23) {
			if ($nForce) {
				$aHora[0] = 0;
			}
			else {
				return false;
			}
		}
		if (@$aHora[1] < 0 || @$aHora[1] > 59) {
			if ($nForce) {
				$aHora[1] = 0;
			}
			else {
				return false;
			}
		}
		if (@$aHora[2] < 0 || @$aHora[2] > 59) {
			if ($nForce) {
				$aHora[2] = 0;
			}
			else {
				return false;
			}
		}
		
		$cReturn = sprintf('%02d', @$aHora[0]).
			':'.sprintf('%02d', @$aHora[1]).
			':'.sprintf('%02d', @$aHora[2]);
			
		return $cReturn;
	}
}

if (! function_exists('mysql2date')) {
	
	/**
	 * Recibe una fecha o fecha/hora en formato de MySql (YYYY-MM-DD HH:MM:SS) y la
	 * pasa al formato especificado por $cFormat.
	 * 
	 * Para saber mas sobre el formato consultar la documentacion de la funcion strftime
	 * en el manual de PHP.
	 *
	 * @param string $cMySqlDate
	 * @param string $cFormat
	 * @return string
	 * @see strftime
	 */
	function mysql2date($cMySqlDate, $cFormat='%d/%m/%Y') {
		if ($cMySqlDate == '') {
			return '';
		}
		
		if (!preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/", $cMySqlDate, $aMySqlDate)) {
			preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})/", $cMySqlDate, $aMySqlDate);
		}
		
		$cReturn = $cFormat;
		$cReturn = str_replace("%d", $aMySqlDate[3], $cReturn);
		$cReturn = str_replace("%m", $aMySqlDate[2], $cReturn);
		$cReturn = str_replace("%Y", $aMySqlDate[1], $cReturn);
		if (isset($aMySqlDate[4])) {
			$cReturn = str_replace("%H", $aMySqlDate[4], $cReturn);
			$cReturn = str_replace("%i", @$aMySqlDate[5], $cReturn);
			$cReturn = str_replace("%s", @$aMySqlDate[6], $cReturn);
		}
		
		return $cReturn;
		
		$nMarca = strtotime($cMySqlDate);
		
		$cDateStr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $cFormat));
		return date($cDateStr, $nMarca);
	}
}

if (! function_exists('date2mysql')) {
	
	/**
	 * Recibe una fecha o fecha/hora en formato de MySql (YYYY-MM-DD HH:MM:SS) y la
	 * pasa al formato especificado por $cFormat.
	 * 
	 * Para saber mas sobre el formato consultar la documentacion de la funcion strftime
	 * en el manual de PHP.
	 *
	 * @param string $cMySqlDate
	 * @param string $cFormat
	 * @return string
	 * @see strftime
	 */
	function date2mysql($cDate, $cFormat='%d/%m/%Y', $nTime=true) {
		if ($cDate == '' || $cDate == '__/__/____') {
			return null;
		}
		
		// Se definen los reemplazos por formato (el formato es igual al que usa strftime).
		$aReemplazos['%d'] = array('f' => '([0-9]{1,2})', 'id' => 2);
		$aReemplazos['%m'] = array('f' => '([0-9]{1,2})', 'id' => 1);
		$aReemplazos['%y'] = array('f' => '([0-9]{2})', 'id' => 0);
		$aReemplazos['%Y'] = array('f' => '([0-9]{2,4})', 'id' => 0);
		$aReemplazos['%H'] = array('f' => '([0-9]{2})', 'id' => 3);
		$aReemplazos['%i'] = array('f' => '([0-9]{2})', 'id' => 4);
		$aReemplazos['%s'] = array('f' => '([0-9]{2})', 'id' => 5);
		
		$aReemplazosVacios['%d'] = '[0-9]{1,2}';
		$aReemplazosVacios['%m'] = '[0-9]{1,2}';
		$aReemplazosVacios['%y'] = '[0-9]{2}';
		$aReemplazosVacios['%Y'] = '[0-9]{2,4}';
		$aReemplazosVacios['%H'] = '[0-9]{2}';
		$aReemplazosVacios['%i'] = '[0-9]{2}';
		$aReemplazosVacios['%s'] = '[0-9]{2}';
		
		$aMySqlDate = array('0000', '00', '00', '00', '00', '00'); // Define los datos de fecha para MySql.
		
		// Cicla por todos los formatos de reemplazo.
		foreach ($aReemplazos as $cClave => $aValores) {
			// Prepara la expresion regular.
			$cFormatoTmp = str_replace($cClave, $aValores['f'], $cFormat);
			$cFormatoTmp = strtr($cFormatoTmp, $aReemplazosVacios);
			$cFormatoTmp = str_replace('/', '\/', $cFormatoTmp);
			
			// Realiza la busqueda del dato de fecha, si la encuentra la pone en el array que contiene
			// los datos de fecha para mysql.
			if (preg_match("/{$cFormatoTmp}/", $cDate, $aFechaTmp)) {
				if (count($aFechaTmp) == 2) {
					$aMySqlDate[$aValores['id']] = $aFechaTmp[1];
				}
			}
		}
		
		if (strlen($aMySqlDate[0]) == 2) {
			$aMySqlDate[0] = "20".$aMySqlDate[0];
		}
		
		// Genera la fecha para MySql en el formato adecuado.
		if ($nTime) {
			$cReturn = "{$aMySqlDate[0]}-{$aMySqlDate[1]}-{$aMySqlDate[2]} {$aMySqlDate[3]}:{$aMySqlDate[4]}:{$aMySqlDate[5]}";
		}
		else {
			$cReturn = "{$aMySqlDate[0]}-{$aMySqlDate[1]}-{$aMySqlDate[2]}";
		}
		
		
		
		if ($cReturn == '0000-00-00 00:00:00' || $cReturn == '0000-00-00') {
			return null;
		}
		else {
			return $cReturn;
		}
	}
}

if (! function_exists('date_diff')) {
	
	/**
	 * Devuelve la diferencia entre dos fechas.
	 *
	 * @param string $cFecha1
	 * @param string $cFecha2
	 * @return string
	 */
	function date_diff($cFecha1, $cFecha2) {
		$nFecha1 = strtotime($cFecha1);
		$nFecha2 = strtotime($cFecha2);
		$nDiff = (int) (($nFecha1 - $nFecha2) / 86400);
		return $nDiff;
	}
}

if (! function_exists('dec2hhmm')) {
	
	/**
	 * Convierte una cantidad decimal a horas y minutos: 3.25 -> 03:15, 2.50 -> 02:30.
	 *
	 * @param string $nDecimal
	 * @return string
	 */
	function dec2hhmm($nDecimal) {
		$aTemp = explode('.', sprintf('%02.2f', $nDecimal));
		$cHora = sprintf('%02s', $aTemp[0]).':'.sprintf('%02s',floor($aTemp[1] * .60));
		return $cHora;
	}
}

if (! function_exists('sec2time')) {
	
	/**
	 * Convierte una cantidad de segundos a formato HH:ii
	 *
	 * @param string $nSegundos
	 * @return string
	 */
	function sec2time($nSegundos) {
		return dec2hhmm($nSegundos / 3600);
	}
}
?>