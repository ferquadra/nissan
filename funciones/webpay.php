<?
// FUNCIONES PARA EL PROCESADOR DE PAGOS DE CHILE.
// TRANSBANK - WEBPAY
/****
 * TARJETAS DE PRUEBA
 * https://www.transbankdevelopers.cl/documentacion/como_empezar#tarjetas-de-prueba
 * 
 * IMPORTANTE:
 * Cuando aparece un formulario de autenticación con RUT y clave, 
 * se debe usar el RUT 11.111.111-1 y la clave 123.
 */

function webpay_cancelOrder($response = null)
{
    // Acá has lo que tangas que hacer para marcar la orden como fallida o cancelada
    if ($response) {
        echo '<pre>'.print_r($response, true).'</pre>';
    }
    echo 'La orden ha sido RECHAZADA';
}

function webpay_approveOrder($response)
{
    // Acá has lo que tangas que hacer para marcar la orden como aprobada o finalizada o lo que necesites en tu negocio.,
    echo 'La orden ha sido APROBADA';
    echo '<pre>'.print_r($response, true).'</pre>';
}

function webpay_userAbortedOnWebpayForm()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene TBK_TOKEN, TBK_ORDEN_COMPRA y TBK_ID_SESION es porque el usuario abortó el pago
    return $tbkToken && $ordenCompra && $idSesion && !$tokenWs;
}

function webpay_anErrorOcurredOnWebpayForm()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene token_ws, TBK_TOKEN, TBK_ORDEN_COMPRA y TBK_ID_SESION es porque ocurrió un error en el formulario de pago
    return $tokenWs && $ordenCompra && $idSesion && $tbkToken;
}

function webpay_theUserWasRedirectedBecauseWasIdleFor10MinutesOnWebapayForm()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene solo TBK_ORDEN_COMPRA y TBK_ID_SESION es porque el usuario estuvo 10 minutos sin hacer nada en el
    // formulario de pago y se canceló la transacción automáticamente (por timeout)
    return $ordenCompra && $idSesion && !$tokenWs && !$tbkToken;
}

function webpay_isANormalPaymentFlow()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene solo token_ws es porque es un flujo de pago normal
    return $tokenWs && !$ordenCompra && !$idSesion && !$tbkToken;
}
?>