<?
class Productos extends Model {
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
	public $IdProducto, $Codigo, $Nombre, $IdCategoria, $IdMarca, $Descripcion, $Texto, $IdImagen, $Precio, $Precio1, $Precio2, $Precio3, $Precio4, $Precio5, $Publicado, $Oferta, $Destacado, $Orden, $Orden_cat, $Precioweb;

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

	public function SQLInsert($cSql){
		return $this->DB->QueryInsert($cSql);
	}

	public function SQL($cSql){
		return $this->DB->Query($cSql);
	}

	public function DB($database){
		return $this->DB->Open($database);
	}

	public function SQLSelect($cSql){
		if($this->DB->Query($cSql)){
			return $this->DB->GetRecordset();
		} else {
			return false;
		}
		
	}

	public function SQLUpdate($cSql){
		return $this->DB->Query($cSql);
	}

	public function GetError(){
		return $this->DB->GetLastError();
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
		if ($this->LimitCant != null) {
			$nLimit = ($this->Page - 1) * $this->LimitCant;
			$cLimit = "LIMIT {$nLimit}, {$this->LimitCant}";
		}
		else {
			$cLimit = '';
		}

		if ($this->Codigo != null) {
			$aWhere[] = "productos.codigo = '{$this->Codigo}'";
		}
		if ($this->Nombre != null) {
			$aWhere[] = "productos.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->BusquedaRecursiva) { // Busca tambien en las categorias de niveles inferiores.
			if ($this->IdCategoria != null) {
				$aCategs = Categorias_producto::ListaArbolSucesoras($this->IdCategoria);
				$aWhere[] = "productos.id_categoria IN (".join(', ', $aCategs).")";
			}
		}
		else {
			if ($this->IdCategoria != null) { // Busca solo en las categorias de primer nivel.
				$aWhere[] = "productos.id_categoria = '{$this->IdCategoria}'";
			}
		}
		if ($this->IdMarca != null) {
			$aWhere[] = "productos.id_marca = '{$this->IdMarca}'";
		}
		if ($this->Descripcion != null) {
			$aWhere[] = "productos.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto != null) {
			$aWhere[] = "productos.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen != null) {
			$aWhere[] = "productos.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Precio != null) {
			$aWhere[] = "productos.precio = '{$this->Precio}'";
		}
		if ($this->Publicado != null) {
			$aWhere[] = "productos.publicado = '{$this->Publicado}'";
		}
		if ($this->Oferta != null) {
			$aWhere[] = "productos.oferta = '{$this->Oferta}'";
		}
		if ($this->Destacado != null) {
			$aWhere[] = "productos.destacado = '{$this->Destacado}'";
		}

		if ($this->TerminoBusqueda != null) {
			$aPalabras = preg_split('/\W+/', stripslashes(utf8_decode($this->TerminoBusqueda)), null, PREG_SPLIT_NO_EMPTY);
			$aWhere[] = "(productos.codigo LIKE '%{$this->TerminoBusqueda}%' OR productos.nombre LIKE '%".join("%' AND productos.nombre LIKE '%", array_map('utf8_encode', array_map('addslashes', $aPalabras)))."%')";
		}

		if($this->Where != null){
			$aWhere[] = $this->Where;
		}

		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "productos.nombre REGEXP '^[^a-z]'";
				break;

			case null:
				break;

			default:
				$aWhere[] = "productos.nombre LIKE '{$this->PorLetra}%'";
				break;
		}

		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';

