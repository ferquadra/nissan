<?
class Operadores extends Model {
	
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
	public $IdOperador, $Nombre, $Usuario, $Clave, $Activo;
	
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
			$aWhere[] = "operadores.nombre = '{$this->Nombre}'";
		}
		if ($this->Usuario !== null) {
			$aWhere[] = "operadores.usuario = '{$this->Usuario}'";
		}
		if ($this->Clave !== null) {
			$aWhere[] = "operadores.clave = '{$this->Clave}'";
		}
		if ($this->Activo !== null) {
			$aWhere[] = "operadores.activo = '{$this->Activo}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS operadores.* FROM operadores {$cWhere} {$cOrderBy} {$cLimit}";
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
		$cSql = "SELECT operadores.* FROM operadores WHERE operadores.id_operador = '{$this->IdOperador}' LIMIT 1";
		
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
		
		if ($this->IdOperador) {
			$cSql = "UPDATE operadores SET ".
				"nombre = ".($this->Nombre ? "'{$this->Nombre}'" : 'NULL').", ".
				"usuario = '{$this->Usuario}', ".
				"clave = ".($this->Clave ? "'{$this->Clave}'" : 'NULL').", ".
				"activo = '{$this->Activo}' ".
				"WHERE id_operador = '{$this->IdOperador}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO operadores SET ".
				"nombre = ".($this->Nombre ? "'{$this->Nombre}'" : 'NULL').", ".
				"usuario = '{$this->Usuario}', ".
				"clave = ".($this->Clave ? "'{$this->Clave}'" : 'NULL').", ".
				"activo = '{$this->Activo}'";
			
			$this->IdOperador = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdOperador;
		}
	}
	
	/**
	 * @desc
	 * Cambia la clave de acceso de un operador determinado.
	 *
	 * @param int $nId
	 * @param string $cClave
	 */
	function CambiarClave($nId, $cClave) {
		$cSql = "UPDATE operadores SET clave = '{$cClave}' WHERE id_operador = '{$nId}' LIMIT 1";
		$this->DB->Query($cSql);
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM operadores WHERE id_operador = '{$this->IdOperador}' LIMIT 1";
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
		$this->IdOperador = $aDatos['id_operador'];
		$this->Nombre = $aDatos['nombre'];
		$this->Usuario = $aDatos['usuario'];
		$this->Clave = $aDatos['clave'];
		$this->Activo = $aDatos['activo'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdOperador = $this->Nombre = $this->Usuario = $this->Clave = $this->Activo = null;
	}
}
?>