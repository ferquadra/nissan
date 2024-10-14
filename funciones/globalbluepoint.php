
<?
// SalesOrder
// https://ws.globalbluepoint.com/torikos/app_webservices/wsSaleOrder.asmx
// Seguir los pasos, primero se obtiene un ID que abre la operación, luego se añaden los productos y se cierra la operación. Se utilizan 3 ws, ver en la doc.

/***********************************************************************************
 strTaxNumberType

1           CUIT
2           CUIL
3           LIBRETA DE ENROLAMIENTO
4           LIBRETA CIVICA
5           DNI
6           PASAPORTE
7           CEDULA DE IDENTIDAD - Capital Federal
8           SIN CALIFICAR
9           CDI
10          CI Extranjera
11          Documentación en Tramite
12          Acta de Nacimiento
21          CUIT - II
25          DNI - II
31          CUIT - III
41          CUIT - IV
51          CUIT - V (S/V)

strFiscalClass: 

1           Arg. I.V.A. Responsable Inscripto
2           Arg. Consumidor Final
3           Arg. Monotributista
4           Arg. I.V.A. Exento
7           Arg. No Responsable
8           Arg. Monotributista Social
9           Arg. Pequeño Contribuyente Eventual
13          Arg. Pequeño Contribuyente Eventual Social
14          Arg. No Categorizado
15          Arg. Tierra del Fuego + EXTERIOR
16          Arg. Tierra del Fuego + Comprobantes A

strCountry : 54 – Argentina
strState   :

54001       Córdoba
54002       Mendoza
54003       Tucumán
54004       Entre Ríos
54005       Corrientes
54006       Santiago del Estero
54007       Jujuy
54008       San Juan
54009       Río Negro
54010       Formosa
54011       Neuquén
54012       Chubut
54013       San Luis
54014       Catamarca
54015       La Rioja
54016       La Pampa
54017       Santa Cruz
54018       Tierra del Fuego
54019       Ciudad Autónoma de Buenos Aires
54020       Buenos Aires
54021       Misiones
54022       Chaco
54023       Salta
54024       Santa Fé

*************************************************************************************/

function Gbp_ObtieneToken(){

    $carpeta = Configuracion::ObtenerValor('globalbluepoint_usuario');

    $soapUrl = "http://ws.globalbluepoint.com/".$carpeta."/app_webservices/wsBasicQuery.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Header>
        <wsBasicQueryHeader xmlns="http://microsoft.com/webservices/">
          <pUsername>truser</pUsername>
          <pPassword>1234</pPassword>
          <pCompany>1</pCompany>
          <pWebWervice>1000</pWebWervice>
          <pAuthenticatedToken></pAuthenticatedToken>
        </wsBasicQueryHeader>
      </soap:Header>
      <soap:Body>
        <AuthenticateUser xmlns="http://microsoft.com/webservices/" />
      </soap:Body>
    </soap:Envelope>';

    $headers = array(
    "Content-Type: text/xml; charset=ISO-8859-1",
    "Host: ws.globalbluepoint.com",
    "SOAPAction: http://microsoft.com/webservices/AuthenticateUser",
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

    //echo $response; die;
  
    $eliminar1 = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><AuthenticateUserResponse xmlns="http://microsoft.com/webservices/"><AuthenticateUserResult>';
  
    $xmlstr = str_replace($eliminar1, "<response>", $response);
  
    $eliminar2 = "</AuthenticateUserResult></AuthenticateUserResponse></soap:Body></soap:Envelope>";
  
    $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);
    
    $xml = simplexml_load_string($xmlstr);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    // Log de Global Blue Point
    $msj = "\n============================================================\n";
    $msj .= date('Y-m-d H:i:s')."\n";
    $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
    $msj .= "SoapUrl: ".$soapUrl."\n";
    $msj .= "Postfields: ".$xml_post_string."\n";
    $msj .= "Response: ".$response."\n";
    $filelog = 'globalbluepoint.log';
    if(isset($_SESSION['instancia'])){
      $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
    }

    if(ADMIN){
      file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    }
    // Fin log Global Blue Point.

    return $array[0];
}


