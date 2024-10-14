<?
function ChequearSession($nombre){
  if(!isset($_SESSION[$nombre])){
    header('location: ./');
    die;
  }
}

function formatearNumeroWhatsApp($numero) {
  // Eliminar espacios, guiones y otros símbolos comunes
  $numeroLimpio = preg_replace('/[\s\-\(\)]+/', '', $numero);

  // Asegúrate de que el número comience con '+'
  if(substr($numeroLimpio, 0, 1) !== '+') {
      $numeroLimpio = '+' . $numeroLimpio;
  }

  return $numeroLimpio;
}

function CodigoProvinciaArgentina($provincia){
  // Según la norma ISO 3166-2:AR
  // https://es.wikipedia.org/wiki/ISO_3166-2:AR

  $aCodigos = array('BUENOS AIRES' => 'AR-B', 'SALTA' => 'AR-A', 'CAPITAL FEDERAL' => 'AR-C', 'SAN LUIS' => 'AR-D',
  'ENTRE RIOS' => 'AR-E', 'LA RIOJA' => 'AR-F', 'SANTIAGO DEL ESTERO' => 'AR-G', 'TUCUMAN' => 'AR-T', 'CHACO' => 'AR-H',
  'CHUBUT' => 'AR-U', 'FORMOSA' => 'AR-P', 'MENDOZA' => 'AR-M', 'LA PAMPA' => 'AR-L', 'RIO NEGRO' => 'AR-R',
  'MISIONES' => 'AR-N', 'SANTA FE' => 'AR-S', 'CORDOBA' => 'AR-X', 'JUJUY' => 'AR-Y', 'SANTA CRUZ' => 'AR-Z',
  'SAN JUAN' => 'AR-J', 'CATAMARCA' => 'AR-K', 'NEUQUEN' => 'AR-Q', 'TIERRA DEL FUEGO' => 'AR-V', 'CORRIENTES' => 'AR-W');

  return $aCodigos[strtoupper($provincia)];
}
function CotizacionBitcoin(){

  $oPro = new Productos();
  $instancia = $_SESSION['instancia'];

  $proveedor = 'bitex';

  // Obtengo la cotización muy fresca.
  $aFile = file_get_contents('https://criptoya.com/api/'.$proveedor.'/btc/usd'); 
  $aRes = json_decode($aFile, true);

  if(isset($aRes['ask'])){
    // Devuelvo la cotización fresca.
    return $aRes['ask'];

  } else {

    // Busco la última guardada.
    $oPro->DB('transpar_super');
    $aRec = $oPro->SQLSelect("SELECT * FROM bitcoin WHERE proveedor = '{$proveedor}' ORDER BY id_bitcoin DESC LIMIT 1");

    $oPro->DB('transpar_'.$instancia);

    if($aRec[0]['ask']){
      return $aRec[0]['ask'];
    } else {
      return 0;
    }

  }

}

function CotizacionDolar($tipo = "blue"){
  
  // NUEVOS CAMPOS: ALTER TABLE `dolar` ADD `oficial` DECIMAL(10,2) NULL AFTER `cotiza`, ADD `solidario` DECIMAL(10,2) NULL AFTER `oficial`, ADD `mep` DECIMAL(10,2) NULL AFTER `solidario`, ADD `ccl` DECIMAL(10,2) NULL AFTER `mep`, ADD `ccb` DECIMAL(10,2) NULL AFTER `ccl`, ADD `blue` DECIMAL(10,2) NULL AFTER `ccb`, ADD `time` INT(16) NULL AFTER `blue`;

  $oPro = new Productos();
  $instancia = $_SESSION['instancia'];

  $oPro->DB('transpar_super');
  $aRec = $oPro->SQLSelect('SELECT * FROM dolar ORDER BY id_dolar DESC LIMIT 1');

  $oPro->DB('transpar_'.$instancia);

  if($tipo == 'blue'){
    return $aRec[0]['blue'];
  } else {
    return $aRec[0]['cotiza'];
  }
  

}

