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
 * CodeIgniter Cookie Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/cookie_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('set_cookie')) {
	/**
	 * Set cookie
	 *
	 * Accepts six parameter, or you can submit an associative
	 * array in the first parameter containing all the values.
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string	the value of the cookie
	 * @param	string	the number of seconds until expiration
	 * @param	string	the cookie domain.  Usually:  .yourdomain.com
	 * @param	string	the cookie path
	 * @param	string	the cookie prefix
	 * @return	void
	 */
	function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '') {
		trigger_error('Función set_cookie() no implementada.', E_USER_ERROR);
		
		if (is_array($name))
		{		
			foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'name') as $item)
			{
				if (isset($name[$item]))
				{
					$$item = $name[$item];
				}
			}
		}
	
		// Set the config file options
		$CI =& get_instance();
	
		if ($prefix == '' AND $CI->config->item('cookie_prefix') != '')
		{
			$prefix = $CI->config->item('cookie_prefix');
		}
		if ($domain == '' AND $CI->config->item('cookie_domain') != '')
		{
			$domain = $CI->config->item('cookie_domain');
		}
		if ($path == '/' AND $CI->config->item('cookie_path') != '/')
		{
			$path = $CI->config->item('cookie_path');
		}
		
		if ( ! is_numeric($expire))
		{
			$expire = time() - 86500;
		}
		else
		{
			if ($expire > 0)
			{
				$expire = time() + $expire;
			}
			else
			{
				$expire = 0;
			}
		}
	
		setcookie($prefix.$name, $value, $expire, $path, $domain, 0);
	}
}
	
// --------------------------------------------------------------------

if (! function_exists('get_cookie')) {
	/**
	 * Fetch an item from the COOKIE array
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	mixed
	 */
	function get_cookie($index = '', $xss_clean = FALSE) {
		trigger_error('Función get_cookie() no implementada.', E_USER_ERROR);
		$CI =& get_instance();
		return $CI->input->cookie($index, $xss_clean);
	}
}

// --------------------------------------------------------------------

if (! function_exists('delete_cookie')) {
	/**
	 * Delete a COOKIE
	 *
	 * @param	mixed
	 * @param	string	the cookie domain.  Usually:  .yourdomain.com
	 * @param	string	the cookie path
	 * @param	string	the cookie prefix
	 * @return	void
	 */
	function delete_cookie($name = '', $domain = '', $path = '/', $prefix = '') {
		trigger_error('Función delete_cookie() no implementada.', E_USER_ERROR);
		set_cookie($name, '', '', $domain, $path, $prefix);
	}
}

?>