<?
// Funciones para generar PDFs.

function generar_orden_de_servicio($id_factura){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include_once('../external/fpdf/fpdf.php');

        $oPro = new Productos();

        $oPro->DB('transpar_super');

        $cSql = "SELECT facturas.*, productos.nombre, productos.domicilio, productos.cuit, productos.id_condicion FROM facturas INNER JOIN productos ON productos.codigo = facturas.instancia WHERE facturas.id_factura = '{$id_factura}' LIMIT 1";
        $aFac = $oPro->SQLSelect($cSql);

        // Si no existe la factura, salgo.
        if(!isset($aFac[0])){
            return false;
        }

        // Datos de la empresa destino del comprobante.
        $nombre = $aFac[0]['nombre'];
        $cuit = $aFac[0]['cuit'];
        $domicilio = $aFac[0]['domicilio'];
        $fecha = date("d/m/Y", strtotime($aFac[0]['fecha']));

        $id_condicion = $aFac[0]['id_condicion'];

        $aCondicion[0] = 'Responsable Inscripto';
        $aCondicion[1] = 'Responsable Inscripto';
        $aCondicion[2] = 'Exento';
        $aCondicion[3] = 'Monotributista';
        $aCondicion[4] = 'Exterior';
        $aCondicion[5] = 'Consumidor Final';

        // Obtengo los productos de SOS Contador.
        $aPro = soscontador_productos();

        foreach($aPro as $item){
            $aProductos[$item['id']] = $item['producto'];
        }

        $sos_idpro1 = $aFac[0]['sos_idpro1'];
        if($sos_idpro1){
            $sos_idpro1_nombre = $aProductos[$sos_idpro1];
        } else {
            $sos_idpro1_nombre = '';
        }

        $sos_idpro1_precio = $aFac[0]['sos_pro1_precio'];
        
        if($sos_idpro1_precio){
            if($aFac[0]['iva'] > 0){
                $sos_idpro1_precioiva = ($sos_idpro1_precio * 0.21);
                $sos_idpro1_preciototal = ($sos_idpro1_precio + $sos_idpro1_precioiva);
            } else {
                $sos_idpro1_precioiva = 0;
                $sos_idpro1_preciototal = $sos_idpro1_precio;
            }
        } else {
            $sos_idpro1_precio = 0;
            $sos_idpro1_precioiva = 0;
            $sos_idpro1_preciototal = 0;
        }

        $sos_idpro2 = $aFac[0]['sos_idpro2'];
        if($sos_idpro2){
            $sos_idpro2_nombre = $aProductos[$sos_idpro2];
        } else {
            $sos_idpro2_nombre = '';
        }
        $sos_idpro2_precio = $aFac[0]['sos_pro2_precio'];
        if($sos_idpro2_precio){
            if($aFac[0]['iva'] > 0){
                $sos_idpro2_precioiva = ($sos_idpro2_precio * 0.21);
                $sos_idpro2_preciototal = ($sos_idpro2_precio + $sos_idpro2_precioiva);
            } else {
                $sos_idpro2_precioiva = 0;
                $sos_idpro2_preciototal = ($sos_idpro2_precio + $sos_idpro2_precioiva);
            }
        } else {
            $sos_idpro2_precio = 0;
            $sos_idpro2_precioiva = 0;
            $sos_idpro2_preciototal = 0;
        }

        $sos_idpro3 = $aFac[0]['sos_idpro3'];
        if($sos_idpro3){
            $sos_idpro3_nombre = $aProductos[$sos_idpro3];
        } else {
            $sos_idpro3_nombre = '';
        }
        $sos_idpro3_precio = $aFac[0]['sos_pro3_precio'];
        if($sos_idpro3_precio){
            if($aFac[0]['iva'] > 0){
                $sos_idpro3_precioiva = ($sos_idpro3_precio * 0.21);
                $sos_idpro3_preciototal = ($sos_idpro3_precio + $sos_idpro3_precioiva);
            } else {
                $sos_idpro3_precioiva = 0;
                $sos_idpro3_preciototal = ($sos_idpro3_precio + $sos_idpro3_precioiva);
            }
        } else {
            $sos_idpro3_precio = 0;
            $sos_idpro3_precioiva = 0;
            $sos_idpro3_preciototal = 0;
        }

        // Empiezo a armar el comprobante.

        $pdf=new FPDF();
        $pdf->AddPage();

        $pdf->Image('./images/ods.jpg', 5, 5, 202, 285);

        $pdf->SetFont('Arial','B',14);
        $str = '0002-0000'.$id_factura; // Cada ODS representa a una factura (comprobante).
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(168,13,$texto);

        $pdf->SetFont('Arial','',13);
        $str = $fecha;
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(180,29,$texto);

        // Datos de la empresa destino del comprobante.
        $pdf->SetFont('Arial','',11);
        $str = $nombre;
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(38,47,$texto);

        $pdf->SetFont('Arial','',11);
        $str = $cuit;
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(38,52,$texto);

        $pdf->SetFont('Arial','',11);
        $str = $aCondicion[$id_condicion];
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(38,57,$texto);

        $pdf->SetFont('Arial','',9);
        $str = $domicilio;
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(38,63,$texto);

        $pdf->SetFont('Arial','',11);
        $str = 'Cuenta Corriente'; // Queda fijo.
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(38,68,$texto);

        // Fin datos.

        // Detalle de items de la factura.
        if($sos_idpro1_precio > 0){

            $pdf->SetFont('Arial','',9);
            $str = 'u';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(41,81,$texto);

            $pdf->SetFont('Arial','',9);
            $str = $sos_idpro1_nombre;
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(47,81,$texto);

            $pdf->SetFont('Arial','',8);
            $str = '1,00';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(131,81,$texto);

            $pdf->SetFont('Arial','',8);
            // Formato con punto y coma para decimales.
            $str = number_format($sos_idpro1_precio, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(144,81,$texto);

            $pdf->SetFont('Arial','',8);
            $str = '21%';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(163,81,$texto);

            $pdf->SetFont('Arial','',8);
            // IVa con formato.
            $str = number_format($sos_idpro1_precioiva, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(171,81,$texto);

            $pdf->SetFont('Arial','',8);
            // Total con formato.
            $str = number_format($sos_idpro1_preciototal, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(188,81,$texto);

        }

        // Segundo Item.
        if($sos_idpro2_precio > 0){

            $pdf->SetFont('Arial','',9);
            $str = 'u';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(41,86,$texto);

            $pdf->SetFont('Arial','',9);
            $str = $sos_idpro2_nombre;
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(47,86,$texto);

            $pdf->SetFont('Arial','',8);
            $str = '1,00';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(131,86,$texto);

            $pdf->SetFont('Arial','',8);
            $str = number_format($sos_idpro2_precio, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(144,86,$texto);

            $pdf->SetFont('Arial','',8);
            $str = '21%';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(163,86,$texto);

            $pdf->SetFont('Arial','',8);
            $str = number_format($sos_idpro2_precioiva, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(171,86,$texto);

            $pdf->SetFont('Arial','',8);
            $str = number_format($sos_idpro2_preciototal, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(188,86,$texto);

        }

        // Tercer Item.
        if($sos_idpro3_precio > 0){

            $pdf->SetFont('Arial','',9);
            $str = 'u';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(41,91,$texto);

            $pdf->SetFont('Arial','',9);
            $str = $sos_idpro3_nombre;
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(47,91,$texto);

            $pdf->SetFont('Arial','',8);
            $str = '1,00';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(131,91,$texto);

            $pdf->SetFont('Arial','',8);
            $str = number_format($sos_idpro3_precio, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(144,91,$texto);

            $pdf->SetFont('Arial','',8);
            $str = '21%';
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(163,91,$texto);

            $pdf->SetFont('Arial','',8);
            $str = number_format($sos_idpro3_precioiva, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(171,91,$texto);

            $pdf->SetFont('Arial','',8);
            $str = number_format($sos_idpro3_preciototal, 2, ',', '.');
            $texto = iconv('UTF-8', 'windows-1252', $str);
            $pdf->Text(188,91,$texto);
        }

        // Subtotal Neto.

        $pdf->SetFont('Arial','',9);
        $str = number_format(($sos_idpro1_precio+$sos_idpro2_precio+$sos_idpro3_precio), 2, ',', '.');
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(184,238,$texto);

        // IVA.
        $pdf->SetFont('Arial','',9);
        $str = number_format(($sos_idpro1_precioiva+$sos_idpro2_precioiva+$sos_idpro3_precioiva), 2, ',', '.');
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(184,264,$texto);

        // TOTAL
        $pdf->SetFont('Arial','B',9);
        $str = number_format(($sos_idpro1_preciototal+$sos_idpro2_preciototal+$sos_idpro3_preciototal), 2, ',', '.');
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(184,282,$texto);

        // NOTA IMPORTANTE.
        $pdf->SetFont('Arial','B',10);
        $str = "NOTA IMPORTANTE: La factura correspondiente a esta orden de servicio";
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(10,264,$texto);

        $pdf->SetFont('Arial','B',10);
        $str = "se emitirá inmediatamente después de la acreditación del pago.";
        $texto = iconv('UTF-8', 'windows-1252', $str);
        $pdf->Text(10,270,$texto);

        // Genero el archivo.
        $codigo_ods = md5('maradona'.$id_factura); // Ofusco para que no sea tan obvio.
        $pdf->Output('F', './webfiles/super/ods/factura-ods-'.$codigo_ods.'.pdf');

}

?>