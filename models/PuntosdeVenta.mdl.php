<?
class PuntosdeVenta extends Model {
	
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
	public $IdPuntodeVenta, $Nombre, $Actividad, $Domicilio, $Localidad, $Provincia, $Pais, $Texto, $Publicado, $Destacado;
	
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
		
		if ($this->Nombre !== null) {
			$aWhere[] = "puntos_de_venta.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->Actividad !== null) {
			$aWhere[] = "puntos_de_venta.actividad = '{$this->Actividad}'";
		}
		if ($this->Domicilio !== null) {
			$aWhere[] = "puntos_de_venta.domicilio = '{$this->Domicilio}'";
		}
		if ($this->Localidad !== null) {
			$aWhere[] = "puntos_de_venta.localidad = '{$this->Localidad}'";
		}
		if ($this->Provincia !== null) {
			$aWhere[] = "puntos_de_venta.provincia = '{$this->Provincia}'";
		}
		if ($this->Pais !== null) {
			$aWhere[] = "puntos_de_venta.pais = '{$this->Pais}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "puntos_de_venta.publicado = '{$this->Publicado}'";
		}
		if ($this->Destacado !== null) {
			$aWhere[] = "puntos_de_venta.destacado = '{$this->Destacado}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS puntos_de_venta.* FROM puntos_de_venta {$cWhere} {$cOrderBy} {$cLimit}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro según su ID primario.
	 *
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {
		$cSql = "SELECT puntos_de_venta.* FROM puntos_de_venta WHERE puntos_de_venta.id_punto_de_venta = '{$this->IdPuntodeVenta}' LIMIT 1";
		
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
		
		if ($this->IdPuntodeVenta) {
			$cSql = "UPDATE puntos_de_venta SET ".
				"nombre = ".($this->Nombre ? "'{$this->Nombre}'" : 'NULL').", ".
				"actividad = ".($this->Actividad ? "'{$this->Actividad}'" : 'NULL').", ".
				"domicilio = ".($this->Domicilio ? "'{$this->Domicilio}'" : 'NULL').", ".
				"localidad = ".($this->Localidad ? "'{$this->Localidad}'" : 'NULL').", ".
				"provincia = ".($this->Provincia ? "'{$this->Provincia}'" : 'NULL').", ".
				"pais = ".($this->Pais ? "'{$this->Pais}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? "'{$this->Publicado}'" : 'NULL').", ".
				"destacado = ".($this->Destacado ? "'{$this->Destacado}'" : 'NULL')." ".
				"WHERE id_punto_de_venta = '{$this->IdPuntodeVenta}' LIMIT 1";
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO puntos_de_venta SET ".
				"nombre = ".($this->Nombre ? "'{$this->Nombre}'" : 'NULL').", ".
				"actividad = ".($this->Actividad ? "'{$this->Actividad}'" : 'NULL').", ".
				"domicilio = ".($this->Domicilio ? "'{$this->Domicilio}'" : 'NULL').", ".
				"localidad = ".($this->Localidad ? "'{$this->Localidad}'" : 'NULL').", ".
				"provincia = ".($this->Provincia ? "'{$this->Provincia}'" : 'NULL').", ".
				"pais = ".($this->Pais ? "'{$this->Pais}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? "'{$this->Publicado}'" : 'NULL').", ".
				"destacado = ".($this->Destacado ? "'{$this->Destacado}'" : 'NULL')."";
			
			$this->IdPuntodeVenta = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdPuntodeVenta;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM puntos_de_venta WHERE id_punto_de_venta = '{$this->IdPuntodeVenta}' LIMIT 1";
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
		$this->IdPuntodeVenta = $aDatos['id_punto_de_venta'];
		$this->Nombre = $aDatos['nombre'];
		$this->Actividad = $aDatos['actividad'];
		$this->Domicilio = $aDatos['domicilio'];
		$this->Localidad = $aDatos['localidad'];
		$this->Provincia = $aDatos['provincia'];
		$this->Pais = $aDatos['pais'];
		$this->Texto = $aDatos['texto'];
		$this->Publicado = $aDatos['publicado'];
		$this->Destacado = $aDatos['destacado'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdPuntodeVenta = $this->Nombre = $this->Actividad = $this->Domicilio = $this->Localidad = $this->Provincia = $this->Pais = $this->Texto = $this->Publicado = 
		$this->Destacado = null;
	}
}
?>