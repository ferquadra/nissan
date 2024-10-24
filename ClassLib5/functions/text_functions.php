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
 * CodeIgniter Text Helpers
 *
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/text_helper.html
 */

// ------------------------------------------------------------------------

if (! function_exists('word_limiter')) {
	/**
	 * Word Limiter
	 *
	 * Limits a string to X number of words.
	 *
	 * @access	public
	 * @param	string
	 * @param	integer
	 * @param	string	the end character. Usually an ellipsis
	 * @return	string
	 */	
	function word_limiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) == '')
		{
			return $str;
		}
	
		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
			
		if (strlen($str) == strlen($matches[0]))
		{
			$end_char = '';
		}
		
		return rtrim($matches[0]).$end_char;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('character_limiter')) {
	/**
	 * Character Limiter
	 *
	 * Limits the string based on the character count.  Preserves complete words
	 * so the character count may not be exactly as specified.
	 *
	 * @access	public
	 * @param	string
	 * @param	integer
	 * @param	string	the end character. Usually an ellipsis
	 * @return	string
	 */	
	function character_limiter($str, $n = 500, $end_char = '&#8230;')
	{
		if (strlen($str) < $n)
		{
			return $str;
		}
		
		$str = preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str));

		if (strlen($str) <= $n)
		{
			return $str;
		}
									
		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			if (strlen($out.$val.' ') >= $n)
			{
				return trim($out).$end_char;
			}		
			$out .= $val.' ';
		}
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('ascii_to_entities')) {
	/**
	 * High ASCII to Entities
	 *
	 * Converts High ascii text and MS Word special characters to character entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */	
	function ascii_to_entities($str)
	{
	   $count	= 1;
	   $out	= '';
	   $temp	= array();
	
	   for ($i = 0, $s = strlen($str); $i < $s; $i++)
	   {
		   $ordinal = ord($str[$i]);
	
		   if ($ordinal < 128)
		   {
			   $out .= $str[$i];
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

				   $out .= '&#'.$number.';';
				   $count = 1;
				   $temp = array();
			   }
		   }
	   }

	   return $out;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('entities_to_ascii')) {
	/**
	 * Entities to ASCII
	 *
	 * Converts character entities back to ASCII
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	string
	 */	
	function entities_to_ascii($str, $all = TRUE)
	{
	   if (preg_match_all('/\&#(\d+)\;/', $str, $matches))
	   {
		   for ($i = 0, $s = count($matches['0']); $i < $s; $i++)
		   {				
			   $digits = $matches['1'][$i];

			   $out = '';

			   if ($digits < 128)
			   {
				   $out .= chr($digits);
		
			   }
			   elseif ($digits < 2048)
			   {
				   $out .= chr(192 + (($digits - ($digits % 64)) / 64));
				   $out .= chr(128 + ($digits % 64));
			   }
			   else
			   {
				   $out .= chr(224 + (($digits - ($digits % 4096)) / 4096));
				   $out .= chr(128 + ((($digits % 4096) - ($digits % 64)) / 64));
				   $out .= chr(128 + ($digits % 64));
			   }

			   $str = str_replace($matches['0'][$i], $out, $str);				
		   }
	   }

	   if ($all)
	   {
		   $str = str_replace(array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;", "&#45;"),
							  array("&","<",">","\"", "'", "-"),
							  $str);
	   }

	   return $str;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('word_censor')) {
	/**
	 * Word Censoring Function
	 *
	 * Supply a string and an array of disallowed words and any
	 * matched words will be converted to #### or to the replacement
	 * word you've submitted.
	 *
	 * @access	public
	 * @param	string	the text string
	 * @param	string	the array of censoered words
	 * @param	string	the optional replacement value
	 * @return	string
	 */	
	function word_censor($str, $censored, $replacement = '')
	{
		if ( ! is_array($censored))
		{
			return $str;
		}

		$str = ' '.$str.' ';
		foreach ($censored as $badword)
		{
			if ($replacement != '')
			{
				$str = preg_replace("/\b(".str_replace('\*', '\w*?', preg_quote($badword)).")\b/i", $replacement, $str);
			}
			else
			{
				$str = preg_replace("/\b(".str_replace('\*', '\w*?', preg_quote($badword)).")\b/ie", "str_repeat('#', strlen('\\1'))", $str);
			}
		}
	
		return trim($str);
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('highlight_code')) {
	/**
	 * Code Highlighter
	 *
	 * Colorizes code strings
	 *
	 * @access	public
	 * @param	string	the text string
	 * @return	string
	 */	
	function highlight_code($str)
	{		
		// The highlight string function encodes and highlights
		// brackets so we need them to start raw
		$str = str_replace(array('&lt;', '&gt;'), array('<', '>'), $str);
	
		// Replace any existing PHP tags to temporary markers so they don't accidentally
		// break the string out of PHP, and thus, thwart the highlighting.
	
		$str = str_replace(array('<?', '?>', '<%', '%>', '\\', '</script>'), 
							array('phptagopen', 'phptagclose', 'asptagopen', 'asptagclose', 'backslashtmp', 'scriptclose'), $str);

		// The highlight_string function requires that the text be surrounded
		// by PHP tags.  Since we don't know if A) the submitted text has PHP tags,
		// or B) whether the PHP tags enclose the entire string, we will add our
		// own PHP tags around the string along with some markers to make replacement easier later
	
		$str = '<?php tempstart'."\n".$str.'tempend ?>';
	
		// All the magic happens here, baby!
		$str = highlight_string($str, TRUE);

		// Prior to PHP 5, the highlight function used icky font tags
		// so we'll replace them with span tags.	
		if (abs(phpversion()) < 5)
		{
			$str = str_replace(array('<font ', '</font>'), array('<span ', '</span>'), $str);
			$str = preg_replace('#color="(.*?)"#', 'style="color: \\1"', $str);
		}
	
		// Remove our artificially added PHP
		$str = preg_replace("#\<code\>.+?tempstart\<br />(?:\</span\>)?#is", "<code>\n", $str);
		$str = preg_replace("#tempend.+#is", "</span>\n</code>", $str);	
	
		// Replace our markers back to PHP tags.
		$str = str_replace(array('phptagopen', 'phptagclose', 'asptagopen', 'asptagclose', 'backslashtmp', 'scriptclose'),
							array('&lt;?', '?&gt;', '&lt;%', '%&gt;', '\\', '&lt;/script&gt;'), $str);
										
		return $str;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('highlight_phrase')) {
	/**
	 * Phrase Highlighter
	 *
	 * Highlights a phrase within a text string
	 *
	 * @access	public
	 * @param	string	the text string
	 * @param	string	the phrase you'd like to highlight
	 * @param	string	the openging tag to precede the phrase with
	 * @param	string	the closing tag to end the phrase with
	 * @return	string
	 */	
	function highlight_phrase($str, $phrase, $tag_open = '<strong>', $tag_close = '</strong>')
	{
		if ($str == '')
		{
			return '';
		}
	
		if ($phrase != '')
		{
			return preg_replace('/('.preg_quote($phrase, '/').')/i', $tag_open."\\1".$tag_close, $str);
		}

		return $str;
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('word_wrap')) {
	/**
	 * Word Wrap
	 *
	 * Wraps text at the specified character.  Maintains the integrity of words.
	 * Anything placed between {unwrap}{/unwrap} will not be word wrapped, nor
	 * will URLs.
	 *
	 * @access	public
	 * @param	string	the text string
	 * @param	integer	the number of characters to wrap at
	 * @return	string
	 */	
	function word_wrap($str, $charlim = '76')
	{
		// Se the character limit
		if ( ! is_numeric($charlim))
			$charlim = 76;
	
		// Reduce multiple spaces
		$str = preg_replace("| +|", " ", $str);
	
		// Standardize newlines
		$str = preg_replace("/\r\n|\r/", "\n", $str);
	
		// If the current word is surrounded by {unwrap} tags we'll 
		// strip the entire chunk and replace it with a marker.
		$unwrap = array();
		if (preg_match_all("|(\{unwrap\}.+?\{/unwrap\})|s", $str, $matches))
		{
			for ($i = 0; $i < count($matches['0']); $i++)
			{
				$unwrap[] = $matches['1'][$i];				
				$str = str_replace($matches['1'][$i], "{{unwrapped".$i."}}", $str);
			}
		}
	
		// Use PHP's native function to do the initial wordwrap.  
		// We set the cut flag to FALSE so that any individual words that are 
		// too long get left alone.  In the next step we'll deal with them.
		$str = wordwrap($str, $charlim, "\n", FALSE);
	
		// Split the string into individual lines of text and cycle through them
		$output = "";
		foreach (explode("\n", $str) as $line) 
		{
			// Is the line within the allowed character count?
			// If so we'll join it to the output and continue
			if (strlen($line) <= $charlim)
			{
				$output .= $line."\n";			
				continue;
			}
			
			$temp = '';
			while((strlen($line)) > $charlim) 
			{
				// If the over-length word is a URL we won't wrap it
				if (preg_match("!\[url.+\]|://|wwww.!", $line))
				{
					break;
				}

				// Trim the word down
				$temp .= substr($line, 0, $charlim-1);
				$line = substr($line, $charlim-1);
			}
		
			// If $temp contains data it means we had to split up an over-length 
			// word into smaller chunks so we'll add it back to our current line
			if ($temp != '')
			{
				$output .= $temp . "\n" . $line; 
			}
			else
			{
				$output .= $line;
			}

			$output .= "\n";
		}

		// Put our markers back
		if (count($unwrap) > 0)
		{	
			foreach ($unwrap as $key => $val)
			{
				$output = str_replace("{{unwrapped".$key."}}", $val, $output);
			}
		}

		// Remove the unwrap tags
		$output = str_replace(array('{unwrap}', '{/unwrap}'), '', $output);

		return $output;	
	}
}

if (! function_exists('wordwrap_utf8'))
{
	/**
	 * Word Wrap UTF8
	 *
	 * Esta funcion es identica a la funcion PHP wordwrap pero permite hacer.
	 * los cortes en UTF8.
	 * 
	 * El parametro $cCorte es la cadena de corte que se pone al final de cada linea.
	 * El parametro $nCorte indica si se debe forzar el corte de linea aun cuando
	 * quede una cadena cortada por la mitad.
	 * 
	 * @access public
	 * @param string $cCadena
	 * @param int $nLongitud
	 * @param string $cCorte
	 * @param int $nCorte
	 * @return string
	 */
	function wordwrap_utf8($cCadena, $nLongitud, $cCorte='<br />', $nCorte=1)
	{
		return utf8_encode(wordwrap(utf8_decode($cCadena), $nLongitud, $cCorte, $nCorte));
	}
}
?>