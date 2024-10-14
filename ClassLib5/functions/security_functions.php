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
 * CodeIgniter Security Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/security_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('xss_clean')) {
	/**
	 * XSS Filtering
	 *
	 * @access	public
	 * @param	string
	 * @param	string	the character set of your data
	 * @return	string
	 */	
	function xss_clean($str, $charset = 'ISO-8859-1')
	{
		trigger_error('Función xss_clean() no implementada.', E_USER_ERROR);
		$CI =& get_instance();
		return $CI->input->xss_clean($str, $charset);
	}
}

// --------------------------------------------------------------------

if (! function_exists('dohash')) {	
	/**
	 * Hash encode a string
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function dohash($str, $type = 'sha1')
	{
		if ($type == 'sha1')
		{
			if ( ! function_exists('sha1'))
			{
				if ( ! function_exists('mhash'))
				{	
					require_once(BASEPATH.'libraries/Sha1'.EXT);
					$SH = new CI_SHA;
					return $SH->generate($str);
				}
				else
				{
					return bin2hex(mhash(MHASH_SHA1, $str));
				}
			}
			else
			{
				return sha1($str);
			}	
		}
		else
		{
			return md5($str);
		}
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('strip_image_tags')) {
	/**
	 * Strip Image Tags
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function strip_image_tags($str)
	{
		$str = preg_replace("#<img\s+.*?src\s*=\s*[\"'](.+?)[\"'].*?\>#", "\\1", $str);
		$str = preg_replace("#<img\s+.*?src\s*=\s*(.+?).*?\>#", "\\1", $str);
			
		return $str;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('encode_php_tags')){
	/**
	 * Convert PHP tags to entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function encode_php_tags($str)
	{
		return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
	}
}

?>