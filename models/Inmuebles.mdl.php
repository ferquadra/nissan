<?
class Inmuebles extends Model {
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
	public $Id, $Codigo, $Nombre, $IdCategoria, $IdOperacion, $Descripcion, $Texto, $IdImagen;
	public $Precio, $IdMoneda, $Mapa, $Precio1, $Precio2, $Precio3, $Precio4, $Precio5, $Publicado, $Oferta, $Destacado;
	public $Ambientes, $Metros, $MetrosCubiertos, $Zona, $IdLocalidad, $IdMarca, $Adicionales;
	
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
		
		if ($this->Codigo !== null) {
			$aWhere[] = "inmuebles.codigo = '{$this->Codigo}'";
		}
		if ($this->Nombre !== null) {
			$aWhere[] = "inmuebles.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->BusquedaRecursiva) { // Busca tambien en las categorias de niveles inferiores.
			if ($this->IdCategoria !== null) {
				$aCategs = Categorias_producto::ListaArbolSucesoras($this->IdCategoria);
				$aWhere[] = "inmuebles.id_categoria IN (".join(', ', $aCategs).")";
			}
		}
		else {
			if ($this->IdCategoria !== null) { // Busca solo en las categorias de primer nivel.
				$aWhere[] = "inmuebles.id_categoria = '{$this->IdCategoria}'";
			}
		}
		if ($this->IdOperacion !== null) {
			$aWhere[] = "inmuebles.id_operacion = '{$this->IdOperacion}'";
		}
		if ($this->Descripcion !== null) {
			$aWhere[] = "inmuebles.descripcion = '{$this->Descripcion}'";
		}
		if ($this->Texto !== null) {
			$aWhere[] = "inmuebles.texto = '{$this->Texto}'";
		}
		if ($this->IdImagen !== null) {
			$aWhere[] = "inmuebles.id_imagen = '{$this->IdImagen}'";
		}
		if ($this->Precio !== null) {
			$aWhere[] = "inmuebles.precio <= '{$this->Precio}'";
		}
		if ($this->Publicado !== null) {
			$aWhere[] = "inmuebles.publicado = '{$this->Publicado}'";
		}
		if ($this->Oferta !== null) {
			$aWhere[] = "inmuebles.oferta = '{$this->Oferta}'";
		}
		if ($this->Destacado !== null) {
			$aWhere[] = "inmuebles.destacado = '{$this->Destacado}'";
		}
		if ($this->IdLocalidad !== null) {
			$aWhere[] = "inmuebles.id_localidad = '{$this->IdLocalidad}'";
		}
		if ($this->Ambientes !== null) {
			$aWhere[] = "inmuebles.ambientes = '{$this->Ambientes}'";
		}
		if ($this->IdMarca !== null) {
			$aWhere[] = "inmuebles.id_operacion = '{$this->IdMarca}'";
		}
		if ($this->TerminoBusqueda !== null) {
			$aPalabras = preg_split('/\W+/', stripslashes(utf8_decode($this->TerminoBusqueda)), null, PREG_SPLIT_NO_EMPTY);
			$aWhere[] = "inmuebles.nombre LIKE '%".join("%' AND inmuebles.nombre LIKE '%", array_map('utf8_encode', array_map('addslashes', $aPalabras)))."%'";
		}
		