function TicketsPendientes(){

  $oPro = new Productos();
  $instancia = $_SESSION['instancia'];

  $oPro->DB('transpar_super');
  $aRec = $oPro->SQLSelect("SELECT count(*) as total FROM tickets WHERE instancia = '{$instancia}' AND estado = 'abierto' AND id_padre = 0 AND label = 'esperando respuesta'");

  $oPro->DB('transpar_'.$instancia);

  if($aRec[0]['total']){
      return $aRec[0]['total'];
  } else {
      return 0;
  }
  
}

// Function función sencilla para comparar los permisos.
function Permisos($permiso, $credenciales){
  $aCred = json_decode(stripslashes($credenciales), true);

    foreach($aCred as $val){
        if(strpos($val, $permiso) !== false){
            return true;
        }
    }

    return false;
}


// Obtiene encabezados de urls.
function get_http_response_code($url) {
  $headers = get_headers($url);
  return substr($headers[0], 9, 3);
}

function FechaToTimestamp($fecha, $hora = "00:00"){

  if(strpos($fecha, " ")){
    // Formato completo (Ej: 2021-06-16 23:04:02).
    $aFechaHora = explode(" ", $fecha);  
    $aFec = explode("-", $aFechaHora[0]);
    $aHora = explode(":", $aFechaHora[1]);
    return mktime($aHora[0],$aHora[1],$aHora[2],$aFec[1],$aFec[2],$aFec[0]);

  } else {

    $aFec = explode("-", $fecha);
    $aHora = explode(":", $hora);
    return mktime($aHora[0],$aHora[1],0,$aFec[1],$aFec[2],$aFec[0]);

  }

}

function Fecha($fecha, $opcionDia = false){

  $aDias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');

  if($fecha){
      if(strlen($fecha) == 10){
        $aFecha = explode("-", $fecha);
        $timestamp = mktime(0, 0, 0, $aFecha[1], $aFecha[2], $aFecha[0]);
        $dia = date("N", $timestamp);

        if($opcionDia){
          return $aDias[$dia]." ".date("d/m/Y", $timestamp);
        } else {
          return date("d/m/Y", $timestamp);
        }
      }

      if(strlen($fecha) > 10){
        $aFechaHora = explode(" ", $fecha);
        $aFecha = explode("-", $aFechaHora[0]);
        $aHora = explode(":", $aFechaHora[1]);

        $timestamp = mktime($aHora[0], $aHora[1], $aHora[2], $aFecha[1], $aFecha[2], $aFecha[0]);

        $dia = date("N", $timestamp);

        if($opcionDia){
          return $aDias[$dia]." ".date("d/m/Y H:i", $timestamp);
        } else {
          return date("d/m/Y", $timestamp);
        }
      }

  }

  return $fecha;

} // FIN Fecha.

function TimeToFecha($timestamp, $opcionDia = false){

  if($timestamp){

  $aDias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo');

  $dia = date("N", $timestamp);

  if($opcionDia){
    return $aDias[$dia]." ".date("d/m/Y", $timestamp);
  } else {
    return date("d/m/Y", $timestamp);
  }

  } else {
    return 0;
  }

} // FIN TimeToFecha.


