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
 * CodeIgniter Array Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('element')) {
	/**
	 * Element
	 *
	 * Lets you determine whether an array index is set and whether it has a value.
	 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */
	function element($item, $array, $default = FALSE)
	{
		if ( ! isset($array[$item]) OR $array[$item] == "")
		{
			return $default;
		}

		return $array[$item];
	}	
}

// ------------------------------------------------------------------------


if (! function_exists('random_element')) {
	/**
	 * Random Element - Takes an array as input and returns a random element
	 *
	 * @access	public
	 * @param	array
	 * @return	mixed	depends on what the array contains
	 */	
	function random_element($array)
	{
		if ( ! is_array($array))
		{
			return $array;
		}
		return $array[array_rand($array)];
	}	
}


// ------------------------------------------------------------------------


if (! function_exists('join_recordset')) {
	/**
	 * Random Element - Takes an array as input and returns a random element
	 *
	 * @access	public
	 * @param	array
	 * @return	mixed	depends on what the array contains
	 */	
	function join_recordset($cGlue, $aArray, $vKey) {
		$aRet = array();
		
		foreach ($aArray as $item) {
			$aRet[] = $item[$vKey];
		}
		
		return join($cGlue, $aRet);
	}	
}

if (! function_exists('trim_recursive')) {
	/**
	 * Trims a entire array recursivly.
	 * 
	 * @author      Jonas John
	 * @version     0.2
	 * @link        http://www.jonasjohn.de/snippets/php/trim-array.htm
	 * @param       array      $Input      Input array
	 */
	function trim_recursive($Input){
		if (!is_array($Input)) {
			return trim($Input);
		}
		
		return array_map('trim_recursive', $Input);
	}
}
?>