<?
function soscontador_registro(){

    if(!isset($_SESSION['soscontador_token'])){

                $curl = curl_init();

                // Autorización
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/login',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "usuario": "sabrina@transparent.com.ar",
                        "password": "JQ5087"
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                $file = "../logs/soscontador.log";
                $logmax = date("Y-m-d H:i:s").";token-login;".$response."\n";
                $logmax = $logmax."\n"."URL: /apiv2/login"."\n\n";
                file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);

                $aRes = json_decode($response, true);

                // Obtenemos los datos.
                $access_token = $aRes['jwt'];
                $id_usuario = $aRes['idusuario'];
                $id_cuit = $aRes['cuits'][0]['id'];

                // Obtenemos el token_cuit
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/cuit/credentials/'.$id_cuit,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$access_token
                    ),
                ));
                
                $response = curl_exec($curl);

                $file = "../logs/soscontador.log";
                $logmax = date("Y-m-d H:i:s").";token-cuit;".$response."\n";
                $logmax = $logmax."\n"."URL: /apiv2/login"."\n\n";
                file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);
                
                $aRes = json_decode($response, true);

                $token_cuit = $aRes['jwt'];

                $_SESSION['soscontador_token'] = $token_cuit;

    }
        
}

function soscontador_productos(){

    if(!isset($_SESSION['soscontador_productos'])){

            $curl = curl_init();

            soscontador_registro();

            $token_cuit = $_SESSION['soscontador_token'];

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/producto/listado',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token_cuit
                ),
            ));
        
            $response = curl_exec($curl);

            $aRes = json_decode($response, true);

            $aProductos = $aRes;

            if(isset($aProductos['items'][0])){
                $_SESSION['soscontador_productos'] = $aProductos['items'];
                return $aProductos['items'];
            } else {
                return false;
            }

    } else {
        return $_SESSION['soscontador_productos'];
    }

}

function soscontador_clientes(){

        $curl = curl_init();

        soscontador_registro();

        $token_cuit = $_SESSION['soscontador_token'];

        $aClientes = array();

        for($k=1; $k < 100; $k++){

                 curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/cliente/listado?proveedor=true&cliente=true&registros=50&pagina='.$k,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer '.$token_cuit
                        ),
                ));
            
                $response = curl_exec($curl);
                
                $aRes = json_decode($response, true);
                
                if(isset($aRes['items'][0])){
                    foreach($aRes['items'] as $item){
                        $aClientes[] = $item;
                    }
                } else {
                    $k = 100;
                }
        }

        if(isset($aClientes[0])){
            return $aClientes;
        } else {
            return false;
        }
  
}

function soscontador_grabarfactura($json, $sos_idfactura = 0){

        $curl = curl_init();

        soscontador_registro();

        $token_cuit = $_SESSION['soscontador_token'];

        if($sos_idfactura > 0){
            $url = 'https://soft.sos-contador.com/apiv2/venta/'.$sos_idfactura;
        } else {
            $url = 'https://soft.sos-contador.com/apiv2/venta';
        }
       
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token_cuit
            ),
        ));
    
      $response = curl_exec($curl);

        $file = "log_soscontador_todas.txt";
        $logmax = date("Y-m-d H:i:s").";grabarfactura;".$response."\n";
        $logmax = $logmax."\n"."URL: ".$url."\n".$json."\n\n";
        file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);

      $aRes = json_decode($response, true);

      // Si existe el id y si es mayor a 0, es que se grabo correctamente.
      if(isset($aRes['id']) && $aRes['id'] > 0){
        return $aRes;
      } else {
        $file = "../logs/soscontador.log";
        $logmax = date("Y-m-d H:i:s").";grabarfactura;".$response."\n";
        $logmax = $logmax."\n"."URL: ".$url."\n".$json."\n\n";
		file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);
        return $response;
      }
  

}

