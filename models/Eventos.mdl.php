<?
class Eventos extends Model {
	/**
	 * @desc
	 * Caso especial para buscar por letra inicial
	 */
	public $PorLetra;
	
	/**
	 * @desc
	 * Cadena con el ORDER BY.
	 *
	 * @var string
	 */
	public $OrderBy;
	
	/**
	 * @desc
	 * Numero de pagina.
	 * Comienza en 1 (1 = primer pagina).
	 * 
	 * Si se pasa un valor menor a 1 lo ignora.
	 *
	 * @var int
	 */
	public $Page;
	
	
	/**
	 * @desc
	 * Limite de consulta.
	 * Se usa junto a Page.
	 * 
	 * Si se asigna NULL no se hace un limite en la consulta.
	 *
	 * @var int
	 */
	public $LimitCant = APP_MYSQL_LIMIT;
	
	/**
	 * @desc
	 * Indica la cantidad total de registros si no se
	 * ubiera usado la clausula LIMIT en la consulta.
	 *
	 * @var int
	 */
	public $FoundRows;
	
	/**
	 * @desc
	 * Propiedades del modelo.
	 *
	 * @var mixed
	 */
	public $IdEvento, $Codigo, $Nombre, $IdCategoria, $IdMarca, $Descripcion, $Texto, $IdImagen, $Precio, $Precio1, $Precio2, $Precio3, $Precio4, $Precio5, $Publicado, $Oferta, $Destacado, $Orden, $Orden_cat;
	public $Where;
	/**
	 * @desc
	 * Determina si debe realizar una busqueda recursiva por
	 * las diferentes categorías que están dentro de la
	 * categoría filtrada.
	 */
	public $BusquedaRecursiva = false;
	
	public $TerminoBusqueda = null;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @desc
	 * Realiza una busqueda de registros.
	 * Ordena por la propiedad OrderBy.
	 * Limita registros por las propiedades Page y LimitCant.
	 * 
	 * Calcula la cantidad de registros sin el limite y lo pone en la
	 * propiedad FoundRows.
	 *
	 * @return array
	 */
	public function Buscar() {
		$cOrderBy = $cLimit = '';
		$aWhere = array();
		
		// Ordenacion.
		if ($this->OrderBy) {
			$cOrderBy = "ORDER BY {$this->OrderBy}";
		}
		
		// Paginacion.
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
		
		if ($this->Codigo !== null) {
			$aWhere[] = "eventos.codigo = '{$this->Codigo}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "eventos.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->BusquedaRecursiva) { // Busca tambien en las categorias de niveles inferiores.
			if ($this->IdCategoria !== null) {
				$aCategs = Categorias_producto::ListaArbolSucesoras($this->IdCategoria);
				$aWhere[] = "eventos.id_categoria IN (".join(', ', $aCategs).")";
			}
		}
		else {
			if ($this->IdCategoria !== null) { // Busca solo en las categorias de primer nivel.
				$aWhere[] = "eventos.id_categoria = '{$this->IdCategoria}'";
			}
		}
		if ($this->IdMarca !== null) {
			$aWhere[] = "eventos.id_marca = '{$this->IdMarca}'";
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "eventos.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "eventos.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "eventos.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Precio !== null) {
			$aWhere[] = "eventos.precio = '{$this->Precio}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "eventos.publicado = '{$this->Publicado}'";
		}
		if ($this->Oferta !== null) {
			$aWhere[] = "eventos.oferta = '{$this->Oferta}'";
		}
		if ($this->Destacado !== null) {
			$aWhere[] = "eventos.destacado = '{$this->Destacado}'";
		}
		if ($this->Where !== null) {
			$aWhere[] = $this->Where;
		}		
		if ($this->TerminoBusqueda !== null) {
			$aPalabras = preg_split('/\W+/', stripslashes(utf8_decode($this->TerminoBusqueda)), null, PREG_SPLIT_NO_EMPTY);
			$aWhere[] = "eventos.nombre LIKE '%".join("%' AND eventos.nombre LIKE '%", array_map('utf8_encode', array_map('addslashes', $aPalabras)))."%'";
		}
		
		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "eventos.nombre REGEXP '^[^a-z]'";
				break;
				
			case null:
				break;
			
			default:
				$aWhere[] = "eventos.nombre LIKE '{$this->PorLetra}%'";
				break;
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS eventos.*, categorias_producto.nombre categoria FROM eventos INNER JOIN categorias_producto ON categorias_producto.id_categoriaproducto = eventos.id_categoria {$cWhere} {$cOrderBy} {$cLimit}";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		/** RETRO COMPATIBILIDAD. HAY QUE HACER CATEGORIAS DE EVENTOS A PARTE.**/
		if(!$this->FoundRows){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS eventos.* FROM eventos {$cWhere} {$cOrderBy} {$cLimit}";
		
			$this->DB->Query($cSql);
			$aRet = $this->DB->GetRecordset();
			
			$cSql = "SELECT FOUND_ROWS() total";
			$this->DB->Query($cSql);
			
			$this->FoundRows = $this->DB->Field('total');
		}
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro segun su ID primario.
	 *
	 * @return array
	 */
	public function Obtener() {
	
		$cSql = "SELECT SQL_CALC_FOUND_ROWS eventos.* FROM eventos WHERE eventos.id_evento = '{$this->IdEvento}' LIMIT 1";
	
		//$cSql = "SELECT eventos.* FROM eventos WHERE eventos.id_evento = '{$this->IdEvento}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		if ($aRet) {
			$this->Set($aRet);
		}
		else {
			$this->Limpiar();
		}
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro segun su Código.
	 *
	 * @return array
	 */
	public function Cargar() {
		$cSql = "SELECT eventos.* FROM eventos WHERE eventos.codigo = '{$this->Codigo}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		if ($aRet) {
			$this->Set($aRet);
		}
		else {
			$this->Limpiar();
		}
		
		return $aRet;
	}

