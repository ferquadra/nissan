<?
class Localidades extends Model {
	
	/**
	 * @desc
	 * Cadena con el ORDER BY.
	 *
	 * @var string
	 */
	public $OrderBy;
	public $GroupBy;
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
	public $Where;
	
	/**
	 * @desc
	 * Limite de consulta.
	 * Se usa junto a Page.
	 * 
	 * Si se asigna NULL no se hace un limite en la consulta.
	 *
	 * @var int
	 */
	public $LimitCant = null;
	
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
	public $IdPais = 1;
	
	public $IdLocalidad, $IdProvincia, $Nombre;
	
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
	public function BuscarLocalidades() {
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
		
		if ($this->IdProvincia !== null) {
			$aWhere[] = "localidades.id_provincia = '{$this->IdProvincia}'";
		}
		if ($this->IdPais !== null) {
			$aWhere[] = "localidades.id_pais = '{$this->IdPais}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS localidades.*, provincias.nombre provincia, paises.nombre pais FROM localidades LEFT JOIN provincias ON provincias.id_provincia = localidades.id_provincia LEFT JOIN paises ON paises.id_pais = provincias.id_pais {$cWhere} {$cOrderBy} {$cLimit}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		//print_r($cSql); die;
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}

	public function ObtenerLocalidad() {

		$cSql = "SELECT localidades.* FROM localidades WHERE id_localidad = {$this->IdLocalidad} LIMIT 1";
	
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
	
	public function ObtenerProvincia() {

		$cSql = "SELECT provincias.* FROM provincias WHERE id_provincia = {$this->IdProvincia} LIMIT 1";
	
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
	
	public function Localidades() {

		$cSql = "SELECT SQL_CALC_FOUND_ROWS localidades.* FROM localidades WHERE localidades.id_provincia = '{$this->IdProvincia}'";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	public function LocalidadesTodas() {

		$cSql = "SELECT localidades.*, provincias.nombre provincia FROM localidades LEFT JOIN provincias ON provincias.id_provincia = localidades.id_provincia ORDER BY nombre ASC";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
	
		return $aRet;
	}
	
	public function Provincias() {

		$cSql = "SELECT SQL_CALC_FOUND_ROWS provincias.* FROM provincias WHERE provincias.id_pais = '{$this->IdPais}'";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	public function Paises() {

		$cSql = "SELECT SQL_CALC_FOUND_ROWS paises.* FROM paises";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function GuardarLocalidad() {
		$this->DB->Begin();
		
		if ($this->IdLocalidad) {
			$cSql = "UPDATE localidades SET ".
				"nombre = ".($this->Nombre ? "'{$this->Nombre}'" : 'NULL').", ".
				"id_provincia = ".($this->IdProvincia ? "'{$this->IdProvincia}'" : 'NULL')." ".
				"WHERE id_localidad = '{$this->IdLocalidad}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO localidades SET ".
				"nombre = ".($this->Nombre ? "'{$this->Nombre}'" : 'NULL').", ".
				"id_provincia = ".($this->IdProvincia ? "'{$this->IdProvincia}'" : 'NULL');
			
			$this->IdLocalidad = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdFormaEnvio;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM formas_envio WHERE id_formaenvio = '{$this->IdFormaEnvio}' LIMIT 1";
		$this->DB->Query($cSql);
		
		return $this->DB->AffectedRows();
	}

	/**
	 * @desc
	 * Llena las propiedades del modelo con los datos
	 * pronombres en el array $aDatos.
	 *
	 * @param array $aDatos
	 */
	private function Set($aDatos) {
		$this->IdLocalidad 	= @$aDatos['id_localidad'];
		$this->IdProvincia 	= @$aDatos['id_provincia'];
		$this->IdPais 		= @$aDatos['id_pais'];
		$this->Nombre 		= @$aDatos['nombre'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdFormaEnvio = $this->Nombre = $this->Precio = null;
	}
}
?>