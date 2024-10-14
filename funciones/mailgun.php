<?

class Mailgun
{
    private $apiKey;

    public $asunto, $correoEmisor, $nombreEmisor, $cuerpo, $destinos = [], $archivos = [];

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function enviarCorreo()
    {
        $ch = curl_init();

        $receptores = implode(",", $this->destinos);

        $postFields = [
            'from'      => "$this->nombreEmisor <$this->correoEmisor>",
            'to'        => $receptores,
            'subject'   => isset($this->asunto) ? $this->asunto : 'Consulta en formulario WEB',
            'html'      => $this->cuerpo,
            //'text'    => $this->cuerpo, <--- Activar solo para correos textuales (sin HTML)
        ];

        if (!empty($this->archivos))
        {
            $counter = 1;

            foreach($this->archivos as $archivo)
            {
                $postFields["attachment[$counter]"] = curl_file_create($archivo['ruta'], $archivo['tipo'], $archivo['nombre']);
                $counter++;
            }
        }

        curl_setopt_array($ch, [
            CURLOPT_URL             => 'https://api.mailgun.net/v3/mailgun.globaltransparent.net/messages',
            CURLOPT_POST            => 1,
            CURLOPT_USERPWD         => "api:$this->apiKey",
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_HTTPHEADER      => array('Content-Type: multipart/form-data'),
            CURLOPT_POSTFIELDS      => $postFields
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        $msjlog = "Fecha: ".date("d/m/Y H:i:s")."\n";
        $msjlog .= "Asunto: ".$this->asunto."\n";
        $msjlog .= "Emisor: ".$this->correoEmisor."\n";
        $msjlog .= "Receptores: ".$receptores."\n";
        $msjlog .= "Respuesta: ".$response."\n";
        $msjlog .= "------------------------------------------\n";
        file_put_contents("/var/www/transpar/logs/mailgun.log", $msjlog, FILE_APPEND);

        return $response;
    }
}

?>