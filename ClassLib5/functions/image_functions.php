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
 * CodeIgniter Image Helpers
 *
 * @author		Estudio Quadra
 * @link		http://codeigniter.com/user_guide/helpers/file_helpers.html
 */

// ------------------------------------------------------------------------

if (! function_exists('save_resampled')) {
	/**
	 * Graba una imagen con un previo resampleo.
	 * El parametro $aImage es lo que viene por $_FILES.
	 * El parametro $cDestPath es el path de destino donde se quiere guardar la imagen.
	 * -- no debe terminar en barra.
	 * El parametro $aSizes son los tamanios de imagenes (para resamplear), EJ:
	 * -> 0: x => 120, y => 75, suf => 'thumb', q => 0 ~ 100
	 * -> 1: x => 240, y => 150, suf => 'crop1', q => 0 ~ 100
	 * $cPref es el prefijo del nombre de la imagen, a ese prefijo se le va a agregar un _INDICE
	 * donde INDICE es el numero de indice del tamanio que se uso para resamplear
	 * 
	 * Si $aSizes se deja en (0,0) no se resamplea la imagen
	 *
	 * @param array $aImage
	 * @param string $cDestPath
	 * @param array $aSizes
	 * @param string $cName
	 * @return bool
	 */
	function save_resampled($aImage, $cDestPath, $aSizes, $cName = false, $cType='jpg') {
		
		// Obtiene las dimensiones de la imagen.
		$aImageData = getimagesize($aImage['tmp_name']);
		
		// Si no se especifico el nombre lo toma del archivo.
		if ($cName === false) {
			$cName = preg_replace('/\.[^\.]+$/', '', $aImage['name']);
		}
		
		switch ($aImageData[2]) {
			case 1:
				$sImage = imagecreatefromgif($aImage['tmp_name']);
				break;
			case 2:
				$sImage = imagecreatefromjpeg($aImage['tmp_name']);
				break;
			case 3:
				$sImage = imagecreatefrompng($aImage['tmp_name']);
				break;
		}
		
		// Si ocurrio algun error al abrir la imagen devuelve falso.
		if (!@$sImage) {
			return false;
		}
		
		foreach ($aSizes as $aSize) {
			// Determina si hay sufijo.
			$cSufijo = $aSize['suf'] ? "_{$aSize['suf']}" : '';
			
			if ($aSize['x'] == 0 && $aSize['y'] == 0) { // deja la imagen como esta
				switch ($cType) {
					case 'gif':
						imagegif($sImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagesavealpha($sImage, true);
						imagepng($sImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
			}
			else {
				
				// Calcula las proporciones a reducir de cada lado.
				$nIndiceX = $aSize['x'] / $aImageData[0];
				$nIndiceY = $aSize['y'] / $aImageData[1];
				
			  	// Calcula la proporcion minima segun las restricciones.
			  	// Si se omite algun parametro se toma solo el que se paso explicitamente.
			  	if ($nIndiceX == 0) {
			  		$nIndice = $nIndiceY;
			  	}
			  	elseif ($nIndiceY == 0) {
			  		$nIndice = $nIndiceX;
			  	}
			  	else {
			  		$nIndice = min($nIndiceX, $nIndiceY);
			  	}
				
			  	// Calcula el nuevo tamanio a partir del indice.
			  	$nNewWidth = round($aImageData[0] * $nIndice);
			  	$nNewHeight = round($aImageData[1] * $nIndice);
				
			  	// Crea la nueva imagen.
			  	$sDestImage = imagecreatetruecolor($nNewWidth, $nNewHeight);
			  	imagealphablending($sDestImage, false);
			  	imagecopyresampled($sDestImage, $sImage, 0, 0, 0, 0, $nNewWidth, $nNewHeight, $aImageData[0], $aImageData[1]);
			  	imagesavealpha($sDestImage, true);
			  	
			  	// Graba la imagen.
				switch ($cType) {
					case 'gif':
						imagegif($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagepng($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
				
				imagedestroy($sDestImage);
			}
		}
		
		imagedestroy($sImage);
	}
}
	
// ------------------------------------------------------------------------

if (! function_exists('save_cropped')) {
	/**
	 * Graba una imagen con un previo resampleo.
	 * El parametro $aImage es lo que viene por $_FILES.
	 * El parametro $cDestPath es el path de destino donde se quiere guardar la imagen.
	 * -- no debe terminar en barra.
	 * El parametro $aSizes son los tamanios de imagenes (para resamplear), EJ:
	 * -> 0: x => 120, y => 75, suf => 'thumb', q => 0 ~ 100
	 * -> 1: x => 240, y => 150, suf => 'crop1', q => 0 ~ 100
	 * $cPref es el prefijo del nombre de la imagen, a ese prefijo se le va a agregar un _INDICE
	 * donde INDICE es el numero de indice del tamanio que se uso para resamplear
	 * 
	 * Si $aSizes se deja en (0,0) no se resamplea la imagen
	 *
	 * @param array $aImage
	 * @param string $cDestPath
	 * @param array $aSizes
	 * @param string $cName
	 * @return bool
	 */
	function save_cropped($aImage, $cDestPath, $aSizes, $cName = false, $cType='jpg') {
		
		// Obtiene las dimensiones de la imagen.
		$aImageData = getimagesize($aImage['tmp_name']);
		
		// Si no se especifico el nombre lo toma del archivo.
		if ($cName === false) {
			$cName = preg_replace('/\.[^\.]+$/', '', $aImage['name']);
		}
		
		switch ($aImageData[2]) {
			case 1:
				$sImage = imagecreatefromgif($aImage['tmp_name']);
				break;
			case 2:
				$sImage = imagecreatefromjpeg($aImage['tmp_name']);
				break;
			case 3:
				$sImage = imagecreatefrompng($aImage['tmp_name']);
				break;
		}
		
		// Si ocurrio algun error al abrir la imagen devuelve falso.
		if (!$sImage) {
			return false;
		}
		
		foreach ($aSizes as $aSize) {
			// Determina si hay sufijo.
			$cSufijo = $aSize['suf'] ? "_{$aSize['suf']}" : '';
			
			if ($aSize['x'] == 0 && $aSize['y'] == 0) { // deja la imagen como esta
				switch ($cType) {
					case 'gif':
						imagegif($sImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagesavealpha($sImage, true);
						imagepng($sImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
			}
			else {
				// Calcula las proporciones a reducir de cada lado.
				$nIndiceX = $aSize['x'] / $aImageData[0];
				$nIndiceY = $aSize['y'] / $aImageData[1];
				
			  	// Calcula la proporcion maxima segun las restricciones.
			  	$nIndice = max($nIndiceX, $nIndiceY);
				
			  	// Calcula el nuevo tama�o a partir del indice.
			  	$nNewWidth = round($aImageData[0] * $nIndice);
			  	$nNewHeight = round($aImageData[1] * $nIndice);
				
			  	$aDiff['x'] = $nNewWidth - $aSize['x'];
			  	$aDiff['y'] = $nNewHeight - $aSize['y'];
			  	
			  	$nSrcX = ($aImageData[0] - $aImageData[1]) / 2;
			  	$nSrcY = ($aImageData[1] - $aImageData[0]) / 2;
			  	
			  	if ($nSrcX < 0) {
			  		$nSrcX = 0;
			  	}
			  	
			  	if ($nSrcY < 0) {
			  		$nSrcY = 0;
			  	}
			  	
			  	$nSrcW = $aImageData[0] - $nSrcX;
			  	$nSrcH = $aImageData[1] - $nSrcY;
			  	
			  	// Crea la nueva imagen.
			  	$sDestImage = imagecreatetruecolor($aSize['x'], $aSize['y']);
				imagealphablending($sDestImage, false);
			  	imagecopyresampled($sDestImage, $sImage, 0, 0, 0, 0, $nNewWidth, $nNewHeight, $aImageData[0], $aImageData[1]);
			  	imagesavealpha($sDestImage, true);
			  	//imagecopyresampled($sDestImage, $sImage, 0, 0, $nSrcX, $nSrcY, $aSize['x'], $aSize['y'], $aImageData[0], $aImageData[1]);
			  	
			  	// Graba la imagen.
				switch ($cType) {
					case 'gif':
						imagegif($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagepng($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
				
				imagedestroy($sDestImage);
			}
		}
		
		imagedestroy($sImage);
	}
}

if (! function_exists('save_center_crop')) {
	/**
	 * Esta funcion es muy similar a save_resampled pero el area cuadrada lo calcula de otra forma.
	 * Si las proporciones de la imagen de origen y destino centra la imagen de origen en la de
	 * destino para copiar solo una parte de la imagen, esto es para lograr una imagen de destino
	 * de dimensiones fijas sin alterar la imagen.
	 *
	 * @param array $aImage
	 * @param string $cDestPath
	 * @param array $aSizes
	 * @param string $cName
	 */
	function save_center_crop($aImage, $cDestPath, $aSizes, $cName = false, $cType='jpg') {
		
		// Obtiene las dimensiones de la imagen.
		$aImageData = @getimagesize($aImage['tmp_name']);
		
		// Si no se especifico el nombre lo toma del archivo.
		if ($cName === false) {
			$cName = preg_replace('/\.[^\.]+$/', '', $aImage['name']);
		}
		
		switch ($aImageData[2]) {
			case 1:
				$sImage = @imagecreatefromgif($aImage['tmp_name']);
				break;
			case 2:
				$sImage = @imagecreatefromjpeg($aImage['tmp_name']);
				break;
			case 3:
				$sImage = @imagecreatefrompng($aImage['tmp_name']);
				break;
		}
		
		// Si ocurrio algun error al abrir la imagen devuelve falso.
		if (!$sImage) {
			return false;
		}
		
		foreach ($aSizes as $aSize) {
			// Determina si hay sufijo.
			$cSufijo = $aSize['suf'] ? "_{$aSize['suf']}" : '';
			
			if ($aSize['x'] == 0 && $aSize['y'] == 0) { // deja la imagen como esta
				switch ($cType) {
					case 'gif':
						imagegif($sImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagesavealpha($sImage, true);
						imagepng($sImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
			}
			else {
				// Calcula el area maxima de origen.
				$nIndiceX = $aImageData[0] / $aSize['x'];
				$nIndiceY = $aImageData[1] / $aSize['y'];
				$nIndice = min($nIndiceX, $nIndiceY);
				
				// Estas son las dimensiones definitivas de origen.
				$nAnchoOrigen = $nIndice * $aSize['x'];
				$nAltoOrigen = $nIndice * $aSize['y'];
				
				// Encuentra el centro de la imagen de origen.
				$nDiffX = $aImageData[0] - $nAnchoOrigen;
				$nDiffY = $aImageData[1] - $nAltoOrigen;
				$nOrigenX = $nDiffX / 2;
				$nOrigenY = $nDiffY / 2;
				
			  	// Crea la nueva imagen.
			  	$sDestImage = imagecreatetruecolor($aSize['x'], $aSize['y']);
			  	
			  	imagealphablending($sDestImage, false);
			  	// Efectua el copiado de la imagen de origen a la imagen de destino.
			  	imagecopyresampled($sDestImage, $sImage, 0, 0, $nOrigenX, $nOrigenY, $aSize['x'], $aSize['y'], $nAnchoOrigen, $nAltoOrigen);
			  	imagesavealpha($sDestImage, true);
			  	
			  	// Graba la imagen.
				switch ($cType) {
					case 'gif':
						imagegif($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagepng($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
				
				imagedestroy($sDestImage);
			}
		}
		
		imagedestroy($sImage);
	}
}

if (! function_exists('save_resized')) {
	/**
	 * Esta funcion fuerza el tamaño especificado.
	 *
	 * @param array $aImage
	 * @param string $cDestPath
	 * @param array $aSizes
	 * @param string $cName
	 */
	function save_resized($aImage, $cDestPath, $aSizes, $cName = false, $cType='jpg') {
		
		// Obtiene las dimensiones de la imagen.
		$aImageData = @getimagesize($aImage['tmp_name']);
		
		// Si no se especifico el nombre lo toma del archivo.
		if ($cName === false) {
			$cName = preg_replace('/\.[^\.]+$/', '', $aImage['name']);
		}
		
		switch ($aImageData[2]) {
			case 1:
				$sImage = @imagecreatefromgif($aImage['tmp_name']);
				break;
			case 2:
				$sImage = @imagecreatefromjpeg($aImage['tmp_name']);
				break;
			case 3:
				$sImage = @imagecreatefrompng($aImage['tmp_name']);
				break;
		}
		
		// Si ocurrio algun error al abrir la imagen devuelve falso.
		if (!$sImage) {
			return false;
		}
		
		foreach ($aSizes as $aSize) {
			// Determina si hay sufijo.
			$cSufijo = $aSize['suf'] ? "_{$aSize['suf']}" : '';
			
			if ($aSize['x'] == 0 && $aSize['y'] == 0) { // deja la imagen como esta
				switch ($cType) {
					case 'gif':
						imagegif($sImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagesavealpha($sImage, true);
						imagepng($sImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
			}
			else {
				// Calcula el area maxima de origen.
				$nIndiceX = $aImageData[0] / $aSize['x'];
				$nIndiceY = $aImageData[1] / $aSize['y'];
				$nIndice = min($nIndiceX, $nIndiceY);
				
				// Estas son las dimensiones definitivas de origen.
				$nAnchoOrigen = $nIndice * $aSize['x'];
				$nAltoOrigen = $nIndice * $aSize['y'];
				
				// Encuentra el centro de la imagen de origen.
				$nDiffX = $aImageData[0] - $nAnchoOrigen;
				$nDiffY = $aImageData[1] - $nAltoOrigen;
				$nOrigenX = $nDiffX / 2;
				$nOrigenY = $nDiffY / 2;
				
			  	// Crea la nueva imagen.
			  	$sDestImage = imagecreatetruecolor($aSize['x'], $aSize['y']);
			  	
			  	imagealphablending($sDestImage, false);
			  	// Efectua el copiado de la imagen de origen a la imagen de destino.
			  	imagecopyresampled($sDestImage, $sImage, 0, 0, 0, 0, $aSize['x'], $aSize['y'], $aImageData[0], $aImageData[1]);
			  	imagesavealpha($sDestImage, true);
			  	
			  	// Graba la imagen.
				switch ($cType) {
					case 'gif':
						imagegif($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.gif");
						break;
						
					case 'png':
						imagepng($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.png");
						break;
						
					case 'jpg':
					default:
						imagejpeg($sDestImage, "{$cDestPath}/{$cName}{$cSufijo}.jpg", $aSize['q']);
						break;
				}
				
				imagedestroy($sDestImage);
			}
		}
		
		imagedestroy($sImage);
	}
}
?>