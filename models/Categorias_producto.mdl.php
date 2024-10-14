<?
class Categorias_producto extends Model {
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
	public $IdCategoriaproducto, $Codigo, $IdPadre, $Nombre, $Descripcion, $Orden, $IdImagen, $Publicado, $Enlace;

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
	public function Buscar($cMarca = false) {
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
			$aWhere[] = "categorias_producto.codigo = '{$this->Codigo}'";
		}
		if ($this->IdPadre !== null) {
			$aWhere[] = "categorias_producto.id_padre = '{$this->IdPadre}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "categorias_producto.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "categorias_producto.descripcion = '{$this->Descripcion}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "categorias_producto.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "categorias_producto.publicado = '{$this->Publicado}'";
		}

		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "categorias_producto.nombre REGEXP '^[^a-z]'";
				break;

			case null:
				break;

			default:
				$aWhere[] = "categorias_producto.nombre LIKE '{$this->PorLetra}%'";
				break;
		}

		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';

		if($cMarca){

			$cSql = "SELECT SQL_CALC_FOUND_ROWS categorias_producto.*
					FROM productos
					INNER JOIN categorias_producto ON categorias_producto.id_categoriaproducto = productos.id_categoria";

			$cSql .= " WHERE productos.id_marca = {$cMarca}";

			if($this->IdPadre){
				$cSql .= " AND categorias_producto.id_padre = {$this->IdPadre}";
			}

			$cSql .= " GROUP BY productos.id_categoria";




		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS categorias_producto.* FROM categorias_producto {$cWhere} {$cOrderBy} {$cLimit}";
		}

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);

		$this->FoundRows = $this->DB->Field('total');

		if(count($aRet)){
			foreach($aRet as $key => $val){
				$cSql = "SELECT SQL_CALC_FOUND_ROWS categorias_producto.* FROM categorias_producto WHERE categorias_producto.id_padre = '{$val['id_categoriaproducto']}' LIMIT 1";
				$this->DB->Query($cSql);
				$aHijas = $this->DB->GetRecordset();

				// Ya se que se puede acotar pero me gusta que se entienda el código!.
				if(count($aHijas)){
					$aRet[$key]['hijas'] = true;
				} else {
					$aRet[$key]['hijas'] = false;
				}
			}
		}

		return $aRet;
	}

	/**
	 * @desc
	 * Devuelve el registro segun su ID primario.
	 *
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {

		$cSql = '';

		if(@$this->IdCategoriaproducto){
			$cSql = "SELECT categorias_producto.* FROM categorias_producto WHERE categorias_producto.id_categoriaproducto = '{$this->IdCategoriaproducto}' LIMIT 1";
		} elseif(@$this->Codigo){
			$cSql = "SELECT categorias_producto.* FROM categorias_producto WHERE categorias_producto.codigo = '{$this->Codigo}' LIMIT 1";
		}

		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();

		if ($aRet) {
			$this->Set($aRet);
		}	else {
			$this->Limpiar();
		}

		return $aRet;
	}

	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {

		$this->DB->Begin();

		if ($this->IdCategoriaproducto) {
			$cSql = "UPDATE categorias_producto SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"id_padre = '{$this->IdPadre}', ".
				"nombre = '{$this->Nombre}', ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"orden = ".($this->Orden ? "'{$this->Orden}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ";

				if($this->baseCampo("enlace")){
					$cSql .= "enlace = '{$this->Enlace}', ";
				}

				$cSql .= "publicado = '{$this->Publicado}' ";

				$cSql .= "WHERE id_categoriaproducto = '{$this->IdCategoriaproducto}' LIMIT 1";

			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO categorias_producto SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"id_padre = '{$this->IdPadre}', ".
				"nombre = '{$this->Nombre}', ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"orden = ".($this->Orden ? "'{$this->Orden}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ";

				if($this->baseCampo("enlace")){
					$cSql .= "enlace = '{$this->Enlace}', ";
				}

				$cSql .= "publicado = '{$this->Publicado}'";

			$this->IdCategoriaproducto = $this->DB->QueryInsert($cSql);
		}

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdCategoriaproducto;
		}
	}

	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM categorias_producto WHERE id_categoriaproducto = '{$this->IdCategoriaproducto}' LIMIT 1";
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
		$this->IdCategoriaproducto = $aDatos['id_categoriaproducto'];
		$this->Codigo = $aDatos['codigo'];
		$this->IdPadre = $aDatos['id_padre'];
		$this->Nombre = $aDatos['nombre'];
		$this->Descripcion = $aDatos['descripcion'];
		$this->Orden = $aDatos['orden'];
		$this->IdImagen = $aDatos['id_imagen'];
		$this->Publicado = $aDatos['publicado'];
	}

	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdCategoriaproducto = $this->Codigo = $this->IdPadre = $this->Nombre = $this->Descripcion = $this->Orden = $this->IdImagen = $this->Publicado = null;
	}

	/**
	 * @desc
	 * Devuelve un array con la lista de categorías antecesoras (inclusive la enviada).
	 *
	 * @param int $nId
	 * @return array
	 */
	public static function ListaArbol($nId) {
		$oDb = new Dbconnection();

		// Mientras haya un antecesor lo agrega al listado, los elementos se añaden por orden en subniveles.
		$aRet = array();
		while ($nId) {
			// Busca la categoría.
			$cSql = "SELECT * FROM categorias_producto WHERE id_categoriaproducto = '{$nId}' AND publicado = 1 LIMIT 1";
			$oDb->Query($cSql);

			if ($aFila = $oDb->Field()) {
				$nId = $aFila['id_padre'];
				array_unshift($aRet, $aFila);
			}
			else {
				$nId = false;
			}
		}

		return $aRet;
	}

	/**
	 * @desc
	 * Devuelve un listado con la lista de categorías sucesoras (inclusive la enviada).
	 *
	 * @param int $nId
	 * @return array
	 */
	public static function ListaArbolSucesoras($nId) {
		$oDb = new Dbconnection();

		// Primer elemento, la categoría en cuestión.
		$aRet[] = $nId;

		// Array temporal con ID's para realiar busquedas de forma iterativa.
		$aTmp[] = $nId;

		// Comienza a ciclar.
		do {
			$cSql = "SELECT * FROM categorias_producto WHERE id_padre IN (".join(', ', $aTmp).") AND publicado = 1";
			$oDb->Query($cSql);

			$aTmp = array();
			foreach ($oDb->GetRecordset('id_categoriaproducto') as $item) {
				$aRet[] = $item;
				$aTmp[] = $item;
			}


		} while ($aTmp);

		return $aRet;
	}

	public function obtenerArbol($publicado = 1) {

		if($publicado){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS categorias_producto.* FROM categorias_producto WHERE publicado = 1 ORDER BY orden ASC, nombre ASC";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS categorias_producto.* FROM categorias_producto ORDER BY orden ASC, nombre ASC";
		}
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		return $this->buildTree($aRet);

	}

	private function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['id_padre'] == $parentId) {
				$children = $this->buildTree($elements, $element['id_categoriaproducto']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}

	public function baseCampo($cCampo = "") {

		$cSql = "SHOW FULL COLUMNS FROM categorias_producto";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		if($cCampo){
			foreach($aRet as $item){
				if(in_array($cCampo, $item)){
					return true;
				}
			}
		} else {
			return $aRet;
		}

	}

	/** Para Canaima y otros similares, saca las categorias de la tabla de productos. **/
	public function Grupos($id_rubro){
		$cSql = "SELECT * FROM productos WHERE id_rubro = '{$id_rubro}' GROUP BY id_grupo";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		return $aRet;
	}
	public function Material($id_grupo){
		$cSql = "SELECT * FROM productos WHERE id_grupo = '{$id_grupo}' GROUP BY id_material";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		return $aRet;
	}

}
?>
