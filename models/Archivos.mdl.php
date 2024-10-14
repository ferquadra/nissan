<?
class Archivos extends Model {
	
	/**
	 * @desc
	 * Cadena OrderBy.
	 *
	 * @var string
	 */
	var $OrderBy;
	
	/**
	 * @desc
	 * Numero de pagina.
	 * Comienza en 1 (1 = primer pagina).
	 * 
	 * Si se pasa un valor menor a 1 lo ignora.
	 *
	 * @var int
	 */
	var $Page;
	
	/**
	 * @desc
	 * Limite de consulta.
	 * Se usa junto a Page.
	 * 
	 * Si se asigna NULL no se hace un limite en la consulta.
	 *
	 * @var int
	 */
	var $LimitCant = APP_MYSQL_LIMIT;
	
	/**
	 * @desc
	 * Indica la cantidad total de registros si no se
	 * ubiera usado la clausula LIMIT en la consulta.
	 *
	 * @var int
	 */
	var $FoundRows;
	
	public $IdArchivo, $Sector, $IdElemento;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @desc
	 * Realiza una busqueda de archivos.
	 *
	 * @return array
	 */
	function Buscar() {
		$cOrderBy = $cLimit = '';
		$aWhere = array();
		
		$aFrom[] = 'archivos';
		
		if ($this->Sector !== null) {
			$aWhere[] = "archivos.sector = '{$this->Sector}'";
		}
		if ($this->IdElemento !== null) {
			$aWhere[] = "archivos.id_elemento = '{$this->IdElemento}'";
		}
		
		$cFrom = 'FROM '.join(' ', $aFrom);
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		if ($this->OrderBy) {
			$cOrderBy = "ORDER BY {$this->OrderBy}";
		}
		
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
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS * {$cFrom} {$cWhere} {$cOrderBy} {$cLimit}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve los datos segun el ID $nId.
	 *
	 * @param int $nId
	 * @return array
	 */
	function Obtener($nId) {
		$cSql = "SELECT * FROM archivos WHERE id_archivo = '{$nId}' LIMIT 1";
		$this->DB->Query($cSql);
		
		return $this->DB->Field();
	}
	
	/**
	 * @desc
	 * Guarda los datos.
	 * Recibe un dato tipo $_FILES['archivo'] y devuelve
	 * el ID del archivo guardado.
	 *
	 * @param array $aData
	 * @return int
	 */
	function Guardar($aData, $cDescripcion=null, $nId=null) {
		// La descripcion generada por el sistema.
		$cDescripcion = $cDescripcion ? $cDescripcion : "NULL";
		
		if(stripos($cDescripcion, "fakepath")){
			$aData['name'] = substr($cDescripcion, 14);
		}

		// Inserta el archivo en la base de datos.
		if ($nId != null) {
			$cSql = "UPDATE archivos SET nombre = '{$aData['name']}', descripcion = '{$cDescripcion}' WHERE id_archivo = '{$nId}' LIMIT 1";
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO archivos SET sector = '{$this->Sector}', id_elemento = '{$this->IdElemento}', nombre = '{$aData['name']}', descripcion = '{$cDescripcion}'";
			$nId = $this->DB->QueryInsert($cSql);
		}

		// Crea la carpeta donde va a almacenar las imagenes.
		if (!is_dir(APP_PATH_ARCHIVOS."/$nId")) {
			mkdir(APP_PATH_ARCHIVOS."/$nId");
		}
		
		// Elimina el contenido de la carpeta (por si ya contenia archivos).
		$aAnteriores = (array) @glob(APP_PATH_ARCHIVOS."/$nId/*");
		foreach ($aAnteriores as $item) {
			@unlink($item);
		}
		
		move_uploaded_file($aData['tmp_name'], APP_PATH_ARCHIVOS."/$nId/archivo.dat");
		
		// Devuelve el ID del registro.
		return $nId;
	}
	
	/**
	 * @desc
	 * Elimina el archivo con ID $nId.
	 *
	 * @param int $nId
	 */
	function Eliminar($nId) {
		$aArchivos = (array) @glob(APP_PATH_ARCHIVOS."/$nId/*");
		foreach ($aArchivos as $cArchivo) {
			@unlink($cArchivo);
		}
		@rmdir(APP_PATH_ARCHIVOS."/$nId");
		
		$cSql = "DELETE FROM archivos WHERE id_archivo = '{$nId}' LIMIT 1";
		$this->DB->Query($cSql);
	}
	
	public function EliminarTodos($nSector, $nIdElemento) {
		$cSql = "SELECT * FROM archivos WHERE sector = '{$nSector}' AND id_elemento = '{$nIdElemento}'";
		$this->DB->Query($cSql);
		
		foreach ($this->DB->GetRecordset() as $item) {
			$this->Eliminar($item['id_archivo']);
		}
	}
	
		/**
	ESTA FUNCION REMPLAZA LA CLAVETEMPORAL QUE GUARDA EL FORMULARIO CUANDO AÚN NO TIENE UN ID DETERMINADO.
	DE ESTA MANERA, SE SOLUCIONA EL PROBLEMA DE TENER QUE GUARDAR ANTES DE SUBIR UNA IMAGEN. LA CLAVE TEMPORAL ES UN TIMESTAMP.
	**/
	public function GuardarId($clavetemporal, $id) {
		
		$cSql = "UPDATE archivos SET id_elemento = '{$id}' WHERE id_elemento = {$clavetemporal}";
		return $this->DB->Query($cSql);

	}
	// Funcion igual a la anterior para mantener compatibilidad.
	public function ActualizarIdTemporal($idTemporal, $idElemento) {
		
		$cSql = "UPDATE archivos SET id_elemento = '{$idElemento}' WHERE id_elemento = {$idTemporal};";
		return $this->DB->Query($cSql);

	}
	
}
?>