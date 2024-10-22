<?

//die("<br /><br /><br />Estamos realizando mejoras, estaremos disponibles en breve, disculpe las molestias.<br />");
error_reporting(E_ALL);
ini_set('display_errors', true);

session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
define('ADMIN', true);
header('Content-Type: text/html; charset=utf-8');


$_SESSION['instancia'] = "super";

// Obtiene encabezados de urls.
function get_http_response_code($url) {
  $headers = get_headers($url);
  return substr($headers[0], 9, 3);
}

function FechaToTimestamp($fecha, $hora = "00:00"){

  if(strpos($fecha, " ")){
    // Formato completo (Ej: 2021-06-16 23:04:02).
    $aFechaHora = explode(" ", $fecha);  
    $aFec = explode("-", $aFechaHora[0]);
    $aHora = explode(":", $aFechaHora[1]);
    return mktime($aHora[0],$aHora[1],$aHora[2],$aFec[1],$aFec[2],$aFec[0]);

  } else {

    $aFec = explode("-", $fecha);
    $aHora = explode(":", $hora);
    return mktime($aHora[0],$aHora[1],0,$aFec[1],$aFec[2],$aFec[0]);

  }

}

function Fecha($fecha, $opcionDia = false){

  $aDias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');

  if($fecha){
      if(strlen($fecha) == 10){
        $aFecha = explode("-", $fecha);
        $timestamp = mktime(0, 0, 0, $aFecha[1], $aFecha[2], $aFecha[0]);
        $dia = date("N", $timestamp);

        if($opcionDia){
          return $aDias[$dia]." ".date("d/m/Y", $timestamp);
        } else {
          return date("d/m/Y", $timestamp);
        }
      }

      if(strlen($fecha) > 10){
        $aFechaHora = explode(" ", $fecha);
        $aFecha = explode("-", $aFechaHora[0]);
        $aHora = explode(":", $aFechaHora[1]);

        $timestamp = mktime($aHora[0], $aHora[1], $aHora[2], $aFecha[1], $aFecha[2], $aFecha[0]);

        $dia = date("N", $timestamp);

        if($opcionDia){
          return $aDias[$dia]." ".date("d/m/Y H:i", $timestamp);
        } else {
          return date("d/m/Y", $timestamp);
        }
      }

  }

  return $fecha;

} // FIN Fecha.


function TimeToFecha($timestamp, $opcionDia = false){

  if($timestamp){

  $aDias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');

  $dia = date("N", $timestamp);

  if($opcionDia){
    return $aDias[$dia]." ".date("d/m/Y H:i", $timestamp);
  } else {
    return date("d/m/Y H:i", $timestamp);
  }

  } else {
    return 0;
  }

} // FIN TimeToFecha.

function Ayuda($titulo = 'Sin título', $texto = 'Sin texto'){

  $cHTML = '<i class="fas fa-question-circle" data-container="body" title="'.$titulo.'" style="cursor: pointer;" data-toggle="popover" data-placement="bottom" data-content="'.$texto.'"></i>';

  return $cHTML;
}

function linkify($value, $protocols = array('http', 'mail'), array $attributes = array('target' => 'blank')){
  // Link attributes
  $attr = '';
  foreach ($attributes as $key => $val) {
      $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
  }

  $links = array();

  // Extract existing links and tags
  $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

  // Extract text links for each protocol
  foreach ((array)$protocols as $protocol) {
      switch ($protocol) {
          case 'http':
          case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value); break;
          case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
          case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;
          default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
      }
  }

  // Insert all link
  return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
}

// Función para verificación de ReCaptcha.
function verifyReCaptcha($recaptchaCode, $secret = '6Lf2GAEVAAAAAHlqX3BqggMsa-NwKPkyoktbLG2c'){
  $postdata = http_build_query(["secret"=>$secret,"response"=>$recaptchaCode]);
  $opts = ['http' =>
      [
          'method'  => 'POST',
          'header'  => 'Content-type: application/x-www-form-urlencoded',
          'content' => $postdata
      ]
  ];
  $context  = stream_context_create($opts);
  $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
  $check = json_decode($result);
  return $check->success;
}

require_once('config.php');
include('./funciones/soscontador.php');
include('./funciones/chatgpt.php');
include('./funciones/pdf.php');
include('./funciones/utiles.php');
include_once('./funciones/mailgun.php');

/*
|---------------------------------------------------------------
| CARGA EL CONTROLADOR
|---------------------------------------------------------------
|
|
*/
require_once ($system_folder.'/manager.php');
?>
