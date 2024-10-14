<?
// https://administracion.donweb.com/apiv3/servicios/dominio/obtenerListado/0/50?ordenarPor=vencimiento&ordenarAscendente=1

$curl = curl_init();

$auth = base64_encode("alejandra@transparent.com.ar:Transparentesmejor789");

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://administracion.donweb.com/apiv3/servicios/dominio/obtenerListado/0/200?ordenarPor=vencimiento&ordenarAscendente=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic ".$auth
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $aRes = json_decode($response, true);
  //echo "<pre>"; print_r($aRes); die;
}
/// FIN ALGORITMO PRIMERO ////////////////////////////////////////

/*********
 * 
 Array
(
    [jsonMC] => Array
        (
            [resultado] => 1
            [respuesta] => Array
                (
                    [items] => Array
                        (
                            [0] => Array
                                (
                                    [servicioID] => 1827705
                                    [dias_para_vencimiento] => 28
                                    [dominio] => pimpumpack.com.ar
                                    [es_administrable] => 
                                    [contactos_anonimos] => 0
                                    [estadoDominio] => Registrado
                                    [administrable] => Array
                                        (
                                            [dns] => 1
                                            [dns_propio] => 
                                            [zona_dns] => 1
                                            [parking] => 1
                                            [whois] => 
                                            [transferencia] => 
                                        )

                                    [cliente] => 443773
                                    [estado] => A
                                    [categoria_suspencion] => 
                                    [proxima_factura] => 2021-08-11
                                    [importe] => 1329.7900000000
                                    [autopagar_con_saldo] => 1
                                    [autopagarConTarjeta] => 
                                    [puedeAutopagar] => 1
                                    [categoria] => 4
                                    [plan] => reg_dominio_comar
                                    [nombrePlan] => Reg. Dominio .COM.AR
                                    [so] => 
                                    [f_activacion] => 2020-08-11 15:55:04
                                    [servicioRelacionado] => 
                                    [tipoFactura] => compra
                                    [mes_pago] => 12
                                    [periodo] => Anual
                                    [bajaSolicitada] => 
                                    [tieneCambioPendiente] => 
                                    [nombreDescriptivoServicio] => 
                                    [derecho_de_registro] => 0
                                    [datosAdicionalesPlan] => Array
                                        (
                                            [actualizacion_pecios_estado] => FINALIZADO
                                            [actualizacion_pecios_fecha] => 2020-11-26 11:24:18
                                            [actualizacion_pecios_pid] => 1606400514467479
                                            [actualizacion_pecios_usuario] => abalducci
                                            [codigoDescuento] => PROMO-BUNDLE
                                            [operacionDominio] => registro
                                        )

                                    [datosServicioRelacionado] => 
                                    [backup] => 
                                    [tieneSeguridadPremium] => 
                                    [puedeComprarSeguridadPremium] => 1
                                    [tieneSeguroVigente] => 
                                    [puedeComprarRegistracionPrivada] => 
                                    [apuntadoSitioSimple] => 0
                                )

                            [1] => Array
 * 
 * *********/

////////////////////////////////////////////////////////////////////////////////
ini_set('max_execution_time',7200);
define('ADMIN', false);
$ini = time();

error_reporting(E_ALL);

// Link a conexión.
$_SESSION['link'] = null;

$_SESSION['instancia'] = 'super';

include('../config.php');
include('../funciones/funciones.php');

// Conecta directamente a MySQL.
//$sMY = mysql_connect(APP_DATABASE_HOST, APP_DATABASE_USER, APP_DATABASE_PASS);
//mysql_select_db(APP_DATABASE_NAME);

$_SESSION['link'] = mysqli_connect(APP_DATABASE_HOST, APP_DATABASE_USER, APP_DATABASE_PASS, APP_DATABASE_NAME);

$nDominios = 0;

