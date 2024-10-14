<?
// Vamos a incluir acá funciones de tracking para publicidad.
// Fernando Cuadrado - CTO & Co-founder - Transparent
// 25-05-2022 - Viva la patria, el mundo y la revolución.

if(isset($_GET['ad'])){

    $publi = $_GET['ad'];
    $file_txt = $publi.".txt";

    // Guardar log.
    $fecha = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $_SERVER['REQUEST_URI'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $referer = $_SERVER['HTTP_REFERER'];
    $query = $_SERVER['QUERY_STRING'];
    $f = fopen('logs/'.$file_txt, 'a');
    fwrite($f, $fecha.' - '.$ip.' - '.$url.' - '.$user_agent.' - '.$referer.' - '.$query."\n");
    fclose($f);

    if($publi == "rosario3"){
            // g	Formato de 12 horas de una hora sin ceros iniciales	1 hasta 12
            if((date("g") % 2) == 0){
                ?>
                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-33317648-49"></script>
                <script type="text/javascript">
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());
                    gtag('config', 'UA-33317648-49');
                </script>
                <script type="text/javascript">
                    window.location.href = "https://www.transparent.com.ar/";
                </script>
                <?
            } else {
            
                ?>
                <script type="text/javascript">
                    window.location.href = "https://globaltransparent.net/paginas/landing";
                </script>
                <?
            }
    }

    // Notificar por email.
    $to = 'fernando@transparent.com.ar';
    $to2 = 'pablo@transparent.com.ar';
    $to3 = 'federico@transparent.com.ar';

    $subject = 'Nuevo click en '.$publi;
    
    $message = "\r\n".'¡Algarabia, alegria y felicidad!'. "\r\n". "\r\n";
    $message .= 'Fecha: '.$fecha. "\r\n";
    $message .= 'IP: '.$ip."\r\n";
    $message .= 'URL: '.$url."\r\n";
    $message .= 'User Agent: '.$user_agent.' - Referer: '.$referer.' - Query: '.$query;

    $message .= "\r\n\r\n\r\n"."Nota: Podés ver el log completo en el archivo /logs/".$file_txt;

    $message .= "\r\n\r\n\r\n".".: Sistema de Tracking - Transparent - HALL 9000 :.";

    $headers = 'From:info@globaltransparent.net' . "\r\n" .
        'Reply-To: info@globaltransparent.net' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    //mail($to, $subject, $message, $headers);

    //mail($to2, $subject, $message, $headers);

    //mail($to3, $subject, $message, $headers);

}


?>