<?
//date_default_timezone_set('America/Argentina/Buenos_Aires');

function CentumSuiteAccessToken(){

    // Configuración
    $fechaUTC = gmdate('Y-m-d\TH:i:s'); // Fecha en formato UTC
    $guid = bin2hex(openssl_random_pseudo_bytes(16)); // GUID sin guiones
    $clavePublica = 'PPe93FEigoWEIflvfie459sdf/sdfirgrlgr34gZepgRVgkdKKFLdsfKDREWzzlfivF293/KIflqm103lErSrg6723'; // Clave pública entregada por la API

    // Generación del hash
    $textoParaHash = "{$fechaUTC} {$guid} {$clavePublica}";

    $hash = hash('SHA1', $textoParaHash); // SHA1

    // Formato final del token
    $centumSuiteAccessToken = "{$fechaUTC} {$guid} {$hash}";

    if($_GET['debug']){
        echo "<br /><br />";
        echo "<strong>Clave API:</strong> ".$clavePublica;
        echo "<br /><br />";
        echo "<strong>Texto para el hash:</strong> ".$textoParaHash;
        echo "<br /><br />";
        echo "<strong>Hash \"SHA1\":</strong> ".$hash;
        echo "<br /><br />";
        echo "<strong>CentumSuiteAccessToken:</strong> ".$centumSuiteAccessToken;
        echo "<br /><br />";
        die;
    }

    return $centumSuiteAccessToken;

}

function CentumRubros($centumSuiteAccessToken){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/Rubros',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
        'CentumSuiteConsumidorApiPublicaId: 2'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function CentumArticulosExistencias($centumSuiteAccessToken){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/ArticulosExistencias',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
        'CentumSuiteConsumidorApiPublicaId: 2'
    ),
    ));

    $response = curl_exec($curl);

    $aPro = json_decode($response, true);

    curl_close($curl);
    return $aPro;
}

function CentumArticulosImagenes($centumSuiteAccessToken, $id_articulo){

    $curl = curl_init();

    // Configuración de cURL usando curl_setopt_array
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/ArticulosImagenes/'.$id_articulo.'?numeroOrden=1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
            'CentumSuiteConsumidorApiPublicaId: 2',
            'If-Modified-Since: ' . gmdate('D, d M Y H:i:s') . ' GMT'
        ),
    ));

    // Ejecutar la llamada cURL
    $response = curl_exec($curl);

    // Verificar si hubo algún error durante la llamada
    if (curl_errno($curl)) {
        echo 'Error en cURL: ' . curl_error($curl);
    } else {
        // Guardar la imagen, suponiendo que la respuesta sea binaria
        file_put_contents("imagen-articulo.jpg", $response);
    }

    // Cerrar el recurso cURL
    curl_close($curl);
    return $response;
}


function CentumClientes($centumSuiteAccessToken){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/Clientes?razonSocial=S.A',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
        'CentumSuiteConsumidorApiPublicaId: 2'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    $aCli = json_decode($response, true);
    
    return $aCli;

}

//Clientes?razonSocial=S.A

function CentumArticulos($centumSuiteAccessToken){
    
    $data = json_encode(array('Codigo' => ''));

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/Articulos/DatosGenerales',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,  // Enviando datos JSON
    CURLOPT_HTTPHEADER => array(
        'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
        'CentumSuiteConsumidorApiPublicaId: 2',
        'Content-Type: application/json',  // Especificando que el tipo de contenido es JSON
        'Content-Length: ' . strlen($data)  // Longitud del contenido
    ),
    ));

    $response = curl_exec($curl);

    $aPro = json_decode($response, true);

    curl_close($curl);
    
    return $aPro;
}


function ListasPrecios($centumSuiteAccessToken){
    
    $data = json_encode(array('Codigo' => ''));

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/ListasPrecios',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
        'CentumSuiteConsumidorApiPublicaId: 2',
        'Content-Type: application/json',  // Especificando que el tipo de contenido es JSON
        'Content-Length: ' . strlen($data)  // Longitud del contenido
    ),
    ));

    $response = curl_exec($curl);

    $aPro = json_decode($response, true);

    curl_close($curl);
    
    return $aPro;
}


