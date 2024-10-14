<?
class Registros_listado extends Model {
	
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
	public $IdRegistrolistado, $IdRegistro, $IdCampolistado, $Valor, $Tipo;
	
	/**
	 * @desc
	 * Propiedades privadas.
	 *
	 * @var mixed
	 */
	private $Texto, $Entero, $Decimal, $Fecha;
	
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
		
		if ($this->IdRegistro !== null) {
			$aWhere[] = "registros_listado.id_registro = '{$this->IdRegistro}'";
		}
		if ($this->IdCampolistado !== null) {
			$aWhere[] = "registros_listado.id_campolistado = '{$this->IdCampolistado}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "registros_listado.texto = '{$this->Texto}'";
		}
		if ($this->Entero !== null) {
			$aWhere[] = "registros_listado.entero = '{$this->Entero}'";
		}
		if ($this->Decimal !== null) {
			$aWhere[] = "registros_listado.decimal = '{$this->Decimal}'";
		}
		if ($this->Fecha !== null) {
			$aWhere[] = "registros_listado.fecha = '{$this->Fecha}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "
			SELECT SQL_CALC_FOUND_ROWS 
				registros_listado.*, campos_listado.titulo campo, campos_listado.tipo
			FROM registros_listado 
				LEFT JOIN campos_listado ON campos_listado.id_campolistado = registros_listado.id_campolistado
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
	 * Devuelve el registro según su ID primario.
	 *
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {
		if ($this->IdRegistro && $this->IdCampolistado) {
			$cSql = "SELECT registros_listado.* FROM registros_listado WHERE registros_listado.id_registro = '{$this->IdRegistro}' AND registros_listado.id_campolistado = '{$this->IdCampolistado}' LIMIT 1";
		}
		else {
			$cSql = "SELECT registros_listado.* FROM registros_listado WHERE registros_listado.id_registrolistado = '{$this->IdRegistrolistado}' LIMIT 1";
		}
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		if ($aRet) {
			$aRet['valor'] = $aRet['texto'] | $aRet['entero'] | $aRet['decimal'] | $aRet['fecha'];
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
		switch ($this->Tipo) {
			case Campos_listado::TIPO_FECHA_CORTA:
				$this->Fecha = date2mysql($this->Valor, '%d/%m/%Y');
				break;
				
			case Campos_listado::TIPO_FECHA_HORA:
				$this->Fecha = date2mysql($this->Valor, '%d/%m/%Y %H:%i', true);
				break;
				
			case Campos_listado::TIPO_NUMERO_DECIMAL:
				$this->Decimal = $this->Valor;
				break;
				
			case Campos_listado::TIPO_NUMERO_ENTERO:
			case Campos_listado::TIPO_SELECT:
				$this->Entero = $this->Valor;
				break;
				
			default:
				$this->Texto = $this->Valor;
		}
		
		if ($this->IdRegistrolistado) {
			$cSql = "UPDATE registros_listado SET ".
				"id_registro = '{$this->IdRegistro}', ".
				"id_campolistado = '{$this->IdCampolistado}', ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"entero = ".($this->Entero ? "'{$this->Entero}'" : 'NULL').", ".
				"`decimal` = ".($this->Decimal ? "'{$this->Decimal}'" : 'NULL').", ".
				"fecha = ".($this->Fecha ? "'{$this->Fecha}'" : 'NULL')." ".
				"WHERE id_registrolistado = '{$this->IdRegistrolistado}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO registros_listado SET ".
				"id_registro = '{$this->IdRegistro}', ".
				"id_campolistado = '{$this->IdCampolistado}', ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"entero = ".($this->Entero ? "'{$this->Entero}'" : 'NULL').", ".
				"`decimal` = ".($this->Decimal ? "'{$this->Decimal}'" : 'NULL').", ".
				"fecha = ".($this->Fecha ? "'{$this->Fecha}'" : 'NULL')."";
			
			$this->IdRegistrolistado = $this->DB->QueryInsert($cSql);
		}
		
		return $this->IdRegistrolistado;
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		if ($this->IdRegistrolistado) {
			$cSql = "DELETE IGNORE FROM registros_listado WHERE id_registrolistado = '{$this->IdRegistrolistado}' LIMIT 1";
		}
		else {
			$cSql = "DELETE IGNORE FROM registros_listado WHERE id_registro = '{$this->IdRegistro}'";
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
		$this->IdRegistrolistado = $aDatos['id_registrolistado'];
		$this->IdRegistro = $aDatos['id_registro'];
		$this->IdCampolistado = $aDatos['id_campolistado'];
		$this->Texto = $aDatos['texto'];
		$this->Entero = $aDatos['entero'];
		$this->Decimal = $aDatos['decimal'];
		$this->Fecha = $aDatos['fecha'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdRegistrolistado = $this->IdRegistro = $this->IdCampolistado = $this->Texto = $this->Entero = $this->Decimal = $this->Fecha = $this->Valor = $this->Tipo = null;
	}
}
?>