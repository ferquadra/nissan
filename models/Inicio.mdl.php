<?
class Inicio extends Model {
	
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
	public $id_inicio, $bienvenido_titulo, $bienvenido_texto, $bienvenido_enlace, $titulo, $widget1, $widget2;
	
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
		
		if ($this->titulo !== null) {
			$aWhere[] = "inicio.titulo = '{$this->Identificador}'";
		}
		if ($this->Maqueta !== null) {
			$aWhere[] = "inicio.maqueta = '{$this->Maqueta}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "inicio.nombre = '{$this->Nombre}'";
		}
		if ($this->Titulo !== null) {
			$aWhere[] = "inicio.titulo = '{$this->Titulo}'";
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "inicio.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "inicio.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "inicio.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Mapa !== null) {
			$aWhere[] = "inicio.mapa = '{$this->Mapa}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS inicio.* FROM Inicio {$cWhere} {$cOrderBy} {$cLimit}";
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
		
		if ($this->id_inicio) {
			$cSql = "SELECT inicio.* FROM Inicio WHERE inicio.id_inicio = '{$this->id_inicio}' LIMIT 1";
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
		$this->DB->Begin();
		
		if ($this->id_inicio) {
			$cSql = "UPDATE inicio SET ".
				"titulo = '{$this->titulo}', ".
				"bienvenido_titulo = '{$this->bienvenido_titulo}', ".
				"bienvenido_texto = '{$this->bienvenido_texto}', ".
				"bienvenido_enlace = '{$this->bienvenido_enlace}', ".
				"widget1 = '{$this->widget1}', ".
				"widget2 = '{$this->widget2}' ".
				"WHERE id_inicio = '{$this->id_inicio}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO inicio SET ".
				"titulo = '{$this->titulo}', ".
				"bienvenido_titulo = '{$this->bienvenido_titulo}', ".
				"bienvenido_texto = '{$this->bienvenido_texto}', ".
				"bienvenido_enlace = '{$this->bienvenido_enlace}', ".
				"widget1 = '{$this->widget1}', ".
				"widget2 = '{$this->widget2}'";
				
			
			$this->id_inicio = $this->DB->QueryInsert($cSql);
		}
	
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdPagina;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM Inicio WHERE id_inicio = '{$this->id_inicio}' LIMIT 1";
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
		$this->id_inicio = $aDatos['id_inicio'];
		$this->titulo = $aDatos['titulo'];
		$this->bienvenido_titulo = $aDatos['bienvenido_titulo'];
		$this->bienvenido_texto = $aDatos['bienvenido_texto'];
		$this->bienvenido_enlace = $aDatos['bienvenido_enlace'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->id_inicio = $this->titulo = $this->bienvenido_titulo = $this->bienvenido_texto = $this->bienvenido_enlace = null;
	}
}
?>