		switch ($this->PorLetra) {
			case 'numeros':
				$aWhere[] = "inmuebles.nombre REGEXP '^[^a-z]'";
				break;
				
			case null:
				break;
			
			default:
				$aWhere[] = "inmuebles.nombre LIKE '{$this->PorLetra}%'";
				break;
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS inmuebles.*, marcas_producto.nombre operacion, categorias_producto.nombre tipo
			FROM inmuebles 
			LEFT JOIN marcas_producto ON marcas_producto.id_marcaproducto = inmuebles.id_operacion
			LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = inmuebles.id_categoria
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
	 * Devuelve el registro segun su ID primario.
	 *
	 * @return array
	 */
	public function Obtener() {
	
		$cSql = "SELECT SQL_CALC_FOUND_ROWS inmuebles.*, marcas_producto.nombre marca, categorias_producto.nombre categoria
			FROM inmuebles 
			LEFT JOIN marcas_producto ON marcas_producto.id_marcaproducto = inmuebles.id_operacion
			LEFT JOIN categorias_producto ON categorias_producto.id_categoriaproducto = inmuebles.id_categoria 
			WHERE inmuebles.id_inmueble = '{$this->Id}' LIMIT 1";
		
		
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
	 * Devuelve el registro segun su Código.
	 *
	 * @return array
	 */
	public function Cargar() {
		$cSql = "SELECT inmuebles.* FROM productos WHERE inmuebles.codigo = '{$this->Codigo}' LIMIT 1";
		
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
	 * Despublica todos los inmuebles.
	 *
	 * @return array
	 */
	public function Despublicar() {
		
		$cSql = "UPDATE inmuebles SET inmuebles.publicado = 0";
		return $this->DB->Query($cSql);
		
	}
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		
		if ($this->Precio !== null) $this->Precio = str_replace(',', '.', $this->Precio);
		if ($this->Precio1 !== null) $this->Precio1 = str_replace(',', '.', $this->Precio1);
		if ($this->Precio2 !== null) $this->Precio2 = str_replace(',', '.', $this->Precio2);
		if ($this->Precio3 !== null) $this->Precio3 = str_replace(',', '.', $this->Precio3);
		if ($this->Precio4 !== null) $this->Precio4 = str_replace(',', '.', $this->Precio4);
		if ($this->Precio5 !== null) $this->Precio5 = str_replace(',', '.', $this->Precio5);
		
		$this->DB->Begin();
		
		if ($this->Id) {
			$cSql = "UPDATE inmuebles SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"id_categoria = ".($this->IdCategoria ? "'{$this->IdCategoria}'" : 'NULL').", ".
				"id_operacion = ".($this->IdOperacion ? "'{$this->IdOperacion}'" : 'NULL').", ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"precio = ".($this->Precio ? "'{$this->Precio}'" : 'NULL').", ".
				"id_moneda = ".($this->IdMoneda ? "'{$this->IdMoneda}'" : 'NULL').", ".
				"mapa = ".($this->Mapa ? "'{$this->Mapa}'" : 'NULL').", ".
				"precio1 = ".($this->Precio1 ? "'{$this->Precio1}'" : 'NULL').", ".
				"precio2 = ".($this->Precio2 ? "'{$this->Precio2}'" : 'NULL').", ".
				"precio3 = ".($this->Precio3 ? "'{$this->Precio3}'" : 'NULL').", ".
				"precio4 = ".($this->Precio4 ? "'{$this->Precio4}'" : 'NULL').", ".
				"precio5 = ".($this->Precio5 ? "'{$this->Precio5}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? '1' : '0').", ".
				"oferta = ".($this->Oferta ? '1' : '0').", ".
				"destacado = ".($this->Destacado ? '1' : '0').", ".
				"ambientes = ".($this->Ambientes ? "'{$this->Ambientes}'" : 'NULL').", ".
				"metros = ".($this->Metros ? "'{$this->Metros}'" : 'NULL').", ".
				"metros_cubiertos = ".($this->MetrosCubiertos ? "'{$this->MetrosCubiertos}'" : 'NULL').", ".
				"zona = ".($this->Zona ? "'{$this->Zona}'" : 'NULL').", ".
				"adicionales = ".($this->Adicionales ? "'{$this->Adicionales}'" : 'NULL').", ".
				"id_localidad = ".($this->IdLocalidad ? "'{$this->IdLocalidad}'" : 'NULL')." ".
				"WHERE id_inmueble = '{$this->Id}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO inmuebles SET ".
				"codigo = ".($this->Codigo ? "'{$this->Codigo}'" : 'NULL').", ".
				"nombre = '{$this->Nombre}', ".
				"id_categoria = ".($this->IdCategoria ? "'{$this->IdCategoria}'" : 'NULL').", ".
				"id_operacion = ".($this->IdOperacion ? "'{$this->IdOperacion}'" : 'NULL').", ".
				"descripcion = ".($this->Descripcion ? "'{$this->Descripcion}'" : 'NULL').", ".
				"texto = ".($this->Texto ? "'{$this->Texto}'" : 'NULL').", ".
				"id_imagen = ".($this->IdImagen ? "'{$this->IdImagen}'" : 'NULL').", ".
				"precio = ".($this->Precio ? "'{$this->Precio}'" : 'NULL').", ".
				"id_moneda = ".($this->IdMoneda ? "'{$this->IdMoneda}'" : 'NULL').", ".
				"mapa = ".($this->Mapa ? "'{$this->Mapa}'" : 'NULL').", ".
				"precio1 = ".($this->Precio1 ? "'{$this->Precio1}'" : 'NULL').", ".
				"precio2 = ".($this->Precio2 ? "'{$this->Precio2}'" : 'NULL').", ".
				"precio3 = ".($this->Precio3 ? "'{$this->Precio3}'" : 'NULL').", ".
				"precio4 = ".($this->Precio4 ? "'{$this->Precio4}'" : 'NULL').", ".
				"precio5 = ".($this->Precio5 ? "'{$this->Precio5}'" : 'NULL').", ".
				"publicado = ".($this->Publicado ? '1' : '0').", ".
				"oferta = ".($this->Oferta ? '1' : '0').", ".
				"destacado = ".($this->Destacado ? '1' : '0').", ".
				"ambientes = ".($this->Ambientes ? "'{$this->Ambientes}'" : 'NULL').", ".
				"metros = ".($this->Metros ? "'{$this->Metros}'" : 'NULL').", ".
				"metros_cubiertos = ".($this->MetrosCubiertos ? "'{$this->MetrosCubiertos}'" : 'NULL').", ".
				"zona = ".($this->Zona ? "'{$this->Zona}'" : 'NULL').", ".
				"adicionales = ".($this->Adicionales ? "'{$this->Adicionales}'" : 'NULL').", ".
				"id_localidad = ".($this->IdLocalidad ? "'{$this->IdLocalidad}'" : 'NULL');
			
			$this->Id = $this->DB->QueryInsert($cSql);
		}
		
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
		$cSql = "DELETE IGNORE FROM inmuebles WHERE id_inmueble = '{$this->Id}' LIMIT 1";
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
		$this->Id = $aDatos['id_inmueble'];
		$this->Codigo = $aDatos['codigo'];
		$this->Nombre = $aDatos['nombre'];
		$this->IdCategoria = $aDatos['id_categoria'];
		$this->IdOperacion = $aDatos['id_operacion'];
		$this->Descripcion = $aDatos['descripcion'];
		$this->Texto = $aDatos['texto'];
		$this->IdImagen = $aDatos['id_imagen'];
		$this->Precio = $aDatos['precio'];
		$this->IdMoneda = $aDatos['id_moneda'];
		$this->Mapa = $aDatos['mapa'];
		$this->Precio1 = $aDatos['precio1'];
		$this->Precio2 = $aDatos['precio2'];
		$this->Precio3 = $aDatos['precio3'];
		$this->Precio4 = $aDatos['precio4'];
		$this->Precio5 = $aDatos['precio5'];
		$this->Publicado = $aDatos['publicado'];
		$this->Oferta = $aDatos['oferta'];
		$this->Destacado = $aDatos['destacado'];
		$this->Ambientes = $aDatos['ambientes'];
		$this->Metros = $aDatos['metros'];
		$this->MetrosCubiertos = $aDatos['metros_cubiertos'];
		$this->Zona = $aDatos['zona'];
		$this->IdLocalidad = $aDatos['id_localidad'];
		$this->Adicionales = @$aDatos['adicionales'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->Id = $this->Codigo = $this->Nombre = $this->IdCategoria = $this->IdOperacion = $this->Descripcion = $this->Texto = $this->IdImagen = $this->Precio = $this->Precio1 = $this->Precio2 = $this->Precio3 = $this->Precio4 = $this->Precio5 = $this->Publicado = $this->Oferta  = $this->Destacado = $this->Ambientes = $this->Metros = $this->MetrosCubiertos = $this->Zona = $this->IdLocalidad = $this->Adicionales = null;
	}
	
	/**
	 * @desc
	 * Devuelve un array con las listas de precios.
	 *
	 * @return array
	 */
	public function BuscarListas() {
		$cSql = "SHOW COLUMNS FROM inmuebles LIKE 'precio%'";
		$this->DB->Query($cSql);
		
		return $this->DB->GetRecordset('Field');
	}
}
?>