// Calcular envio OCA
// Cuit de prueba Fer Cuadrado: 20-27498523-3
// Cuit de Magneto SRL: 30-70968097-4
function CalcularEnvio($cporigen, $cpdestino, $peso, $vol, $paquetes, $valor, $cuit = '20-27498523-3', $operativa = '321780'){

  /************************************
   *  321780 PUERTA A PUERTA
   *  321784 PUERTA A SUCURSAL
   *  321785 SUCURSAL A PUERTA
   *  321787 SUCURSAL A SUCURSAL
   ************************************/

   /****
    * Codigo postal origen Ej: 2000 id="cporigen"
    * Codigo postal destino Ej: 1000 id="cpdestino"
    * Peso (Kg) Ej: 0.5 id="peso"
    * Volumen (M3) Ej: 0.05 id="vol"
    * Cantidad de paquetes Ej: 1 id="paquetes
    * Valor total $ Ej: 3900 id="valor"
    */

  $soapUrl = "http://webservice.oca.com.ar/epak_tracking/Oep_TrackEPak.asmx";

  $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
  <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
    <soap12:Body>
      <Tarifar_Envio_Corporativo xmlns="#Oca_e_Pak">
        <PesoTotal>'.$peso.'</PesoTotal>
        <VolumenTotal>'.$vol.'</VolumenTotal>
        <CodigoPostalOrigen>'.$cporigen.'</CodigoPostalOrigen>
        <CodigoPostalDestino>'.$cpdestino.'</CodigoPostalDestino>
        <CantidadPaquetes>'.$paquetes.'</CantidadPaquetes>
        <ValorDeclarado>'.$valor.'</ValorDeclarado>
        <Cuit>'.$cuit.'</Cuit>
        <Operativa>'.$operativa.'</Operativa>
      </Tarifar_Envio_Corporativo>
    </soap12:Body>
  </soap12:Envelope>';

  $headers = array(
  "Content-Type: text/xml; charset=utf-8",
  "SOAPAction: #Oca_e_Pak/Tarifar_Envio_Corporativo",
  "Connection: close",
  "Content-Length: ".strlen($xml_post_string)
  );

  $ch = curl_init($soapUrl);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

  $response = curl_exec($ch);
  curl_close($ch);

  $response = html_entity_decode($response);

  $eliminar1 = '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Tarifar_Envio_CorporativoResponse xmlns="#Oca_e_Pak"><Tarifar_Envio_CorporativoResult><xs:schema id="NewDataSet" xmlns="" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata"><xs:element name="NewDataSet" msdata:IsDataSet="true" msdata:Locale=""><xs:complexType><xs:choice minOccurs="0" maxOccurs="unbounded"><xs:element name="Table"><xs:complexType><xs:sequence><xs:element name="Tarifador" type="xs:int" minOccurs="0" /><xs:element name="Precio" type="xs:decimal" minOccurs="0" /><xs:element name="idTiposervicio" type="xs:int" minOccurs="0" /><xs:element name="Ambito" type="xs:string" minOccurs="0" /><xs:element name="PlazoEntrega" type="xs:int" minOccurs="0" /><xs:element name="Adicional" type="xs:decimal" minOccurs="0" /><xs:element name="Total" type="xs:decimal" minOccurs="0" /><xs:element name="XML" type="xs:string" minOccurs="0" /></xs:sequence></xs:complexType></xs:element></xs:choice></xs:complexType></xs:element></xs:schema><diffgr:diffgram xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1"><NewDataSet xmlns=""><Table diffgr:id="Table1" msdata:rowOrder="0">';

  $xmlstr = str_replace($eliminar1, "<response>", $response);

  $ini = strpos($xmlstr, '<XML>');
  $fin = strpos($xmlstr, '</soap:Envelope>');

  $eliminar2 = substr($xmlstr, $ini, $fin);

  $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);

  //echo $xmlstr; die;

  $xml = simplexml_load_string($xmlstr);
  $json = json_encode($xml);
  $array = json_decode($json,TRUE);

  if(!isset($array['Total'])){
    echo "Error de API de OCA<br /><br />Response:<br />";
    echo $response;
    die;
  }

  return $array;

}


