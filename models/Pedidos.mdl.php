<?
class Pedidos extends Model {

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
	public $IdPedido, $Fecha, $IdUsuario, $Comentario, $Nota, $IdEstado, $CantidadTotal, $ImporteTotal;
	public $IdEnvio, $ImporteEnvio, $where;

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

		if ($this->Fecha !== null) {
			$aWhere[] = "pedidos.fecha = '{$this->Fecha}'";
		}
		if ($this->IdUsuario !== null) {
			$aWhere[] = "pedidos.id_usuario = '{$this->IdUsuario}'";
		}
		if (isset($this->Usuario) && $this->Usuario !== null) {
			$aWhere[] = "usuarios.nombre LIKE '%{$this->Usuario}%'";
		}
		if ($this->Comentario !== null) {
			$aWhere[] = "pedidos.comentario = '{$this->Comentario}'";
		}
		if ($this->Nota !== null) {
			$aWhere[] = "pedidos.nota = '{$this->Nota}'";
		}
		if ($this->IdEstado !== null) {
			$aWhere[] = "pedidos.id_estado = '{$this->IdEstado}'";
		}
		if ($this->CantidadTotal !== null) {
			$aWhere[] = "pedidos.cantidad_total = '{$this->CantidadTotal}'";
		}
		if ($this->ImporteTotal !== null) {
			$aWhere[] = "pedidos.importe_total = '{$this->ImporteTotal}'";
		}

		if ($this->where !== null) {
			$aWhere[] = $this->where;
		}


		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';

		$cSql = "
			SELECT SQL_CALC_FOUND_ROWS pedidos.*, usuarios.nombre usuario, estados_pedido.nombre estado, usuarios.activo
			FROM pedidos
			LEFT JOIN usuarios ON usuarios.id_usuario = pedidos.id_usuario
			LEFT JOIN estados_pedido ON estados_pedido.id_estadopedido = pedidos.id_estado
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
		$cSql = "
			SELECT pedidos.*, usuarios.nombre usuario, estados_pedido.nombre estado
			FROM pedidos
			LEFT JOIN usuarios ON usuarios.id_usuario = pedidos.id_usuario
			LEFT JOIN estados_pedido ON estados_pedido.id_estadopedido = pedidos.id_estado
			WHERE pedidos.id_pedido = '{$this->IdPedido}' LIMIT 1";

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

		if ($this->IdPedido) {
			$cSql = "UPDATE pedidos SET ".
				"id_usuario = ".($this->IdUsuario ? "'{$this->IdUsuario}'" : 'NULL').", ".
				"comentario = ".($this->Comentario ? "'{$this->Comentario}'" : 'NULL').", ".
				"nota = ".($this->Nota ? "'{$this->Nota}'" : 'NULL').", ".
				"id_estado = ".($this->IdEstado ? "'{$this->IdEstado}'" : '1').", ".
				"cantidad_total = '{$this->CantidadTotal}', ";

				if($this->IdEnvio){
					$cSql .= "id_envio = '{$this->IdEnvio}', ";
					$cSql .= "importe_envio = '{$this->ImporteEnvio}', ";
				}

				$cSql .= "importe_total = '{$this->ImporteTotal}' ".
				"WHERE id_pedido = '{$this->IdPedido}' LIMIT 1";

			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO pedidos SET ".
				"id_usuario = ".($this->IdUsuario ? "'{$this->IdUsuario}'" : 'NULL').", ".
				"comentario = ".($this->Comentario ? "'{$this->Comentario}'" : 'NULL').", ".
				"nota = ".($this->Nota ? "'{$this->Nota}'" : 'NULL').", ".
				"id_estado = '{$this->IdEstado}', ";

				if($this->IdEnvio){
					$cSql .= "id_envio = '{$this->IdEnvio}', ";
					$cSql .= "importe_envio = '{$this->ImporteEnvio}', ";
				}

				$cSql .= "cantidad_total = '{$this->CantidadTotal}', ".
				"importe_total = '{$this->ImporteTotal}'";

			$this->IdPedido = $this->DB->QueryInsert($cSql);
		}

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdPedido;
		}
	}

	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM pedidos WHERE id_pedido = '{$this->IdPedido}' LIMIT 1";
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
		$this->IdPedido = $aDatos['id_pedido'];
		$this->Fecha = $aDatos['fecha'];
		$this->IdUsuario = $aDatos['id_usuario'];
		$this->Comentario = $aDatos['comentario'];
		$this->Nota = $aDatos['nota'];
		$this->IdEstado = $aDatos['id_estado'];
		$this->CantidadTotal = $aDatos['cantidad_total'];
		$this->ImporteTotal = $aDatos['importe_total'];
	}

	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdPedido = $this->Fecha = $this->IdUsuario = $this->Comentario = $this->Nota = $this->IdEstado = $this->CantidadTotal = $this->ImporteTotal = null;
	}
}
?>