		if(@APP=="MARRONE"){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS productos.*, marcas_producto.nombre marca, marcas_producto.codigo codigomarca, marcas_producto.texto textomarca, marcas_producto.descripcion descripcionmarca, marcas_producto.id_imagen imagen_marca, categorias_producto.id_padre id_padre, categorias_producto.nombre categoria, categorias_producto.codigo codigocategoria, categorias_producto.orden categoria_orden
			FROM productos
			LEFT JOIN marcas_producto ON marcas_producto.id_marcaproducto = productos.id_marca
			LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = productos.id_categoria
			{$cWhere} ORDER BY productos.orden ASC, categorias_producto.id_categoriaproducto ASC, productos.nombre ASC {$cLimit}";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS productos.*, marcas_producto.nombre marca, marcas_producto.codigo codigomarca, marcas_producto.texto textomarca, marcas_producto.descripcion descripcionmarca, marcas_producto.id_imagen imagen_marca, categorias_producto.id_padre id_padre, categorias_producto.nombre categoria, categorias_producto.codigo codigocategoria, categorias_producto.orden categoria_orden
			FROM productos
			LEFT JOIN marcas_producto ON marcas_producto.id_marcaproducto = productos.id_marca
			LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = productos.id_categoria
			{$cWhere} {$cOrderBy} {$cLimit}";
		}

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);

		$this->FoundRows = $this->DB->Field('total');


		foreach($aRet as $key => $item){

			$aCategoria = $this->BuscarCategoria($item['id_padre']);

			if(@$aCategoria[0]['id_padre'] > 0){
				$aRet[$key]['categoria_padre'] = $aCategoria[0]['nombre'];
			} else {
				$aRet[$key]['categoria_padre'] = $aRet[$key]['categoria'] ;
			}

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

		$cSql = "SELECT SQL_CALC_FOUND_ROWS productos.*, marcas_producto.nombre marca, marcas_producto.id_imagen imagen_marca, categorias_producto.nombre categoria
			FROM productos
			LEFT JOIN marcas_producto ON marcas_producto.id_marcaproducto = productos.id_marca
			LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = productos.id_categoria
			WHERE productos.id_producto = '{$this->IdProducto}' LIMIT 1";

		//$cSql = "SELECT productos.* FROM productos WHERE productos.id_producto = '{$this->IdProducto}' LIMIT 1";

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

	function ObtenerSimilares($codigo) {
		$cSql = "SELECT * FROM productos WHERE codigo LIKE '{$codigo}%' ORDER BY id_producto DESC";
		$this->DB->Query($cSql);
		return $this->DB->GetRecordset();
	}

	function ObtenerRelacionManual($codigo){

		$aCod = explode(",", $codigo);

		$cCodigos = "";
		if(count($aCod)){
			foreach($aCod as $item){
				$cCodigos .= "'".$item."',";
			}
		}
		$cCodigos = substr($cCodigos, 0, -1);

		$cSql = "SELECT * FROM productos WHERE codigo IN ({$cCodigos}) ORDER BY id_producto DESC";
		$this->DB->Query($cSql);
		return $this->DB->GetRecordset();

	}


	function ObtenerMedidas($nId) {
		$nId = (int) $nId;
		$cSql = "SELECT * FROM productos_medidas WHERE id_producto = '{$nId}' ORDER BY id_medida";
		$this->DB->Query($cSql);
		return $this->DB->GetRecordset();
	}

	function BuscarCategoria($nId) {
		$nId = (int) $nId;
		$cSql = "SELECT * FROM categorias_producto WHERE id_categoriaproducto = '{$nId}' LIMIT 1";
		$this->DB->Query($cSql);
		return $this->DB->GetRecordset();
	}

	/**
	 * @desc
	 * Devuelve el registro segun su Código.
	 *
	 * @return array
	 */
	public function Cargar() {
		$cSql = "SELECT productos.* FROM productos WHERE productos.codigo = '{$this->Codigo}' LIMIT 1";

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
	 * Despublica todos los productos.
	 *
	 * @return array
	 */
	public function Despublicar() {

		$cSql = "UPDATE productos SET productos.publicado = 0";
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

		if ($this->IdProducto) {
			$cSql = "UPDATE productos SET ".
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
				"orden = ".($this->Orden ? $this->Orden : 'null').", ".
				"orden_cat = ".($this->Orden_cat ? $this->Orden_cat : 'null').", ";

				if(defined('CAMPO_PRECIOWEB')){
					$cSql .= "precioweb = ".($this->Precioweb ? $this->Precioweb : 'null').", ";
				}

				$cSql .= "destacado = ".($this->Destacado ? '1' : '0')." ".
				"WHERE id_producto = '{$this->IdProducto}' LIMIT 1";

			$this->DB->Query($cSql);

		}
		else {
			$cSql = "INSERT INTO productos SET ".
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
				"orden_cat = ".($this->Orden_cat ? $this->Orden_cat : '99999').", ";

				if(defined('CAMPO_PRECIOWEB')){
					$cSql .= "precioweb = ".($this->Precioweb ? $this->Precioweb : 'null').", ";
				}

				$cSql .= "destacado = ".($this->Destacado ? '1' : '0');

			$this->IdProducto = $this->DB->QueryInsert($cSql);
		}

		// Si tiene talles... deberá tener la base de datos actualizada.
		if(@Configuracion::ObtenerValor('talles') && isset($_POST['talles'])){
			$this->GuardarTalles($_POST['talles'], $this->IdProducto);
		}

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdProducto;
		}
	}

	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM productos WHERE id_producto = '{$this->IdProducto}' LIMIT 1";
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
		$this->IdProducto = $aDatos['id_producto'];
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
		$this->Precioweb = @$aDatos['precioweb'];
	}

	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdProducto = $this->Codigo = $this->Nombre = $this->IdCategoria = $this->IdMarca = $this->Descripcion = $this->Texto = $this->IdImagen = $this->Precio = $this->Precio1 = $this->Precio2 = $this->Precio3 = $this->Precio4 = $this->Precio5 = $this->Publicado = $this->Oferta = $this->Destacado = $this->Orden = $this->Orden_cat = $this->Precioweb = null;
	}

	/***
	* TALLES. Fernando Cuadrado - 07/11/2013
	***/
	public function Talles() {

		$cSql = "SELECT SQL_CALC_FOUND_ROWS talles.* FROM talles ORDER BY orden ASC, nombre ASC";

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		return $aRet;
	}

	/***
	* BUSCAR TALLES. Fernando Cuadrado - 07/11/2013
	***/
	public function BuscarTalles($nId, $nStock = null, $cSector = SECTOR_PRODUCTOS) {

		if($nStock){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS talles_elementos.*, talles.nombre FROM talles_elementos INNER JOIN talles ON talles.id_talle = talles_elementos.id_talle WHERE id_sector = '{$cSector}' AND id_elemento = '{$nId}' AND stock >= '{$nStock}' ORDER BY talles.orden ASC, talles.nombre ASC";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS talles_elementos.*, talles.nombre FROM talles_elementos INNER JOIN talles ON talles.id_talle = talles_elementos.id_talle WHERE id_sector = '{$cSector}' AND id_elemento = '{$nId}' ORDER BY talles.orden ASC, talles.nombre ASC";
		}

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		return $aRet;
	}

	/***
	* TRAER TALLE. Fernando Cuadrado - 08/11/2013
	***/
	public function TraerTalle($nId) {

		$cSql = "SELECT talles_elementos.*, talles.nombre FROM talles_elementos INNER JOIN talles ON talles.id_talle = talles_elementos.id_talle WHERE id_talle_elemento = '{$nId}'";

		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();

		return $aRet;
	}

	/***
	* GUARDAR TALLES. Fernando Cuadrado - 07/11/2013
	***/
	public function GuardarTalles($aDatos, $nId, $cSector = SECTOR_PRODUCTOS) {

		$cSql  = "DELETE FROM talles_elementos WHERE id_elemento = '{$nId}' AND id_sector = '{$cSector}'";
		$this->DB->Query($cSql);

		foreach($aDatos as $item){

			// Crea el registro únicamente si hay Stock. Debe haber al menos uno.
			if($item['stock'] > 0){
				$cSql  = "INSERT INTO talles_elementos SET";
				$cSql .= " id_talle = '{$item['id_talle']}',";
				$cSql .= " id_sector = '{$cSector}',";
				$cSql .= " id_elemento = '{$nId}',";
				$cSql .= " stock = '{$item['stock']}',";
				$cSql .= " precio = '{$item['precio']}',";
				$cSql .= " descripcion = ''";
				$this->DB->Query($cSql);
			}


		}

	}

	/**
	* @desc
	* Trae los rubros de la tabla de productos. Para casos como SERVICEITALIA.
	* - Si se asigna parámetro IdRub trae los subrubros asociados. Fernando Cuadrado - 17-09-2014
	*/
	public function Rubros($nIdRub = false){

		if($nIdRub){
			$cSql = "SELECT cod_subrub codigo, des_subrub nombre FROM productos WHERE cod_rub = '{$nIdRub}' GROUP BY cod_subrub";
		} else {
			$cSql = "SELECT cod_rub codigo, des_rub nombre FROM productos GROUP BY cod_rub";
		}

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		return $aRet;
	}

	/**
	 * @desc
	 * Importación de productos.
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

		// Lee todas las lineas e importa los productos.
		while ($aData = fgetcsv($sFp, null, $_POST['separador'], '"')) {
			// Guarda informacion para saber el porcentaje completado.
			$nPosicion = round(ftell($sFp) * 100 / $nSize);
			file_put_contents($cFileStatus, json_encode(array('porcentaje'=>$nPosicion)));

			$aProducto = array(
				'id_producto'=>null,
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
				//$aProducto['codigo'] = utf8_encode(addslashes(trim($aData[$nPos])));
				// ELIMINO EL TRIM... Los espacios pueden ser útiles. FER. 27-06-2014
				$aProducto['codigo'] = utf8_encode(addslashes($aData[$nPos]));

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
							$cCodigo = utf8_encode(addslashes($aData[$pos]));

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
							$cCodigo = utf8_encode(addslashes($aData[$pos]));

							if ($cCodigo !== '') {
								$cSql = "SELECT id_marcaproducto FROM marcas_producto WHERE codigo = '{$cCodigo}' LIMIT 1";
								$sRes = mysql_query($cSql, $sMY);

								if (mysql_num_rows($sRes)) {
									$aTmp = mysql_fetch_array($sRes, MYSQL_ASSOC);
									$aProducto['id_marca'] = $aTmp['id_marcaproducto'];
								}
								elseif (isset($_POST['auto_insertar']) && $_POST['auto_insertar']) {
									$cPublicado = $_POST['publicado'] !== '' ? ", publicado = '{$_POST['publicado']}'" : '';
									$cSql = "INSERT INTO marcas_producto SET codigo = '{$cCodigo}', nombre = '{$cCodigo}'{$cPublicado}";
									mysql_query($cSql, $sMY);
									$aProducto['id_marca'] = mysql_insert_id($sMY);
								}
							}
							break;
					}
				}
				else {
					$aProducto[$col] = utf8_encode(addslashes($aData[$pos]));
				}
			}

			if ($aProducto['id_producto']) {
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
					"WHERE id_producto = '{$aProducto['id_producto']}' LIMIT 1";
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