// Calcular envio CRUZ DEL SUR
function CalcularEnvioCruzDelSur($x, $y, $z, $peso, $codpos, $valor){

  $idcliente = Configuracion::ObtenerValor('envio_cruzdelsur_idcliente');
  $ulogin = Configuracion::ObtenerValor('envio_cruzdelsur_ulogin');
  $uclave = Configuracion::ObtenerValor('envio_cruzdelsur_uclave');

  $ancho = $z;
  $largo = $x;
  $alto = $y;
  $peso = $peso;
  $codigopostal = $codpos;
  $valor = $valor;

  $cUrl = "https://api-ventaenlinea.cruzdelsur.com//api/NuevaCotXMed?idcliente={$idcliente}&ancho={$ancho}&largo={$largo}&alto={$alto}&peso={$peso}&codigopostal={$codigopostal}&localidad=&valor={$valor}&contrareembolso=&ulogin={$ulogin}&uclave={$uclave}&items=&despacharDesdeDestinoSiTieneAlmacenamiento=N";

  // Obtener contenido de la URL y pasarlo a JSON
  $curlSession = curl_init();
  curl_setopt($curlSession, CURLOPT_URL, $cUrl);
  curl_setopt($curlSession, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

  $res = curl_exec($curlSession);
  curl_close($curlSession);

  $aRes = json_decode($res, true);

  //echo "<pre>"; print_r($aRes); die;

  return $aRes;

}

// Calcular envio ENVIOPACK
function CalcularEnvioEnviopack($x, $y, $z, $peso, $codpos, $codprovincia){

  $apikey = Configuracion::ObtenerValor('envio_enviopack_apikey');
  $secret = Configuracion::ObtenerValor('envio_enviopack_secret');

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, 'https://api.enviopack.com/auth');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "api-key={$apikey}&secret-key={$secret}");
  
  $headers = array();
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
  $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  } else {
      $aToken = json_decode($result, true);
  }
  
  $access_token = $aToken['token'];
  
  curl_close($ch);
  
  $cUrl = "https://api.enviopack.com/cotizar/costo?access_token=".$access_token."&provincia=".$codprovincia."&codigo_postal=".$codpos."&peso=".$peso."&paquetes=".$x."x".$y."x".$z."&modalidad=D";
  
  // Obtener contenido de la URL y pasarlo a JSON
  $curlSession = curl_init();
  curl_setopt($curlSession, CURLOPT_URL, $cUrl);
  curl_setopt($curlSession, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
  
  $res = curl_exec($curlSession);
  curl_close($curlSession);
  
  $aRes = json_decode($res, true);
  
  //echo "<pre>"; print_r($aRes); die;

  return $aRes;

}

