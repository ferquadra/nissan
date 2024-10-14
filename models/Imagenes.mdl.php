<?
class Imagenes extends Model {
	
	/**
	 * @desc
	 * Cadena OrderBy.
	 *
	 * @var string
	 */
	var $OrderBy;
	
	/**
	 * @desc
	 * Numero de pagina.
	 * Comienza en 1 (1 = primer pagina).
	 * 
	 * Si se pasa un valor menor a 1 lo ignora.
	 *
	 * @var int
	 */
	var $Page;
	
	/**
	 * @desc
	 * Limite de consulta.
	 * Se usa junto a Page.
	 * 
	 * Si se asigna NULL no se hace un limite en la consulta.
	 *
	 * @var int
	 */
	var $LimitCant = APP_MYSQL_LIMIT;
	
	/**
	 * @desc
	 * Indica la cantidad total de registros si no se
	 * ubiera usado la clausula LIMIT en la consulta.
	 *
	 * @var int
	 */
	var $FoundRows;
	
	/**
	 * @desc
	 * Array de objetos ImagenCrop.
	 *
	 * @var array
	 */
	var $Crops = array();
	
	var $Galerias;
	
	public $IdImagen, $Sector, $IdElemento, $Descripcion, $Enlace;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @desc
	 * Realiza una busqueda de imagenes.
	 *
	 * @return array
	 */
	function Buscar() {
		$cOrderBy = $cLimit = '';
		$aWhere = array();
		
		$aFrom[] = 'imagenes';
		
		if ($this->Galerias !== null) {
			$aFrom[] = 'INNER JOIN rel_galerias_imagenes USING(id_imagen)';
			$aWhere[] = "rel_galerias_imagenes.id_galeria IN ({$this->Galerias})";
		}
		if ($this->Sector !== null) {
			$aWhere[] = "imagenes.sector = '{$this->Sector}'";
		}
		if ($this->IdElemento !== null) {
			$aWhere[] = "imagenes.id_elemento = '{$this->IdElemento}'";
		}
		
		$cFrom = 'FROM '.join(' ', $aFrom);
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		if ($this->OrderBy) {
			$cOrderBy = "ORDER BY {$this->OrderBy}";
		}
		
		if ($this->Page < 1) {
			$this->Page = 1;
		}
		
		if ($this->LimitCant !== null) {
			$nLimit = ($this->Page - 1) * $this->LimitCant;
			$cLimit = "LIMIT {$nLimit}, {$this->LimitCant}";
		}
		else {
			$cLimit = '';
		}
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS * {$cFrom} {$cWhere} {$cOrderBy} {$cLimit}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve los datos segun el ID $nId.
	 *
	 * @param int $nId
	 * @return array
	 */
	function Obtener($nId) {
		$cSql = "SELECT * FROM imagenes WHERE id_imagen = '{$nId}' LIMIT 1";
		$this->DB->Query($cSql);
		
		return $this->DB->Field();
	}
	
	/**
	 * @desc
	 * Guarda los datos.
	 * Recibe un dato tipo $_FILES['imagen'] y devuelve
	 * el ID de la imagen guardada.
	 *
	 * @param array $aData 'tmp_name' 'name'
	 * @return int
	 */
	function Guardar($aData, $cDescripcion=null, $nId=null) {
		// El gif animado no se puede guardar como imagen.
		if (self::is_animated_gif($aData['tmp_name'])) {
			return false;
		}
		
		// Determina el nombre de archivo.
		preg_match('/(.+)\.[^\.]+$/', $aData['name'], $aArgs);
		
		$cName = $aArgs[1];
		
		// La descripcion generada por el sistema.
		$cDescripcion = $cDescripcion ? "'{$cDescripcion}'" : 'NULL';
		
		// Inserta la imagen en la base de datos.
		if ($nId != null) {
			$cSql = "UPDATE imagenes SET nombre = '{$cName}', descripcion = {$cDescripcion} WHERE id_imagen = '{$nId}' LIMIT 1";
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO imagenes SET sector = '{$this->Sector}', id_elemento = '{$this->IdElemento}', nombre = '{$cName}', descripcion = {$cDescripcion}";
			$nId = $this->DB->QueryInsert($cSql);
		}
		
		// Crea la carpeta donde va a almacenar las imagenes.
		if (!is_dir(APP_PATH_IMAGENES."/$nId")) {
			mkdir(APP_PATH_IMAGENES."/$nId");
		}
		
		// Elimina el contenido de la carpeta (por si ya contenia imagenes).
		$aAnteriores = (array) @glob(APP_PATH_IMAGENES."/$nId/*");
		foreach ($aAnteriores as $item) {
			@unlink($item);
		}
		
		// Crops que SIEMPRE se hacen. Imagen pequeña para el admin y la del área de trabajo y zoom del front.
		$aSize[] = array('x'=>960, 'y'=>720, 'suf'=>"", 'q'=>90);
		$aSize[] = array('x'=>90, 'y'=>90, 'suf'=>"thumb", 'q'=>80);
		// Busca los crops definidos para todos los elementos del sector.
		if (isset($GLOBALS['CROPS'][$this->Sector]['sector']) && is_array($GLOBALS['CROPS'][$this->Sector]['sector'])) {
			foreach ($GLOBALS['CROPS'][$this->Sector]['sector'] as $item) {
				$aSize[] = array('x'=>$item['ancho'], 'y'=>$item['alto'], 'suf'=>"{$item['ancho']}x{$item['alto']}", 'q'=>99);
			}
		}
		// Busca los crops definidos para un elemento en particular del sector.
		if (isset($GLOBALS['CROPS'][$this->Sector]['elem'][$this->IdElemento]) && is_array($GLOBALS['CROPS'][$this->Sector]['elem'][$this->IdElemento])) {
			foreach ($GLOBALS['CROPS'][$this->Sector]['elem'][$this->IdElemento] as $item) {
				$aSize[] = array('x'=>$item['ancho'], 'y'=>$item['alto'], 'suf'=>"{$item['ancho']}x{$item['alto']}", 'q'=>99);
			}
		}
		// Busca crops de registros dinámicos.
		if ($this->Sector == SECTOR_CAMPOS_REGISTRO) {
			$oRL = new Registros_listado();
			$oRL->IdRegistrolistado = $this->IdElemento;
			$oRL->Obtener();
			
			$oCL = new Campos_listado();
			$oCL->IdCampolistado = $oRL->IdCampolistado;
			$oCL->Obtener();
			preg_match_all("/(([^\=\;]+)\=([0-9]+)x([0-9]+));/", $oCL->Extra, $aSpt);
			
			foreach ($aSpt[0] as $pos => $item) {
				
				// Hay una serie de palabras reservadas, las ignora.
				if (in_array($item, array('limite'))) {
					continue;
				}
				
				$aSize[] = array('x'=>$aSpt[3][$pos], 'y'=>$aSpt[4][$pos], 'suf'=>"{$aSpt[3][$pos]}x{$aSpt[4][$pos]}", 'q'=>85);
			}
		}
		
		// Realiza los crops.
		$aData['name'] = 'imagen';
		require_once(APP_FUNCTIONS_PATH.'/image_functions.php');
		if (@$this->Sector==SECTOR_SLIDER) {
			save_cropped($aData, APP_PATH_IMAGENES."/$nId", $aSize);
		} elseif ((@$this->Sector==1) || (@$this->Sector==11)) {
			if($aData['type']=="image/png"){
				// También se guarda un thumb para mostrar en el Panel Administrador.
				save_resampled($aData, APP_PATH_IMAGENES."/$nId", 'imagen', $aSize, "png");
			} else {
				save_resampled($aData, APP_PATH_IMAGENES."/$nId", $aSize);
			}
			
			// Copia el archivo original, por ser un fondo se respeta tal cual lo sube el cliente.
			move_uploaded_file($aData['tmp_name'], APP_PATH_IMAGENES."/$nId/imagen.jpg");
			
		} else {
			if($aData['type']=="image/png"){
				// También se guarda un thumb para mostrar en el Panel Administrador.
				save_resampled($aData, APP_PATH_IMAGENES."/$nId", 'imagen', $aSize, "png");
			} else {
				save_resampled($aData, APP_PATH_IMAGENES."/$nId", $aSize);
			}
		}

		// Devuelve el ID del registro.
		return $nId;
	}
	
	/**
	 * @desc
	 * Elimina la imagen con ID $nId.
	 *
	 * @param int $nId
	 */
	function Eliminar($nId) {
		$aArchivos = (array) @glob(APP_PATH_IMAGENES."/$nId/*");
		foreach ($aArchivos as $cArchivo) {
			@unlink($cArchivo);
		}
		@rmdir(APP_PATH_IMAGENES."/$nId");
		
		$cSql = "DELETE FROM imagenes WHERE id_imagen = '{$nId}' LIMIT 1";
		$this->DB->Query($cSql);
	}
	
	public function EliminarTodas($nSector, $nIdElemento) {
		$cSql = "SELECT * FROM imagenes WHERE sector = '{$nSector}' AND id_elemento = '{$nIdElemento}'";
		$this->DB->Query($cSql);
		
		foreach ($this->DB->GetRecordset() as $item) {
			$this->Eliminar($item['id_imagen']);
		}
	}
	
	public function GuardarDescripcion() {
		
		$cSql = "UPDATE imagenes SET descripcion = '{$this->Descripcion}' WHERE id_imagen = {$this->IdImagen} LIMIT 1";
		return $this->DB->Query($cSql);

	}
	
	public function GuardarEnlace() {
		
		$cSql = "UPDATE imagenes SET enlace = '{$this->Enlace}' WHERE id_imagen = {$this->IdImagen} LIMIT 1";
		return $this->DB->Query($cSql);

	}
	
	/**
	ESTA FUNCION REMPLAZA LA CLAVETEMPORAL QUE GUARDA EL FORMULARIO CUANDO AÚN NO TIENE UN ID DETERMINADO.
	DE ESTA MANERA, SE SOLUCIONA EL PROBLEMA DE TENER QUE GUARDAR ANTES DE SUBIR UNA IMAGEN. LA CLAVE TEMPORAL ES UN TIMESTAMP.
	**/
	public function GuardarId($clavetemporal, $id) {
		
		$cSql = "UPDATE imagenes SET id_elemento = '{$id}' WHERE id_elemento = {$clavetemporal}";
		return $this->DB->Query($cSql);

	}
	// Funcion igual a la anterior para mantener compatibilidad.
	public function ActualizarIdTemporal($idTemporal, $idElemento) {
		
		$cSql = "UPDATE imagenes SET id_elemento = '{$idElemento}' WHERE id_elemento = {$idTemporal};";
		return $this->DB->Query($cSql);

	}
	
	
	public function EstablecerPrincipal($nIdImagen, $nSector, $nIdElemento) {
		switch ($nSector) {
			case SECTOR_GALERIA:
				$cSql = "UPDATE galerias SET id_imagen = '{$nIdImagen}' WHERE id_galeria = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
			case SECTOR_EVENTO:
				$cSql = "UPDATE eventos SET id_imagen = '{$nIdImagen}' WHERE id_evento = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
			case SECTOR_NOTICIA:
				$cSql = "UPDATE noticias SET id_imagen = '{$nIdImagen}' WHERE id_noticia = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
			case SECTOR_PRODUCTO:
				$cSql = "UPDATE productos SET id_imagen = '{$nIdImagen}' WHERE id_producto = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
			case SECTOR_CATEGORIAPRODUCTO:
				$cSql = "UPDATE productos_categorias SET id_imagen = '{$nIdImagen}' WHERE id_categoria = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
			case SECTOR_PAGINA:
				$cSql = "UPDATE paginas SET id_imagen = '{$nIdImagen}' WHERE id_pagina = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
			case SECTOR_LINK:
				$cSql = "UPDATE links SET id_imagen = '{$nIdImagen}' WHERE id_link = '{$nIdElemento}' LIMIT 1";
				$this->DB->Query($cSql);
				break;
		}
	}
	
	public static function is_animated_gif($filename) {
	    if(!($fh = @fopen($filename, 'rb')))
	        return false;
	    $count = 0;
	    //an animated gif contains multiple "frames", with each frame having a
	    //header made up of:
	    // * a static 4-byte sequence (\x00\x21\xF9\x04)
	    // * 4 variable bytes
	    // * a static 2-byte sequence (\x00\x2C)
	
	    // We read through the file til we reach the end of the file, or we've found
	    // at least 2 frame headers
	    while(!feof($fh) && $count < 2)
	        $chunk = fread($fh, 1024 * 100); //read 100kb at a time
	        $count += preg_match_all('#\x00\x21\xF9\x04.{4}\x00\x2C#s', $chunk, $matches);
	
	    fclose($fh);
	    return $count > 1;
	}
}
?>