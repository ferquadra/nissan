<?
// Documentación:
// https://documenter.getpostman.com/view/8308637/SVmpYN3A?version=latest#8812d97b-35fe-43a8-8386-7901e3d31600

function contabilium_token($client_id, $client_secret){

    // SemillaViva
    // client_id = info@semillaviva.com.ar
    // client_secret = c145ec5ffd9d4d69a1a1438c0e978f10

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://rest.contabilium.com/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id='.$client_id.'&client_secret='.$client_secret,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));
    
   $response = curl_exec($curl);
   
   $aRes = json_decode($response, true);

   if(isset($aRes['access_token'])){
    return $aRes['access_token'];
   } else {
    return false;
   }
}

function contabilium_provincias($token, $id_pais = 10){

    $curl = curl_init();

    $aRec = array();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.contabilium.com/api/common/provincias?idPais='.$id_pais,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
        )
    ));

    $response = curl_exec($curl);
    $aRec = json_decode($response, true);

    return $aRec;

}

function contabilium_clientebydoc($token, $nro, $tipo = 'CUIT'){

    // Tipo = CUIT o DNI

    $curl = curl_init();

    $aRec = array();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.contabilium.com/api/clientes/GetClientByDoc?tipoDoc='.$tipo.'&nroDoc='.$nro,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
        )
    ));

    $response = curl_exec($curl);
    $aRec = json_decode($response, true);

    return $aRec;

}

function contabilium_createorden($token, $id_cliente, $fecha, $obs, $bon, $condventa, $total, $aItems){

    // Los parámetros obligatiorios son:idCliente, fechaEmision
    // fecha = 2018-04-23
    // condicionVenta (string) = Efectivo,Cheque, Cuenta corriente, MercadoPago, Tarjeta de debito, Tarjeta de crédito,Ticket,Otro

    $json_items = json_encode($aItems);

    $curl = curl_init();

    $aRec = array();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.contabilium.com/api/ordenesVenta',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "idCliente": "'.$id_cliente.'",
            "fechaEmision": "'.$fecha.'",
            "observaciones": "'.$obs.'",
            "bonificacionGlobal": '.$bon.',
            "condicionVenta": "'.$condventa.'",
            "total": '.$total.',
            "items": '.$json_items.'
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
            
        )
    ));

    $response = curl_exec($curl);

    echo $response; die;
    $aRec = json_decode($response, true);

    return $aRec;

}

function contabilium_createcliente($token, $razsoc, $condiva, $tipodoc, $nrodoc, $id_pais, $id_provincia, $domicilio, $email = '', $telefono = ''){

    // Los parámetros obligatiorios son:razonSocial, condicionIva, tipoDoc, nroDoc, idPais, idProvincia y domicilio
    // condicionIva = RI, MO, EX, CF
    // 

    $curl = curl_init();

    $aRec = array();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest.contabilium.com/api/clientes',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "Id": 0,
            "RazonSocial": "'.$razsoc.'",
            "CondicionIva": "'.$condiva.'",
            "TipoDoc": "'.$tipodoc.'",
            "NroDoc": "'.$nrodoc.'",
            "Domicilio": "'.$domicilio.'",
            "Telefono": "'.$telefono.'",
            "Email": "'.$email.'",
            "IdPais": '.$id_pais.',
            "IdProvincia": '.$id_provincia.'
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
            
        )
    ));

    $response = curl_exec($curl);

    echo $response; die;
    $aRec = json_decode($response, true);

    return $aRec;

}

function contabilium_clientes($token){

    $curl = curl_init();

    $aRec = array();

    for($k=1; $k<500; $k++){

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.contabilium.com/api/clientes/search?filtro=&page='.$k,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            )
        ));

        $response = curl_exec($curl);
        $res = json_decode($response, true);

        if(isset($res['Items'][0])){
            foreach($res['Items'] as $item){
                $aRec[$item['Id']] = $item;
            }
        } else {
            $k = 500;
        }

    }

    return $aRec;    

}

?>