function CentumPrecios($centumSuiteAccessToken){
    
    $data = json_encode(array('IdLista' => '1'));

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://plataforma1.centum.com.ar:23990/BL9/Articulos/FiltrosPrecios',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,  // Enviando datos JSON
    CURLOPT_HTTPHEADER => array(
        'CentumSuiteAccessToken: '.$centumSuiteAccessToken,
        'CentumSuiteConsumidorApiPublicaId: 2',
        'Content-Type: application/json',  // Especificando que el tipo de contenido es JSON
        'Content-Length: ' . strlen($data)  // Longitud del contenido
        ),
    ));

    $response = curl_exec($curl);

    $aPro = json_decode($response, true);

    curl_close($curl);
    
    return $aPro;

}

//FiltrosPrecios

/************ ESTRUCTURA CENTUM - ARTICULOS ********************
			 [6857] => Array
				(
					[IdArticulo] => 8032
					[Codigo] => 202433
					[CodigoAuxiliar] => 
					[Nombre] => ZTSC FERRUM ARMONICA TAPON CERAMICO 
					[NombreFantasia] => 
					[Rubro] => Array
						(
							[IdRubro] => 16
							[Codigo] => 016
							[Nombre] => LOZA SANITARIA
						)

					[SubRubro] => Array
						(
							[IdSubRubro] => 133
							[Codigo] => 00160006
							[Nombre] => LINEA ARMONICA
							[IdRubro] => 16
						)

					[CategoriaArticulo] => 
					[MarcaArticulo] => Array
						(
							[IdMarcaArticulo] => 6291
							[Codigo] => Marca Defecto
							[Nombre] => Marca Defecto
						)

					[Habilitado] => 
					[ActivoWeb] => 1
					[Ranking] => 
					[CategoriaImpuestoIVA] => Array
						(
							[IdCategoriaImpuestoIVA] => 4
							[Codigo] => 5
							[Nombre] => IVA 21.00
							[Tasa] => 21
						)

					[UnidadNivel1] => 1
					[UnidadNivel2] => 1
					[Masa] => 1
					[MasaEspecifico] => 1
					[Volumen] => 1
					[Alto] => 1
					[Largo] => 1
					[Ancho] => 1
					[EsPesable] => 
					[InformaTropa] => 
					[Observaciones] => 
					[Detalle] => 
					[CantidadImagenesArticulo] => 0
					[Videos] => Array
						(
						)

					[Tags] => Array
						(
						)

					[FactorConversion] => 0
					[UnidadMaximaVenta] => 0
					[UnidadMinimaVenta] => 0
				)
			**********************************************************/

    /***** CLIENTE
     * 
     * 
     * [1] => Array
                (
                    [IdCliente] => 15
                    [Codigo] => P0028
                    [RazonSocial] => FERRUM S.A DE CERAMICA Y METALURGIA
                    [CUIT] => 30525341263
                    [Direccion] => ESPAÑA 496
                    [Localidad] => AVELLANEDA
                    [CodigoPostal] => 1870
                    [Provincia] => Array
                        (
                            [IdProvincia] => 4876
                            [Codigo] => 02
                            [Nombre] => Buenos Aires
                        )

                    [Pais] => Array
                        (
                            [IdPais] => 4657
                            [Codigo] => ARG
                            [Nombre] => ARGENTINA
                        )

                    [Zona] => Array
                        (
                            [IdZona] => 6095
                            [Codigo] => CAPITAL FEDERAL
                            [Nombre] => CAPITAL FEDERAL
                            [Activo] => 1
                            [EntregaLunes] => 
                            [EntregaMartes] => 
                            [EntregaMiercoles] => 
                            [EntregaJueves] => 
                            [EntregaViernes] => 
                            [EntregaSabado] => 
                            [EntregaDomingo] => 
                            [DemoraEnHorasFechaEntrega] => 0
                            [CostoEntrega] => 0
                        )

                    [Latitud] => 
                    [Longitud] => 
                    [DireccionEntrega] => 
                    [CalleEntrega] => 
                    [NumeroCalleEntrega] => 
                    [LocalEntrega] => 
                    [CallePerpendicular1Entrega] => 
                    [CallePerpendicular2Entrega] => 
                    [LocalidadEntrega] => AVELLANEDA
                    [CodigoPostalEntrega] => 
                    [DepartamentoEntrega] => 
                    [ProvinciaEntrega] => 
                    [PaisEntrega] => 
                    [ZonaEntrega] => Array
                        (
                            [IdZona] => 6095
                            [Codigo] => CAPITAL FEDERAL
                            [Nombre] => CAPITAL FEDERAL
                            [Activo] => 1
                            [EntregaLunes] => 
                            [EntregaMartes] => 
                            [EntregaMiercoles] => 
                            [EntregaJueves] => 
                            [EntregaViernes] => 
                            [EntregaSabado] => 
                            [EntregaDomingo] => 
                            [DemoraEnHorasFechaEntrega] => 0
                            [CostoEntrega] => 0
                        )

                    [LatitudEntrega] => 
                    [LongitudEntrega] => 
                    [Telefono] => 4222-1500/4229-6200
                    [TelefonoAlternativo] => 1152618115 - Edgardo Nucaro 
                    [Fax] =>  fax 4229-6244
                    [Interno] => 
                    [Email] => enucaro@ferrum.com
                    [ObservacionesCliente] => Ciente nro. 538/0685 SA  5-de abril 25 % dto en bari 12% en andina y en varios 12% tambien en repuestos
                    [CondicionIVA] => Array
                        (
                            [IdCondicionIVA] => 1895
                            [Codigo] => RI
                            [Nombre] => Responsable Inscripto
                        )

                    [CondicionVenta] => Array
                        (
                            [IdCondicionVenta] => 1
                            [Codigo] => 01
                            [Nombre] => CONTADO
                        )

                    [Vendedor] => Array
                        (
                            [IdVendedor] => 4
                            [Codigo] => 1
                            [Nombre] => MARCELO VILLANUEVA
                            [CUIT] => 20185344194
                            [Direccion] => 
                            [Localidad] => 
                            [Telefono] => 
                            [Mail] => 
                            [EsSupervisor] => 
                        )

                    [Transporte] => Array
                        (
                            [IdTransporte] => 1
                            [Codigo] => TRA1
                            [RazonSocial] => Transporte Defecto
                            [Direccion] => 
                            [Localidad] => 
                            [CodigoPostal] => 
                            [Provincia] => Array
                                (
                                    [IdProvincia] => 4876
                                    [Codigo] => 02
                                    [Nombre] => Buenos Aires
                                )

                            [Pais] => Array
                                (
                                    [IdPais] => 4657
                                    [Codigo] => ARG
                                    [Nombre] => ARGENTINA
                                )

                            [DireccionEntrega] => 
                            [LocalidadEntrega] => 
                            [CodigoPostalEntrega] => 
                            [ProvinciaEntrega] => 
                            [PaisEntrega] => 
                            [ZonaEntrega] => 
                            [Telefono] => 
                            [NumeroDocumento] => 00000000
                            [Email] => 
                            [TipoDocumento] => Array
                                (
                                    [IdTipoDocumento] => 6028
                                    [Codigo] => DNI
                                    [Nombre] => Documento Nacional de Identidad
                                )

                        )

                    [Bonificacion] => Array
                        (
                            [IdBonificacion] => 6235
                            [Codigo] => 0
                            [Calculada] => 0
                        )

                    [LimiteCredito] => Array
                        (
                            [IdLimiteCredito] => 46002
                            [Nombre] => Límite Credito 1/5
                            [Valor] => 3000000
                        )

                    [ClaseCliente] => Array
                        (
                            [IdClaseCliente] => 6087
                            [Codigo] => ClaseDefecto
                            [Nombre] => Clase Defecto
                        )

                    [ConceptoVenta] => Array
                        (
                            [IdConcepto] => 23
                            [Codigo] => DP0009CV
                            [Nombre] => NOTAS DE DEBITO POR PUBLICIDAD
                            [CategoriaImpuestoIVA] => Array
                                (
                                    [IdCategoriaImpuestoIVA] => 4
                                    [Codigo] => 5
                                    [Nombre] => IVA 21.00
                                    [Tasa] => 21
                                )

                        )

                    [FrecuenciaCliente] => Array
                        (
                            [IdFrecuenciaCliente] => 7044
                            [Nombre] => Frecuencia Defecto
                        )

                    [VisitaRegularDiaSemanaLunes] => 
                    [VisitaRegularDiaSemanaMartes] => 
                    [VisitaRegularDiaSemanaMiercoles] => 
                    [VisitaRegularDiaSemanaJueves] => 
                    [VisitaRegularDiaSemanaViernes] => 
                    [VisitaRegularDiaSemanaSabado] => 
                    [VisitaRegularDiaSemanaDomingo] => 
                    [PoseeMostradorExclusivo] => 
                    [CanalCliente] => Array
                        (
                            [IdCanalCliente] => 7057
                            [Codigo] => OTR
                            [Nombre] => Otros
                        )

                    [CadenaCliente] => Array
                        (
                            [IdCadenaCliente] => 7079
                            [Codigo] => OTR
                            [Nombre] => Otros
                        )

                    [UbicacionCliente] => Array
                        (
                            [IdUbicacionCliente] => 7103
                            [Codigo] => OTR
                            [Nombre] => Otras Zonas
                        )

                    [EdadesPromedioConsumidoresCliente] => Array
                        (
                            [IdEdadesPromedioConsumidoresCliente] => 7104
                            [Codigo] => 111
                            [Nombre] => Hay igual cantidad de consumidores
                        )

                    [GeneroPromedioConsumidoresCliente] => Array
                        (
                            [IdGeneroPromedioConsumidoresCliente] => 7117
                            [Codigo] => 11
                            [Nombre] => Hay igual cantidad de consumidores
                        )

                    [DiasAtencionCliente] => Array
                        (
                            [IdDiasAtencionCliente] => 7120
                            [Codigo] => LV
                            [Nombre] => Lunes a Viernes
                        )

                    [HorarioAtencionCliente] => Array
                        (
                            [IdHorarioAtencionCliente] => 7124
                            [Codigo] => F
                            [Nombre] => 24hs
                        )

                    [CigarreraCliente] => Array
                        (
                            [IdCigarreraCliente] => 7129
                            [Codigo] => NON
                            [Nombre] => No tiene ningún tipo de cigarrera
                        )

                    [ListaPrecio] => Array
                        (
                            [IdListaPrecio] => 1
                            [Codigo] => ListaDefault
                            [Descripcion] => Default
                            [Habilitado] => 1
                            [FechaDesde] => 2015-01-01T00:00:00
                            [FechaHasta] => 2025-12-31T00:00:00
                            [PorcentajePrecioSugerido] => 40
                            [Moneda] => Array
                                (
                                    [IdMoneda] => 1
                                    [Codigo] => ARS
                                    [Nombre] => Peso Argentino
                                    [Cotizacion] => 1
                                )

                            [ListaPrecioAlternativa] => 
                        )

                    [DiasMorosidad] => 30
                    [DiasIncobrables] => 180
                    [EsClienteMassalin] => 
                    [TipoIncoterm] => 
                    [ImporteMinimoPedido] => 
                    [ContactoEnvioComprobanteEmpresa] => Array
                        (
                        )

                    [Activo] => 1
                    [FechaAltaCliente] => 2015-08-01T00:00:00
                    [CondicionIIBB] => Array
                        (
                            [IdCondicionIIBB] => 6052
                            [Codigo] => Convenio Multilatera
                        )

                    [NumeroIIBB] => 
                )

     * 
     * *******/

?>