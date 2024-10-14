<?
class Mensajes extends Model {

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
	public $IdMensaje, $Fecha, $Ip, $Visto, $Nombre, $Email, $Telefono, $Comentario, $Nota;

	function __construct() {
		parent::__construct();
	}

	public function Log($msj = ""){

		$msj = date("d-m-Y H:i:s")."\n======================\n".$msj."\n======================\n";

		$fp = fopen('mensajes.txt', 'a');
		fwrite($fp, $msj);
		fclose($fp);

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
		if ($this->LimitCant != null) {
			$nLimit = ($this->Page - 1) * $this->LimitCant;
			$cLimit = "LIMIT {$nLimit}, {$this->LimitCant}";
		}
		else {
			$cLimit = '';
		}

		if ($this->Fecha !=null) {
			$aWhere[] = "mensajes.fecha LIKE '%{$this->Fecha}%'";
		}
		if ($this->Ip !== null) {
			$aWhere[] = "mensajes.ip = '{$this->Ip}'";
		}
		if ($this->Visto != null) {
			$aWhere[] = "mensajes.visto = {$this->Visto}";
		}
		if ($this->Nombre != null) {
			$aWhere[] = "mensajes.nombre = '{$this->Nombre}'";
		}
		if ($this->Email != null) {
			$aWhere[] = "mensajes.email = '{$this->Email}'";
		}
		if ($this->Telefono != null) {
			$aWhere[] = "mensajes.telefono = '{$this->Telefono}'";
		}
		if ($this->Comentario != null) {
			$aWhere[] = "mensajes.comentario = '{$this->Comentario}'";
		}
		if ($this->Nota != null) {
			$aWhere[] = "mensajes.nota = '{$this->Nota}'";
		}
		if (isset($this->Lapso)) {
			$aWhere[] = "ADDTIME(mensajes.fecha, '{$this->Lapso}') > NOW()";
		}

		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';

		$cSql = "SELECT SQL_CALC_FOUND_ROWS mensajes.* FROM mensajes {$cWhere} {$cOrderBy} {$cLimit}";
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
		$cSql = "SELECT mensajes.* FROM mensajes WHERE mensajes.id_mensaje = '{$this->IdMensaje}' LIMIT 1";

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

	public function Visto($id, $visto = 0){

		$cSql = "UPDATE mensajes SET visto = '{$visto}' WHERE id_mensaje = '{$id}' LIMIT 1";
		$this->DB->Query($cSql);
		
	}

	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		$this->DB->Begin();

		if ($this->IdMensaje) {
			$cSql = "UPDATE mensajes SET ".
				"visto = {$this->Visto}, ".
				"nota = ".($this->Nota ? "'{$this->Nota}'" : 'NULL')." ".
				"WHERE id_mensaje = '{$this->IdMensaje}' LIMIT 1";

			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO mensajes SET ".
				"ip = '{$this->Ip}', ".
				"nombre = '{$this->Nombre}', ".
				"email = ".($this->Email ? "'{$this->Email}'" : 'NULL').", ".
				"telefono = ".($this->Telefono ? "'{$this->Telefono}'" : 'NULL').", ".
				"comentario = '{$this->Comentario}', ".
				"nota = ".($this->Nota ? "'{$this->Nota}'" : 'NULL')."";

			$this->IdMensaje = $this->DB->QueryInsert($cSql);
		}

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdMensaje;
		}
	}

	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM mensajes WHERE id_mensaje = '{$this->IdMensaje}' LIMIT 1";
		return $this->DB->Query($cSql);
	}

	/**
	 * @desc
	 * Llena las propiedades del modelo con los datos
	 * provistos en el array $aDatos.
	 *
	 * @param array $aDatos
	 */
	private function Set($aDatos) {
		$this->IdMensaje = $aDatos['id_mensaje'];
		$this->Fecha = $aDatos['fecha'];
		$this->Ip = $aDatos['ip'];
		$this->Visto = $aDatos['visto'];
		$this->Nombre = $aDatos['nombre'];
		$this->Email = $aDatos['email'];
		$this->Telefono = $aDatos['telefono'];
		$this->Comentario = $aDatos['comentario'];
		$this->Nota = $aDatos['nota'];
	}

	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdMensaje = $this->Fecha = $this->Ip = $this->Visto = $this->Nombre = $this->Email = $this->Telefono = $this->Comentario = $this->Nota = null;
	}
}
?>
