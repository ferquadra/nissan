<?
class Listados extends Model {
	
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
	public $IdListado, $Controlador, $Titulo, $IdCampoBusqueda, $IdCampoOrden, $CampoOrdenDireccion, $Bloqueado;
	
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
		
		if ($this->Controlador !== null) {
			$aWhere[] = "listados.controlador = '{$this->Controlador}'";
		}
		if ($this->Titulo !== null) {
			$aWhere[] = "listados.titulo LIKE '%{$this->Titulo}%'";
		}
		if ($this->Bloqueado !== null) {
			$aWhere[] = "listados.bloqueado = '{$this->Bloqueado}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS listados.* FROM listados {$cWhere} {$cOrderBy} {$cLimit}";
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
		if ($this->IdListado) {
			$cWhere = "id_listado = '{$this->IdListado}'";
		}
		else {
			$cWhere = "controlador = '{$this->Controlador}'";
		}
		
		$cSql = "
			SELECT listados.*, cl1.titulo campo_busqueda, cl2.titulo campo_orden
			FROM listados 
				LEFT JOIN campos_listado cl1 ON cl1.id_campolistado = listados.id_campobusqueda
				LEFT JOIN campos_listado cl2 ON cl2.id_campolistado = listados.id_campoorden
			WHERE listados.{$cWhere}
			LIMIT 1";
		
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
		
		if ($this->IdListado) {
			$cSql = "UPDATE listados SET ".
				"controlador = '{$this->Controlador}', ".
				"titulo = '{$this->Titulo}', ".
				"id_campobusqueda = ".($this->IdCampoBusqueda ? "'{$this->IdCampoBusqueda}'" : 'NULL').", ".
				"id_campoorden = ".($this->IdCampoOrden ? "'{$this->IdCampoOrden}'" : 'NULL').", ".
				"campo_orden_direccion = ".($this->CampoOrdenDireccion ? "'{$this->CampoOrdenDireccion}'" : 'NULL').", ".
				"bloqueado = '{$this->Bloqueado}' ".
				"WHERE id_listado = '{$this->IdListado}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO listados SET ".
				"controlador = '{$this->Controlador}', ".
				"titulo = '{$this->Titulo}', ".
				"id_campobusqueda = ".($this->IdCampoBusqueda ? "'{$this->IdCampoBusqueda}'" : 'NULL').", ".
				"id_campoorden = ".($this->IdCampoOrden ? "'{$this->IdCampoOrden}'" : 'NULL').", ".
				"campo_orden_direccion = ".($this->CampoOrdenDireccion ? "'{$this->CampoOrdenDireccion}'" : 'NULL').', '.
				"bloqueado = '{$this->Bloqueado}'";
			
			$this->IdListado = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdListado;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM listados WHERE id_listado = '{$this->IdListado}' LIMIT 1";
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
		$this->IdListado = $aDatos['id_listado'];
		$this->Controlador = $aDatos['controlador'];
		$this->Titulo = $aDatos['titulo'];
		$this->IdCampoBusqueda = $aDatos['id_campobusqueda'];
		$this->IdCampoOrden = $aDatos['id_campoorden'];
		$this->CampoOrdenDireccion = $aDatos['campo_orden_direccion'];
		$this->Bloqueado = $aDatos['bloqueado'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdListado = $this->Controlador = $this->Titulo = $this->IdCampoBusqueda = $this->IdCampoOrden = $this->CampoOrdenDireccion = $this->Bloqueado = null;
	}
}
?>