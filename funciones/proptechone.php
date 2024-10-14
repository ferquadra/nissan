<?
function proptechone_listado($oid){

    // Conexión con la función Curl para esta url: https://propexone-testing-api.sbi-technology.com/api/Publication/PublicationsTransparent?OrganizationId=FF5A0FEA-A0E2-4BBC-1F78-08DBF1D3F22B
    $curl = curl_init();

    //$oid = "FF5A0FEA-A0E2-4BBC-1F78-08DBF1D3F22B";
    //$oid = "ec70005d-4c7b-4378-c878-08dc38574e68"; // instancia: testqaa

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://propexone-integration-api.sbi-technology.com/api/Publication/PublicationsTransparent?OrganizationId=".$oid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // Convert respond to array
    $response = json_decode($response, true);

    return $response;

}

?>