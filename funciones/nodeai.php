<?
function nodeai_tags($txt){

    // URL del endpoint
    $url = "https://nodeai.tech/tags/";

    // Datos que deseas enviar en la solicitud POST
    $data = array(
        'txt' => 'El sabía, resignado, que el mundo esperaba otro hito... "hay que entregar mañana" pensó, y se vió como el trapecista que cae con estilo por pura experiencia en golpes. Un destello de coraje lo iluminó y expresó para si mismo: "A darle, git pull."'
    );

    // Inicializar cURL
    $curl = curl_init($url);

    // Establecer las opciones de cURL
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($curl);

    // Verificar si ocurrió algún error
    if ($response === false) {
        $error = curl_error($curl);
        // Manejar el error adecuadamente
        nodeai_log("ERROR: ".$error);
    } else {
        // Procesar la respuesta
        nodeai_log("SUCCESS: ".$response);
        return $response;
    }

    // Cerrar la sesión de cURL
    curl_close($curl);

}

function nodeai_gpt($txt, $model = "gpt-3.5-turbo"){

    // URL del endpoint
    $url = "https://nodeai.tech/chat/";

    // Datos que deseas enviar en la solicitud POST
    /***
    $data = array(
        'txt' => 'El sabía, resignado, que el mundo esperaba otro hito... "hay que entregar mañana" pensó, y se vió como el trapecista que cae con estilo por pura experiencia en golpes. Un destello de coraje lo iluminó y expresó para si mismo: "A darle, git pull."'
    );
    ****/
    $data = array(
        'txt' => $txt,
        'model' => $model
    );

    // Inicializar cURL
    $curl = curl_init($url);

    // Establecer las opciones de cURL
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($curl);

    // Verificar si ocurrió algún error
    if ($response === false) {
        $error = curl_error($curl);
        // Manejar el error adecuadamente
        nodeai_log("ERROR: ".$error);
    } else {
        // Procesar la respuesta
        nodeai_log("SUCCESS: ".$response);
        return $response;
    }

    // Cerrar la sesión de cURL
    curl_close($curl);

}

// Graba en un archio de log en la carpeta /logs
function nodeai_log($txt){

    $log = fopen("../logs/log_nodeai.txt", "a");
    fwrite($log, "FECHA: ".date("Y-m-d H:i:s")."\nTXT: ".$txt."\n");
    fclose($log);

}
?>