function CalcularEnvioShipnow($peso, $codpos){

  $token = Configuracion::ObtenerValor('shipnow_token');

  $url = 'https://api.shipnow.com.ar/shipping_options';
  $weight = ($peso * 1000); // Peso del paquete (en gramos) (En el Panel se cargan Kg)
  $zip_code = $codpos; // Código postal
  $types = 'ship_pap,ship_pas'; // Tipo de envío

  // Combinar los parámetros con la URL
  $fullUrl = "$url?weight=$weight&to_zip_code=$zip_code&types=$types";

  $ch = curl_init($fullUrl);

  $headers = array(
      'Authorization: Bearer '.$token
  );

  curl_setopt($ch, CURLOPT_HTTPGET, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }

  // Log shipnow.
  $msj = "FECHA: ".date('d/m/Y H:i:s')."\n";
  $msj .= "URL: ".$fullUrl."\n";
  $msj .= "RESPONSE: ".$response."\n";
  $msj .= "---------------------------------------------\n";
  file_put_contents('/home/transpar/public_html/logs/shipnow_'.$_SESSION['instancia'].'.log', $msj, FILE_APPEND);

  $aRec = json_decode($response, true);

  //echo "<pre>"; print_r($aRec); echo "</pre>";
  /****
   * Array
(
    [results] => Array
        (
            [0] => Array
                (
                    [minimum_delivery] => 2023-08-18T09:00:00.000-03:00
                    [maximum_delivery] => 2023-08-22T18:00:00.000-03:00
                    [price] => 2575.43
                    [tax_price] => 3116.27
                    [ship_from_type] => Warehouse
                    [ship_from] => Array
                        (
                            [id] => 1
                            [name] => Shipnow Estrella
                            [operation_from_hour] => 06:00
                            [operation_to_hour] => 23:59
                            [operation_only_workdays] => 1
                            [drop_off_point] => 
                            [pickup_point] => 1
                            [type] => warehouse
                        )

                    [ship_to_type] => 
                    [ship_to] => 
                    [shipping_contract] => Array
                        (
                            [id] => 8276
                            [status] => active
                            [account] => Array
                                (
                                    [id] => 1
                                )

                            [shipping_service] => Array
                                (
                                    [id] => 54
                                )

                        )

                    [shipping_service] => Array
                        (
                            [id] => 54
                            [code] => shipnow_pap
                            [description] => Shipnow - Entrega puerta a puerta
                            [type] => ship_pap
                            [mode] => delivery
                            [category] => economic
                            [carrier] => Array
                                (
                                    [code] => shipnow
                                    [description] => Envíos a CABA. Puerta a Puerta
                                    [flexible_dispatching] => 
                                    [id] => 12
                                    [image_url] => 
                                    [name] => Shipnow
                                    [tracking_url] => https://www.shipnow.com.ar/track
                                )

                        )

                )

            [1] => Array
                (
                    [minimum_delivery] => 2023-08-18T09:00:00.000-03:00
                    [maximum_delivery] => 2023-08-25T18:00:00.000-03:00
                    [price] => 1953.38
                    [tax_price] => 2363.59
                    [ship_from_type] => Warehouse
                    [ship_from] => Array
                        (
                            [id] => 1
                            [name] => Shipnow Estrella
                            [operation_from_hour] => 06:00
                            [operation_to_hour] => 23:59
                            [operation_only_workdays] => 1
                            [drop_off_point] => 
                            [pickup_point] => 1
                            [type] => warehouse
                        )

                    [ship_to_type] => PostOffice
                    [ship_to] => Array
                        (
                            [id] => 4806
                            [external_reference] => 
                            [external_id] => 1664
                            [description] => ROSARIO CI 2
                            [pickup_point] => 1
                            [drop_off_point] => 1
                            [address] => Array
                                (
                                    [zip_code] => 2000
                                    [street_name] => CORRIENTES
                                    [street_number] => 631
                                    [city] => ROSARIO
                                    [state] => SANTA FE
                                    [floor] => 
                                    [unit] => 
                                    [name] => 
                                    [last_name] => 
                                    [full_name] => 
                                    [phone] => 0341-999999999
                                    [email] => 
                                    [lon] => -60.6417291
                                    [lat] => -32.9436406
                                    [doc_type] => 
                                    [doc_number] => 
                                    [line] => 
                                    [address_line] => CORRIENTES 631
                                    [country] => Array
                                        (
                                            [name] => Argentina
                                            [code] => AR
                                        )

                                )

                        )

                    [shipping_contract] => Array
                        (
                            [id] => 111
                            [status] => active
                            [account] => Array
                                (
                                    [id] => 1
                                )

                            [shipping_service] => Array
                                (
                                    [id] => 18
                                )

                        )

                    [shipping_service] => Array
                        (
                            [id] => 18
                            [code] => oca_pas_estandar
                            [description] => OCA Puerta a Sucursal - Estandar
                            [type] => ship_pas
                            [mode] => delivery
                            [category] => economic
                            [carrier] => Array
                                (
                                    [code] => oca
                                    [description] => Envíos a todo el país. Puerta a Puerta y Sucursal
                                    [flexible_dispatching] => 
                                    [id] => 2
                                    [image_url] => 
                                    [name] => OCA
                                    [tracking_url] => https://www9.oca.com.ar/OEPTrackingWeb/detalleenviore.asp?numero=
                                )

                        )

                )
   */

  curl_close($ch);

  return $aRec;

}


