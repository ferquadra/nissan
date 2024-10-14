<?
function mobbex_checkout($apikey, $secret, $aData){

    $url = 'https://api.mobbex.com/p/checkout';

    $ch = curl_init($url);

    /************************* ESTRUCTURA EJEMPLO
    $data = array(
        "total" => "100.53",
        "description" => "Checkout de Prueba",
        "reference" => "260520210954",
        "currency" => "ARS",
        "test" => true,
        "return_url" => "https://transparent.com.ar/pruebas/mobbex.php",
        "webhook" => "https://transparent.com.ar/pruebas/mobbex.php?webhook=true",
        "customer" => array(
            "email" => "fer@transparent.com.ar",
            "name" => "Transparent",
            "identification" => "27498523"
        )
    );
    ********************************************/

    $data = $aData;

    $headers = array(
        'x-api-key: '.$apikey,
        'x-access-token: '.$secret,
        'Content-Type: application/json'
    );

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    $aRes = json_decode($response, true);

    return $aRes;

} // end function mobbex_checkout.

function mobbex_mediosdepago($apikey, $secret, $total){

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.mobbex.com/p/sources?total='.$total,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-api-key: '.$apikey,
        'x-access-token: '.$secret
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return $response;    

}
?>