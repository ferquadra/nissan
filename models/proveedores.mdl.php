<?
class Proveedores extends Model {
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
	public $Id, $Codigo, $Nombre, $IdCategoria, $IdOperacion, $Descripcion, $Texto, $IdImagen, $Publicado, $Destacado, $Orden, $Orden_cat;
	public $Direccion, $Telefonos, $EmailPublico, $EmailPrivado, $IdLocalidad, $IdZona, $Mapa;
	public $Comidas, $Caracteristicas, $Servicios;
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
			$aWhere[] = "proveedores.codigo = '{$this->Codigo}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "proveedores.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->BusquedaRecursiva) { // Busca tambien en las categorias de niveles inferiores.
			if ($this->IdCategoria !== null) {
				$aCategs = Categorias_producto::ListaArbolSucesoras($this->IdCategoria);
				$aWhere[] = "proveedores.id_categoria IN (".join(', ', $aCategs).")";
			}
		}
		else {
			if ($this->IdCategoria !== null) { // Busca solo en las categorias de primer nivel.
				$aWhere[] = "proveedores.id_categoria = '{$this->IdCategoria}'";
			}
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "proveedores.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "proveedores.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "proveedores.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "proveedores.publicado = '{$this->Publicado}'";
		}
		if ($this->Destacado !== null) {
			$aWhere[] = "proveedores.destacado = '{$this->Destacado}'";
		}
		if ($this->IdZona !== null) {
			$aWhere[] = "proveedores.id_zona = '{$this->IdZona}'";
		}
		if ($this->Where !== null) {
			$aWhere[] = $this->Where;
		}		
		if ($this->TerminoBusqueda !== null) {
			$aPalabras = preg_split('/\W+/', stripslashes(utf8_decode($this->TerminoBusqueda)), null, PREG_SPLIT_NO_EMPTY);
			$aWhere[] = "proveedores.nombre LIKE '%".join("%' AND proveedores.nombre LIKE '%", array_map('utf8_encode', array_map('addslashes', $aPalabras)))."%'";
		}
		
		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "proveedores.nombre REGEXP '^[^a-z]'";
				break;
				
			case null:
				break;
			
			default:
				$aWhere[] = "proveedores.nombre LIKE '{$this->PorLetra}%'";
				break;
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS proveedores.*, categorias_producto.nombre categoria
			FROM proveedores LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = proveedores.id_categoria
			{$cWhere} {$cOrderBy} {$cLimit}";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro segun su ID primario.
	 *
	 * @return array
	 */
	public function Obtener() {
	
		$cSql = "SELECT SQL_CALC_FOUND_ROWS proveedores.*, categorias_producto.nombre categoria
			FROM proveedores LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = proveedores.id_categoria 
			WHERE proveedores.id_proveedor = '{$this->Id}' LIMIT 1";
	
		//$cSql = "SELECT proveedores.* FROM inmuebles WHERE proveedores.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
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
	
	
	public function Comidas($cCom = "") {
	
		if($cCom){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS comidas.* FROM comidas WHERE id_comida IN ({$cCom})";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS comidas.* FROM comidas";
		}
	
		//$cSql = "SELECT proveedores.* FROM inmuebles WHERE proveedores.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	public function Servicios($cSer = "") {
	
		if($cSer){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS servicios.* FROM servicios WHERE id_servicio IN ({$cSer})";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS servicios.* FROM servicios";
		}
	
		//$cSql = "SELECT proveedores.* FROM inmuebles WHERE proveedores.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	public function Caracteristicas($cCar = "") {
	
		if($cCar){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS caracteristicas.* FROM caracteristicas WHERE id_caracteristica IN ({$cCar})";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS caracteristicas.* FROM caracteristicas";
		}
	
		//$cSql = "SELECT proveedores.* FROM inmuebles WHERE proveedores.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro segun su Código.
	 *
	 * @return array
	 */
	public function Cargar() {
		$cSql = "SELECT proveedores.* FROM proveedores WHERE proveedores.codigo = '{$this->Codigo}' LIMIT 1";
		
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
	 * Despublica todos los proveedores.
	 *
	 * @return array
	 */
	public function Despublicar() {
		
		$cSql = "UPDATE bares SET proveedores.publicado = 0";
		return $this->DB->Query($cSql);
		
	}
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		
		$this->DB->Begin();
		/*
			public $Id, $Codigo, $Nombre, $IdCategoria, $IdOperacion, $Descripcion, $Texto, $IdImagen, $Publicado, $Destacado, $Orden, $Orden_cat;
	public $Direccion, $Telefonos, $EmailPublico, $EmailPrivado, $Zona;
	public $Comidas, $Caracteristicas;
		*/
		if ($this->Id) {
			$cSql = "UPDATE proveedores SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"id_categoria = ".($this->IdCategoria ? "'{$this->IdCategoria}'" : 'NULL').", ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? '1' : '0').", ".
				"orden = ".($this->Orden ? $this->Orden : '99999').", ".
				"orden_cat = ".($this->Orden_cat ? $this->Orden_cat : '99999').", ".
				"direccion = ".($this->Direccion ? "'{$this->Direccion}'" : 'NULL').", ".
				"telefonos = ".($this->Telefonos ? "'{$this->Telefonos}'" : 'NULL').", ".
				"emailpublico = ".($this->EmailPublico ? "'{$this->EmailPublico}'" : 'NULL').", ".
				"emailprivado = ".($this->EmailPrivado ? "'{$this->EmailPrivado}'" : 'NULL').", ".
				"id_localidad = ".($this->IdLocalidad ? "'{$this->IdLocalidad}'" : 'NULL').", ".
				"id_zona = ".($this->IdZona ? "'{$this->IdZona}'" : 'NULL').", ".
				"mapa = ".($this->Mapa ? "'".$this->Mapa."'" : 'NULL').", ".
				"destacado = ".($this->Destacado ? '1' : '0')." ".
				"WHERE id_proveedor = '{$this->Id}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO proveedores SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"id_categoria = ".($this->IdCategoria ? "'{$this->IdCategoria}'" : 'NULL').", ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? '1' : '0').", ".
				"orden = ".($this->Orden ? $this->Orden : '99999').", ".
				"orden_cat = ".($this->Orden_cat ? $this->Orden_cat : '99999').", ".
				"direccion = ".($this->Direccion ? "'{$this->Direccion}'" : 'NULL').", ".
				"telefonos = ".($this->Telefonos ? "'{$this->Telefonos}'" : 'NULL').", ".
				"emailpublico = ".($this->EmailPublico ? "'{$this->EmailPublico}'" : 'NULL').", ".
				"emailprivado = ".($this->EmailPrivado ? "'{$this->EmailPrivado}'" : 'NULL').", ".
				"id_localidad = ".($this->IdLocalidad ? "'{$this->IdLocalidad}'" : 'NULL').", ".
				"id_zona = ".($this->IdZona ? "'{$this->IdZona}'" : 'NULL').", ".
				"mapa = ".($this->Mapa ? "'".$this->Mapa."'" : 'NULL').", ".
				"destacado = ".($this->Destacado ? '1' : '0');
			
			$this->Id = $this->DB->QueryInsert($cSql);
		}
		
		
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			
			return 0;
		}
		else {
			$this->DB->Commit();
	
			return $this->Id;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM proveedores WHERE id_proveedor = '{$this->Id}' LIMIT 1";
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
		$this->Id = @$aDatos['id_proveedor'];
		$this->Codigo = @$aDatos['codigo'];
		$this->Nombre = @$aDatos['nombre'];
		$this->IdCategoria = @$aDatos['id_categoria'];
		$this->Descripcion = @$aDatos['descripcion'];
		$this->Texto = @$aDatos['texto'];
		$this->IdImagen = @$aDatos['id_imagen'];
		$this->Publicado = @$aDatos['publicado'];

		$this->Direccion = @$aDatos['direccion'];
		$this->Telefonos = @$aDatos['telefonos'];
		$this->IdLocalidad = @$aDatos['id_localidad'];
		$this->IdZona = @$aDatos['id_zona'];
		$this->EmailPublico = @$aDatos['emailpublico'];
		$this->EmailPrivado = @$aDatos['emailprivado'];
		$this->Caracteristicas = @$aDatos['caracteristicas'];

		
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
		$this->Id = $this->Codigo = $this->Nombre = $this->IdCategoria = $this->IdOperacion = $this->Descripcion = $this->Texto = $this->IdImagen = $this->Precio = $this->Precio1 = $this->Precio2 = $this->Precio3 = $this->Precio4 = $this->Precio5 = $this->Publicado = $this->Oferta = $this->Destacado = $this->Servicios = $this->Orden = $this->Orden_cat = null;
	}
	
	/**
	 * @desc
	 * Importación de proveedores.
	 *
	 */
	public function Importar() {
		$nInicio = microtime(true);
		
		// Conecta directamente a MySQL.
		$sMY = mysql_connect(APP_DATABASE_HOST, APP_DATABASE_USER, APP_DATABASE_PASS);
		mysql_select_db(APP_DATABASE_NAME);
		
		// Archivos de datos.
		$cFilename = APP_PATH_ARCHIVOS."/tmp_importar/data";
		$cFileStatus = './productos-importacion.dat';
		
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
		
		// Lee todas las lineas e importa los proveedores.
		while ($aData = fgetcsv($sFp, null, $_POST['separador'], '"')) {
			// Guarda informacion para saber el porcentaje completado.
			$nPosicion = round(ftell($sFp) * 100 / $nSize);
			file_put_contents($cFileStatus, json_encode(array('porcentaje'=>$nPosicion)));
			
			$aProducto = array(
				'id_proveedor'=>null,
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
				
			$aProducto['id_categoria'] = @$_POST['id_categoria'] ? $_POST['id_categoria'] : null;
			$aProducto['id_marca'] = @$_POST['id_marca'] ? $_POST['id_marca'] : null;
			
			// Si se pasó el código, primero busca un producto con ese código para actualizarlo.
			if (($nPos = array_search('codigo', $_POST['columna'])) !== false) {
				$aProducto['codigo'] = utf8_encode(addslashes(trim($aData[$nPos])));
				
				$cSql = "SELECT * FROM productos WHERE codigo = '{$aProducto['codigo']}' LIMIT 1";
				$sRes = mysql_query($cSql, $sMY);
				if (mysql_num_rows($sRes)) {
					$aProducto = mysql_fetch_array($sRes, MYSQL_ASSOC);
				}
			}
			
			// Marca como publicado si se indicó así.
			if ($_POST['publicado'] !== '') {
				$aProducto['publicado'] = $_POST['publicado'];
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
									$aProducto['id_categoria'] = $aTmp['id_categoriaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$cPublicado = $_POST['publicado'] !== '' ? ", publicado = '{$_POST['publicado']}'" : '';
									$cSql = "INSERT INTO categorias_producto SET codigo = '{$cCodigo}', nombre = '{$cCodigo}'{$cPublicado}";
									mysql_query($cSql, $sMY);
									$aProducto['id_categoria'] = mysql_insert_id($sMY);
								}
							}
							break;
							
						// Relaciona con marca precargada.
						case 'CodigoMarca':
							$cCodigo = utf8_encode(addslashes(trim($aData[$pos])));
							
							if ($cCodigo !== '') {
								$cSql = "SELECT id_marcaproducto FROM operaciones_inmuebles WHERE codigo = '{$cCodigo}' LIMIT 1";
								$sRes = mysql_query($cSql, $sMY);
								
								if (mysql_num_rows($sRes)) {
									$aTmp = mysql_fetch_array($sRes, MYSQL_ASSOC);
									$aProducto['id_marca'] = $aTmp['id_marcaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$cPublicado = $_POST['publicado'] !== '' ? ", publicado = '{$_POST['publicado']}'" : '';
									$cSql = "INSERT INTO operaciones_inmuebles SET codigo = '{$cCodigo}', nombre = '{$cCodigo}'{$cPublicado}";
									mysql_query($cSql, $sMY);
									$aProducto['id_marca'] = mysql_insert_id($sMY);
								}
							}
							break;
					}
				}
				else {
					$aProducto[$col] = utf8_encode(addslashes(trim($aData[$pos])));
				}
			}
			
			if ($aProducto['id_proveedor']) {
				$cSql = "UPDATE productos SET ".
					"codigo = ".($aProducto['codigo'] ? "'{$aProducto['codigo']}'" : 'NULL').", ".
					"nombre = '{$aProducto['nombre']}', ".
					"id_categoria = ".($aProducto['id_categoria'] ? "'{$aProducto['id_categoria']}'" : 'NULL').", ".
					"id_marca = ".($aProducto['id_marca'] ? "'{$aProducto['id_marca']}'" : 'NULL').", ".
					"descripcion = ".($aProducto['descripcion'] ? "'{$aProducto['descripcion']}'" : 'NULL').", ".
					"texto = ".($aProducto['texto'] ? "'{$aProducto['texto']}'" : 'NULL').", ".
					"precio = ".($aProducto['precio'] ? "'{$aProducto['precio']}'" : 'NULL').", ".
					"precio1 = ".($aProducto['precio1'] ? "'{$aProducto['precio1']}'" : 'NULL').", ".
					"precio2 = ".($aProducto['precio2'] ? "'{$aProducto['precio2']}'" : 'NULL').", ".
					"precio3 = ".($aProducto['precio3'] ? "'{$aProducto['precio3']}'" : 'NULL').", ".
					"precio4 = ".($aProducto['precio4'] ? "'{$aProducto['precio4']}'" : 'NULL').", ".
					"precio5 = ".($aProducto['precio5'] ? "'{$aProducto['precio5']}'" : 'NULL').", ".
					"publicado = ".($aProducto['publicado'] ? '1' : '0')." ".
					"WHERE id_proveedor = '{$aProducto['id_proveedor']}' LIMIT 1";
				mysql_query($cSql, $sMY);
			}
			else {
				$cSql = "INSERT INTO productos SET ".
					"codigo = ".($aProducto['codigo'] ? "'{$aProducto['codigo']}'" : 'NULL').", ".
					"nombre = '{$aProducto['nombre']}', ".
					"id_categoria = ".($aProducto['id_categoria'] ? "'{$aProducto['id_categoria']}'" : 'NULL').", ".
					"id_marca = ".($aProducto['id_marca'] ? "'{$aProducto['id_marca']}'" : 'NULL').", ".
					"descripcion = ".($aProducto['descripcion'] ? "'{$aProducto['descripcion']}'" : 'NULL').", ".
					"texto = ".($aProducto['texto'] ? "'{$aProducto['texto']}'" : 'NULL').", ".
					"precio = ".($aProducto['precio'] ? "'{$aProducto['precio']}'" : 'NULL').", ".
					"precio1 = ".($aProducto['precio1'] ? "'{$aProducto['precio1']}'" : 'NULL').", ".
					"precio2 = ".($aProducto['precio2'] ? "'{$aProducto['precio2']}'" : 'NULL').", ".
					"precio3 = ".($aProducto['precio3'] ? "'{$aProducto['precio3']}'" : 'NULL').", ".
					"precio4 = ".($aProducto['precio4'] ? "'{$aProducto['precio4']}'" : 'NULL').", ".
					"precio5 = ".($aProducto['precio5'] ? "'{$aProducto['precio5']}'" : 'NULL').", ".
					"publicado = ".($aProducto['publicado'] ? '1' : '0');
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
									$oProducto->IdCategoria = $aResultado[0]['id_categoriaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$oCategorias->Codigo = $oCategorias->Nombre = utf8_encode(addslashes(trim($aData[$pos])));
									if ($_POST['publicado'] !== '') {
										$oCategorias->Publicado = $_POST['publicado'];
									}
									//$oProducto->IdCategoria = $oCategorias->Guardar();
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
									$oProducto->IdMarca = $aResultado[0]['id_marcaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$oMarcas->Codigo = $oMarcas->Nombre = utf8_encode(addslashes(trim($aData[$pos])));
									if ($_POST['publicado'] !== '') {
										$oMarcas->Publicado = $_POST['publicado'];
									}
									//$oProducto->IdMarca = $oMarcas->Guardar();
								}
							}
							break;
					}
				}
				else {
					$oProducto->$col = utf8_encode(addslashes(trim($aData[$pos])));
				}
			}
			
			//$oProducto->Guardar();
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
		$cSql = "SHOW COLUMNS FROM productos LIKE 'precio%'";
		$this->DB->Query($cSql);
		
		return $this->DB->GetRecordset('Field');
	}
}
?>
