<?
class Wiwix extends Model {
	/**
	 * @desc
	 * Caso especial para buscar por letra inicial
	 */
	public $PorLetra;
	
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
	public $Id, $Wiwix, $Codigo, $IdFilm, $Publicado;
	public $Where;
	/**
	 * @desc
	 * Determina si debe realizar una busqueda recursiva por
	 * las diferentes categorías que están dentro de la
	 * categoría filtrada.
	 */
	public $BusquedaRecursiva = false;
	
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
		
		if ($this->Publicado !== null) {
			$aWhere[] = "wiwix.publicado = '{$this->Publicado}'";
		}
		
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
		
		if ($this->Where !== null) {
			$aWhere[] = $this->Where;
		}		
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS wiwix.*, peliculas_wiwix.id_film FROM wiwix LEFT JOIN peliculas_wiwix ON peliculas_wiwix.id_wiwix = wiwix.id {$cWhere} {$cOrderBy} {$cLimit}";
		
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
	 * @return array
	 */
	public function Obtener() {
		
		if($this->Codigo){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS wiwix.*, peliculas_wiwix.id_film FROM wiwix LEFT JOIN peliculas_wiwix ON wiwix.id = peliculas_wiwix.id_wiwix WHERE wiwix.codigo = '{$this->Codigo}' LIMIT 1";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS wiwix.*, peliculas_wiwix.id_film FROM wiwix LEFT JOIN peliculas_wiwix ON wiwix.id = peliculas_wiwix.id_wiwix WHERE wiwix.id = '{$this->Id}' LIMIT 1";
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
	
	
	public function Ultimo() {
	
		$cSql = "SELECT SQL_CALC_FOUND_ROWS wiwix.* FROM wiwix ORDER BY id DESC LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		if ($aRet) {
			$this->Set($aRet);
		}
		else {
			$this->Limpiar();
		}
		
		return $aRet['codigo'];
	}
	
	
	public function Comidas($cCom = "") {
	
		if($cCom){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS comidas.* FROM comidas WHERE id_comida IN ({$cCom})";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS comidas.* FROM comidas";
		}
	
		//$cSql = "SELECT wiwix.* FROM inmuebles WHERE wiwix.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	public function Servicios($cSer = "") {
	
		if($cSer){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS servicios.* FROM servicios WHERE id_servicio IN ({$cSer})";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS servicios.* FROM servicios";
		}
	
		//$cSql = "SELECT wiwix.* FROM inmuebles WHERE wiwix.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	public function Caracteristicas($cCar = "") {
	
		if($cCar){
			$cSql = "SELECT SQL_CALC_FOUND_ROWS caracteristicas.* FROM caracteristicas WHERE id_caracteristica IN ({$cCar})";
		} else {
			$cSql = "SELECT SQL_CALC_FOUND_ROWS caracteristicas.* FROM caracteristicas";
		}
	
		//$cSql = "SELECT wiwix.* FROM inmuebles WHERE wiwix.id_inmueble = '{$this->IdProducto}' LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro segun su Código.
	 *
	 * @return array
	 */
	public function Cargar() {
		$cSql = "SELECT wiwix.* FROM bares WHERE wiwix.codigo = '{$this->Codigo}' LIMIT 1";
		
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
	 * Despublica todos los wiwix.
	 *
	 * @return array
	 */
	public function Despublicar() {
		
		$cSql = "UPDATE bares SET wiwix.publicado = 0";
		return $this->DB->Query($cSql);
		
	}
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		
		$this->DB->Begin();
		/*
			public $Id, $Codigo, $Nombre, $IdCategoria, $IdOperacion, $Descripcion, $Texto, $IdImagen, $Publicado, $Destacado, $Orden, $Orden_cat;
	public $Direccion, $Telefonos, $EmailPublico, $EmailPrivado, $Zona;
	public $Comidas, $Caracteristicas;
		*/
			$cSql = "INSERT INTO wiwix SET codigo = '{$this->Codigo}', wiwix = '{$this->Wiwix}', publicado = 1";
			$this->Id = $this->DB->QueryInsert($cSql);
			
			$cSql = "INSERT INTO peliculas_wiwix SET id_film = '{$this->IdFilm}', id_wiwix = '{$this->Id}'";
			$this->DB->QueryInsert($cSql);
		
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->Id;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM wiwix WHERE id = '{$this->Id}' LIMIT 1";
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
		$this->Id = @$aDatos['id'];
		$this->Codigo = @$aDatos['codigo'];
		$this->Wiwix = @$aDatos['wiwix'];
		$this->IdFilm = @$aDatos['id_film'];
		$this->Publicado = @$aDatos['publicado'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->Id = $this->Codigo = $this->Wiwix = $this->IdFilm = $this->Publicado;
	}
	

}
?>