function Gbp_Customers_funGetXMLData(){

    $carpeta = Configuracion::ObtenerValor('globalbluepoint_usuario');

    $soapUrl = "http://ws.globalbluepoint.com/".$carpeta."/app_webservices/wsBasicQuery.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Header>
        <wsBasicQueryHeader xmlns="http://microsoft.com/webservices/">
          <pUsername>truser</pUsername>
          <pPassword>1234</pPassword>
          <pCompany>1</pCompany>
          <pWebWervice>1000</pWebWervice>
          <pAuthenticatedToken>'.$_SESSION['token'].'</pAuthenticatedToken>
        </wsBasicQueryHeader>
      </soap:Header>
      <soap:Body>
        <Customers_funGetXMLData xmlns="http://microsoft.com/webservices/">
            <pbra_id>1</pbra_id>
            <pcust_id>-1</pcust_id>
            <ppage_number>1</ppage_number>
        </Customers_funGetXMLData>
      </soap:Body>
    </soap:Envelope>';

    $headers = array(
      "Content-Type: text/xml; charset=ISO-8859-1",
      "Host: ws.globalbluepoint.com",
      "SOAPAction: http://microsoft.com/webservices/Customers_funGetXMLData",
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);

    $response = curl_exec($ch);
    curl_close($ch);

    $response = html_entity_decode($response);

    // Log de Global Blue Point
    $msj = "\n============================================================\n";
    $msj .= date('Y-m-d H:i:s')."\n";
    $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
    $msj .= "SoapUrl: ".$soapUrl."\n";
    $msj .= "Postfields: ".$xml_post_string."\n";
    $msj .= "Response: ".$response."\n";
    $filelog = 'globalbluepoint.log';
    if(isset($_SESSION['instancia'])){
      $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
    }
    if(ADMIN){
      file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    }
    // Fin log Global Blue Point.

    //echo $response; die;

    $eliminar1 = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Customers_funGetXMLDataResponse xmlns="http://microsoft.com/webservices/"><Customers_funGetXMLDataResult><NewDataSet>';

    $xmlstr = str_replace($eliminar1, "<response>", $response);

    $eliminar2 = "</NewDataSet></Customers_funGetXMLDataResult></Customers_funGetXMLDataResponse></soap:Body></soap:Envelope>";

    $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);

    //echo $xmlstr; die;

    $xml = simplexml_load_string($xmlstr);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    return $array['Table'];

}

function Gbp_Customers_setNEWCustomer($token, $aData){

  // ptaxnumbertype = 1 - CUIT / 5 - DNI
  $carpeta = Configuracion::ObtenerValor('globalbluepoint_usuario');

  $soapUrl = "https://ws.globalbluepoint.com/".$carpeta."/app_webservices/wsBasicQuery.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Header>
        <wsBasicQueryHeader xmlns="http://microsoft.com/webservices/">
          <pUsername>truser</pUsername>
          <pPassword>1234</pPassword>
          <pCompany>1</pCompany>
          <pWebWervice>1000</pWebWervice>
          <pAuthenticatedToken>'.$token.'</pAuthenticatedToken>
        </wsBasicQueryHeader>
      </soap:Header>
      <soap:Body>
        <Customers_setNEWCustomer xmlns="http://microsoft.com/webservices/">
          <pname>'.$aData['name'].'</pname>
          <pcountry>'.$aData['country'].'</pcountry>
          <pstate>'.$aData['state'].'</pstate>
          <paddress>'.$aData['address'].'</paddress>
          <pcity>'.$aData['city'].'</pcity>
          <pzip>'.$aData['zip'].'</pzip>
          <pfiscalclass>'.$aData['fiscalclass'].'</pfiscalclass>
          <ptaxnumbertype>'.$aData['taxnumbertype'].'</ptaxnumbertype>
          <ptaxnumber>'.$aData['taxnumber'].'</ptaxnumber>
          <pemail>'.$aData['email'].'</pemail>
          <pphone>'.$aData['phone'].'</pphone>
          <pnickname>'.$aData['nickname'].'</pnickname>
          <ppass1>'.$aData['pass1'].'</ppass1>
          <ppass2>'.$aData['pass2'].'</ppass2>
        </Customers_setNEWCustomer>
      </soap:Body>
    </soap:Envelope>';

    $headers = array(
      "Content-Type: text/xml; charset=utf-8",
      "Host: ws.globalbluepoint.com",
      "SOAPAction: http://microsoft.com/webservices/Customers_setNEWCustomer",
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);

    $response = curl_exec($ch);
    curl_close($ch);

    // Log de Global Blue Point
    $msj = "\n============================================================\n";
    $msj .= date('Y-m-d H:i:s')."\n";
    $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
    $msj .= "SoapUrl: ".$soapUrl."\n";
    $msj .= "Postfields: ".$xml_post_string."\n";
    $msj .= "Response: ".$response."\n";
    $filelog = 'globalbluepoint.log';
    if(isset($_SESSION['instancia'])){
      $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
    }
    if(ADMIN){
      file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    }
    // Fin log Global Blue Point.

    
  if (preg_match('/<Customers_setNEWCustomerResult>(\d+)<\/Customers_setNEWCustomerResult>/', $response, $matches)) {
    return $matches[1];
  } else {
    return 0;
  }

}