if(isset($aRes['jsonMC'])){

  $cSql = "UPDATE dominios SET actualizado = 0";
  mysqli_query($_SESSION['link'], $cSql);
  
  // Solo si no hay ningún error.
  if($aRes['jsonMC']['respuesta']['error'] == ""){

    foreach($aRes['jsonMC']['respuesta']['items'] as $item){
      
            
        $id = $item['servicioID'];
        $dominio = $item['dominio'];
        $proveedor = 'donweb';
        $dias_vence = $item['dias_para_vencimiento'];
        $fecha_vence = $item['proxima_factura'];
        $estado = $item['estado'];
        $importe = $item['importe'];
        $fecha_registro = $item['f_activacion'];
        $fecha_mod = date('Y-m-d H:i:s');
      
    
        $cSql = "SELECT * FROM dominios WHERE id_servicio = '{$id}' LIMIT 1";
        $sRes = mysqli_query($_SESSION['link'], $cSql);
        $aDom = mysqli_fetch_array($sRes, MYSQLI_ASSOC);
    
        if(!isset($aDom['id_dominio'])){

          $cSql = "INSERT INTO dominios SET dominio = '{$dominio}', proveedor = 'donweb', 
          id_servicio = '{$id}', dias_vence = '{$dias_vence}', 
          fecha_vence = '{$fecha_vence}', estado = '{$estado}', 
          importe = '{$importe}', fecha_registro = '{$fecha_registro}', fecha_mod = '{$fecha_mod}', actualizado = '1'";

          if(mysqli_query($_SESSION['link'], $cSql)){
            $nDominios++;
          } else {
            echo $cSql;
            die;
          }

        } else {

          $id_dominio = $aDom['id_dominio'];
          
          $cSql = "UPDATE dominios SET dominio = '{$dominio}', proveedor = 'donweb', 
          id_servicio = '{$id}', dias_vence = '{$dias_vence}', 
          fecha_vence = '{$fecha_vence}', estado = '{$estado}', 
          importe = '{$importe}', fecha_registro = '{$fecha_registro}', fecha_mod = '{$fecha_mod}', actualizado = '1' WHERE id_dominio = '{$id_dominio}' LIMIT 1";

          if(mysqli_query($_SESSION['link'], $cSql)){
            $nDominios++;
          } else {
            echo $cSql;
            die;
          }

        }
      
      /********************************
       * ESTRUCTURA DE ITEM DOMINIO EN DONWEB. GRACIAS Diego V.
       Array
        (
            [servicioID] => 1827705
            [dias_para_vencimiento] => 28
            [dominio] => pimpumpack.com.ar
            [es_administrable] => 
            [contactos_anonimos] => 0
            [estadoDominio] => Registrado
            [administrable] => Array
                (
                    [dns] => 1
                    [dns_propio] => 
                    [zona_dns] => 1
                    [parking] => 1
                    [whois] => 
                    [transferencia] => 
                )

            [cliente] => 443773
            [estado] => A
            [categoria_suspencion] => 
            [proxima_factura] => 2021-08-11
            [importe] => 1329.7900000000
            [autopagar_con_saldo] => 1
            [autopagarConTarjeta] => 
            [puedeAutopagar] => 1
            [categoria] => 4
            [plan] => reg_dominio_comar
            [nombrePlan] => Reg. Dominio .COM.AR
            [so] => 
            [f_activacion] => 2020-08-11 15:55:04
            [servicioRelacionado] => 
            [tipoFactura] => compra
            [mes_pago] => 12
            [periodo] => Anual
            [bajaSolicitada] => 
            [tieneCambioPendiente] => 
            [nombreDescriptivoServicio] => 
            [derecho_de_registro] => 0
            [datosAdicionalesPlan] => Array
                (
                    [actualizacion_pecios_estado] => FINALIZADO
                    [actualizacion_pecios_fecha] => 2020-11-26 11:24:18
                    [actualizacion_pecios_pid] => 1606400514467479
                    [actualizacion_pecios_usuario] => abalducci
                    [codigoDescuento] => PROMO-BUNDLE
                    [operacionDominio] => registro
                )

            [datosServicioRelacionado] => 
            [backup] => 
            [tieneSeguridadPremium] => 
            [puedeComprarSeguridadPremium] => 1
            [tieneSeguroVigente] => 
            [puedeComprarRegistracionPrivada] => 
            [apuntadoSitioSimple] => 0
        )
       *****************************************/


    } // endforeach

  } // end if - error

}

echo "Se cargaron ".$nDominios." dominios en la base de datos.";
die('hasta aca');

?>