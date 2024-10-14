<?
class Campos_categoriaproducto extends Model {
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
	public $IdCampocategoria, $IdCategoria, $Nombre, $Tipo, $Extra, $Orden;
	
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
		
		if ($this->IdCategoria !== null) {
			$aWhere[] = "campos_categoriaproducto.id_categoria = '{$this->IdCategoria}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "campos_categoriaproducto.nombre = '{$this->Nombre}'";
		}
		if ($this->Tipo !== null) {
			$aWhere[] = "campos_categoriaproducto.tipo = '{$this->Tipo}'";
		}
		if ($this->Extra !== null) {
			$aWhere[] = "campos_categoriaproducto.extra = '{$this->Extra}'";
		}
		if ($this->Orden !== null) {
			$aWhere[] = "campos_categoriaproducto.orden = '{$this->Orden}'";
		}
		if (isset($this->IdProducto)) {
			$cSelect = ', valores_campoproducto.valor';
			$cFrom = "LEFT JOIN valores_campoproducto ON valores_campoproducto.id_producto = '{$this->IdProducto}' AND valores_campoproducto.id_campocategoria = campos_categoriaproducto.id_campocategoria";
		}
		else {
			$cSelect = $cFrom = '';
		}
		
		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "campos_categoriaproducto.nombre REGEXP '^[^a-z]'";
				break;
				
			case null:
				break;
			
			default:
				$aWhere[] = "campos_categoriaproducto.nombre LIKE '{$this->PorLetra}%'";
				break;
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS campos_categoriaproducto.* {$cSelect} FROM campos_categoriaproducto {$cFrom} {$cWhere} {$cOrderBy} {$cLimit}";
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
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {
		$cSql = "SELECT campos_categoriaproducto.* FROM campos_categoriaproducto WHERE campos_categoriaproducto.id_campocategoria = '{$this->IdCampocategoria}' LIMIT 1";
		
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
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		$this->DB->Begin();
		
		if ($this->IdCampocategoria) {
			$cSql = "UPDATE campos_categoriaproducto SET ".
				"id_categoria = '{$this->IdCategoria}', ".
				"nombre = '{$this->Nombre}', ".
				"tipo = '{$this->Tipo}', ".
				"extra = ".($this->Extra ? "'{$this->Extra}'" : 'NULL').", ".
				"orden = ".($this->Orden ? "'{$this->Orden}'" : 'NULL')." ".
				"WHERE id_campocategoria = '{$this->IdCampocategoria}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO campos_categoriaproducto SET ".
				"id_categoria = '{$this->IdCategoria}', ".
				"nombre = '{$this->Nombre}', ".
				"tipo = '{$this->Tipo}', ".
				"extra = ".($this->Extra ? "'{$this->Extra}'" : 'NULL').", ".
				"orden = ".($this->Orden ? "'{$this->Orden}'" : 'NULL')."";
			
			$this->IdCampocategoria = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdCampocategoria;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		if ($this->IdCampocategoria) {
			$cSql = "DELETE IGNORE FROM campos_categoriaproducto WHERE id_campocategoria = '{$this->IdCampocategoria}' LIMIT 1";
		}
		elseif ($this->IdCategoria) {
			$cSql = "DELETE IGNORE FROM campos_categoriaproducto WHERE id_categoria = '{$this->IdCategoria}'";
		}
		
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
		$this->IdCampocategoria = $aDatos['id_campocategoria'];
		$this->IdCategoria = $aDatos['id_categoria'];
		$this->Nombre = $aDatos['nombre'];
		$this->Tipo = $aDatos['tipo'];
		$this->Extra = $aDatos['extra'];
		$this->Orden = $aDatos['orden'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdCampocategoria = $this->IdCategoria = $this->Nombre = $this->Tipo = $this->Extra = $this->Orden = null;
	}
}
?>