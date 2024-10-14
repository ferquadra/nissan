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
		if(isset($_GET['page']) && $_GET['page'] == 3){
			echo $this->Template->Load('3.tpl.php', $this->Buffer);
			die;
		} else if(isset($_GET['page']) && $_GET['page'] == 4){
			echo $this->Template->Load('4.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 5){
			echo $this->Template->Load('5.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 6){
			echo $this->Template->Load('6.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 7){
			echo $this->Template->Load('7.tpl.php', $this->Buffer);
			die;
		} elseif(isset($_GET['page']) && $_GET['page'] == 'loading'){
			echo $this->Template->Load('loading.tpl.php', $this->Buffer);
			die;
		}  elseif(isset($_GET['page']) && $_GET['page'] == 'final'){
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