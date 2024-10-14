<?
session_start();
header("HTTP/1.1 200 OK");
define('ADMIN', false);
date_default_timezone_set('America/Argentina/Buenos_Aires');
ini_set('max_execution_time',7200);
// ********** DETECCIÓN DE LA INSTANCIA **************************************
$_SESSION['instancia']  = 'super';
// ********** FIN DE LA DETECCIÓN DE INSTANCIA *******************************
// Link a conexión.
$_SESSION['link'] = null;
include('/home/transpar/public_html/config.php');

$_SESSION['link'] = mysqli_connect(APP_DATABASE_HOST, APP_DATABASE_USER, APP_DATABASE_PASS, APP_DATABASE_NAME);


/// funciones SQL
/// funciones SQL
/// funciones SQL
/// funciones SQL
/// funciones SQL
/// funciones SQL
/// funciones SQL
/// funciones SQL

function Select($cSql, $debug = false){

	$sRes = mysqli_query($_SESSION['link'], $cSql);

  if($debug){
    echo $cSql;
    echo var_dump($sRes);
    die;
  }

  $aRec = array();
	while($item = mysqli_fetch_array($sRes, MYSQLI_ASSOC)){
    $aRec[] = $item;
    if($debug){

    }
  }

  if(count($aRec) > 0){
    return $aRec;
  } else {
    return false;
  }

}

function Update($cSql){
	if(mysqli_query($_SESSION['link'], $cSql)){
    return true;
  } else {
    echo mysqli_error($_SESSION['link']);
    die('error on function Update');
  }
}

function Delete($cSql){
	if(mysqli_query($_SESSION['link'], $cSql)){
    return true;
  } else {
    echo mysqli_error($_SESSION['link']);
    die('error on function Update');
  }
}

function Insert($cSql){
	if(mysqli_query($_SESSION['link'], utf8_decode($cSql))){
    return mysqli_insert_id($_SESSION['link']);
  } else {
    echo mysqli_error($_SESSION['link']);
    die('error on function Update');
  }
}


/// fin funciones SQL
/// fin funciones SQL
/// fin funciones SQL
/// fin funciones SQL
/// fin funciones SQL
/// fin funciones SQL
/// fin funciones SQL
/// fin funciones SQL

$str = date('d/m/Y H:i:s')." === GET === ".print_r($_GET, true);
file_put_contents('mp-notificaciones.txt', $str, FILE_APPEND | LOCK_EX);

$id     = $_GET['id'];
$topic  = $_GET['topic'];
$fecha 	= date("Y-m-d H:i:s");

$cSql = "INSERT INTO mercadopago_ipn SET id = '{$id}', topic = '{$topic}', fecha = '{$fecha}'";
Insert($cSql);

die;
?>
