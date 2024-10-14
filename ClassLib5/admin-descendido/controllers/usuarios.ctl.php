<?
class UsuariosCtl extends Controller {
	
	/**
	 * @desc
	 * Usuarios.
	 *
	 * @var Usuarios
	 */
	private $Usuarios;
	
	function __construct() {
		parent::__construct();
		$this->Usuarios = new Usuarios();
		$this->Ami = new Amigos();
		$this->Par = new Partidos();
		$this->Tra = new Traza();
	}
	
	/**
	 * @desc
	 * Controlador predeterminado.
	 *
	 */
	public function index() {
		$this->listado();
	}
	
	/**
	 * @desc
	 * Listado.
	 *
	 */
	public function listado() {
		$this->menu_lateral();
		
		if (isset($_GET['general']) && $_GET['general']) {
			//$this->Usuarios->nombre = $_GET['general'];
			$this->Usuarios->email = $_GET['general'];
		}
		
		if (isset($_GET['activo']) && $_GET['activo'] !== '') {
			$this->Usuarios->activo = $_GET['activo'];
		}
		
		$this->Usuarios->Page = @$_GET['pg'];
		$this->Usuarios->OrderBy = 'users.id_user DESC';
		$this->Usuarios->GroupBy = 'id_user';
		$this->Usuarios->LimitCant = 100;
		$this->Buffer['listado'] = $this->Usuarios->BuscarTodo();
		
		foreach ($this->Buffer['listado'] as $key => $item){
			$this->Usuarios->id_user = $item['id_user'];
			$this->Buffer['listado'][$key]['anexo'] = $this->Usuarios->Anexo();
			$this->Buffer['listado'][$key]['geo'] = $this->Usuarios->Geo();
			$this->Buffer['listado'][$key]['cantidadamigos'] = $this->Usuarios->CantidadAmigos($item['id_user']);
		}
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Usuarios->FoundRows, 100, @$_GET['pg']);
		
