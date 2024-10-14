<?
class Productos_pedido extends Model {

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
	public $IdProductopedido, $IdPedido, $IdProducto, $Cantidad, $Unitario, $Total, $Descripcion;

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

		if ($this->IdPedido !== null) {
			$aWhere[] = "productos_pedido.id_pedido = '{$this->IdPedido}'";
		}
		if ($this->IdProducto !== null) {
			$aWhere[] = "productos_pedido.id_producto = '{$this->IdProducto}'";
		}
		if ($this->Cantidad !== null) {
			$aWhere[] = "productos_pedido.cantidad = '{$this->Cantidad}'";
		}
		if ($this->Unitario !== null) {
			$aWhere[] = "productos_pedido.unitario = '{$this->Unitario}'";
		}
		if ($this->Total !== null) {
			$aWhere[] = "productos_pedido.total = '{$this->Total}'";
		}

		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';

		$cSql = "
			SELECT SQL_CALC_FOUND_ROWS productos_pedido.*, productos.codigo, productos.nombre producto
			FROM productos_pedido
			LEFT JOIN productos ON productos.id_producto = productos_pedido.id_producto
			{$cWhere} {$cOrderBy} {$cLimit}";

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		echo $cSql; die;

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
		$cSql = "SELECT productos_pedido.* FROM productos_pedido WHERE productos_pedido.id_productopedido = '{$this->IdProductopedido}' LIMIT 1";

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

		if ($this->IdProductopedido) {
			$cSql = "UPDATE productos_pedido SET ".
				"id_pedido = '{$this->IdPedido}', ".
				"id_producto = '{$this->IdProducto}', ".
				"cantidad = '{$this->Cantidad}', ".
				"unitario = '{$this->Unitario}', ";

				if(Configuracion::ObtenerValor('talles')){
					$cSql .= "descripcion = '{$this->Descripcion}', ";
				}

				$cSql .= "total = '{$this->Total}'";

				$cSql .= " WHERE id_productopedido = '{$this->IdProductopedido}' LIMIT 1";

			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO productos_pedido SET ".
				"id_pedido = '{$this->IdPedido}', ".
				"id_producto = '{$this->IdProducto}', ".
				"cantidad = '{$this->Cantidad}', ".
				"unitario = '{$this->Unitario}', ";

				if(Configuracion::ObtenerValor('talles')){
					$cSql .= "descripcion = '{$this->Descripcion}', ";
				}

				$cSql .= "total = '{$this->Total}'";

			$this->IdProductopedido = $this->DB->QueryInsert($cSql);
		}

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdProductopedido;
		}
	}

	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM productos_pedido WHERE id_productopedido = '{$this->IdProductopedido}' LIMIT 1";
		$this->DB->Query($cSql);

		return $this->DB->AffectedRows();
	}

	public function VaciarAnteriores() {
		if ($this->IdPedido) {
			$cSql = "DELETE FROM productos_pedido WHERE id_pedido = '{$this->IdPedido}';";
			$this->DB->Query($cSql);
		}
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
		$this->IdProductopedido = $aDatos['id_productopedido'];
		$this->IdPedido = $aDatos['id_pedido'];
		$this->IdProducto = $aDatos['id_producto'];
		$this->Cantidad = $aDatos['cantidad'];
		$this->Unitario = $aDatos['unitario'];
		$this->Total = $aDatos['total'];
	}

	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdProductopedido = $this->IdPedido = $this->IdProducto = $this->Cantidad = $this->Unitario = $this->Total = null;
	}
}
?>
