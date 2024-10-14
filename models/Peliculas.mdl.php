<?
class Peliculas extends Model {
	
	/**
	 * @desc
	 * Cadena con el ORDER BY.
	 *
	 * @var string
	 */
	public $OrderBy;
	
	/**
	 * @desc
	 * Numero de pagina.
	 * Comienza en 1 (1 = primer pagina).
	 * 
	 * Si se pasa un valor menor a 1 lo ignora.
	 *
	 * @var int
	 */
	public $Page;
	
	
	/**
	 * @desc
	 * Limite de consulta.
	 * Se usa junto a Page.
	 * 
	 * Si se asigna NULL no se hace un limite en la consulta.
	 *
	 * @var int
	 */
	public $LimitCant = APP_MYSQL_LIMIT;
	
	/**
	 * @desc
	 * Indica la cantidad total de registros si no se
	 * ubiera usado la clausula LIMIT en la consulta.
	 *
	 * @var int
	 */
	public $FoundRows;
	
	/**
	 * @desc
	 * Propiedades del modelo.
	 *
	 * @var mixed
	 */
	public $Id, $id_genero, $id_subgenero, $Titulo, $Publicado, $Destacado, $Notas, $FechaAlta;
	public $Titulo_org;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @desc
	 * Realiza una busqueda de registros.
	 * Ordena por la propiedad OrderBy.
	 * Limita registros por las propiedades Page y LimitCant.
	 * 
	 * Calcula la cantidad de registros sin el limite y lo pone en la
	 * propiedad FoundRows.
	 *
	 * @return array
	 */
	public function Buscar() {
		$cOrderBy = $cLimit = '';
		$aWhere = array();
		
		// Ordenacion.
		if ($this->OrderBy) {
			$cOrderBy = "ORDER BY {$this->OrderBy}";
		}
		
		// Paginacion.
		if ($this->Page < 1) {
			$this->Page = 1;
		}
		if ($this->LimitCant !== null) {
			$nLimit = ($this->Page - 1) * $this->LimitCant;
			$cLimit = "LIMIT {$nLimit}, {$this->LimitCant}";
		}
		else {
			$cLimit = '';
		}
		
		if ($this->Titulo !== null) {
			$aWhere[] = "peliculas.titulo LIKE '%{$this->Titulo}%' OR peliculas.titulo LIKE '%{$this->Titulo_org}%'";
		}
		
		if ($this->Publicado !== null) {
			$aWhere[] = "peliculas.publicado = '{$this->Publicado}'";
		}
		
		if ($this->Destacado !== null) {
			$aWhere[] = "peliculas.destacado = '{$this->Destacado}'";
		}

		
		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';
		
		$cSql = "SELECT SQL_CALC_FOUND_ROWS peliculas.* FROM peliculas {$cWhere} {$cOrderBy} {$cLimit}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);
		
		$this->FoundRows = $this->DB->Field('total');
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Devuelve el registro según su ID primario.
	 *
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {
		$cSql = "SELECT peliculas.* FROM peliculas WHERE id_film = {$this->Id} LIMIT 1";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		
		if ($aRet) {
			$this->Set($aRet);
		}
		else {
			$this->Limpiar();
		}
		
		return $aRet;
	}
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Guardar() {
		$this->DB->Begin();
		
		if ($this->IdNoticias) {
			$cSql = "UPDATE noticias SET ".
				"nombre = '{$this->Nombre}', ".
				"publicado = '{$this->Publicado}', ".
				"descripcion = '{$this->Descripcion}', ".
				"notas = ".($this->Notas ? "'{$this->Notas}'" : 'NULL')." ".
				"WHERE id_noticias = '{$this->IdNoticias}' LIMIT 1";
			$this->DB->Query($cSql);
		}
		else {
			$cSql = "INSERT INTO noticias SET ".
				"nombre = '{$this->Nombre}', ".
				"publicado = '{$this->Publicado}', ".
				"descripcion = '{$this->Descripcion}', ".
				"notas = ".($this->Notas ? "'{$this->Notas}'" : 'NULL')."";
			
			$this->IdNoticias = $this->DB->QueryInsert($cSql);
		}
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdNoticias;
		}
	}
	
	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM noticias WHERE id_noticias = '{$this->IdNoticias}' LIMIT 1";
		$this->DB->Query($cSql);
		
