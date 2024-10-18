<?
function compararFechasDescendente($a, $b) {
	return strtotime($b['fecha']) - strtotime($a['fecha']);
}

class HomeCtl extends Controller {

	/****************************************************************************
	*****************************************************************************
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!

	.: Idea y Desarrollo -> Fernando Cuadrado :. Programación e Infraestructura.

	.: Lo más complejo de todo proyecto de software es conectar los cables lógicos que suelen estar en el aire. :.

	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	*****************************************************************************
	****************************************************************************/

	function __construct() {

		parent::__construct();

		$this->Pro = new Productos();


	}


	/*************************   ESTÁS EN EL HOME DEL SUPER-ADMIN!!!   **********/
	/*************************   ESTÁS EN EL HOME DEL SUPER-ADMIN!!!   **********/
	/*************************   ESTÁS EN EL HOME DEL SUPER-ADMIN!!!   **********/
	public function index() {

		/*** FUNCA LA BASE
		$aRec = array();
		$aRec = $this->Pro->SQLSelect("SELECT * FROM novedades");
		***********/


		$this->Buffer['body'] = $this->Template->Load('home.tpl.php');
		echo $this->Template->Load('default.tpl.php', $this->Buffer);

	}

	public function es() {

		/*** FUNCA LA BASE
		$aRec = array();
		$aRec = $this->Pro->SQLSelect("SELECT * FROM novedades");
		***********/
		if(!isset($_SESSION['creaciones'])){
			$_SESSION['creaciones'] = array();
			$_SESSION['creaciones']['idioma'] = 'es';
		}		

		if(isset($_GET['page']) && $_GET['page'] == 3){
			echo $this->Template->Load('3.tpl.php', $this->Buffer);
			die;
		} else if(isset($_GET['page']) && $_GET['page'] == 4){
			echo $this->Template->Load('4.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 5){

			if(isset($_GET['op'])){
				$_SESSION['creaciones']['op'] = $_GET['op'];
			} else {
				header('Location: ./');
				die;
			}	
			echo $this->Template->Load('5.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 6){

			if(isset($_GET['ritmo'])){
				$_SESSION['creaciones']['ritmo'] = $_GET['ritmo'];
			} else {
				header('Location: ./');
				die;
			}	
			echo $this->Template->Load('6.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 7){

			if(isset($_GET['texto'])){
				$_SESSION['creaciones']['texto'] = $_GET['texto'];
			} else {
				header('Location: ./');
				die;
			}	

			echo $this->Template->Load('7.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 'loading'){
			
			if(isset($_GET['frase'])){
				$_SESSION['creaciones']['frase'] = $_GET['frase'];
			} else {
				header('Location: ./');
				die;
			}

			// Grabar la $_SESSION['creaciones'] en la base de datos, convertir a json.
			$_SESSION['creaciones']['fecha'] = date('Y-m-d H:i:s');

			$texto = json_encode($_SESSION['creaciones']);

			$clave = md5($texto);

			$cSql = "INSERT INTO elementos SET texto = '{$texto}', mapa = '{$clave}'";
			if($this->Pro->SQLInsert($cSql)){
				$this->Buffer['clave'] = $clave;
				echo $this->Template->Load('loading.tpl.php', $this->Buffer);
				die;
			} else {
				die('Error al generar la creación en la base de datos.');
			}

		}  elseif(isset($_GET['page']) && $_GET['page'] == 'final'){

			if(isset($_GET['key'])){
				$clave = $_GET['key'];

				$cSql = "SELECT * FROM elementos WHERE mapa = '{$clave}' LIMIT 1";
				$aRec = $this->Pro->SQLSelect($cSql);

				if(count($aRec) > 0){
					$this->Buffer['creacion'] = json_decode(stripslashes($aRec[0]['texto']), true);
				} else {
					die('No se encontró la creación. Key incorrecta.');
				}

				//echo "<pre>"; print_r($this->Buffer['creacion']); die;

			} else {
				header('Location: ./');
				die;
			}
			echo $this->Template->Load('final.tpl.php', $this->Buffer);
			die;
		} else {
			echo $this->Template->Load('2.tpl.php', $this->Buffer);
			die;
		}

		

	}
	/****************************************************************************
	*****************************************************************************
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!

	.: Idea y Desarrollo -> Fernando Cuadrado :. Salvador de vidas miserables.

	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	ESTAS EN EL HOME DEL SUPER - ESTAS EN EL HOME DEL SUPER !!!
	*****************************************************************************
	****************************************************************************/

}

$oCont = new HomeCtl();
if (method_exists($oCont, $METHOD)) {
	$oCont->$METHOD();
}
else {
	$cTmp = APP_DEFAULT_METHOD;
	$oCont->$cTmp();
}
?>