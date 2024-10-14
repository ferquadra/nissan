<?
class Ubicaciones_anuncio extends Model {
	
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
	public $IdUbicacionanuncio, $Sector, $Ubicacion, $IdAnuncio, $FechaValida, $ImpresionesValidas, $ClicksValidos, $Publicado;
	
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
		
		if ($this->Sector !== null) {
			$aWhere[] = "ubicaciones_anuncio.sector = '{$this->Sector}'";
		}
		if ($this->Ubicacion !== null) {
			$aWhere[] = "ubicaciones_anuncio.ubicacion = '{$this->Ubicacion}'";
		}
		if ($this->IdAnuncio !== null) {
			$aWhere[] = "ubicaciones_anuncio.id_anuncio = '{$this->IdAnuncio}'";
		}
		if ($this->FechaValida) {
			$aWhere[] = "( (anuncios.vigencia_desde <= NOW() OR anuncios.vigencia_desde IS NULL) AND (anuncios.vigencia_hasta >= NOW() OR anuncios.vigencia_hasta IS NULL) )";
		}
		if ($this->ImpresionesValidas) {
			$aWhere[] = "( anuncios.impresiones IS NOT NULL AND anuncios.contador_impresiones <= anuncios.impresiones)";
		}
		if ($this->ClicksValidos) {
			$aWhere[] = "( anuncios.clicks IS NOT NULL AND anuncios.contador_clicks <= anuncios.clicks)";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "anuncios.publicado = '{$this->Publicado}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS 
				ubicaciones_anuncio.*, anuncios.*, archivos.id_archivo, archivos.nombre nombre_archivo
			FROM 
				ubicaciones_anuncio 
				LEFT JOIN anuncios ON anuncios.id_anuncio = ubicaciones_anuncio.id_anuncio
				LEFT JOIN archivos ON archivos.sector = ".SECTOR_ANUNCIOS." AND archivos.id_elemento = ubicaciones_anuncio.id_anuncio
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
		$cSql = "SELECT ubicaciones_anuncio.* FROM ubicaciones_anuncio WHERE ubicaciones_anuncio.id_ubicacionanuncio = '{$this->IdUbicacionanuncio}' LIMIT 1";
		
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
	 * Guarda un registro y devuelve verdadero.
	 *
	 * @return bool
	 */
	public function Guardar() {
		$cSql = "SELECT * FROM ubicaciones_anuncio WHERE id_anuncio = '{$this->IdAnuncio}' AND sector = '{$this->Sector}' LIMIT 1";
		$this->DB->Query($cSql);
		
		if ($nId = $this->DB->Field('id_ubicacionanuncio')) {
			$cSql = "UPDATE ubicaciones_anuncio SET ".
				"ubicacion = '{$this->Ubicacion}' ".
				"WHERE id_ubicacionanuncio = '{$nId}' LIMIT 1";
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO ubicaciones_anuncio SET ".
				"ubicacion = '{$this->Ubicacion}', ".
				"id_anuncio = '{$this->IdAnuncio}', ".
				"sector = '{$this->Sector}'";
			$this->IdUbicacionanuncio = $this->DB->QueryInsert($cSql);
		}
		
		return true;
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM ubicaciones_anuncio WHERE id_anuncio = '{$this->IdAnuncio}'";
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
		$this->IdUbicacionanuncio = $aDatos['id_ubicacionanuncio'];
		$this->Sector = $aDatos['sector'];
		$this->Ubicacion = $aDatos['ubicacion'];
		$this->IdAnuncio = $aDatos['id_anuncio'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdUbicacionanuncio = $this->Sector = $this->Ubicacion = $this->IdAnuncio = null;
	}
}
?>