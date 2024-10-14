<?
class Usuarios extends Model {
	
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
	public $IdUsuario, $Nombre, $Empresa, $Dni, $Localidad, $CodigoPostal, $Domicilio, $Telefono, $Nota, $Observacion, $Email, $Clave, $Lista, $Activo, $Bloqueado, $FechaAlta, $AltaAdmin, $UltimoIngreso, $UltimaActividad;
	public $entrega_domicilio, $entrega_localidad, $entrega_codpos, $entrega_piso, $entrega_departamento, $entrega_comentarios;
	public $Piso, $Departamento;
	
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
			$aWhere[] = "usuarios.nombre LIKE '%{$this->Nombre}%'";
		}
		if ($this->Empresa !== null) {
			$aWhere[] = "usuarios.empresa = '{$this->Empresa}'";
		}
		if ($this->Dni !== null) {
			$aWhere[] = "usuarios.dni = '{$this->Dni}'";
		}
		if ($this->Localidad !== null) {
			$aWhere[] = "usuarios.localidad = '{$this->Localidad}'";
		}
		if ($this->CodigoPostal !== null) {
			$aWhere[] = "usuarios.codigo_postal = '{$this->CodigoPostal}'";
		}
		if ($this->Domicilio !== null) {
			$aWhere[] = "usuarios.domicilio = '{$this->Domicilio}'";
		}
		if ($this->Telefono !== null) {
			$aWhere[] = "usuarios.telefono = '{$this->Telefono}'";
		}
		if ($this->Nota !== null) {
			$aWhere[] = "usuarios.nota = '{$this->Nota}'";
		}
		if ($this->Observacion !== null) {
			$aWhere[] = "usuarios.observacion = '{$this->Observacion}'";
		}
		if ($this->Email !== null) {
			$aWhere[] = "usuarios.email = '{$this->Email}'";
		}
		if ($this->Clave !== null) {
			$aWhere[] = "usuarios.clave = '{$this->Clave}'";
		}
		if ($this->Lista !== null) {
			$aWhere[] = "usuarios.lista = '{$this->Lista}'";
		}
		if ($this->Activo !== null) {
			$aWhere[] = "usuarios.activo = '{$this->Activo}'";
		}
		if ($this->Bloqueado !== null) {
			$aWhere[] = "usuarios.bloqueado = '{$this->Bloqueado}'";
		}
		if ($this->FechaAlta !== null) {
			$aWhere[] = "usuarios.fecha_alta = '{$this->FechaAlta}'";
		}
		if ($this->AltaAdmin !== null) {
			$aWhere[] = "usuarios.alta_admin = '{$this->AltaAdmin}'";
		}
		if ($this->UltimoIngreso !== null) {
			$aWhere[] = "usuarios.ultimo_ingreso = '{$this->UltimoIngreso}'";
		}
		if ($this->UltimaActividad !== null) {
			$aWhere[] = "usuarios.ultima_actividad = '{$this->UltimaActividad}'";
		}
		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS usuarios.* FROM usuarios {$cWhere} {$cOrderBy} {$cLimit}";
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
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {
		if ($this->Email) {
			$cSql = "SELECT usuarios.* FROM usuarios WHERE usuarios.email = '{$this->Email}' LIMIT 1";
		}
		else {
			$cSql = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = '{$this->IdUsuario}' LIMIT 1";
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
	 * Inicia sesión de usuario.
	 *
	 * @param string $cEmail
	 * @param string $cClave
	 * @return array
	 */
	public function Login($cEmail, $cClave) {
		$cSql = "SELECT * FROM usuarios WHERE email = '{$cEmail}' AND clave = '{$cClave}' AND bloqueado = 0";
		$this->DB->Query($cSql);
		
		$aRet = $this->DB->Field();
		
		if ($aRet) {
			$_SESSION['usuario'] = $aRet;
			
			$cSql = "UPDATE usuarios SET ultimo_ingreso = NOW() WHERE id_usuario = '{$aRet['id_usuario']}'";
			$this->DB->Query($cSql);
		}
		else {
			unset($_SESSION['usuario']);
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
		
		if ($this->IdUsuario) {
			$cSql = "UPDATE usuarios SET ".
				"nombre = '{$this->Nombre}', ".
				"empresa = ".($this->Empresa ? "'{$this->Empresa}'" : 'NULL').", ".
				"dni = '{$this->Dni}', ".
				"localidad = '{$this->Localidad}', ".
				"codigo_postal = '{$this->CodigoPostal}', ".
				"domicilio = '{$this->Domicilio}', ".
				"telefono = '{$this->Telefono}', ";
			
			if(@$this->Piso){
				$cSql .= "piso = '{$this->Piso}', ";
			}
			if(@$this->Departamento){
				$cSql .= "departamento = '{$this->Departamento}', ";
			}
			
			$cSql .= "nota = ".($this->Nota ? "'{$this->Nota}'" : 'NULL').", ".
				"observacion = ".($this->Observacion ? "'{$this->Observacion}'" : 'NULL').", ".
				"email = '{$this->Email}', ".
				"clave = '{$this->Clave}', ".
				"lista = ".($this->Lista ? "'{$this->Lista}'" : 'NULL').", ".
				"activo = '{$this->Activo}', ".
				"bloqueado = '{$this->Bloqueado}', ".
				"alta_admin = '{$this->AltaAdmin}', ".
				"ultimo_ingreso = ".($this->UltimoIngreso ? "'{$this->UltimoIngreso}'" : 'NULL').", ".
				"ultima_actividad = ".($this->UltimaActividad ? "'{$this->UltimaActividad}'" : 'NULL')." ".
				"WHERE id_usuario = '{$this->IdUsuario}' LIMIT 1";
			
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO usuarios SET ".
				"nombre = '{$this->Nombre}', ".
				"empresa = ".($this->Empresa ? "'{$this->Empresa}'" : 'NULL').", ".
				"dni = '{$this->Dni}', ".
				"localidad = '{$this->Localidad}', ".
				"codigo_postal = '{$this->CodigoPostal}', ".
				"domicilio = '{$this->Domicilio}', ".
				"telefono = '{$this->Telefono}', ";
				
				if(@$this->Piso){
					$cSql .= "piso = '{$this->Piso}', ";
				}
				if(@$this->Departamento){
					$cSql .= "departamento = '{$this->Departamento}', ";
				}
				
				$cSql .= "nota = ".($this->Nota ? "'{$this->Nota}'" : 'NULL').", ".
				"observacion = ".($this->Observacion ? "'{$this->Observacion}'" : 'NULL').", ".
				"email = '{$this->Email}', ".
				"clave = '{$this->Clave}', ".
				"lista = ".($this->Lista ? "'{$this->Lista}'" : 'NULL').", ".
				"activo = '{$this->Activo}', ".
				"bloqueado = '{$this->Bloqueado}', ".
				"alta_admin = '{$this->AltaAdmin}', ".
				"ultimo_ingreso = ".($this->UltimoIngreso ? "'{$this->UltimoIngreso}'" : 'NULL').", ".
				"ultima_actividad = ".($this->UltimaActividad ? "'{$this->UltimaActividad}'" : 'NULL')."";
			
			$this->IdUsuario = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdUsuario;
		}
	}
	
		/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function GuardarDireccion() {
		
		//Busca si la tabla posee esos valores.
		$this->DB->Query("SHOW FIELDS FROM usuarios");
		$aCampos = $this->DB->GetRecordset();
		
		$cCampos = "";
		foreach($aCampos as $item){
			$cCampos .= $item['Field'].";";
		}
		
		if(strstr($cCampos, 'entrega_domicilio')){
		
			$this->DB->Begin();							
			
			if ($this->IdUsuario) {
				$cSql = "UPDATE usuarios SET ".
					"entrega_domicilio = '{$this->entrega_domicilio}', ".
					"entrega_localidad = '{$this->entrega_localidad}', ".
					"entrega_codpos = '{$this->entrega_codpos}', ".
					"entrega_piso = '{$this->entrega_piso}', ".
					"entrega_departamento = '{$this->entrega_departamento}', ".
					"entrega_comentarios = '{$this->entrega_comentarios}' ".
					"WHERE id_usuario = '{$this->IdUsuario}' LIMIT 1";
				
				$this->DB->Query($cSql);
			}
			
			if ($this->DB->GetLastError()) {
				$this->DB->Rollback();
				return 0;
			}
			else {
				$this->DB->Commit();
				return $this->IdUsuario;
			}
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM usuarios WHERE id_usuario = '{$this->IdUsuario}' LIMIT 1";
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
		$this->IdUsuario = $aDatos['id_usuario'];
		$this->Nombre = $aDatos['nombre'];
		$this->Empresa = $aDatos['empresa'];
		$this->Dni = $aDatos['dni'];
		$this->Localidad = $aDatos['localidad'];
		$this->CodigoPostal = $aDatos['codigo_postal'];
		$this->Domicilio = $aDatos['domicilio'];
		$this->Telefono = $aDatos['telefono'];
		$this->Piso = @$aDatos['piso'];
		$this->Departamento = @$aDatos['departamento'];
		$this->Nota = $aDatos['nota'];
		$this->Observacion = $aDatos['observacion'];
		$this->Email = $aDatos['email'];
		$this->Clave = $aDatos['clave'];
		$this->Lista = $aDatos['lista'];
		$this->Activo = $aDatos['activo'];
		$this->Bloqueado = $aDatos['bloqueado'];
		$this->FechaAlta = $aDatos['fecha_alta'];
		$this->AltaAdmin = $aDatos['alta_admin'];
		$this->UltimoIngreso = $aDatos['ultimo_ingreso'];
		$this->UltimaActividad = $aDatos['ultima_actividad'];
	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdUsuario = $this->Nombre = $this->Empresa = $this->Dni = $this->Localidad = $this->CodigoPostal = $this->Domicilio = $this->Telefono = $this->Piso = $this->Departamento = $this->Nota = $this->Observacion = $this->Email = $this->Clave = $this->Lista = $this->Activo = $this->Bloqueado = $this->FechaAlta = $this->AltaAdmin = $this->UltimoIngreso = $this->UltimaActividad = null;
	}
}
?>