		return $this->DB->AffectedRows();
	}
	
	/**
	 * @desc
	 * Llena las propiedades del modelo con los datos
	 * provistos en el array $aDatos.
	 *
	 * @param array $aDatos
	 */
	private function Set($aDatos) {

		$this->Id = $aDatos['id_film'];
		$this->Titulo = $aDatos['titulo'];
		$this->id_genero = $aDatos['id_genero'];
		$this->id_subgenero = $aDatos['id_subgenero'];

	}
	
	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdNoticias = $this->Nombre = $this->Publicado = $this->Notas = null;
	}

	public function PeliculasCartelera(){
		
		//$tiempo = time() - 604800;
		$tiempo = JuevesAnterior(true); 

		$cSql = "SELECT * FROM peliculas, tiempos WHERE peliculas.id_film = tiempos.id_film AND tiempos.ingreso > {$tiempo} AND tiempos.egreso = 0 ORDER BY peliculas.escala DESC";
		$this->DB->Query($cSql);
		$aRec = $this->DB->GetRecordset();
		
		if(count($aRec) < 1){
		
			$tiempo = $tiempo - 691200; // 8 días atrás... suficiente, no hay necesidad de rastrear el Jueves anterior. Fer 9-11-2012.

			$cSql = "SELECT * FROM peliculas, tiempos WHERE peliculas.id_film = tiempos.id_film AND tiempos.ingreso > {$tiempo} AND tiempos.egreso = 0 ORDER BY peliculas.escala DESC";
			$this->DB->Query($cSql);
			$aRec = $this->DB->GetRecordset();
			
		}
		
		foreach ($aRec as $key => $aRow) {
			if (file_exists(APP_PATH."/infores/".$aRec[$key]["id_film"]."rd.jpg")) $aRec[$key]['cartel-thumb'] = "http://www.rosariocine.com.ar/infores/".$aRow["id_film"]."rd.jpg";
			if (file_exists(APP_PATH."/info/".$aRec[$key]["id_film"]."d.jpg")) $aRec[$key]['cartel'] = "http://www.rosariocine.com.ar/info/".$aRow["id_film"]."d.jpg";
		}
		
		return $aRec;
	}
	
		
	public function YouTube($id_film){

		$cSql = "SELECT url FROM trailers WHERE id_film = {$id_film} LIMIT 1";
		$this->DB->Query($cSql);
		$aRet = $this->DB->Field();
		return $aRet;
		
	}
	
	public function fotosPeliculasVert($id_film){
		
		$path = null;
		$aLetras = array('a', 'b', 'c');
		
		foreach ($aLetras as $letra){
					if (file_exists(APP_PATH."/infores/".$id_film."r".$letra.".jpg")) $path['thumb'][] = "http://www.rosariocine.com.ar/infores/".$id_film."r".$letra.".jpg";
					if (file_exists(APP_PATH."/info/".$id_film.$letra.".jpg")) $path['big'][] = "http://www.rosariocine.com.ar/info/".$id_film.$letra.".jpg";
		}
				
		return $path;
		
	}
	
	public function horariosTV($id_pelitv){

		$mes = date("m");
        $year = date("y");
		
		$cSql = "SELECT * FROM pelitv_horario WHERE id_pelitv = {$id_pelitv} AND fecha LIKE '%/{$mes}/{$year}'";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
 
        foreach ($aRet as $row){
                if ($row['canal']) $dubleymoore .= "<b>".$row['canal']."</b> ".crea_fecha2($row['fecha'])." a las ".substr($row['hora'],0,5)." Hs.<br>";
        }
        
		return $dubleymoore;
	
	}
	
	public function horariosCine($numero = 0){
		
		$desdeJueves = Jueves();
		
		$cSql = "SELECT * FROM horarios WHERE id_pelicula = $numero AND notas <> '' AND medio = 'cine' AND fecha = '$desdeJueves'";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		//echo $cSql; die;
		if(@$aRet[0]['notas']){
			return $aRet[0]['notas'];
		} else {
			return false;
		}
	
	}
	
	public function MasInteres($nIdGenero, $nIdSubgenero, $nIdFilm = 0){
	
		$aRec = Interes($nIdGenero, $nIdSubgenero, 4, $nIdFilm);
           		
		foreach ($aRec as $key => $aRow) {
			if (file_exists(APP_PATH."/infores/".$aRec[$key]["id_film"]."rd.jpg")) $aRec[$key]['imagen'] = "http://www.rosariocine.com.ar/infores/".$aRow["id_film"]."rd.jpg";
			elseif (file_exists(APP_PATH."/info/".$aRec[$key]["id_film"]."d.jpg")) $aRec[$key]['imagen'] = "http://www.rosariocine.com.ar/info/".$aRow["id_film"]."d.jpg";
		}
					
		return $aRec;
	}
	
	public function Criticas($id_film){
		
		$cSql = "SELECT * FROM criticas WHERE id_film = {$id_film}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		foreach ($aRet as $key => $aRow) {
			if (file_exists(APP_PATH."/infores/".$aRet[$key]["id_film"]."rd.jpg")) $aRet[$key]['imagen'] = "http://www.rosariocine.com.ar/infores/".$aRow["id_film"]."rd.jpg";
			elseif (file_exists(APP_PATH."/info/".$aRet[$key]["id_film"]."d.jpg")) $aRet[$key]['imagen'] = "http://www.rosariocine.com.ar/info/".$aRow["id_film"]."d.jpg";
		}
	
        return $aRet;
		
	}
	
	public function CriticasTodas($desde = 0, $cantidad = 42){
		
		$cSql = "SELECT criticas.*, peliculas.titulo FROM criticas, peliculas WHERE criticas.id_film = peliculas.id_film ORDER BY criticas.id_film DESC LIMIT {$desde}, {$cantidad}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
	
		foreach ($aRet as $key => $aRow) {
			if (file_exists(APP_PATH."/infores/".$aRet[$key]["id_film"]."rd.jpg")) $aRet[$key]['imagen'] = "http://www.rosariocine.com.ar/infores/".$aRow["id_film"]."rd.jpg";
			elseif (file_exists(APP_PATH."/info/".$aRet[$key]["id_film"]."d.jpg")) $aRet[$key]['imagen'] = "http://www.rosariocine.com.ar/info/".$aRow["id_film"]."d.jpg";
		}
	
        return $aRet;
		
	}
	
	public function Cartelera(){
	
		$desdeJueves = Jueves();

		$cSql = "SELECT * FROM peliculas, horarios, tiempos WHERE peliculas.id_film = horarios.id_pelicula AND peliculas.id_film = tiempos.id_film AND horarios.medio = 'cine' AND horarios.notas <> '' AND horarios.fecha = '{$desdeJueves}' AND peliculas.publicar = 1 GROUP BY peliculas.id_film ORDER BY tiempos.ingreso DESC, peliculas.titulo ASC";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		if(count($aRet) < 1){
		
			$desdeJueves = date("d/m/Y", time()-691200); // 8 días atrás... suficiente, no hay necesidad de rastrear el Jueves anterior. Fer 9-11-2012.

			$cSql = "SELECT * FROM peliculas, horarios, tiempos WHERE peliculas.id_film = horarios.id_pelicula AND peliculas.id_film = tiempos.id_film AND horarios.medio = 'cine' AND horarios.notas <> '' AND horarios.fecha = '{$desdeJueves}' AND peliculas.publicar = 1 GROUP BY peliculas.id_film ORDER BY peliculas.titulo ASC";
			$this->DB->Query($cSql);
			$aRet = $this->DB->GetRecordset();
			
		}
		
		foreach ($aRet as $key => $valor){
		
			if(file_exists(APP_PATH."/infores/".$aRet[$key]['id_film']."rd.jpg")){
				$aRet[$key]['fotochica'] = "http://www.rosariocine.com.ar/infores/".$aRet[$key]['id_film']."rd.jpg";
			}
		
			if(file_exists(APP_PATH."/info/".$aRet[$key]['id_film']."d.jpg")){
				$aRet[$key]['fotogrande'] = "http://www.rosariocine.com.ar/info/".$aRet[$key]['id_film']."d.jpg";
			}
			
		}
		
		return $aRet;
	
	}
	
	public function SanearHorarios($horarios, $cine = null){
		
		if(!$cine){
			$horarios = str_replace("Monumental", "<br /><strong>Monumental</strong>", $horarios);
			$horarios = str_replace("Showcase", "<br /><strong>Showcase</strong>", $horarios);
			$horarios = str_replace("Cines Del Centro", "<br /><strong>Cines del Centro</strong>", $horarios);
			$horarios = str_replace("Sunstar", "<br /><strong>Sunstar</strong>", $horarios);
			$horarios = str_replace("Village", "<br /><strong>Village</strong>", $horarios);
		} elseif($cine == "monumental") {
			$horarios = str_replace("Monumental", "<br /><strong>Monumental</strong>", $horarios);
			$horarios = str_replace("Showcase", "<br />Showcase", $horarios);
			$horarios = str_replace("Cines Del Centro", "<br />Cines del Centro", $horarios);
			$horarios = str_replace("Sunstar", "<br />Sunstar", $horarios);
			$horarios = str_replace("Village", "<br />Village", $horarios);
		} elseif($cine == "showcase") {
			$horarios = str_replace("Showcase", "<br /><strong>Showcase</strong>", $horarios);
		} elseif($cine == "cines del centro") {
			$horarios = str_replace("Cines Del Centro", "<br /><strong>Cines del Centro</strong>", $horarios);
		} elseif($cine == "village") {
			$horarios = str_replace("Village", "<br /><strong>Village</strong>", $horarios);
		} elseif($cine == "sunstar") {
			$horarios = str_replace("Sunstar", "<br /><strong>Sunstar</strong>", $horarios);
		}
		return $horarios;
	
	}
	
	public function TiempoEnCartel($cant = 6){ /////// COMIENZO DE FUNCION PARA INDEX PROXIMOS ESTRENOS CINE
				
		$hoy = time();

		$desdeJueves = Jueves();

		$cSql  = "SELECT peliculas.titulo, tiempos.id_film, ($hoy - ingreso) seg";
		$cSql .= " FROM tiempos INNER JOIN peliculas ON tiempos.id_film = peliculas.id_film INNER JOIN horarios ON peliculas.id_film = horarios.id_pelicula";
		$cSql .= " WHERE tiempos.id_film = peliculas.id_film AND ingreso > 0 AND egreso = 0 AND horarios.medio = 'cine' AND horarios.fecha = '$desdeJueves'";
		$cSql .= " ORDER BY seg DESC LIMIT $cant";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		foreach ($aRet as $key => $row){
		
			$cont++;
			$aRet[$key]['horas'] = round((($aRet[$key]['seg'] / 86400) - intval(($aRet[$key]['seg'] / 86400))) * 24);
			$aRet[$key]['dias']  = intval(($aRet[$key]['seg'] / 86400));
			
			if ($aRet[$key]['dias']) $aRet[$key]['dias'] .= " Dias";
				else $aRet[$key]['dias'] = "";
				
			$aRet[$key]['horas'] .=  " Hs.";
			
			if ($cont == 1) $cien = (100 / $aRet[$key]['seg']);
			
			switch($cont){
				case 1: $aRet[$key]['color'] = "#FF0000"; break;
				case 2: $aRet[$key]['color'] = "#FF3300"; break;
				case 3: $aRet[$key]['color'] = "#FF6600"; break;
				case 4: $aRet[$key]['color'] = "#FF9900"; break;
				case 5: $aRet[$key]['color'] = "#FFCC00"; break;
				case 6: $aRet[$key]['color'] = "#FFFF00"; break;
				}
			if ($cont > 6) $aRet[$key]['color'] = "#00CC00";
			
			$aRet[$key]['porcentaje'] = $cien * $aRet[$key]['seg'];
			if ($aRet[$key]['porcentaje'] > 99) $aRet[$key]['porcentaje'] = 95;
			
		} 
		
		return $aRet;

	}
	
	public function ProximosEstrenos($nLimit = 10){
	
		$cLImit = "";
		if($nLimit) {
			$cLimit = "LIMIT {$nLimit}";
		}
	
		$cSql = "SELECT * FROM peliculas, tiempos WHERE peliculas.id_film = tiempos.id_film AND peliculas.publicar = 1 AND tiempos.carga > 0 AND tiempos.ingreso = 0 GROUP BY tiempos.id_film ORDER BY peliculas.escala DESC {$cLimit}";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		foreach ($aRet as $key => $valor){
			if(file_exists(APP_PATH."/infores/".$aRet[$key]['id_film']."rd.jpg")){
				$aRet[$key]['cartel-thumb'] = "http://www.rosariocine.com.ar/infores/".$aRet[$key]['id_film']."rd.jpg";
			}
			if(file_exists(APP_PATH."/info/".$aRet[$key]['id_film']."d.jpg")){
				$aRet[$key]['cartel'] = "http://www.rosariocine.com.ar/info/".$aRet[$key]['id_film']."d.jpg";
			}
		}
		
		return $aRet;
		
	}
	
	public function Television($desde = 0, $cant = 4){
		$cSql = "SELECT * FROM peliculas, destacados WHERE peliculas.id_film = destacados.id_film GROUP BY peliculas.titulo ORDER BY destacados.fecha DESC LIMIT {$cant}";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		foreach ($aRet as $key => $valor){
		
			$aRet[$key]['horario'] = $this->horariosTV($aRet[$key]['id_film']);
		
			if(file_exists(APP_PATH."/infores/".$aRet[$key]['id_film']."rd.jpg")){
				$aRet[$key]['cartel-thumb'] = "http://www.rosariocine.com.ar/infores/".$aRet[$key]['id_film']."rd.jpg";
			}
			if(file_exists(APP_PATH."/info/".$aRet[$key]['id_film']."d.jpg")){
				$aRet[$key]['cartel'] = "http://www.rosariocine.com.ar/info/".$aRet[$key]['id_film']."d.jpg";
			}
			if(file_exists(APP_PATH."/infores/".$aRet[$key]['id_film']."ra.jpg")){
				$aRet[$key]['foto-a-thumb'] = "http://www.rosariocine.com.ar/infores/".$aRet[$key]['id_film']."ra.jpg";
			}
		}
		
		return $aRet;
		
	}
	
	public function Buscador($busca, $desde = 0, $cantidad = 50){
		
		$cSql = "SELECT * FROM peliculas";
		$cSql .= " WHERE";
		$cSql .= " titulo LIKE '%{$busca}%' OR";
		$cSql .= " titulo_org LIKE '%{$busca}%' OR";
		//$cSql .= " elenco LIKE '%{$busca}%' OR";
		$cSql .= " year LIKE '%{$busca}%' OR";
		$cSql .= " actor LIKE '%{$busca}%' OR";
		$cSql .= " director LIKE '%{$busca}%' ";
		$cSql .= "ORDER BY id_film DESC LIMIT {$desde}, {$cantidad}";
		
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
	}
	
	public function UltimosHorariosCine(){
	
		$cSql = "SELECT * FROM horarios WHERE medio = 'cine' ORDER BY id_horario DESC LIMIT 1";
	
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
		
	}
	
	public function Envios($cFecha){
	
		$cSql = "INSERT INTO envios SET fecha = '{$cFecha}'";
		$this->DB->Query($cSql);
		
	}
	
	public function UltimoEnvio(){
	
		$cSql = "SELECT * FROM envios ORDER BY id_envio DESC LIMIT 1";
		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();
		
		return $aRet;
		
	}
	
	public function CreoCamp($cFecha, $cBody, $cAsunto){
	
			$baseURL = 'http://v2.envialosimple.com';
			$apiKey = NEWSLETTER_API_KEY;

			// Creo nueva campaña
			$params = array();
			$params['APIKey']=$apiKey;
			$params['CampaignName']='Cartelera RosarioCine Automatica '.date("d/m/Y H:i:s");
			$params['CampaignSubject']=$cAsunto;
			$params['MailListsIds[]']='2';
			$params['FromID']='1';
			$params['ReplyToID']='1';
			$params['TrackLinkClicks']='1';
			$params['TrackReads']='1';
			$params['TrackAnalitics']='1';
			$params['SendStateReport']='';
			$params['AddToPublicArchive']='0';
			$params['ScheduleCampaign']='1';
			$params['SendNow']='0';
			$params['SendDate']=$cFecha;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $baseURL.'/campaign/save/format/json');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			$jsonResponse = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($jsonResponse, true);

			$ok = isset($response['root']['ajaxResponse']['success']);
			if(!$ok)
			{
				mail("fcuadrado@estudioquadra.com", "error de campaña rosariocine ".date("d/m/Y H:i:s"), print_r($response, true), "From: info@rosariocine.com.ar");
				return false;
				exit;
			}

			$id = $response['root']['ajaxResponse']['campaign']['CampaignID'];
			$name = $response['root']['ajaxResponse']['campaign']['Name'];
			echo "Nueva Campaña: $id $name\n";
			if($response['root']['ajaxResponse']['campaign']['integrity']['status']=='1')
			{
				if($response['root']['ajaxResponse']['campaign']['integrity']['subject']=='-1')
				{
					echo "Debes asignar un Asunto.\n";
				}

				if($response['root']['ajaxResponse']['campaign']['integrity']['schedule']=='-1')
				{
					echo "Debes determinar una configuracion de envio\n";
				}

				if($response['root']['ajaxResponse']['campaign']['integrity']['content']=='-1')
				{
					echo "Debes determinar un contenido de la campaña\n";
				}

				if($response['root']['ajaxResponse']['campaign']['integrity']['replyTo']=='-1')
				{
					echo "Debes determinar un remitente 'reply to'\n";
				}

				if($response['root']['ajaxResponse']['campaign']['integrity']['fromTo']=='-1')
				{
					echo "Debes determinar un origen 'from'\n";
				}

				if($response['root']['ajaxResponse']['campaign']['integrity']['maillist']=='-1')
				{
					echo "Debes determinar una o varias listas de contactos\n";
				}
			}

			// Crea contenido
			$params = array();
			$params['APIKey']=$apiKey;
			$params['CampaignID']=$id;
			$params['HTML']= $cBody;
			$params['PlainText']='texto alternativo';

			// Asigno contenido a la campaña.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $baseURL.'/content/edit/format/json');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			$jsonResponse = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($jsonResponse, true);
			$ok = isset($response['root']['ajaxResponse']['success']);
			if(!$ok)
			{
				mail("fcuadrado@estudioquadra.com", "error de contenido de campaña rosariocine ".date("d/m/Y H:i:s"), print_r($response, true), "From: info@rosariocine.com.ar");
				return false;
				exit;
			}
			
			// Envio la campaña
			$params = array();
			$params['APIKey']=$apiKey;
			$params['CampaignID']=$id;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $baseURL.'/campaign/resume/format/json');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			$jsonResponse = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($jsonResponse, true);
			$ok = isset($response['root']['ajaxResponse']['success']);

			if(!$ok)
			{
				mail("fcuadrado@estudioquadra.com", "error al enviar campaña rosariocine ".date("d/m/Y H:i:s"), print_r($response, true), "From: info@rosariocine.com.ar");
				return false;
				exit;
			}
			
			return true;

	}
	
}
?>