// Bloqueador de IPs :. .: Seguridad :. Fernando Cuadrado .: Tu eres atrevida, hablaste mucho pero no tienes salida. Que Tire Pa. Daddy Yanki.
function BloquearIP($nota = ""){

  $ip = $_SERVER['REMOTE_ADDR'];

  // Guardar la ip en el archivo de bloqueos.
  $msj = $ip."\n";
  error_log($msj, 3, "ip_bloqueadas.txt");

  // Crea el email para reportar.
  
  $headers = "From: no-reply@transparent.com.ar"."\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  $body = date("d/m/Y H:i:s")."<br />IP: ".$ip."<br />";

  if(isset($_SESSION['instancia'])){
    $body .= "INSTANCIA: ".$_SESSION['instancia']."<br />";	
  }

  if($nota){
    $body .= "<strong>".$nota."</strong><br />";
  }
  
  return mail("fernando@transparent.com.ar", "Nueva IP bloqueada", $body, $headers);

}

// Función para limpiar los datos, sacarle comillas.
function Sanear($str){
  $str = strip_tags($str);
  $str = str_replace('"', '', $str);
  $str = str_replace("'", "", $str);
  return $str;
}

function UrlMorph($str){
  // Esta es creada por mi, para transformar cualquier cosa en formato url. Fer .: The Earth is Flat.
  $str = str_replace(" ", "-", $str);
  $str = str_replace("ñ", "n", $str);
  $str = str_replace("Ñ", "n", $str);
  $str = str_replace("á", "a", $str);
  $str = str_replace("é", "e", $str);
  $str = str_replace("í", "i", $str);
  $str = str_replace("ó", "o", $str);
  $str = str_replace("ú", "u", $str);
  $str = str_replace("Á", "a", $str);
  $str = str_replace("É", "e", $str);
  $str = str_replace("Í", "i", $str);
  $str = str_replace("Ó", "o", $str);
  $str = str_replace("Ú", "u", $str);
  $str = strtolower($str);
  $str = str_replace("-----", "-", $str);
  $str = str_replace("----", "-", $str);
  $str = str_replace("---", "-", $str);
  $str = str_replace("--", "-", $str);
  return Sanitizar($str);
}

function Sanitizar($str, $regla = "/[^-A-Za-z0-9]/"){
      // De cualquier cosa que haya en la cadena, deja únicamente: letras y números y - (guión medio).
      // regla: /[^-_A-Za-z0-9?!]/
      // Mejor sacamos los _ ? y !... 
      // https://stackoverflow.com/questions/7059543/php-filter-with-preg-replace-allow-only-letters

			$new_string = preg_replace($regla,'',$str);
			return $new_string;
}

// Función para verificación de ReCaptcha.
function verifyReCaptcha($recaptchaCode, $secret = ''){

  $secret = $_SESSION['google_recaptcha']['secret'];

  $postdata = http_build_query(["secret"=>$secret,"response"=>$recaptchaCode]);
  $opts = ['http' =>
      [
          'method'  => 'POST',
          'header'  => 'Content-type: application/x-www-form-urlencoded',
          'content' => $postdata
      ]
  ];
  $context  = stream_context_create($opts);
  $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
  $check = json_decode($result);
  return $check->success;
  
}

function linkify($value, $protocols = array('http', 'mail'), array $attributes = array('target' => 'blank')){
  // Link attributes
  $attr = '';
  foreach ($attributes as $key => $val) {
      $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
  }

  $links = array();

  // Extract existing links and tags
  $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

  // Extract text links for each protocol
  foreach ((array)$protocols as $protocol) {
      switch ($protocol) {
          case 'http':
          case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value); break;
          case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
          case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;
          default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
      }
  }

  // Insert all link
  return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
}

?>