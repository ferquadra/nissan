<?
function CalcularArea($ticketsAbiertos){
    // Definir valores mínimos y máximos para el área y los tickets
    $areaMax = 2500;
    $areaMin = 500;
    $ticketsMax = 30;
  
    // Calcular la relación
    $area = $areaMax - (($areaMax - $areaMin) / $ticketsMax) * $ticketsAbiertos;
  
    // Asegurarse de que el área no exceda los límites
    $area = max($areaMin, min($area, $areaMax));
  
    return intval($area);
}
function EvaluarProgresoDelMes(){
    // Obtener el día actual y el último día del mes
    $diaActual = date('j');
    $ultimoDia = date('t');
  
    // Calcular el progreso
    $progreso = ($diaActual / $ultimoDia) * 10;
  
    // Redondear al entero más cercano
    $progreso = round($progreso);
  
    // Asegurar que esté en el rango de 1 a 10
    $progreso = max(1, min(10, $progreso));
  
    return $progreso;
}
?>