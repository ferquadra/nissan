<?
class Agenda extends Model {
	
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
	public $id_agenda, $codigo, $nombre, $direccion, $codpos, $localidad, $provincia;
	public $telefono, $contacto, $email, $id_tipo, $comentarios;
	
	/** Para hacer consultas en el controlador... **/
	public $Where;
	
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
		
		if ($this->TerminoBusqueda != null) {
			$aWhere[] = "(agenda.codigo LIKE '%{$this->TerminoBusqueda}%' OR agenda.nombre LIKE '%{$this->TerminoBusqueda}%' OR agenda.provincia LIKE '%{$this->TerminoBusqueda}%' OR agenda.localidadla pla LIKE '%{$this->TerminoBusqueda}%')";
		}
		
		if ($this->Where !== null) {
			$aWhere[] = $this->Where;
		}
			
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS agenda.* FROM agenda {$cWhere} {$cOrderBy} {$cLimit}";
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
	
		if ($this->id_agenda) {
			$cSql = "SELECT agenda.* FROM agenda WHERE agenda.id_agenda = '{$this->id_agenda}' LIMIT 1";
		}
		else {
			$cSql = "SELECT agenda.* FROM agenda ORDER BY id_agenda DESC LIMIT 1";
		}
		
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
		/**
		echo "<pre>"; print_r($_POST);
		die;**/
	
		$this->DB->Begin();
		// $id_agenda, $codigo, $nombre, $direccion, $codpos, $localidad, $provincia, $telefono, $id_tipo;
		if ($this->id_agenda) {
			$cSql = "UPDATE agenda SET ".
				"codigo = '{$this->codigo}', ".
				"nombre = '{$this->nombre}', ".
				"direccion = '{$this->direccion}', ".
				"codpos = '{$this->codpos}', ".
				"localidad = ".($this->localidad ? "'{$this->localidad}'" : "'NULL'").", ".
				"provincia = ".($this->provincia ? "'{$this->provincia}'" : "'NULL'").", ".
				"telefono = ".($this->telefono ? "'{$this->telefono}'" : "'NULL'").", ".
				"id_tipo = ".($this->id_tipo ? "'{$this->id_tipo}'" : "'NULL'").", ".
				"contacto = ".($this->contacto ? "'{$this->contacto}'" : "'NULL'").", ".
				"email = ".($this->email ? "'{$this->email}'" : "'NULL'").", ".
				"comentarios = ".($this->comentarios ? "'{$this->comentarios}'" : "'NULL'")." ".
				"WHERE id_agenda = '{$this->id_agenda}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO agenda SET ".
				"codigo = '{$this->codigo}', ".
				"nombre = '{$this->nombre}', ".
				"direccion = '{$this->direccion}', ".
				"codpos = '{$this->codpos}', ".
				"localidad = ".($this->localidad ? "'{$this->localidad}'" : 'NULL').", ".
				"provincia = ".($this->provincia ? "'{$this->provincia}'" : 'NULL').", ".
				"telefono = ".($this->telefono ? "'{$this->telefono}'" : 'NULL').", ".
				"id_tipo = ".($this->id_tipo ? "'{$this->id_tipo}'" : 'NULL').", ".
				"contacto = ".($this->contacto ? "'{$this->contacto}'" : 'NULL').", ".
				"email = ".($this->email ? "'{$this->email}'" : 'NULL').", ".
				"comentarios = ".($this->comentarios ? "'{$this->comentarios}'" : 'NULL');
			
			$this->id_agenda = $this->DB->QueryInsert($cSql);
		}
	
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->id_agenda;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM agenda WHERE id_agenda = '{$this->id_agenda}' LIMIT 1";
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
	 // $id_agenda, $codigo, $nombre, $direccion, $codpos, $localidad, $provincia, $telefono, $contacto, $email, $id_tipo, $comentarios;
	public function Set($aDatos) {

		$this->id_agenda 	= @$aDatos['id_agenda'];
		$this->codigo 		= @$aDatos['codigo'];
		$this->nombre 		= @$aDatos['nombre'];
		$this->direccion 	= @$aDatos['direccion'];
		$this->codpos 		= @$aDatos['codpos'];
		$this->localidad 	= @$aDatos['localidad'];
		$this->provincia 	= @$aDatos['provincia'];
		$this->telefono 	= @$aDatos['telefono'];
		$this->contacto 	= @$aDatos['contacto'];
		$this->email 		= @$aDatos['email'];
		$this->id_tipo 		= @$aDatos['id_tipo'];
		$this->comentarios 	= @$aDatos['comentarios'];
		
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->id_agenda = $this->codigo = $this->nombre = $this->codpos = $this->localidad = $this->provincia = $this->direccion = $this->id_tipo = $this->comentario = null;
	}
}
?>