		// Almacena todos los registros para hacer otras operaciones sin el resultado paginado.
		$this->Usuarios->Page = null;
		$this->Usuarios->LimitCant = null;
		$this->Buffer['total'] = $this->Usuarios->Buscar();
		foreach ($this->Buffer['total'] as $key => $item){
			$this->Usuarios->id_user = $item['id_user'];
			$this->Buffer['total'][$key]['anexo'] = $this->Usuarios->Anexo();
		}
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}

	public function listadoamigos() {
		$this->menu_lateral();
		
		if (isset($_GET['general']) && $_GET['general']) {
			$this->Ami->nombre = $_GET['general'];
		}
		
		$this->Ami->id_user = @$_GET['id_user'];
		
		$this->Ami->Page = @$_GET['pg'];
		$this->Ami->OrderBy = 'id_amigo DESC';
		$this->Buffer['listado'] = $this->Ami->BuscarAmigos();
		
		foreach ($this->Buffer['listado'] as $key => $item){
			$this->Usuarios->Limpiar();
			$this->Buffer['listado'][$key]['cantidadamigos'] = $this->Usuarios->CantidadAmigos($item['id_amigo']);
		}
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Usuarios->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado-amigos.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	public function listadopartidos() {
		$this->menu_lateral();
		
		if (isset($_GET['general']) && $_GET['general']) {
			$this->Par->lugar = $_GET['general'];
		}
		
		$this->Par->id_user = @$_GET['id_user'];
		
		$this->Par->Page = @$_GET['pg'];
		$this->Par->OrderBy = 'id_partido DESC';
		$this->Buffer['listado'] = $this->Par->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Par->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado-partidos.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}

	public function partidoscompletos(){
		// Partidos al 80% de la convocatoria.
		$this->Buffer['listado'] = $this->Par->PartidosCompletos();
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado-completos.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	public function traza() {
		$this->menu_lateral();
		
		$this->Tra->Page = @$_GET['pg'];
		$this->Tra->OrderBy = 'timestamp ASC';
		$this->Tra->id_user = @$_GET['id_user'];
		
		$this->Buffer['listado'] = $this->Tra->Buscar();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Tra->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/listado-traza.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	public function data() {
		$this->menu_lateral();
		
		$this->Usuarios->id_user = @$_GET['id_user'];
		
		$this->Buffer['user'] = $this->Usuarios->Obtener();
		$this->Buffer['anexo'] = $this->Usuarios->Anexo();
		
		require_once(APP_FUNCTIONS_PATH.'/utils_functions.php');
		$this->Buffer['paginador'] = paginator_range($this->Tra->FoundRows, APP_MYSQL_LIMIT, @$_GET['pg']);
		
		$this->Buffer['body'] = $this->Template->Load('usuarios/data.tpl.php', $this->Buffer);
		$this->Template->Load('default.tpl.php', $this->Buffer, false);
	}
	
	
	/**
	 * @desc
	 * Prepara y muestra el formulario.
	 *
	 */
	public function nuevo() {
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Carga datos y muestra el formulario.
	 *
	 */
	public function editar() {
		$this->Usuarios->id_user = $_GET['id_usuario'];
		$this->Buffer['datos'] = $this->Usuarios->Obtener();
		
		$this->formulario();
	}
	
	/**
	 * @desc
	 * Muestra el formulario.
	 * Método privado, independiente de si se está editando o añadiendo.
	 *
	 */
	private function formulario() {
		//$oProductos = new Productos();
		//$this->Buffer['listas'] = $oProductos->BuscarListas();
		
		$this->menu_lateral();
		$this->Buffer['body'] = $this->Template->Load('usuarios/formulario.tpl.php', $this->Buffer);
		echo $this->Template->Load('default.tpl.php', $this->Buffer);
	}
	
	/**
	 * @desc
	 * Guarda y vuelve al listado.
	 *
	 */
	public function guardar() {
		$this->Usuarios->IdUsuario = $_POST['id_usuario'];
		$this->Usuarios->Obtener();
		$this->Usuarios->Nombre = $_POST['nombre'];
		$this->Usuarios->Empresa = $_POST['empresa'];
		$this->Usuarios->Dni = $_POST['dni'];
		$this->Usuarios->Localidad = $_POST['localidad'];
		$this->Usuarios->CodigoPostal = $_POST['codigo_postal'];
		$this->Usuarios->Domicilio = $_POST['domicilio'];
		$this->Usuarios->Telefono = $_POST['telefono'];
		$this->Usuarios->Nota = $_POST['nota'];
		$this->Usuarios->Observacion = $_POST['observacion'];
		$this->Usuarios->Email = $_POST['email'];
		$this->Usuarios->Clave = $_POST['clave'];
		$this->Usuarios->Lista = $_POST['lista'];
		$this->Usuarios->Bloqueado = @$_POST['bloqueado'];
		if (!$_POST['id_usuario']) { // Si se esta dando de alta en el administrador.
			$this->Usuarios->AltaAdmin = 1;
		}
		$this->Usuarios->Guardar();
		header("Location: ?p=usuarios");
	}
	
	/**
	 * @desc
	 * Marca un registro como activo o inactivo.
	 *
	 */
	public function x_activar() {
		$this->Usuarios->IdUsuario = $_POST['id'];
		$aData = $this->Usuarios->Obtener();
		$this->Usuarios->Activo = !$this->Usuarios->Activo;
		$this->Usuarios->Guardar();
		
		$aData['activo'] = $this->Usuarios->Activo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Marca un registro como bloqueado o no.
	 *
	 */
	public function x_sexo() {
	
		$this->Usuarios->id_user = $_POST['id'];
		
		$aUser = $this->Usuarios->Obtener();
		
		$sexo = "";
		
		if($aUser['sexo'] == "M"){
			$sexo = "F";
		} else {
			$sexo = "M";
		}
		
		$this->Usuarios->Sexo($_POST['id'], $sexo);
		
		$aData['sexo'] = $sexo;
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Elimina un registro mediante AJAX.
	 *
	 */
	public function x_eliminar() {
		$this->Usuarios->IdUsuario = $_POST['id'];
		if ($this->Usuarios->Eliminar()) {
			$aData['eliminado'] = 1;
		}
		else {
			$aData['eliminado'] = 0;
		}
		
		echo json_encode($aData);
	}
	
	/**
	 * @desc
	 * Devuelve el nombre del registro segun el ID pasado como argumento.
	 *
	 * @param int $nId
	 * @return string
	 */
	public function x_obtener_nombre($nId) {
		$this->Usuarios->IdUsuario = $nId;
		$this->Usuarios->Obtener();
		return $this->Usuarios->Nombre;
	}
	
	/**
	 * @desc
	 * Devuelve codigo para el autocompletado.
	 *
	 */
	public function x_autocompletar() {
		$this->Usuarios->Nombre = @$_GET['q'];
		$this->Usuarios->OrderBy = 'nombre';
		$this->Usuarios->LimitCant = 50;
		$aDatos = $this->Usuarios->Buscar();
		
		foreach($aDatos as $item) {
			echo str_replace('|', '', $item['nombre'])."|{$item['id_usuario']}\n";
		}
	}
	
	/**
	 * @desc
	 * Muestra el menú lateral.
	 *
	 */
	private function menu_lateral() {
		$this->Buffer['menu_lateral'] = $this->Template->Load('usuarios/menu-lateral.tpl.php');
	}
}

$oCont = new UsuariosCtl();

if (isset($AUTORUN) && $AUTORUN == false) return; // Para servicio.

if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>
