<?
class Marcas_producto extends Model {
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
	public $IdMarcaproducto, $Codigo, $Nombre, $Descripcion, $Texto, $IdImagen, $Publicado;
	
	// Para poder filtrar Imagen = true;
	public $Imagen;
	
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
			$aWhere[] = "marcas_producto.codigo = '{$this->Codigo}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "marcas_producto.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "marcas_producto.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "marcas_producto.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "marcas_producto.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Imagen !== null) {
			$aWhere[] = "marcas_producto.id_imagen > 0";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "marcas_producto.publicado = '{$this->Publicado}'";
		}
		
		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "marcas_producto.nombre REGEXP '^[^a-z]'";
				break;
				
			case null:
				break;
			
			default:
				$aWhere[] = "marcas_producto.nombre LIKE '{$this->PorLetra}%'";
				break;
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS marcas_producto.* FROM marcas_producto {$cWhere} {$cOrderBy} {$cLimit}";
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
		$cSql = "SELECT marcas_producto.* FROM marcas_producto WHERE marcas_producto.id_marcaproducto = '{$this->IdMarcaproducto}' LIMIT 1";
		
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
		
		if ($this->IdMarcaproducto) {
			$cSql = "UPDATE marcas_producto SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"publicado = '{$this->Publicado}' ".
				"WHERE id_marcaproducto = '{$this->IdMarcaproducto}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO marcas_producto SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"publicado = '{$this->Publicado}'";
			
			$this->IdMarcaproducto = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdMarcaproducto;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM marcas_producto WHERE id_marcaproducto = '{$this->IdMarcaproducto}' LIMIT 1";
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
		$this->IdMarcaproducto = $aDatos['id_marcaproducto'];
		$this->Codigo = $aDatos['codigo'];
		$this->Nombre = $aDatos['nombre'];
		$this->Descripcion = $aDatos['descripcion'];
		$this->Texto = $aDatos['texto'];
		$this->IdImagen = $aDatos['id_imagen'];
		$this->Publicado = $aDatos['publicado'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdMarcaproducto = $this->Nombre = $this->Descripcion = $this->Texto = $this->IdImagen = $this->Publicado = null;
	}
}
?>