function Gbp_CustomersByTaxNumber_funGetXMLData($token, $nro){

  $carpeta = Configuracion::ObtenerValor('globalbluepoint_usuario');

  $soapUrl = "https://ws.globalbluepoint.com/".$carpeta."/app_webservices/wsBasicQuery.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Header>
        <wsBasicQueryHeader xmlns="http://microsoft.com/webservices/">
          <pUsername>truser</pUsername>
          <pPassword>1234</pPassword>
          <pCompany>1</pCompany>
          <pWebWervice>1000</pWebWervice>
          <pAuthenticatedToken>'.$token.'</pAuthenticatedToken>
        </wsBasicQueryHeader>
      </soap:Header>
      <soap:Body>
        <CustomersByTaxNumber_funGetXMLData xmlns="http://microsoft.com/webservices/">
          <strTaxNumber>'.$nro.'</strTaxNumber>
        </CustomersByTaxNumber_funGetXMLData>
      </soap:Body>
    </soap:Envelope>';

    $headers = array(
      "Content-Type: text/xml; charset=utf-8",
      "Host: ws.globalbluepoint.com",
      "SOAPAction: http://microsoft.com/webservices/CustomersByTaxNumber_funGetXMLData",
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);

    $response = curl_exec($ch);
    curl_close($ch);

    // Log de Global Blue Point
    $msj = "\n============================================================\n";
    $msj .= date('Y-m-d H:i:s')."\n";
    $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
    $msj .= "SoapUrl: ".$soapUrl."\n";
    $msj .= "Postfields: ".$xml_post_string."\n";
    $msj .= "Response: ".$response."\n";
    $filelog = 'globalbluepoint.log';
    if(isset($_SESSION['instancia'])){
      $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
    }
    if(ADMIN){
      file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
    }
    // Fin log Global Blue Point.

    $response = html_entity_decode($response);

    $eliminar1 = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><CustomersByTaxNumber_funGetXMLDataResponse xmlns="http://microsoft.com/webservices/"><CustomersByTaxNumber_funGetXMLDataResult><NewDataSet>';

    $xmlstr = str_replace($eliminar1, "<response>", $response);

    $eliminar2 = "</NewDataSet></CustomersByTaxNumber_funGetXMLDataResult></CustomersByTaxNumber_funGetXMLDataResponse></soap:Body></soap:Envelope>";

    $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);

    //echo $xmlstr; die;

    $xml = simplexml_load_string($xmlstr);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    return $array['Table'];
}