	/**
	 * @desc
	 * Despublica todos los eventos.
	 *
	 * @return array
	 */
	public function Despublicar() {
		
		$cSql = "UPDATE eventos SET eventos.publicado = 0";
		return $this->DB->Query($cSql);
		
	}
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		
		if ($this->Precio !== null) $this->Precio = str_replace(',', '.', $this->Precio);
		if ($this->Precio1 !== null) $this->Precio1 = str_replace(',', '.', $this->Precio1);
		if ($this->Precio2 !== null) $this->Precio2 = str_replace(',', '.', $this->Precio2);
		if ($this->Precio3 !== null) $this->Precio3 = str_replace(',', '.', $this->Precio3);
		if ($this->Precio4 !== null) $this->Precio4 = str_replace(',', '.', $this->Precio4);
		if ($this->Precio5 !== null) $this->Precio5 = str_replace(',', '.', $this->Precio5);
		
		$this->DB->Begin();
		
		if ($this->IdEvento) {
			$cSql = "UPDATE eventos SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"id_categoria = ".($this->IdCategoria ? "'{$this->IdCategoria}'" : 'NULL').", ".
				"id_marca = ".($this->IdMarca ? "'{$this->IdMarca}'" : 'NULL').", ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"precio = ".($this->Precio ? "'{$this->Precio}'" : 'NULL').", ".
				"precio1 = ".($this->Precio1 ? "'{$this->Precio1}'" : 'NULL').", ".
				"precio2 = ".($this->Precio2 ? "'{$this->Precio2}'" : 'NULL').", ".
				"precio3 = ".($this->Precio3 ? "'{$this->Precio3}'" : 'NULL').", ".
				"precio4 = ".($this->Precio4 ? "'{$this->Precio4}'" : 'NULL').", ".
				"precio5 = ".($this->Precio5 ? "'{$this->Precio5}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? '1' : '0').", ".
				"oferta = ".($this->Oferta ? '1' : '0').", ".
				"orden = ".($this->Orden ? $this->Orden : '99999').", ".
				"orden_cat = ".($this->Orden_cat ? $this->Orden_cat : '99999').", ".
				"destacado = ".($this->Destacado ? '1' : '0')." ".
				"WHERE id_evento = '{$this->IdEvento}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO eventos SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"id_categoria = ".($this->IdCategoria ? "'{$this->IdCategoria}'" : 'NULL').", ".
				"id_marca = ".($this->IdMarca ? "'{$this->IdMarca}'" : 'NULL').", ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"precio = ".($this->Precio ? "'{$this->Precio}'" : 'NULL').", ".
				"precio1 = ".($this->Precio1 ? "'{$this->Precio1}'" : 'NULL').", ".
				"precio2 = ".($this->Precio2 ? "'{$this->Precio2}'" : 'NULL').", ".
				"precio3 = ".($this->Precio3 ? "'{$this->Precio3}'" : 'NULL').", ".
				"precio4 = ".($this->Precio4 ? "'{$this->Precio4}'" : 'NULL').", ".
				"precio5 = ".($this->Precio5 ? "'{$this->Precio5}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? '1' : '0').", ".
				"oferta = ".($this->Oferta ? '1' : '0').", ".
				"orden = ".($this->Orden ? $this->Orden : '99999').", ".
				"orden_cat = ".($this->Orden_cat ? $this->Orden_cat : '99999').", ".
				"destacado = ".($this->Destacado ? '1' : '0');
			
			$this->IdEvento = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdEvento;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM eventos WHERE id_evento = '{$this->IdEvento}' LIMIT 1";
		$this->DB->Query($cSql);
		
		return $this->DB->AffectedRows();
	}
	
	/**
	 * @desc
	 * Llena las propiedades del modelo con los datos
	 * provistos en el array $aDatos.
	 *
	 * @param array $aDatos
	 */
	private function Set($aDatos) {
		$this->IdEvento = $aDatos['id_evento'];
		$this->Codigo = $aDatos['codigo'];
		$this->Nombre = $aDatos['nombre'];
		$this->IdCategoria = $aDatos['id_categoria'];
		$this->IdMarca = $aDatos['id_marca'];
		$this->Descripcion = $aDatos['descripcion'];
		$this->Texto = $aDatos['texto'];
		$this->IdImagen = $aDatos['id_imagen'];
		$this->Precio = $aDatos['precio'];
		$this->Precio1 = $aDatos['precio1'];
		$this->Precio2 = $aDatos['precio2'];
		$this->Precio3 = $aDatos['precio3'];
		$this->Precio4 = $aDatos['precio4'];
		$this->Precio5 = $aDatos['precio5'];
		$this->Publicado = $aDatos['publicado'];
		$this->Oferta = $aDatos['oferta'];
		$this->Destacado = $aDatos['destacado'];
		$this->Orden = @$aDatos['orden'];
		$this->Orden_cat = @$aDatos['orden_cat'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdEvento = $this->Codigo = $this->Nombre = $this->IdCategoria = $this->IdMarca = $this->Descripcion = $this->Texto = $this->IdImagen = $this->Precio = $this->Precio1 = $this->Precio2 = $this->Precio3 = $this->Precio4 = $this->Precio5 = $this->Publicado = $this->Oferta = $this->Destacado = $this->Orden = $this->Orden_cat = null;
	}
	
	/**
	 * @desc
	 * Importación de eventos.
	 *
	 */
	public function Importar() {
		$nInicio = microtime(true);
		
		// Conecta directamente a MySQL.
		$sMY = mysql_connect(APP_DATABASE_HOST, APP_DATABASE_USER, APP_DATABASE_PASS);
		mysql_select_db(APP_DATABASE_NAME);
		
		// Archivos de datos.
		$cFilename = APP_PATH_ARCHIVOS."/tmp_importar/data";
		$cFileStatus = './eventos-importacion.dat';
		
		// Obtiene el tamaño del archivo
		$nSize = filesize($cFilename);
		
		// Abre el archivo CSV nuevamente.
		$sFp = @fopen($cFilename, 'r');
		if (!$sFp) {
			//throw new Exception('Ocurrió un error inesperado al subir el archivo.');
		}
		
		// Lee la primer línea?.
		if (@$_POST['ignorar_1linea']) {
			fgetcsv($sFp, null, $_POST['separador']);
		}
		
		// Lee todas las lineas e importa los eventos.
		while ($aData = fgetcsv($sFp, null, $_POST['separador'], '"')) {
			// Guarda informacion para saber el porcentaje completado.
			$nPosicion = round(ftell($sFp) * 100 / $nSize);
			file_put_contents($cFileStatus, json_encode(array('porcentaje'=>$nPosicion)));
			
			$aEvento = array(
				'id_evento'=>null,
				'codigo'=>null,
				'nombre'=>null,
				'id_categoria'=>null,
				'id_marca'=>null,
				'descripcion'=>null,
				'texto'=>null,
				'precio'=>null,
				'precio1'=>null,
				'precio2'=>null,
				'precio3'=>null,
				'precio4'=>null,
				'precio5'=>null,
				'publicado'=>1
				);
				
			$aEvento['id_categoria'] = @$_POST['id_categoria'] ? $_POST['id_categoria'] : null;
			$aEvento['id_marca'] = @$_POST['id_marca'] ? $_POST['id_marca'] : null;
			
			// Si se pasó el código, primero busca un producto con ese código para actualizarlo.
			if (($nPos = array_search('codigo', $_POST['columna'])) !== false) {
				$aEvento['codigo'] = utf8_encode(addslashes(trim($aData[$nPos])));
				
				$cSql = "SELECT * FROM eventos WHERE codigo = '{$aEvento['codigo']}' LIMIT 1";
				$sRes = mysql_query($cSql, $sMY);
				if (mysql_num_rows($sRes)) {
					$aEvento = mysql_fetch_array($sRes, MYSQL_ASSOC);
				}
			}
			
			// Marca como publicado si se indicó así.
			if ($_POST['publicado'] !== '') {
				$aEvento['publicado'] = $_POST['publicado'];
			}
			
			foreach ($_POST['columna'] as $pos => $col) {
				// Si no se seleccionó columna sigue con la siguiente.
				if (!$col) continue;
				
				// Campos relacionales.
				if (preg_match('/REL::(.+)/', $col, $aRegExp)) {
					switch ($aRegExp[1]) {
						// Relaciona con categoria precargada.
						case 'CodigoCategoria':
							$cCodigo = utf8_encode(addslashes(trim($aData[$pos])));
							
							if ($cCodigo !== '') {
								$cSql = "SELECT id_categoriaproducto FROM categorias_producto WHERE codigo = '{$cCodigo}' LIMIT 1";
								$sRes = mysql_query($cSql, $sMY);
								
								if (mysql_num_rows($sRes)) {
									$aTmp = mysql_fetch_array($sRes, MYSQL_ASSOC);
									$aEvento['id_categoria'] = $aTmp['id_categoriaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$cPublicado = $_POST['publicado'] !== '' ? ", publicado = '{$_POST['publicado']}'" : '';
									$cSql = "INSERT INTO categorias_producto SET codigo = '{$cCodigo}', nombre = '{$cCodigo}'{$cPublicado}";
									mysql_query($cSql, $sMY);
									$aEvento['id_categoria'] = mysql_insert_id($sMY);
								}
							}
							break;
							
						// Relaciona con marca precargada.
						case 'CodigoMarca':
							$cCodigo = utf8_encode(addslashes(trim($aData[$pos])));
							
							if ($cCodigo !== '') {
								$cSql = "SELECT id_marcaproducto FROM marcas_producto WHERE codigo = '{$cCodigo}' LIMIT 1";
								$sRes = mysql_query($cSql, $sMY);
								
								if (mysql_num_rows($sRes)) {
									$aTmp = mysql_fetch_array($sRes, MYSQL_ASSOC);
									$aEvento['id_marca'] = $aTmp['id_marcaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$cPublicado = $_POST['publicado'] !== '' ? ", publicado = '{$_POST['publicado']}'" : '';
									$cSql = "INSERT INTO marcas_producto SET codigo = '{$cCodigo}', nombre = '{$cCodigo}'{$cPublicado}";
									mysql_query($cSql, $sMY);
									$aEvento['id_marca'] = mysql_insert_id($sMY);
								}
							}
							break;
					}
				}
				else {
					$aEvento[$col] = utf8_encode(addslashes(trim($aData[$pos])));
				}
			}
			
			if ($aEvento['id_evento']) {
				$cSql = "UPDATE eventos SET ".
					"codigo = ".($aEvento['codigo'] ? "'{$aEvento['codigo']}'" : 'NULL').", ".
					"nombre = '{$aEvento['nombre']}', ".
					"id_categoria = ".($aEvento['id_categoria'] ? "'{$aEvento['id_categoria']}'" : 'NULL').", ".
					"id_marca = ".($aEvento['id_marca'] ? "'{$aEvento['id_marca']}'" : 'NULL').", ".
					"descripcion = ".($aEvento['descripcion'] ? "'{$aEvento['descripcion']}'" : 'NULL').", ".
					"texto = ".($aEvento['texto'] ? "'{$aEvento['texto']}'" : 'NULL').", ".
					"precio = ".($aEvento['precio'] ? "'{$aEvento['precio']}'" : 'NULL').", ".
					"precio1 = ".($aEvento['precio1'] ? "'{$aEvento['precio1']}'" : 'NULL').", ".
					"precio2 = ".($aEvento['precio2'] ? "'{$aEvento['precio2']}'" : 'NULL').", ".
					"precio3 = ".($aEvento['precio3'] ? "'{$aEvento['precio3']}'" : 'NULL').", ".
					"precio4 = ".($aEvento['precio4'] ? "'{$aEvento['precio4']}'" : 'NULL').", ".
					"precio5 = ".($aEvento['precio5'] ? "'{$aEvento['precio5']}'" : 'NULL').", ".
					"publicado = ".($aEvento['publicado'] ? '1' : '0')." ".
					"WHERE id_evento = '{$aEvento['id_evento']}' LIMIT 1";
				mysql_query($cSql, $sMY);
			}
			else {
				$cSql = "INSERT INTO eventos SET ".
					"codigo = ".($aEvento['codigo'] ? "'{$aEvento['codigo']}'" : 'NULL').", ".
					"nombre = '{$aEvento['nombre']}', ".
					"id_categoria = ".($aEvento['id_categoria'] ? "'{$aEvento['id_categoria']}'" : 'NULL').", ".
					"id_marca = ".($aEvento['id_marca'] ? "'{$aEvento['id_marca']}'" : 'NULL').", ".
					"descripcion = ".($aEvento['descripcion'] ? "'{$aEvento['descripcion']}'" : 'NULL').", ".
					"texto = ".($aEvento['texto'] ? "'{$aEvento['texto']}'" : 'NULL').", ".
					"precio = ".($aEvento['precio'] ? "'{$aEvento['precio']}'" : 'NULL').", ".
					"precio1 = ".($aEvento['precio1'] ? "'{$aEvento['precio1']}'" : 'NULL').", ".
					"precio2 = ".($aEvento['precio2'] ? "'{$aEvento['precio2']}'" : 'NULL').", ".
					"precio3 = ".($aEvento['precio3'] ? "'{$aEvento['precio3']}'" : 'NULL').", ".
					"precio4 = ".($aEvento['precio4'] ? "'{$aEvento['precio4']}'" : 'NULL').", ".
					"precio5 = ".($aEvento['precio5'] ? "'{$aEvento['precio5']}'" : 'NULL').", ".
					"publicado = ".($aEvento['publicado'] ? '1' : '0');
					mysql_query($cSql, $sMY);
			}
			
			/*
			
			
			// Comienza a llenar los campos.
			foreach ($_POST['columna'] as $pos => $col) {
				// Si no se seleccionó columna sigue con la siguiente.
				if (!$col) continue;
				
				// Campos relacionales.
				if (preg_match('/REL::(.+)/', $col, $aRegExp)) {
					switch ($aRegExp[1]) {
						// Relaciona con categoria precargada.
						case 'CodigoCategoria':
							$cCodigo = utf8_encode(addslashes(trim($aData[$pos])));
							
							if ($cCodigo !== '') {
								$oCategorias->Limpiar();
								$oCategorias->Codigo = $cCodigo;
								$oCategorias->LimitCant = 1;
								$aResultado = $oCategorias->Buscar();
								if ($aResultado) {
									$oEvento->IdCategoria = $aResultado[0]['id_categoriaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$oCategorias->Codigo = $oCategorias->Nombre = utf8_encode(addslashes(trim($aData[$pos])));
									if ($_POST['publicado'] !== '') {
										$oCategorias->Publicado = $_POST['publicado'];
									}
									//$oEvento->IdCategoria = $oCategorias->Guardar();
								}
							}
							break;
						// Relaciona con marca precargada.
						case 'CodigoMarca':
							$cCodigo = utf8_encode(addslashes(trim($aData[$pos])));
							
							if ($cCodigo !== '') {
								$oMarcas->Limpiar();
								$oMarcas->Codigo = $cCodigo;
								$oMarcas->LimitCant = 1;
								$aResultado = $oMarcas->Buscar();
								if ($aResultado) {
									$oEvento->IdMarca = $aResultado[0]['id_marcaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$oMarcas->Codigo = $oMarcas->Nombre = utf8_encode(addslashes(trim($aData[$pos])));
									if ($_POST['publicado'] !== '') {
										$oMarcas->Publicado = $_POST['publicado'];
									}
									//$oEvento->IdMarca = $oMarcas->Guardar();
								}
							}
							break;
					}
				}
				else {
					$oEvento->$col = utf8_encode(addslashes(trim($aData[$pos])));
				}
			}
			
			//$oEvento->Guardar();
			*/
		}
		
		fclose($sFp);
		@unlink($cFilename);
		@unlink($cFileStatus);
		@rmdir(APP_PATH_ARCHIVOS."/tmp_importar");
		
		$nFinal = microtime(true);
		file_put_contents("./todo", $nFinal - $nInicio);
	}
	
	/**
	 * @desc
	 * Devuelve un array con las listas de precios.
	 *
	 * @return array
	 */
	public function BuscarListas() {
		$cSql = "SHOW COLUMNS FROM eventos LIKE 'precio%'";
		$this->DB->Query($cSql);
		
		return $this->DB->GetRecordset('Field');
	}
}
?>
