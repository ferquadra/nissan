<?

// define('SECRET_KEY',  'YOUR_CLIENT_SECRET');
// define('SECRET_IV',  'YOUR_CLIENT_ID');

// Funcion para desencriptar el token desde la url
function decrypt_querystring_to_data($token_encrypt){
    $base64_token_decode = base64url_decode($token_encrypt);
    $token_decrypt = encrypt_decrypt($base64_token_decode,'decrypt');
    parse_str($token_decrypt, $data);
    return $data; 
}

// Funcion para encriptar el token para la url
function encrypt_data_to_querystring($data){
    $query_string = http_build_query($data);
    $token_encrypt = encrypt_decrypt($query_string,'encrypt');
    $base64_token_encrypt = base64url_encode($token_encrypt);
    return $base64_token_encrypt; 
}

// echo hash('sha256','a');exit;
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

// Funcion para encriptar/descencriptar el token
function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16); // sha256 is hash_hmac_algo

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function tco_get_url($tco_api_url, $access_token, $array_data){

    define('SECRET_KEY', '27CCBE261818AC11A8A0B4DE0C735A1DE99533B6CD13FD8676878E23EA288231');
    define('SECRET_IV', '40DA4E79A2CEA5C9FA2B2B9232A5A917');
    /***
    $data = [
        "dni" =>  '95109887',
        "telefono" =>  "3415112233",
        "monto" =>    50000,
        "tipo" =>  "estandar",

        "callback_success" =>  'https://misitio.com/callback_success',
        "callback_failure" =>  'https://misitio.com/callback_failure',
        "callback_cancel" =>  'https://misitio.com/callback_cancel',
        "payment_notification" =>  'https://misitio.com/payment_notification',

        "time" =>  time(),

        "nombre" =>  "MARIA LOURDES",
        "apellido" =>  "ZAYAS",
        "email" =>  "test@ZAYAS.com",
        "genero" =>  "FEMALE",
        "ingresos_mensuales" =>  "50000",
    ];
    ***/
    $token = encrypt_data_to_querystring($array_data);
    $url = $tco_api_url .'?at='. $access_token.'&tk='.$token;
    return $url;
}
?>