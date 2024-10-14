<?

function decidir_procesarpago($aTarjeta, $site_id_hijo, $amount_total, $amount, $amount_fee, $descripcion){

    $site_id = '40000032'; // De Transparent Web SAS.
    /********************************
     * §  ID SITE PADRE: 40000032
        o   Public Apikey: 89d2508043514261b85f970e12698bc7
        o   Private Apikey: 071e64901aee48d2bd1bc618482c3f30
        o   Descripción: TransparemtWeb-monto
        o   Mail/From Mail: info@transparent.com.ar
        o   N° Establecimiento Visa: 91621730
        o   N° Establecimiento Master: 91621763
        o   N° Establecimiento Cabal: 91621748
        o   N° Establecimiento Amex Prisma: 91621755
        o   OBSERVACION: Este site fue configurado con anterioridad y es con el cual realizaron sus pruebas.
     *******************/

    /***
     * $card_number, $card_expiration_month, $card_expiration_year, $security_code, $card_holder_name, $card_holder_identification_type, $card_holder_identification_number, $payment_method_id
     */
    $card_number = $aTarjeta['card_number'];
    $card_expiration_month = $aTarjeta['card_expiration_month'];
    $card_expiration_year = $aTarjeta['card_expiration_year'];
    $security_code = $aTarjeta['security_code'];
    $card_holder_name = $aTarjeta['card_holder_name'];
    $card_holder_identification_type = $aTarjeta['card_holder_identification_type'];
    $card_holder_identification_number = $aTarjeta['card_holder_identification_number'];
    $payment_method_id = $aTarjeta['payment_method_id'];
    /************* PAYMENT_METHOD_ID *******
        1 - Visa
        15 - Mastercard
        65 - American Express
        31 - Visa Débito
        66 - MasterCard Débito
     ******/
    
     //echo $card_holder_identification_type;
     //die;

    $data = array(
        'card_number' => $card_number,
        'card_expiration_month' => $card_expiration_month,
        'card_expiration_year' => $card_expiration_year,
        'security_code' => $security_code,
        'card_holder_name' => $card_holder_name,
        'card_holder_identification' => array(
            'type' => $card_holder_identification_type,
            'number' => $card_holder_identification_number,
        ),
    );

    /***idSite-40000032-monto
    89d2508043514261b85f970e12698bc7
    071e64901aee48d2bd1bc618482c3f30
    */

    // $privateKeyDistri = "d8cd75a302cf40809d56957260c9a6b1";
    // $publicKeyDistri = "26a647a2dcde4c0b802db61e73403cda";

    $publicKeyDistri = "89d2508043514261b85f970e12698bc7";
    $privateKeyDistri = "071e64901aee48d2bd1bc618482c3f30";

    //$publicKeyDistriPorc = "3bb0f39189ac4c0e95810e4e244aaed2";
    //$privateKeyDistriPor = "87f52b5e84c444c2a653ded2475b7b3f";

    //$url = 'https://developers.decidir.com/api/v2'; // URL Developer.
    $url = 'https://live.decidir.com/api/v2'; // URL Producción.

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url.'/tokens',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        'apikey: '.$publicKeyDistri,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    $aRes = json_decode($response, true);

    $token = $aRes['id'];
    $randomID = date("YmdHis")."-".rand(1000, 9999);
    $bin = $aRes['bin'];

    //echo "<pre>"; print_r($aRes); die;

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url.'/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "site_transaction_id": "'.$descripcion.'-'.$randomID.'",
    "token": "'.$token.'",
    "payment_method_id": '.$payment_method_id.',
    "bin": "'.$bin.'",
    "amount": '.$amount_total.',
    "currency": "ARS",
    "installments": 1,
    "description": "'.$descripcion.'",
    "payment_type": "distributed",
    "sub_payments": [
        {
        "site_id": "'.$site_id.'",
        "installments": 1,
        "amount": '.$amount_fee.'
        },
        {
        "site_id": "'.$site_id_hijo.'",
        "installments": 1,
        "amount": '.$amount.'
        }
    ]
    }',
    CURLOPT_HTTPHEADER => array(
        'apikey: '.$privateKeyDistri,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // log del response.
    $log = fopen("./logs/decidir_log_".$site_id_hijo.".txt", "a");
    $fecha = date("Y-m-d H:i:s");
    $datos = print_r($aRes, true);
    fwrite($log, $fecha."\n".$datos."\n".$response."\n========================================\n");
    fclose($log);

    $aRes2 = json_decode($response, true);
    return $aRes2;

    //echo "RESPUESTA DE PAGO:<br /><br />";
    //echo "<pre>"; print_r($aRes2); die;
    /*****************************************
     * Array
    (
        [id] => 845314744
        [site_transaction_id] => 107e73e0-3484-44fd-bf31-f53c0cc3a664
        [payment_method_id] => 31
        [card_brand] => Visa Débito
        [amount] => 3000
        [currency] => ars
        [status] => approved
        [status_details] => Array
                    (
                    [ticket] =>
                    [card_authorization_code] =>
                    [address_validation_code] => VTE2222
                    [error] =>
                    )
        [date] => 2023-01-19T01:00Z
        [customer] =>
        [bin] => 451772
        [installments] =>
        [first_installment_expiration_date] =>
        [payment_type] => distributed
        [sub_payments] => Array
                (
                    [0] => Array
                    (
                            [site_id] => 00250444
                            [installments] => 1
                            [amount] => 2000
                            [ticket] => 2
                            [card_authorization_code] => 761306
                            [subpayment_id] => 13818512
                            [status] => approved
                    )
                    [1] => Array
                            (
                            [site_id] => 40000032
                            [installments] => 1
                            [amount] => 1000
                            [ticket] => 2
                            [card_authorization_code] => 760374
                            [subpayment_id] => 13818511
                            [status] => approved
                            )
                )
        [site_id] => 40000032
        [fraud_detection] =>
        [aggregate_data] =>
        [establishment_name] =>
        [spv] =>
        [confirmed] =>
        [pan] =>
        [customer_token] =>
        [card_data] => /tokens/845314744
        [token] => 510ad30c-5ff4-49a8-b9a9-cd6899f10dc5
    )
    **********************************************/
}
// Fin de la función DECIDIR.



