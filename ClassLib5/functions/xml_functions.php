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
 * CodeIgniter XML Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/xml_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('xml_convert')) {
	/**
	 * Convert Reserved XML characters to Entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function xml_convert($str)
	{
		$temp = '__TEMP_AMPERSANDS__';

		// Replace entities to temporary markers so that 
		// ampersands won't get messed up
		$str = preg_replace("/&#(\d+);/", "$temp\\1;", $str);
		$str = preg_replace("/&(\w+);/",  "$temp\\1;", $str);
	
		$str = str_replace(array("&","<",">","\"", "'", "-"),
						   array("&amp;", "&lt;", "&gt;", "&quot;", "&#39;", "&#45;"),
						   $str);

		// Decode the temp markers back to entities		
		$str = preg_replace("/$temp(\d+);/","&#\\1;",$str);
		$str = preg_replace("/$temp(\w+);/","&\\1;", $str);
		
		return $str;
	}
}

?>