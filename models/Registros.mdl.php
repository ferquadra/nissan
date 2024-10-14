<?
class Registros extends Model {
	
	/**
	 * @desc
	 * Cadena con el ORDER BY.
	 *
	 * @var string
	 */
	public $OrderBy;
	
	/**
	 * @desc
	 * Array con el WHERE dinámico.
	 *
	 * @var array
	 */
	public $Where=array();
	
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
	public $IdRegistro, $IdListado, $Publicado;
	
	/**
	 * @desc
	 * Cadena de búsqueda para campo predeterminado.
	 *
	 * @var string
	 */
	public $Busqueda;
	
	/**
	 * @desc
	 * Indica si el metodo buscar debe traer el detalle completo.
	 *
	 * @var bool
	 */
	public $DetalleCompleto = false;
	
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
		$cJoinOrder = $cOrderBy = $cLimit = '';
		$aJoins = $aWhere = array();
		
		$oCL = new Campos_listado();
		
		// Ordenacion.
		if ($this->OrderBy) {
			if (strtoupper($this->OrderBy) == 'RAND()') {
				$cOrderBy = "ORDER BY RAND()";
			}
			else {
				preg_match('/^([0-9]+)(.+)?/', $this->OrderBy, $aSubp);
				
				$oCL->IdCampolistado = $aSubp[1];
				$oCL->Obtener();
				
				$cOrderBy = @"ORDER BY rl_orden.`{$oCL->Columna}`{$aSubp[2]}";
				$cJoinOrder = "INNER JOIN registros_listado rl_orden ON registros.id_registro = rl_orden.id_registro AND rl_orden.id_campolistado = {$oCL->IdCampolistado} ";
			}
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
		
		if ($this->IdListado !== null) {
			$aWhere[] = "registros.id_listado = '{$this->IdListado}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "registros.publicado = '{$this->Publicado}'";
		}
		if ($this->Busqueda) {
			$oListado = new Listados();
			$oListado->IdListado = $this->IdListado;
			$oListado->Obtener();
			
			$oCL->IdCampolistado = $oListado->IdCampoBusqueda;
			$oCL->Obtener();
			
			
			$aJoins[] = "INNER JOIN registros_listado rl_1 ON registros.id_registro = rl_1.id_registro AND rl_1.id_campolistado = {$oListado->IdCampoBusqueda} AND rl_1.`{$oCL->Columna}` LIKE '{$this->Busqueda}%' ";
		}
		
		// Where dinamico.
		if ($this->Where) {
			foreach ($this->Where as $pos => $item) {
				preg_match("/^([0-9]+)(.+)/", $item, $aSubp);
				
				$oCL->IdCampolistado = $aSubp[1];
				$oCL->Obtener();
				
				$aJoins[] = "INNER JOIN registros_listado rldyn_{$pos} ON registros.id_registro = rldyn_{$pos}.id_registro AND rldyn_{$pos}.id_campolistado = {$aSubp[1]} AND rldyn_{$pos}.`{$oCL->Columna}`{$aSubp[2]} ";
			}
		}
		
		// Arma la cadena SQL.
		$cJoin = join(' ', $aJoins);
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "
			SELECT SQL_CALC_FOUND_ROWS 
				registros.*
			FROM registros
				{$cJoin}
				{$cJoinOrder}
			{$cWhere} {$cOrderBy} {$cLimit}";
		$this->DB->Query($cSql);
		
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		$this->FoundRows = $this->DB->Field('total');
		
		if ($this->DetalleCompleto) {
			$oRL = new Registros_listado();
			
			for ($i=0; $i<count($aRet); ++$i) {
				// Busca los registros.
				$oRL->IdRegistro = $aRet[$i]['id_registro'];
				foreach ($oRL->Buscar() as $item) {
					$aRet[$i]['datos'][$item['id_campolistado']] = $item['texto'] | $item['entero'] | $item['decimal'] | $item['fecha'];
					$aRet[$i]['ref'][$item['id_campolistado']] = $item['id_registrolistado'];
				}
			}
		}
		
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
		$cSql = "SELECT registros.* FROM registros WHERE registros.id_registro = '{$this->IdRegistro}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		if ($this->DetalleCompleto) {
			$oRL = new Registros_listado();
			
			// Busca los registros.
			$oRL->IdRegistro = $aRet['id_registro'];
			foreach ($oRL->Buscar() as $item) {
				$aRet['datos'][$item['id_campolistado']] = $item['texto'] | $item['entero'] | $item['decimal'] | $item['fecha'];
				$aRet['ref'][$item['id_campolistado']] = $item['id_registrolistado'];
			}
		}
		
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
		
		if ($this->IdRegistro) {
			$cSql = "UPDATE registros SET ".
				"id_listado = '{$this->IdListado}', ".
				"publicado = '{$this->Publicado}' ".
				"WHERE id_registro = '{$this->IdRegistro}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO registros SET ".
				"id_listado = '{$this->IdListado}', ".
				"publicado = '{$this->Publicado}'";
			
			$this->IdRegistro = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdRegistro;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM registros WHERE id_registro = '{$this->IdRegistro}' LIMIT 1";
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
		$this->IdRegistro = $aDatos['id_registro'];
		$this->IdListado = $aDatos['id_listado'];
		$this->Publicado = $aDatos['publicado'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdRegistro = $this->IdListado = $this->Publicado = null;
	}
}
?>