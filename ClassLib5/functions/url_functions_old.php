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
 * CodeIgniter URL Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('site_url')) {
	/**
	 * Site URL
	 *
	 * Create a local URL based on your basepath. Segments can be passed via the
	 * first parameter either as a string or an array.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function site_url($uri = '')
	{
		trigger_error('Función site_url() no implementada.', E_USER_ERROR);
		$CI =& get_instance();
		return $CI->config->site_url($uri);
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('base_url')) {
	/**
	 * Base URL
	 *
	 * Returns the "base_url" item from your config file
	 *
	 * @access	public
	 * @return	string
	 */	
	function base_url()
	{
		trigger_error('Función base_url() no implementada.', E_USER_ERROR);
		$CI =& get_instance();
		return $CI->config->slash_item('base_url');
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('index_page')) {
	/**
	 * Index page
	 *
	 * Returns the "index_page" from your config file
	 *
	 * @access	public
	 * @return	string
	 */	
	function index_page()
	{
		trigger_error('Función index_page() no implementada.', E_USER_ERROR);
		$CI =& get_instance();
		return $CI->config->item('index_page');
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('anchor')) {
	/**
	 * Anchor Link
	 *
	 * Creates an anchor based on the local URL.
	 *
	 * @access	public
	 * @param	string	the URL
	 * @param	string	the link title
	 * @param	mixed	any attributes
	 * @return	string
	 */	
	function anchor($uri = '', $title = '', $attributes = '')
	{
		$title = (string) $title;
	
		if ( ! is_array($uri))
		{
			$site_url = ( ! preg_match('!^\w+://!i', $uri)) ? site_url($uri) : $uri;
		}
		else
		{
			$site_url = site_url($uri);
		}
	
		if ($title == '')
		{
			$title = $site_url;
		}

		if ($attributes == '')
		{
			$attributes = ' title="'.$title.'"';
		}
		else
		{
			$attributes = _parse_attributes($attributes);
		}

		return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('anchor_popup')) {
	/**
	 * Anchor Link - Pop-up version
	 *
	 * Creates an anchor based on the local URL. The link
	 * opens a new window based on the attributes specified.
	 *
	 * @access	public
	 * @param	string	the URL
	 * @param	string	the link title
	 * @param	mixed	any attributes
	 * @return	string
	 */
	function anchor_popup($uri = '', $title = '', $attributes = FALSE)
	{	
		$title = (string) $title;
	
		$site_url = ( ! preg_match('!^\w+://!i', $uri)) ? site_url($uri) : $uri;
	
		if ($title == '')
		{
			$title = $site_url;
		}
	
		if ($attributes === FALSE)
		{
			return "<a href='javascript:void(0);' onclick=\"window.open('".$site_url."', '_blank');\">".$title."</a>";
		}
	
		if ( ! is_array($attributes))
		{
			$attributes = array();
		}
		
		foreach (array('width' => '800', 'height' => '600', 'scrollbars' => 'yes', 'status' => 'yes', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0', ) as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
		}

		return "<a href='javascript:void(0);' onclick=\"window.open('".$site_url."', '_blank', '"._parse_attributes($atts, TRUE)."');\">".$title."</a>";
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('mailto')) {
	/**
	 * Mailto Link
	 *
	 * @access	public
	 * @param	string	the email address
	 * @param	string	the link title
	 * @param	mixed 	any attributes
	 * @return	string
	 */
	function mailto($email, $title = '', $attributes = '')
	{
		$title = (string) $title;
	
		if ($title == "")
		{
			$title = $email;
		}
	
		$attributes = _parse_attributes($attributes);
	
		return '<a href="mailto:'.$email.'"'.$attributes.'>'.$title.'</a>';
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('safe_mailto')) {
	/**
	 * Encoded Mailto Link
	 *
	 * Create a spam-protected mailto link written in Javascript
	 *
	 * @access	public
	 * @param	string	the email address
	 * @param	string	the link title
	 * @param	mixed 	any attributes
	 * @return	string
	 */
	function safe_mailto($email, $title = '', $attributes = '')
	{
		$title = (string) $title;
	
		if ($title == "")
		{
			$title = $email;
		}
					
		for ($i = 0; $i < 16; $i++)
		{
			$x[] = substr('<a href="mailto:', $i, 1);
		}
	
		for ($i = 0; $i < strlen($email); $i++)
		{
			$x[] = "|".ord(substr($email, $i, 1));
		}

		$x[] = '"';

		if ($attributes != '')
		{
			if (is_array($attributes))
			{
				foreach ($attributes as $key => $val)
				{
					$x[] =  ' '.$key.'="';
					for ($i = 0; $i < strlen($val); $i++)
					{
						$x[] = "|".ord(substr($val, $i, 1));
					}
					$x[] = '"';
				}
			}
			else
			{	
				for ($i = 0; $i < strlen($attributes); $i++)
				{
					$x[] = substr($attributes, $i, 1);
				}
			}
		}	
	
		$x[] = '>';
	
		$temp = array();
		for ($i = 0; $i < strlen($title); $i++)
		{
			$ordinal = ord($title[$i]);
	
			if ($ordinal < 128)
			{
				$x[] = "|".$ordinal;
			}
			else
			{
				if (count($temp) == 0)
				{
					$count = ($ordinal < 224) ? 2 : 3;
				}
		
				$temp[] = $ordinal;
				if (count($temp) == $count)
				{
					$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);
					$x[] = "|".$number;
					$count = 1;
					$temp = array();
				}
			}
		}
	
		$x[] = '<'; $x[] = '/'; $x[] = 'a'; $x[] = '>';
	
		$x = array_reverse($x);
		ob_start();
	
	?><script type="text/javascript">
	//<![CDATA[
	var l=new Array();
	<?php
	$i = 0;
	foreach ($x as $val){ ?>l[<?php echo $i++; ?>]='<?php echo $val; ?>';<?php } ?>

	for (var i = l.length-1; i >= 0; i=i-1){
	if (l[i].substring(0, 1) == '|') document.write("&#"+unescape(l[i].substring(1))+";");
	else document.write(unescape(l[i]));}
	//]]>
	</script><?php

		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('auto_link')) {
	/**
	 * Auto-linker
	 *
	 * Automatically links URL and Email addresses.
	 * Note: There's a bit of extra code here to deal with
	 * URLs or emails that end in a period.  We'll strip these
	 * off and add them after the link.
	 *
	 * @access	public
	 * @param	string	the string
	 * @param	string	the type: email, url, or both
	 * @param	bool 	whether to create pop-up links
	 * @return	string
	 */
	function auto_link($str, $type = 'both', $popup = FALSE)
	{
		if ($type != 'email')
		{		
			if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $str, $matches))
			{
				$pop = ($popup == TRUE) ? " target=\"_blank\" " : "";
		
				for ($i = 0; $i < sizeof($matches['0']); $i++)
				{
					$period = '';
					if (preg_match("|\.$|", $matches['6'][$i]))
					{
						$period = '.';
						$matches['6'][$i] = substr($matches['6'][$i], 0, -1);
					}
			
					$str = str_replace($matches['0'][$i],
										$matches['1'][$i].'<a href="http'.
										$matches['4'][$i].'://'.
										$matches['5'][$i].
										$matches['6'][$i].'"'.$pop.'>http'.
										$matches['4'][$i].'://'.
										$matches['5'][$i].
										$matches['6'][$i].'</a>'.
										$period, $str);
				}
			}
		}

		if ($type != 'url')
		{	
			if (preg_match_all("/([a-zA-Z0-9_\.\-]+)@([a-zA-Z0-9\-]+)\.([a-zA-Z0-9\-\.]*)/i", $str, $matches))
			{
				for ($i = 0; $i < sizeof($matches['0']); $i++)
				{
					$period = '';
					if (preg_match("|\.$|", $matches['3'][$i]))
					{
						$period = '.';
						$matches['3'][$i] = substr($matches['3'][$i], 0, -1);
					}
			
					$str = str_replace($matches['0'][$i], safe_mailto($matches['1'][$i].'@'.$matches['2'][$i].'.'.$matches['3'][$i]).$period, $str);
				}
		
			}
		}
		return $str;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('prep_url')) {
	/**
	 * Prep URL
	 *
	 * Simply adds the http:// part if missing
	 *
	 * @access	public
	 * @param	string	the URL
	 * @return	string
	 */
	function prep_url($str = '')
	{
		if ($str == 'http://' OR $str == '')
		{
			return '';
		}
	
		if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://')
		{
			$str = 'http://'.$str;
		}
	
		return $str;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('url_title')) {
	/**
	 * Create URL Title
	 *
	 * Takes a "title" string as input and creates a
	 * human-friendly URL string with either a dash
	 * or an underscore as the word separator.
	 *
	 * @access	public
	 * @param	string	the string
	 * @param	string	the separator: dash, or underscore
	 * @return	string
	 */
	function url_title($str, $separator = 'dash') {
		$utf = is_utf($str);
		
		if ($separator == 'dash') {
			$search		= '_';
			$replace	= '-';
		}
		else {
			$search		= '-';
			$replace	= '_';
		}
		
		if ($utf) {
			$str = utf8_decode($str);
		}
		
		// Los caracteres a transformar están en UTF (la condificación del archivo).
		$aOrigen  = array_map('utf8_decode', array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'ü'));
		$aDestino = array_map('utf8_decode', array('a', 'e', 'i', 'o', 'u', 'n', 'u'));
		$str = str_ireplace($aOrigen, $aDestino, $str);
		
		
		$trans = array(
			$search								=> $replace,
			"\s+"									=> $replace,
			"[^a-z0-9".$replace."]"			=> '',
			$replace."+"						=> $replace,
			$replace."$"						=> '',
			"^".$replace						=> ''
	   );
	   
		$str = strip_tags(strtolower($str));
	
		foreach ($trans as $key => $val) {
			$str = preg_replace("#".$key."#", $val, $str);
		}
		
		return trim(stripslashes($str));
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('redirect')) {
	/**
	 * Header Redirect
	 *
	 * Header redirect in two flavors
	 *
	 * @access	public
	 * @param	string	the URL
	 * @param	string	the method: location or redirect
	 * @return	string
	 */
	function redirect($uri = '', $method = 'location')
	{
		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".site_url($uri));
				break;
			default			: header("Location: ".site_url($uri));
				break;
		}
		exit;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('_parse_attributes')) {
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	function _parse_attributes($attributes, $javascript = FALSE)
	{
		if (is_string($attributes))
		{
			return ($attributes != '') ? ' '.$attributes : '';
		}

		$att = '';
		foreach ($attributes as $key => $val)
		{
			if ($javascript == TRUE)
			{
				$att .= $key . '=' . $val . ',';
			}
			else
			{
				$att .= ' ' . $key . '="' . $val . '"';
			}
		}
	
		if ($javascript == TRUE AND $att != '')
		{
			$att = substr($att, 0, -1);
		}
	
		return $att;
	}
}





function is_utf($t)
{
	if ( @preg_match ('/.+/u', $t) ) {
 		
		return true;
	}
}


function isEmpty($word)
{
	$isEmpty = false;
   	
	$empty = array(
		"a", "ante", "bajo", "con", "contra", "de", "desde", "en",
   		"entre", "hacia", "hasta", "para", "por", "segun", "sin", "so",
		"sobre", "tras", "durante", "mediante","la","las","los","el",
		"un","uno","una","unos","unas","y","del","este","esto", "esta", "estos",
		"estas", "ese", "esa", "esos", "esas", "aquel", "aquella", "aquellos", "aquellas",
		"las","se","va","le","les"
	);
   						
	foreach($empty as $v)
   	{
   		if($v==$word)
  		{
  			$isEmpty = true;
  			break;
		}
  	}
  	
  	return $isEmpty;
}

function drop_special_chars($str) {
	
	//if(!$sep) $sep = "/";
	//Quita los carateres especiales del array
	$tofind = array("/","(",",","|","'","|","\\",".",")","/","[","]","\"",'"',"¿","?","!","¡","-","_","=","%",":"," ");
	$str = str_replace( $tofind, ' ', $str );
	$tofind = '';
	
	$dict = array(
		'á' => 'a',
		'�?' => 'A',
		'ç' => 'c',
		'Ç' => 'C',
		'é' => 'e',
		'É' => 'E',
		'í' => 'i',
		'�?' => 'I',
		'ñ' => 'n',
		'Ñ' => 'N',
		'ó' => 'o',
		'Ó' => 'O',
		'ú' => 'u',
		'Ú' => 'U',
		'Ü' => 'U',
		'ü' => 'u'
	);
	
	$str = strtr($str, $dict);
	
	$str = strtolower($str);
	
	return $str;
}




function strtosem( $str, $deleteEmpty=true, $id = FALSE, $sep='/' )
{	
	//quitar caracteres especiales
	$str = drop_special_chars( $str );

	//Obtener un array con las palabras
	$parts = explode(' ', trim($str));
	
	if($deleteEmpty)
	{
		$parts_destination = array();
			
		foreach($parts as $part)
		{
			
			$parte = trim($part);
				
			if(!isEmpty($part) && !empty($part))
			{
				$parts_destination[] = $part;
			}
		}
			
		$str = implode($sep,$parts_destination);
	}
	else
	{
		$str = implode($sep,$parts);
	}
		
	if($id)
		return $str . $sep . $id;
	else
		return $str;
}


/*
 * Convertir una cadena apta para la url
 */
function replace( $str, $union='/' ) {

	$esc = drop_special_chars($str);
	$esc = trim($esc);

	return str_replace(' ',$union,$esc);

}

if (! function_exists('get_query_string')) {
	/**
	 * Get Query String
	 *
	 * Devuelve una cadena de Query String basada en $_GET.
	 * Si se pasan cadenas como parametros se omiten las respectivas
	 * variables de $_GET del retorno de la funcion.
	 *
	 * @access	public
	 * @return	string
	 */
	function get_query_string() {
		// Obtiene los argumentos que indican que variables ignorar.
		$aArgs = func_get_args();
		
		// Buffer de retorno.
		$aRet = array();
		
		foreach ($_GET as $var => $item) {
			if (in_array($var, $aArgs)) {
				continue;
			}
			else {
				if (is_array($item)) {
					foreach ($item as $key => $value) {
						$aRet[] = "{$var}[{$key}]={$value}";
					}
				}
				else {
					$aRet[] = "{$var}={$item}";
				}
			}
		}
		
		return join('&amp;', $aRet);
	}
}
?>