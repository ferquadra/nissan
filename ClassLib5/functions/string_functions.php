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
 * CodeIgniter String Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/string_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('trim_slashes')) {
	/**
	 * Trim Slashes
	 *
	 * Removes any leading/traling slashes from a string:
	 *
	 * /this/that/theother/
	 *
	 * becomes:
	 *
	 * this/that/theother
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function trim_slashes($str)
	{
	    return trim($str, '/');
	}
}

// ------------------------------------------------------------------------

if (! function_exists('strip_slashes')) {
	/**
	 * Strip Slashes
	 *
	 * Removes slashes contained in a string or in an array
	 *
	 * @access	public
	 * @param	mixed	string or array
	 * @return	mixed	string or array
	 */
	function strip_slashes($str)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = strip_slashes($val);
			}
		}
		else
		{
			$str = stripslashes($str);
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('escape')) {
	/**
	 * Escape Input
	 *
	 * Prepara una/s cadena/s para ser enviada/s al HTML.
	 *
	 * @access	public
	 * @param	mixed	string or array $str
	 * @param	string $charset
	 * @return	mixed	string or array
	 */
	function escape($str, $charset='UTF-8')
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				if (is_array($val)) {
					$str[$key] = escape($val, $charset);
				}
				else {
					$str[$key] = stripslashes($val);
					$str[$key] = htmlentities($str[$key], ENT_QUOTES, $charset);
				}
			}
		}
		else
		{
			$str = stripslashes($str);
			$str = htmlentities($str, ENT_QUOTES, $charset);

		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('escape_input')) {
	/**
	 * Escape Input
	 *
	 * Prepara una/s cadena/s para ser enviada/s a un input.
	 *
	 * @access	public
	 * @param	mixed	string or array $str
	 * @param	string $charset
	 * @return	mixed	string or array
	 */
	function escape_input($str, $charset='UTF-8')
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = stripslashes($val);
				$str[$key] = htmlentities($str[$key], ENT_QUOTES, $charset);

			}
		}
		else
		{
			$str = stripslashes($str);
			$str = htmlentities($str, ENT_QUOTES, $charset);

		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('escape_jsvar')) {
	/**
	 * Escape Input
	 *
	 * Prepara una/s cadena/s para ser enviada/s a una variable javascript.
	 *
	 * @access	public
	 * @param	mixed	string or array $str
	 * @param	string $charset
	 * @return	mixed	string or array
	 */
	function escape_jsvar($str, $charset='UTF-8')
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = stripslashes($val);
				$str[$key] = addcslashes($val, "\0..\37\n\r");

			}
		}
		else
		{
			$str = stripslashes($str);
			$str = addcslashes($str, "\0..\37\n\r");

		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('strip_quotes')) {
	/**
	 * Strip Quotes
	 *
	 * Removes single and double quotes from a string
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function strip_quotes($str)
	{
		return str_replace(array('"', "'"), '', $str);
	}
}

// ------------------------------------------------------------------------

if (! function_exists('quotes_to_entities')) {
	/**
	 * Quotes to Entities
	 *
	 * Converts single and double quotes to entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function quotes_to_entities($str)
	{
		return str_replace(array("\'","\"","'",'"'), array("&#39;","&quot;","&#39;","&quot;"), $str);
	}
}

// ------------------------------------------------------------------------

if (! function_exists('reduce_double_slashes')) {
	/**
	 * Reduce Double Slashes
	 *
	 * Converts double slashes in a string to a single slash,
	 * except those found in http://
	 *
	 * http://www.some-site.com//index.php
	 *
	 * becomes:
	 *
	 * http://www.some-site.com/index.php
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function reduce_double_slashes($str)
	{
		return preg_replace("#([^:])//+#", "\\1/", $str);
	}
}

// ------------------------------------------------------------------------

if (! function_exists('reduce_multiples')) {
	/**
	 * Reduce Multiples
	 *
	 * Reduces multiple instances of a particular character.  Example:
	 *
	 * Fred, Bill,, Joe, Jimmy
	 *
	 * becomes:
	 *
	 * Fred, Bill, Joe, Jimmy
	 *
	 * @access	public
	 * @param	string
	 * @param	string	the character you wish to reduce
	 * @param	bool	TRUE/FALSE - whether to trim the character from the beginning/end
	 * @return	string
	 */
	function reduce_multiples($str, $character = ',', $trim = FALSE)
	{
		$str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);

		if ($trim === TRUE)
		{
			$str = trim($str, $character);
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('random_string')) {
	/**
	 * Create a Random String
	 *
	 * Useful for generating passwords or hashes.
	 *
	 * @access	public
	 * @param	string 	type of random string.  Options: alunum, numeric, nozero, unique
	 * @param	integer	number of characters
	 * @return	string
	 */
	function random_string($type = 'alnum', $len = 8)
	{
		switch($type)
		{
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:

					switch ($type)
					{
						case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'numeric'	:	$pool = '0123456789';
							break;
						case 'nozero'	:	$pool = '123456789';
							break;
					}

					$str = '';
					for ($i=0; $i < $len; $i++)
					{
						$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
					}
					return $str;
			  break;
			case 'unique' : return md5(uniqid(mt_rand()));
			  break;
		}
	}
}

// ------------------------------------------------------------------------

if (! function_exists('alternator'))
{
	/**
	 * Alternator
	 *
	 * Allows strings to be alternated.  See docs...
	 *
	 * @access	public
	 * @param	string (as many parameters as needed)
	 * @return	string
	 */
	function alternator()
	{
		static $i;

		if (func_num_args() == 0)
		{
			$i = 0;
			return '';
		}
		$args = func_get_args();
		return $args[($i++ % count($args))];
	}
}

// ------------------------------------------------------------------------

if (! function_exists('repeater')) {
	/**
	 * Repeater function
	 *
	 * @access	public
	 * @param	string
	 * @param	integer	number of repeats
	 * @return	string
	 */
	function repeater($data, $num = 1)
	{
		return (($num > 0) ? str_repeat($data, $num) : '');
	}
}


if (! function_exists('strip_returns')) {
	/**
	 * Strip Returns
	 * Quita los retornos de carro y saltos de linea de la cadena $str.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function strip_returns($str)
	{
		return str_replace(array("\r", "\n", "\r\n"), '', $str);
	}
}

if (! function_exists('string_ai')) {
	/**
	 * String AI
	 * Devuelve una cadena formateada para usar en PREG de modo que sea insensitiva
	 * a acentos.
	 *
	 * Funciona en UTF8
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function string_ai($str) {
		$return = $str;

		$return = preg_replace('/a|à|á|â|ã|ä|å|ǻ|ā|ă|ą/iu', '[aàáâãäåǻāăą]', $return);
		$return = preg_replace('/e|è|é|ê|ë/iu', '[eèéêë]', $return);
		$return = preg_replace('/i|ì|í|î|ï/iu', '[iìíîï]', $return);
		$return = preg_replace('/o|ò|ó|ô|ö/iu', '[oòóôö]', $return);
		$return = preg_replace('/u|ù|ú|û|ü/iu', '[uùúûü]', $return);

		return $return;
	}
}

if (! function_exists('ibm850_ansi')) {
	/**
	 * Convierte una cadena en IBM850 a ANSI
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function ibm850_ansi($cStr) {
		$aConv = array(128=>199,129=>252,130=>233,131=>226,132=>228,133=>224,134=>229,135=>231,136=>234,137=>235,138=>232,139=>239,140=>238,141=>236,142=>196,143=>197,144=>201,145=>230,146=>198,147=>244,148=>246,149=>242,150=>251,151=>249,152=>255,153=>214,154=>220,155=>248,156=>163,157=>216,158=>215,159=>402,160=>225,161=>237,162=>243,163=>250,164=>241,165=>209,166=>170,167=>186,168=>191,169=>174,170=>172,171=>189,172=>188,173=>161,174=>171,175=>187,176=>9617,177=>9618,178=>9619,179=>9474,180=>9508,181=>193,182=>194,183=>192,184=>169,185=>9571,186=>9553,187=>9559,188=>9565,189=>162,190=>165,191=>9488,192=>9492,193=>9524,194=>9516,195=>9500,196=>9472,197=>9532,198=>227,199=>195,200=>9562,201=>9556,202=>9577,203=>9574,204=>9568,205=>9552,206=>9580,207=>164,208=>240,209=>208,210=>202,211=>203,212=>200,213=>305,214=>205,215=>206,216=>207,217=>9496,218=>9484,219=>9608,220=>9604,221=>166,222=>204,223=>9600,224=>211,225=>223,226=>212,227=>210,228=>245,229=>213,230=>181,231=>254,232=>222,233=>218,234=>219,235=>217,236=>253,237=>221,238=>175,239=>180,240=>173,241=>177,242=>8215,243=>190,244=>182,245=>167,246=>247,247=>184,248=>176,249=>168,250=>183,251=>185,252=>179,253=>178,254=>9632,255=>160);

		$nCant = strlen($cStr);
		for ($i=0; $i<$nCant; ++$i) {
			if (isset($aConv[ord($cStr[$i])])) {
				$cStr[$i] = chr($aConv[ord($cStr[$i])]);
			}
		}

		return $cStr;
	}
}
?>
