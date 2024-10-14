<?
class Paginas extends Model {
	
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
	public $IdPagina, $Identificador, $Maqueta, $Nombre, $Titulo, $Descripcion, $Texto, $IdImagen, $Mapa;
	
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
		
		if ($this->Identificador !== null) {
			$aWhere[] = "paginas.identificador = '{$this->Identificador}'";
		}
		if ($this->Maqueta !== null) {
			$aWhere[] = "paginas.maqueta = '{$this->Maqueta}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "paginas.nombre = '{$this->Nombre}'";
		}
		if ($this->Titulo !== null) {
			$aWhere[] = "paginas.titulo = '{$this->Titulo}'";
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "paginas.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "paginas.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "paginas.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Mapa !== null) {
			$aWhere[] = "paginas.mapa = '{$this->Mapa}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS paginas.* FROM paginas {$cWhere} {$cOrderBy} {$cLimit}";
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
		if ($this->IdPagina) {
			$cSql = "SELECT paginas.* FROM paginas WHERE paginas.id_pagina = '{$this->IdPagina}' LIMIT 1";
		}
		else {
			$cSql = "SELECT paginas.* FROM paginas WHERE paginas.identificador = '{$this->Identificador}' LIMIT 1";
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
		
		if ($this->IdPagina) {
			$cSql = "UPDATE paginas SET ".
				"identificador = '{$this->Identificador}', ".
				"maqueta = '{$this->Maqueta}', ".
				"nombre = '{$this->Nombre}', ".
				"titulo = '{$this->Titulo}', ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"mapa = ".($this->Mapa ? "'{$this->Mapa}'" : 'NULL')." ".
				"WHERE id_pagina = '{$this->IdPagina}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO paginas SET ".
				"identificador = '{$this->Identificador}', ".
				"maqueta = '{$this->Maqueta}', ".
				"nombre = '{$this->Nombre}', ".
				"titulo = '{$this->Titulo}', ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"mapa = ".($this->Mapa ? "'{$this->Mapa}'" : 'NULL')."";
			
			$this->IdPagina = $this->DB->QueryInsert($cSql);
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
	
		// BORRA IMAGENES ASOCIADAS.
		
		$cSql = "SELECT * FROM imagenes WHERE (sector = '".SECTOR_PAGINAS."' OR sector = '".SECTOR_PAGINAS_HEAD."') AND id_elemento = '{$this->IdPagina}'";
		$this->DB->Query($cSql);
		$aRec = $this->DB->GetRecordset();
				
		foreach ($aRec as $item){
			
			$aArchivos = (array) @glob(APP_PATH_IMAGENES."/".$item['id_imagen']."/*");
			foreach ($aArchivos as $cArchivo) {
				@unlink($cArchivo);
			}
			@rmdir(APP_PATH_IMAGENES."/".$item['id_imagen']);
		
			$cSql = "DELETE FROM imagenes WHERE id_imagen = '".$item['id_imagen']."' LIMIT 1";
			$this->DB->Query($cSql);
			
		}
		
		// BORRA LOS ARCHIVOS ASOCIADOS.
		$cSql = "SELECT * FROM archivos WHERE sector = '".SECTOR_PAGINAS."' AND id_elemento = '{$this->IdPagina}'";
		$this->DB->Query($cSql);
		$aRec = $this->DB->GetRecordset();
		
		foreach ($aRec as $item){
			
			$aArchivos = (array) @glob(APP_PATH_ARCHIVOS."/".$item['id_archivo']."/*");
			foreach ($aArchivos as $cArchivo) {
				@unlink($cArchivo);
			}
			@rmdir(APP_PATH_ARCHIVOS."/".$item['id_archivo']);
		
			$cSql = "DELETE FROM archivos WHERE id_archivo = '".$item['id_archivo']."' LIMIT 1";
			$this->DB->Query($cSql);
			
		}
		
		// FINALMENTE... BORRA LA PÁGINA.
		$cSql = "DELETE IGNORE FROM paginas WHERE id_pagina = '{$this->IdPagina}' LIMIT 1";
		$this->DB->Query($cSql);
		
		
		return true;
	}
	
	/**
	 * @desc
	 * Llena las propiedades del modelo con los datos
	 * provistos en el array $aDatos.
	 *
	 * @param array $aDatos
	 */
	private function Set($aDatos) {
		$this->IdPagina = $aDatos['id_pagina'];
		$this->Identificador = $aDatos['identificador'];
		$this->Maqueta = $aDatos['maqueta'];
		$this->Nombre = $aDatos['nombre'];
		$this->Titulo = $aDatos['titulo'];
		$this->Descripcion = $aDatos['descripcion'];
		$this->Texto = $aDatos['texto'];
		$this->IdImagen = $aDatos['id_imagen'];
		$this->Mapa = $aDatos['mapa'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdPagina = $this->Identificador = $this->Maqueta = $this->Nombre = $this->Titulo = $this->Descripcion = $this->Texto = $this->IdImagen = $this->Mapa = null;
	}
}
?>