function soscontador_grabarcliente($sos_idcliente, $cuit, $nombre, $id_provincia, $condicion, $email, $domicilio){

    $curl = curl_init();

    soscontador_registro();

    $nombre = str_replace('"', '', $nombre);
    $nombre = str_replace(',', '', $nombre);

    $token_cuit = $_SESSION['soscontador_token'];

    $aPostFields = array(
        'cuit' => $cuit,
        'clipro' => $nombre,
        'idprovincia' => $id_provincia,
        'domicilio' => $domicilio,
        'idtipocondicioniva' => $condicion,
        'email' => $email
    );
    
    $jsonPostFields = json_encode($aPostFields);

    if(!$sos_idcliente){

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/cliente',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonPostFields,
                CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token_cuit
                ),
            ));
        
            $response = curl_exec($curl);

            $aRes = json_decode($response, true);

            $file = "../logs/soscontador.log";
            $logmax = date("Y-m-d H:i:s").";insertarnuevocliente;".$response."\n";
            $logmax = $logmax."\n -- ".$jsonPostFields;
            $logmax = $logmax."\n====================\n";
            file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);

            if(isset($aRes['id'])){
                return $aRes['id'];
            } else {
                return false;
            }

    } else {
        // Modificar en SOS

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/cliente/'.$sos_idcliente,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => $jsonPostFields,
                CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token_cuit
                ),
            ));
        
            $response = curl_exec($curl);

            $aRes = json_decode($response, true);

            $file = "../logs/soscontador.log";
            $logmax = date("Y-m-d H:i:s").";modificarcliente;".$response."\n";
            $logmax = $logmax."\nid_cliente: ".$sos_idcliente." - ".$jsonPostFields;
            $logmax = $logmax."\n====================\n";
            file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);

            if(isset($aRes['id'])){
                return $aRes['id'];
            } else {
                return false;
            }


    }


}

function soscontador_bajarfactura($id, $file){

    $curl = curl_init();

    soscontador_registro();

    $token_cuit = $_SESSION['soscontador_token'];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/venta/pdf/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Authorization: Bearer '.$token_cuit
        ),
    ));
  
    $response = curl_exec($curl);

    // Verificar si es un PDF
    if (substr($response, 0, 4) != "%PDF") {
        $file = "../logs/soscontador.log";
        $logmax = date("Y-m-d H:i:s").";soscontador_bajarfactura;".$response."\n";
        $logmax = $logmax."\nid_factura: ".$id."\n\n";
        file_put_contents($file, $logmax, FILE_APPEND | LOCK_EX);
        return false;
    } else {
        file_put_contents('webfiles/super/facturas/'.$file, $response);
        return true;
    }
    
}

function soscontador_facturadetalle($id){

    $curl = curl_init();

    soscontador_registro();

    $token_cuit = $_SESSION['soscontador_token'];
      
    // Ventas Detalle
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/venta/detalle/'.$id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$token_cuit
    ),
    ));

    $response = curl_exec($curl);
    
    $aRes = json_decode($response, true);

    return $aRes;
}

function soscontador_ventas(){

    // Max execution time 30 segs.
    ini_set('max_execution_time', 30);

    $curl = curl_init();

    soscontador_registro();

    $token_cuit = $_SESSION['soscontador_token'];

    $aVentas = array();

    for($k=1; $k < 400; $k += 49){

            if($k > 1){
                $pag = $k;
            } else {
                $pag = 1;
            }

            curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/venta/listado/facturas/mes/todas/?pagina='.$pag,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token_cuit
                    ),
            ));
        
            $response = curl_exec($curl);
            
            $aRes = json_decode($response, true);
            
            if(isset($aRes['items'][0])){
                foreach($aRes['items'] as $item){
                    $aVentas[] = $item;
                }
            } else {
                $k = 400;
            }
    }

    if(isset($aVentas[0])){
        return $aVentas;
    } else {
        return false;
    }

}

function soscontador_ventas_mes_anterior(){

    // Max execution time 30 segs.
    ini_set('max_execution_time', 30);
    
    $curl = curl_init();

    soscontador_registro();

    $token_cuit = $_SESSION['soscontador_token'];

    $aVentas = array();

    for($k=1; $k < 400; $k += 49){

            if($k > 1){
                $pag = $k;
            } else {
                $pag = 1;
            }

            curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/venta/listado/facturas/mes_anterior/todas/?pagina='.$pag,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token_cuit
                    ),
            ));
        
            $response = curl_exec($curl);
            
            $aRes = json_decode($response, true);
            
            if(isset($aRes['items'][0])){
                foreach($aRes['items'] as $item){
                    $aVentas[] = $item;
                }
            } else {
                $k = 400;
            }
    }

    //echo "<pre>"; print_r($aVentas); die;

    if(isset($aVentas[0])){
        return $aVentas;
    } else {
        return false;
    }
   
}

function soscontador_borrarventa($id_fac){

            $curl = curl_init();

            soscontador_registro();

            $token_cuit = $_SESSION['soscontador_token'];

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://soft.sos-contador.com/apiv2/venta/'.$id_fac,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token_cuit
                ),
            ));
        
            $response = curl_exec($curl);

            return $response;  

}
?>