function Gbp_funGetData($token){

  $soapUrl = "https://ws.globalbluepoint.com/torikos/app_webservices/wsSaleOrder.asmx";

  $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Header>
      <wsSaleOrderHeader xmlns="http://microsoft.com/webservices/">
      <pUsername>truser</pUsername>
      <pPassword>1234</pPassword>
      <pCompany>1</pCompany>
      <pWebWervice>1000</pWebWervice>
        <pLanguage>1</pLanguage>
        <pAuthenticatedToken>'.$token.'</pAuthenticatedToken>
        <pStor_id4ForceInsertItem>0</pStor_id4ForceInsertItem>
      </wsSaleOrderHeader>
    </soap:Header>
    <soap:Body>
      <Identifier_funGetData xmlns="http://microsoft.com/webservices/" />
    </soap:Body>
  </soap:Envelope>';

  $headers = array(
    "Content-Type: text/xml; charset=utf-8",
    "Host: ws.globalbluepoint.com",
    "SOAPAction: http://microsoft.com/webservices/Identifier_funGetData",
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
  curl_setopt($ch, CURLOPT_TIMEOUT, 180);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);

  $response = curl_exec($ch);
  curl_close($ch);

  $response = html_entity_decode($response);

  // Log de Global Blue Point
  $msj = "\n============================================================\n";
  $msj .= date('Y-m-d H:i:s')."\n";
  $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
  $msj .= "SoapUrl: ".$soapUrl."\n";
  $msj .= "Postfields: ".$xml_post_string."\n";
  $msj .= "Response: ".$response."\n";
  $filelog = 'globalbluepoint.log';
  if(isset($_SESSION['instancia'])){
    $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
  }
  if(ADMIN){
    file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
  } else {
    file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
  }
  // Fin log Global Blue Point.

  /****
   * <?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Identifier_funGetDataResponse xmlns="http://microsoft.com/webservices/"><Identifier_funGetDataResult><NewDataSet>
<Table>
  <guid>98ad3ca1-5401-4d11-aaf0-f5da266f7ce0</guid>
</Table>
</NewDataSet></Identifier_funGetDataResult></Identifier_funGetDataResponse></soap:Body></soap:Envelope>
   */

  $eliminar1 = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Identifier_funGetDataResponse xmlns="http://microsoft.com/webservices/"><Identifier_funGetDataResult><NewDataSet>';

  $xmlstr = str_replace($eliminar1, "<response>", $response);

  $eliminar2 = "</NewDataSet></Identifier_funGetDataResult></Identifier_funGetDataResponse></soap:Body></soap:Envelope>";

  $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);

  //echo $xmlstr; die;

  $xml = simplexml_load_string($xmlstr);
  $json = json_encode($xml);
  $array = json_decode($json,TRUE);

  return $array['Table'];

}

function Gbp_Item_funInsertData($token, $guid_pedido, $id_producto, $cantidad){

// Esto se llama por cada producto en el carrito.

  // PENDIENTE FALTA EL PARSEO Y PROBAR CON DATOS REALES.

  $soapUrl = "https://ws.globalbluepoint.com/torikos/app_webservices/wsSaleOrder.asmx";

  $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Header>
      <wsSaleOrderHeader xmlns="http://microsoft.com/webservices/">
      <pUsername>truser</pUsername>
      <pPassword>1234</pPassword>
      <pCompany>1</pCompany>
      <pWebWervice>1000</pWebWervice>
        <pLanguage>1</pLanguage>
        <pAuthenticatedToken>'.$token.'</pAuthenticatedToken>
        <pStor_id4ForceInsertItem>0</pStor_id4ForceInsertItem>
      </wsSaleOrderHeader>
    </soap:Header>
    <soap:Body>
      <Item_funInsertData xmlns="http://microsoft.com/webservices/">
      <pGuid>'.$guid_pedido.'</pGuid>
      <pStor>1</pStor>
      <pItem>'.$id_producto.'</pItem>
      <pPrli>1</pPrli>
      <pQty>'.$cantidad.'</pQty>
      </Item_funInsertData>
  </soap:Body>
  </soap:Envelope>';

  $headers = array(
    "Content-Type: text/xml; charset=utf-8",
    "Host: ws.globalbluepoint.com",
    "SOAPAction: http://microsoft.com/webservices/Item_funInsertData",
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
  curl_setopt($ch, CURLOPT_TIMEOUT, 180);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);

  $response = curl_exec($ch);
  curl_close($ch);

  $response = html_entity_decode($response);

  // Log de Global Blue Point
  $msj = "\n============================================================\n";
  $msj .= date('Y-m-d H:i:s')."\n";
  $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
  $msj .= "SoapUrl: ".$soapUrl."\n";
  $msj .= "Postfields: ".$xml_post_string."\n";
  $msj .= "Response: ".$response."\n";
  $filelog = 'globalbluepoint.log';
  if(isset($_SESSION['instancia'])){
    $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
  }
  if(ADMIN){
    file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
  } else {
    file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
  }
  // Fin log Global Blue Point.

  /****
   * <?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Identifier_funGetDataResponse xmlns="http://microsoft.com/webservices/"><Identifier_funGetDataResult><NewDataSet>
<Table>
  <guid>98ad3ca1-5401-4d11-aaf0-f5da266f7ce0</guid>
</Table>
</NewDataSet></Identifier_funGetDataResult></Identifier_funGetDataResponse></soap:Body></soap:Envelope>
   */

  $eliminar1 = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Item_funInsertDataResponse xmlns="http://microsoft.com/webservices/"><Item_funInsertDataResult><NewDataSet>';

  $xmlstr = str_replace($eliminar1, "<response>", $response);

  $eliminar2 = "</NewDataSet></Item_funInsertDataResult></Item_funInsertDataResponse></soap:Body></soap:Envelope>";

  $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);

  //echo $xmlstr; die;

  $xml = simplexml_load_string($xmlstr);
  $json = json_encode($xml);
  $array = json_decode($json,TRUE);

  return $array['Table'];

}

