<?
/***
 * https://platform.openai.com/
 * 
 * USUARIO: fernando@transparent.com.ar
 */
function chatgpt($prompt, $system = "", $aPrevios = array()){
    /****
      {"role": "system", "content": "You are a helpful assistant."},
      {"role": "user", "content": "Who won the world series in 2020?"},
      {"role": "assistant", "content": "The Los Angeles Dodgers won the World Series in 2020."},
      {"role": "user", "content": "Where was it played?"}
     ***********/
    if($system){

        if(isset($aPrevios['user'])){
            $messages = array(
                array("role" => "system", "content" => $system),
                array("role" => "user", "content" => $aPrevios['user']),
                array("role" => "assistant", "content" => $aPrevios['assistant']),
                array("role" => "user", "content" => $prompt)
            );
        } else {
            $messages = array(
                    array("role" => "system", "content" => $system),
                    array("role" => "user", "content" => $prompt)
            );
        }

    } else {
        $messages = array(
            array(
                "role" => "user",
                "content" => $prompt
            )
        );
    }
    $data = array(
        "model" => "gpt-4",
        "messages" => $messages
    );

    /*******
    $data = array(
        "model" => "gpt-3.5-turbo",
        "messages" => $messages
    );
    ******/

    $json_data = json_encode($data);
  
    $token = "";
  
    $curl = curl_init();
  
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $json_data,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $token",
        "Content-Type: application/json"
        ),
    ));
    
    $response = curl_exec($curl);

    // Loguea la respuesta.
    $log = fopen("/home/transpar/public_html/logs/log_chatgpt.txt", "a");
    if(isset($_SESSION['instancia'])){
        fwrite($log, "INSTANCIA: ".$_SESSION['instancia']."\nFECHA: ".date("Y-m-d H:i:s")."\nJSON_DATA_INPUT: ".$json_data."\nRESPONSE: ".$response."\n");
    } else {
        fwrite($log, "FECHA: ".date("Y-m-d H:i:s")."\nJSON_DATA_INPUT: ".$json_data."\nRESPONSE: ".$response."\n");
    }
    fclose($log);
    
    curl_close($curl);
    $aRes = json_decode($response, true);

    return $aRes;

}

function AI_keywords($texto){
    $prompt = "Extrae las 7 keywords más relevantes (separadas por coma) del siguiente texto (evitar peso o dimensiones): ";
    $aRes = chatgpt($prompt.$texto);
    if(isset($aRes['choices'][0]['message']['content'])){
        return $aRes['choices'][0]['message']['content'];
    } else {
        return "";
    }    
}

function AI_texto_periodistico($titulo){
    $prompt = "Actúa como si fueras un periodista que debe redactar un artículo (de hasta 100 palabras) en base a la siguiente consigna: ";
    $aRes = chatgpt($prompt.$titulo);
    if(isset($aRes['choices'][0]['message']['content'])){
        return $aRes['choices'][0]['message']['content'];
    } else {
        return "";
    }    
}

function AI_titulo_periodistico($texto){
    $prompt = "Escribe un título de hasta 11 palabras (en español) relacionado con el siguiente texto: ";
    $aRes = chatgpt($prompt.$texto);
    if(isset($aRes['choices'][0]['message']['content'])){
        return $aRes['choices'][0]['message']['content'];
    } else {
        return "";
    }    
}
?>