function decidir_procesarpago_transparent($aTarjeta, $amount_total, $descripcion){

    $site_id = '40000032'; // De Transparent Web SAS.
    /********************************
     * §  ID SITE PADRE: 40000032
        o   Public Apikey: 89d2508043514261b85f970e12698bc7
        o   Private Apikey: 071e64901aee48d2bd1bc618482c3f30
        o   Descripción: TransparemtWeb-monto
        o   Mail/From Mail: info@transparent.com.ar
        o   N° Establecimiento Visa: 91621730
        o   N° Establecimiento Master: 91621763
        o   N° Establecimiento Cabal: 91621748
        o   N° Establecimiento Amex Prisma: 91621755
        o   OBSERVACION: Este site fue configurado con anterioridad y es con el cual realizaron sus pruebas.
     *******************/

    /***
     * $card_number, $card_expiration_month, $card_expiration_year, $security_code, $card_holder_name, $card_holder_identification_type, $card_holder_identification_number, $payment_method_id
     */
    $card_number = $aTarjeta['card_number'];
    $aTarjeta['card_expiration_month'] = str_pad($aTarjeta['card_expiration_month'], 2, '0', STR_PAD_LEFT);
    $card_expiration_month = $aTarjeta['card_expiration_month'];
    $card_expiration_year = $aTarjeta['card_expiration_year'];
    $security_code = $aTarjeta['security_code'];
    $card_holder_name = $aTarjeta['card_holder_name'];
    $card_holder_identification_type = $aTarjeta['card_holder_identification_type'];
    $card_holder_identification_number = $aTarjeta['card_holder_identification_number'];
    $payment_method_id = $aTarjeta['payment_method_id'];
    /************* PAYMENT_METHOD_ID *******
        1 - Visa
        15 - Mastercard
        65 - American Express
        31 - Visa Débito
        66 - MasterCard Débito
     ******/
    
     //echo $card_holder_identification_type;
     //die;

    $data = array(
        'card_number' => $card_number,
        'card_expiration_month' => $card_expiration_month,
        'card_expiration_year' => $card_expiration_year,
        'security_code' => $security_code,
        'card_holder_name' => $card_holder_name,
        'card_holder_identification' => array(
            'type' => $card_holder_identification_type,
            'number' => $card_holder_identification_number,
        ),
    );

    /***idSite-40000032-monto
    89d2508043514261b85f970e12698bc7
    071e64901aee48d2bd1bc618482c3f30
    */

    // $privateKeyDistri = "d8cd75a302cf40809d56957260c9a6b1";
    // $publicKeyDistri = "26a647a2dcde4c0b802db61e73403cda";

    $publicKeyDistri = "89d2508043514261b85f970e12698bc7";
    $privateKeyDistri = "071e64901aee48d2bd1bc618482c3f30";

    //$publicKeyDistriPorc = "3bb0f39189ac4c0e95810e4e244aaed2";
    //$privateKeyDistriPor = "87f52b5e84c444c2a653ded2475b7b3f";

    //$url = 'https://developers.decidir.com/api/v2'; // URL Developer.
    $url = 'https://live.decidir.com/api/v2'; // URL Producción.

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url.'/tokens',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        'apikey: '.$publicKeyDistri,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    $aRes = json_decode($response, true);

    if(!isset($aRes['id'])){
        echo $response;
        echo "<br /><br />";
        print_r($aTarjeta);
        die;
    }

    $token = $aRes['id'];
    $randomID = rand(1000, 9999);
    $bin = $aRes['bin'];

    //echo "<pre>"; print_r($aRes); die;

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url.'/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "site_transaction_id": "'.$descripcion.'-'.$randomID.'",
    "token": "'.$token.'",
    "payment_method_id": '.$payment_method_id.',
    "bin": "'.$bin.'",
    "amount": '.$amount_total.',
    "currency": "ARS",
    "installments": 1,
    "description": "'.$descripcion.'",
    "payment_type": "single",
    "sub_payments": [
        {
        "site_id": "'.$site_id.'",
        "installments": 1,
        "amount": '.$amount_total.'
        }
    ]
    }',
    CURLOPT_HTTPHEADER => array(
        'apikey: '.$privateKeyDistri,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $logtransaccion = '{
        "site_transaction_id": "'.$descripcion.'-'.$randomID.'",
        "token": "'.$token.'",
        "payment_method_id": '.$payment_method_id.',
        "bin": "'.$bin.'",
        "amount": '.$amount_total.',
        "currency": "ARS",
        "installments": 1,
        "description": "'.$descripcion.'",
        "payment_type": "single",
        "sub_payments": [
            {
            "site_id": "'.$site_id.'",
            "installments": 1,
            "amount": '.$amount_total.'
            }';

    // log del response.
    $log = fopen("/home/transpar/public_html/logs/decidir_log_debito_transparent.txt", "a");
    $fecha = date("Y-m-d H:i:s");
    $datos = print_r($aRes, true);
    fwrite($log, $fecha."\n".$datos."\n".$logtransaccion."\n".$response."\n========================================\n");
    fclose($log);

    $aRes2 = json_decode($response, true);
    return $aRes2;

    //echo "RESPUESTA DE PAGO:<br /><br />";
    //echo "<pre>"; print_r($aRes2); die;
    /*****************************************
     * Array
    (
        [id] => 845314744
        [site_transaction_id] => 107e73e0-3484-44fd-bf31-f53c0cc3a664
        [payment_method_id] => 31
        [card_brand] => Visa Débito
        [amount] => 3000
        [currency] => ars
        [status] => approved
        [status_details] => Array
                    (
                    [ticket] =>
                    [card_authorization_code] =>
                    [address_validation_code] => VTE2222
                    [error] =>
                    )
        [date] => 2023-01-19T01:00Z
        [customer] =>
        [bin] => 451772
        [installments] =>
        [first_installment_expiration_date] =>
        [payment_type] => distributed
        [sub_payments] => Array
                (
                    [0] => Array
                    (
                            [site_id] => 00250444
                            [installments] => 1
                            [amount] => 2000
                            [ticket] => 2
                            [card_authorization_code] => 761306
                            [subpayment_id] => 13818512
                            [status] => approved
                    )
                    [1] => Array
                            (
                            [site_id] => 40000032
                            [installments] => 1
                            [amount] => 1000
                            [ticket] => 2
                            [card_authorization_code] => 760374
                            [subpayment_id] => 13818511
                            [status] => approved
                            )
                )
        [site_id] => 40000032
        [fraud_detection] =>
        [aggregate_data] =>
        [establishment_name] =>
        [spv] =>
        [confirmed] =>
        [pan] =>
        [customer_token] =>
        [card_data] => /tokens/845314744
        [token] => 510ad30c-5ff4-49a8-b9a9-cd6899f10dc5
    )
    **********************************************/
}
// Fin de la función DECIDIR-TRANSPARENT.
?>