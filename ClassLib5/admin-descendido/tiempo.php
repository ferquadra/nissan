<?
$hoy = time();
$futuro = mktime(15,30,0,6,30,2014);

echo date("d/m/Y H:i:s", $futuro);
echo "---";

$faltan = $futuro-$hoy;

echo " hoy: ".date("d/m/Y h:i:s");

$dias = intval($faltan / (60*60*24));
$horas = intval(($faltan - ($dias*24*60*60)) / (60*60));
$minutos = intval(($faltan - ($dias*24*60*60) - ($horas*60*60)) / 60);
$segundos = $faltan - ($dias*24*60*60) - ($horas*60*60) - ($minutos*60);

echo "<br /><br />";
echo $dias." ".$horas." ".$minutos." ".$segundos;
//$horas =  



?>