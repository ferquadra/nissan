<?
function digital_crearsubdominio($subdomain){

    $command = "sudo /var/www/transpar/scripts/crearsubdominio.sh ".$subdomain;
    $output = shell_exec($command);

    $archivo = "/var/www/transpar/logs/digitalocean.log";
        
    $msj = date("d/m/Y H:i:s")."\n";
    $msj .= "IP: ".$_SERVER['REMOTE_ADDR']."\n";
    $msj .= "funciones > digital_crearsubdominio > ".$output."\n";
    
    file_put_contents($archivo, $msj, FILE_APPEND);

    return $output;
}

function copiarCarpeta($dirOrigen, $dirDestino) {
    if (!is_dir($dirDestino)) {
        mkdir($dirDestino);
    }

    $archivos = scandir($dirOrigen);

    foreach ($archivos as $archivo) {
        if ($archivo == '.' || $archivo == '..') continue;

        $rutaOrigen = $dirOrigen . '/' . $archivo;
        $rutaDestino = $dirDestino . '/' . $archivo;

        if (is_dir($rutaOrigen)) {
            copiarCarpeta($rutaOrigen, $rutaDestino);
        } else {
            copy($rutaOrigen, $rutaDestino);
        }
    }
}
?>