function Gbp_SaleOrder_funInsertData($token, $guid_pedido, $id_customer){

  // PENDIENTE, FALTA EL PARSEO PROBANDO CON DATOS REALES.
  // pBranch = 1 // es la sucursal.

  $soapUrl = "https://ws.globalbluepoint.com/torikos/app_webservices/wsSaleOrder.asmx";

  $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Header>
      <wsSaleOrderHeader xmlns="http://microsoft.com/webservices/">
      <pUsername>truser</pUsername>
      <pPassword>1234</pPassword>
      <pCompany>1</pCompany>
      <pBranch>1</pBranch>
      <pWebWervice>1000</pWebWervice>
        <pLanguage>1</pLanguage>
        <pAuthenticatedToken>'.$token.'</pAuthenticatedToken>
        <pStor_id4ForceInsertItem>0</pStor_id4ForceInsertItem>
      </wsSaleOrderHeader>
    </soap:Header>
    <soap:Body>
          <SaleOrder_funInsertData xmlns="http://microsoft.com/webservices/">
          <pGuid>'.$guid_pedido.'</pGuid>
          <pCust>'.$id_customer.'</pCust>
          <pDocument>1</pDocument>
          </SaleOrder_funInsertData>
      </soap:Body>
  </soap:Envelope>';

  $headers = array(
    "Content-Type: text/xml; charset=utf-8",
    "Host: ws.globalbluepoint.com",
    "SOAPAction: http://microsoft.com/webservices/SaleOrder_funInsertData",
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
  curl_setopt($ch, CURLOPT_TIMEOUT, 180);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);

  $response = curl_exec($ch);
  curl_close($ch);

  $response = html_entity_decode($response);

  // Log de Global Blue Point
  $msj = "\n============================================================\n";
  $msj .= date('Y-m-d H:i:s')."\n";
  $msj .= "Url: ".$_SERVER['REQUEST_URI']."\n";
  $msj .= "SoapUrl: ".$soapUrl."\n";
  $msj .= "Postfields: ".$xml_post_string."\n";
  $msj .= "Response: ".$response."\n";
  $filelog = 'globalbluepoint.log';
  if(isset($_SESSION['instancia'])){
    $filelog = 'globalbluepoint_'.$_SESSION['instancia'].'.log';
  }
  if(ADMIN){
    file_put_contents('../logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
  } else {
    file_put_contents('./logs/'.$filelog, $msj.PHP_EOL, FILE_APPEND);
  }
  // Fin log Global Blue Point.

  /****
   * <?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Identifier_funGetDataResponse xmlns="http://microsoft.com/webservices/"><Identifier_funGetDataResult><NewDataSet>
<Table>
  <guid>98ad3ca1-5401-4d11-aaf0-f5da266f7ce0</guid>
</Table>
</NewDataSet></Identifier_funGetDataResult></Identifier_funGetDataResponse></soap:Body></soap:Envelope>
   */

  $eliminar1 = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><SaleOrder_funInsertDataResponse xmlns="http://microsoft.com/webservices/"><SaleOrder_funInsertDataResult><NewDataSet>';

  $xmlstr = str_replace($eliminar1, "<response>", $response);

  $eliminar2 = "</NewDataSet></SaleOrder_funInsertDataResult></SaleOrder_funInsertDataResponse></soap:Body></soap:Envelope>";

  $xmlstr = str_replace($eliminar2, "</response>", $xmlstr);

  //echo $xmlstr; die;

  $xml = simplexml_load_string($xmlstr);
  $json = json_encode($xml);
  $array = json_decode($json,TRUE);

  return $array['Table'];

}
?>
