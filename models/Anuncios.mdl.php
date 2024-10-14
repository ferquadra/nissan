<?
class Anuncios extends Model {
	
	const SECTOR_HOME						= 'home';
	const SECTOR_PRODUCTOS				= 'productos';
	const SECTOR_PAGINAS					= 'paginas';
	const SECTOR_CONTACTO				= 'contacto';
	
	const UBICACION_SUPERIOR			= 'top';
	const UBICACION_MEDIA				= 'middle';
	const UBICACION_INFERIOR			= 'bottom';
	
	const UBICACION_LATERAL_SUPERIOR	= 'lat_top';
	const UBICACION_LATERAL_MEDIA		= 'lat_middle';
	const UBICACION_LATERAL_INFERIOR	= 'lat_bottom';
	
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
	public $IdAnuncio, $Nombre, $Url, $Target, $FechaAlta, $VigenciaDesde, $VigenciaHasta, $Impresiones, $ContadorImpresiones, $Clicks, $ContadorClicks, $Publicado, $Notas;
	
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
			$aWhere[] = "anuncios.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->Url !== null) {
			$aWhere[] = "anuncios.url = '{$this->Url}'";
		}
		if ($this->Target !== null) {
			$aWhere[] = "anuncios.target = '{$this->Target}'";
		}
		if ($this->FechaAlta !== null) {
			$aWhere[] = "anuncios.fecha_alta = '{$this->FechaAlta}'";
		}
		if ($this->VigenciaDesde !== null) {
			$aWhere[] = "anuncios.vigencia_desde = '{$this->VigenciaDesde}'";
		}
		if ($this->VigenciaHasta !== null) {
			$aWhere[] = "anuncios.vigencia_hasta = '{$this->VigenciaHasta}'";
		}
		if ($this->Impresiones !== null) {
			$aWhere[] = "anuncios.impresiones = '{$this->Impresiones}'";
		}
		if ($this->ContadorImpresiones !== null) {
			$aWhere[] = "anuncios.contador_impresiones = '{$this->ContadorImpresiones}'";
		}
		if ($this->Clicks !== null) {
			$aWhere[] = "anuncios.clicks = '{$this->Clicks}'";
		}
		if ($this->ContadorClicks !== null) {
			$aWhere[] = "anuncios.contador_clicks = '{$this->ContadorClicks}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "anuncios.publicado = '{$this->Publicado}'";
		}
		if ($this->Notas !== null) {
			$aWhere[] = "anuncios.notas = '{$this->Notas}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS anuncios.* FROM anuncios {$cWhere} {$cOrderBy} {$cLimit}";
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
		$cSql = "SELECT anuncios.* FROM anuncios WHERE anuncios.id_anuncio = '{$this->IdAnuncio}' LIMIT 1";
		
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
		
		if ($this->IdAnuncio) {
			$cSql = "UPDATE anuncios SET ".
				"nombre = '{$this->Nombre}', ".
				"url = ".($this->Url ? "'{$this->Url}'" : 'NULL').", ".
				"target = ".($this->Target ? "'{$this->Target}'" : 'NULL').", ".
				"vigencia_desde = ".($this->VigenciaDesde ? "'{$this->VigenciaDesde}'" : 'NULL').", ".
				"vigencia_hasta = ".($this->VigenciaHasta ? "'{$this->VigenciaHasta}'" : 'NULL').", ".
				"impresiones = ".($this->Impresiones ? "'{$this->Impresiones}'" : 'NULL').", ".
				"contador_impresiones = ".($this->ContadorImpresiones ? "'{$this->ContadorImpresiones}'" : 'NULL').", ".
				"clicks = ".($this->Clicks ? "'{$this->Clicks}'" : 'NULL').", ".
				"contador_clicks = ".($this->ContadorClicks ? "'{$this->ContadorClicks}'" : 'NULL').", ".
				"publicado = '{$this->Publicado}', ".
				"notas = ".($this->Notas ? "'{$this->Notas}'" : 'NULL')." ".
				"WHERE id_anuncio = '{$this->IdAnuncio}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO anuncios SET ".
				"nombre = '{$this->Nombre}', ".
				"url = ".($this->Url ? "'{$this->Url}'" : 'NULL').", ".
				"target = ".($this->Target ? "'{$this->Target}'" : 'NULL').", ".
				"vigencia_desde = ".($this->VigenciaDesde ? "'{$this->VigenciaDesde}'" : 'NULL').", ".
				"vigencia_hasta = ".($this->VigenciaHasta ? "'{$this->VigenciaHasta}'" : 'NULL').", ".
				"impresiones = ".($this->Impresiones ? "'{$this->Impresiones}'" : 'NULL').", ".
				"contador_impresiones = ".($this->ContadorImpresiones ? "'{$this->ContadorImpresiones}'" : 'NULL').", ".
				"clicks = ".($this->Clicks ? "'{$this->Clicks}'" : 'NULL').", ".
				"contador_clicks = ".($this->ContadorClicks ? "'{$this->ContadorClicks}'" : 'NULL').", ".
				"publicado = '{$this->Publicado}', ".
				"notas = ".($this->Notas ? "'{$this->Notas}'" : 'NULL')."";
			
			$this->IdAnuncio = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdAnuncio;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM anuncios WHERE id_anuncio = '{$this->IdAnuncio}' LIMIT 1";
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
		$this->IdAnuncio = $aDatos['id_anuncio'];
		$this->Nombre = $aDatos['nombre'];
		$this->Url = $aDatos['url'];
		$this->Target = $aDatos['target'];
		$this->FechaAlta = $aDatos['fecha_alta'];
		$this->VigenciaDesde = $aDatos['vigencia_desde'];
		$this->VigenciaHasta = $aDatos['vigencia_hasta'];
		$this->Impresiones = $aDatos['impresiones'];
		$this->ContadorImpresiones = $aDatos['contador_impresiones'];
		$this->Clicks = $aDatos['clicks'];
		$this->ContadorClicks = $aDatos['contador_clicks'];
		$this->Publicado = $aDatos['publicado'];
		$this->Notas = $aDatos['notas'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdAnuncio = $this->Nombre = $this->Url = $this->Target = $this->FechaAlta = $this->VigenciaDesde = $this->VigenciaHasta = $this->Impresiones = $this->ContadorImpresiones = $this->Clicks = $this->ContadorClicks = $this->Publicado = $this->Notas = null;
	}
}
?>