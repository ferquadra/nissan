<?
class Campos_listado extends Model {
	
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
	public $IdCampolistado, $IdListado, $Titulo, $Tipo, $Extra, $Orden, $Ayuda, $Requerido;
	
	/**
	 * @desc
	 * Nombre de la columna utilizada por el tipo de datos.
	 *
	 * @var string
	 */
	Public $Columna;
	
	const TIPO_TEXTO_CORTO							= 1;
	const TIPO_TEXTO_MULTILINEA					= 2;
	const TIPO_TEXTO_ENRIQUECIDO					= 3;
	const TIPO_NUMERO_ENTERO						= 4;
	const TIPO_NUMERO_DECIMAL						= 5;
	const TIPO_RADIO									= 6;
	const TIPO_SELECT									= 7;
	const TIPO_IMAGEN									= 8;
	const TIPO_ARCHIVO								= 9;
	const TIPO_GOOGLE_MAP							= 10;
	const TIPO_FECHA_CORTA							= 11;
	const TIPO_FECHA_HORA							= 12;
	
	private $Tipos = array(
		self::TIPO_TEXTO_CORTO => array('titulo' => 'Texto corto'),
		self::TIPO_TEXTO_MULTILINEA => array('titulo' => 'Texto multi línea'),
		self::TIPO_TEXTO_ENRIQUECIDO => array('titulo' => 'Texto enriquecido'),
		self::TIPO_NUMERO_ENTERO => array('titulo' => 'Número entero'),
		self::TIPO_NUMERO_DECIMAL => array('titulo' => 'Número decimal'),
		self::TIPO_RADIO => array('titulo' => 'Opción de selección'),
		self::TIPO_SELECT => array('titulo' => 'Lista seleccionable'), // Para enlazar a otra tabla.
		self::TIPO_IMAGEN => array('titulo' => 'Carga de imágenes'),
		self::TIPO_ARCHIVO => array('titulo' => 'Carga de archivos'),
		self::TIPO_GOOGLE_MAP => array('titulo' => 'Google map'),
		self::TIPO_FECHA_CORTA => array('titulo' => 'Fecha corta'),
		self::TIPO_FECHA_HORA => array('titulo' => 'Fecha y hora'),
	);
	
	public $Columnas = array(
		self::TIPO_TEXTO_CORTO => 'texto',
		self::TIPO_TEXTO_MULTILINEA  => 'texto',
		self::TIPO_TEXTO_ENRIQUECIDO => 'texto',
		self::TIPO_NUMERO_ENTERO => 'entero',
		self::TIPO_NUMERO_DECIMAL => 'decimal',
		self::TIPO_RADIO => 'texto',
		self::TIPO_SELECT => 'entero',
		self::TIPO_IMAGEN => 'entero',
		self::TIPO_ARCHIVO => 'entero',
		self::TIPO_GOOGLE_MAP => 'texto',
		self::TIPO_FECHA_CORTA => 'fecha',
		self::TIPO_FECHA_HORA => 'fecha'
	);
	
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
		
		if ($this->IdListado !== null) {
			$aWhere[] = "campos_listado.id_listado = '{$this->IdListado}'";
		}
		if ($this->Titulo !== null) {
			$aWhere[] = "campos_listado.titulo LIKE '%{$this->Titulo}%'";
		}
		if ($this->Tipo !== null) {
			$aWhere[] = "campos_listado.tipo = '{$this->Tipo}'";
		}
		if ($this->Extra !== null) {
			$aWhere[] = "campos_listado.extra = '{$this->Extra}'";
		}
		if ($this->Orden !== null) {
			$aWhere[] = "campos_listado.orden = '{$this->Orden}'";
		}
		if ($this->Ayuda !== null) {
			$aWhere[] = "campos_listado.ayuda = '{$this->Ayuda}'";
		}
		if ($this->Requerido !== null) {
			$aWhere[] = "campos_listado.requerido = '{$this->Requerido}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS campos_listado.* FROM campos_listado {$cWhere} {$cOrderBy} {$cLimit}";
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
		$cSql = "SELECT campos_listado.* FROM campos_listado WHERE campos_listado.id_campolistado = '{$this->IdCampolistado}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		switch ($aRet['tipo']) {
			case Campos_listado::TIPO_FECHA_CORTA:
			case Campos_listado::TIPO_FECHA_HORA:
				$cCol = 'fecha';
				break;
				
			case Campos_listado::TIPO_NUMERO_DECIMAL:
				$cCol = '´decimal´';
				break;
				
			case Campos_listado::TIPO_NUMERO_ENTERO:
			case Campos_listado::TIPO_SELECT:
				$cCol = 'entero';
				break;
				
			default:
				$cCol = 'texto';
		}
		
		if ($aRet) {
			$aRet['columna'] = $cCol;
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
		if ($this->IdCampolistado) {
			$cSql = "UPDATE campos_listado SET ".
				"id_listado = '{$this->IdListado}', ".
				"titulo = '{$this->Titulo}', ".
				"tipo = '{$this->Tipo}', ".
				"extra = ".($this->Extra ? "'{$this->Extra}'" : 'NULL').", ".
				"orden = '{$this->Orden}', ".
				"ayuda = ".($this->Ayuda ? "'{$this->Ayuda}'" : 'NULL').", ".
				"requerido = '{$this->Requerido }' ".
				"WHERE id_campolistado = '{$this->IdCampolistado}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO campos_listado SET ".
				"id_listado = '{$this->IdListado}', ".
				"titulo = '{$this->Titulo}', ".
				"tipo = '{$this->Tipo}', ".
				"extra = ".($this->Extra ? "'{$this->Extra}'" : 'NULL').", ".
				"orden = '{$this->Orden}', ".
				"ayuda = ".($this->Ayuda ? "'{$this->Ayuda}'" : 'NULL').", ".
				"requerido = '{$this->Requerido }'";
			
			$this->IdCampolistado = $this->DB->QueryInsert($cSql);
		}
		
		return $this->IdCampolistado;
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM campos_listado WHERE id_campolistado = '{$this->IdCampolistado}' LIMIT 1";
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
		$this->IdCampolistado = $aDatos['id_campolistado'];
		$this->IdListado = $aDatos['id_listado'];
		$this->Titulo = $aDatos['titulo'];
		$this->Tipo = $aDatos['tipo'];
		$this->Extra = $aDatos['extra'];
		$this->Orden = $aDatos['orden'];
		$this->Ayuda = $aDatos['ayuda'];
		$this->Requerido = $aDatos['requerido'];
		$this->Columna = @$aDatos['columna'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdCampolistado = $this->IdListado = $this->Titulo = $this->Tipo = $this->Extra = $this->Orden = $this->Ayuda = $this->Requerido = $this->Columna = null;
	}
	
	/**
	 * Devuelve los tipos de campos disponibles.
	 *
	 * @return array
	 */
	public function Tipos() {
		return $this->Tipos;
	}
	
	/**
	 * @desc
	 * Devuelve el número de orden más alto más 10 del listado indicado en $this->IdListado.
	 *
	 * @return int
	 */
	public function OrdenSiguiente() {
		$cSql = "SELECT MAX(orden) maximo FROM campos_listado WHERE campos_listado.id_listado = '{$this->IdListado}'";
		$this->DB->Query($cSql);
		
		return $this->DB->Field('maximo') + 10;
	}
}
?>