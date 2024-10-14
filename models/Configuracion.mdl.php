<?
class Configuracion extends Model {

	const TIPO_TEXTO_MONOLINEA 				= 1;
	const TIPO_TEXTO_MULTILINEA 			= 2;
	const TIPO_TEXTO_ENRIQUECIDO 			= 3;
	const TIPO_RADIO			 			= 4;
	const TIPO_IMAGEN			 			= 5;
	const TIPO_ARCHIVO			 			= 6;
	const TIPO_GOOGLEMAP		 			= 7;
	const TIPO_COLORPICKER		 			= 8;
	const TIPO_ARCHIVOS			 			= 9;
	const TIPO_SELECT			 			= 10;

	public static $CAMPOS 					= array(1=>'Texto', 2=>'Texto largo', 3=>'Texto HTML', 4=>'Opciones', 5=>'Imagen', 6=>'Archivo', 7=>'Google Map', 8=>'Color', 9=>'Archivos', 10=>'Select');

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
	public $IdConfiguracion, $Categoria, $Nombre, $Tipo, $Valor, $Extra, $Orden, $Titulo, $Ayuda;

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

		if ($this->Nombre !== null) {
			$aWhere[] = "configuracion.nombre = '{$this->Nombre}'";
		}
		if ($this->Categoria !== null) {
			$aWhere[] = "configuracion.categoria = '{$this->Categoria}'";
		}
		if ($this->Tipo !== null) {
			$aWhere[] = "configuracion.tipo = '{$this->Tipo}'";
		}
		if ($this->Valor !== null) {
			$aWhere[] = "configuracion.valor = '{$this->Valor}'";
		}
		if ($this->Extra !== null) {
			$aWhere[] = "configuracion.extra = '{$this->Extra}'";
		}
		if ($this->Orden !== null) {
			$aWhere[] = "configuracion.orden = '{$this->Orden}'";
		}
		if ($this->Titulo !== null) {
			$aWhere[] = "configuracion.titulo = '{$this->Titulo}'";
		}
		if ($this->Ayuda !== null) {
			$aWhere[] = "configuracion.ayuda = '{$this->Ayuda}'";
		}

		// Arma la cadena SQL.
		$cWhere = $aWhere ? 'WHERE '.join(' AND ', $aWhere) : '';

		$cSql = "SELECT SQL_CALC_FOUND_ROWS configuracion.* FROM configuracion {$cWhere} {$cOrderBy} {$cLimit}";

		

		$this->DB->Query($cSql);
		$aRet = $this->DB->GetRecordset();

		$cSql = "SELECT FOUND_ROWS() total";
		$this->DB->Query($cSql);

		$this->FoundRows = $this->DB->Field('total');

		return $aRet;
	}

	public function BuscarCategorizado() {
		$cSql = "SELECT DISTINCT categoria FROM configuracion";
		$this->DB->Query($cSql);

		$aRet = array();
		foreach ($this->DB->GetRecordset('categoria') as $item) {
			$this->Categoria = $item;
			$aRet[$item] = $this->Buscar();
		}

		$this->Categoria = null;
		return $aRet;
	}

	/**
	 * @desc
	 * Devuelve el registro segun su ID primario.
	 *
	 * @param int $nId
	 * @return array
	 */
	public function Obtener() {
		$cSql = "SELECT configuracion.* FROM configuracion WHERE configuracion.id_configuracion = '{$this->IdConfiguracion}' LIMIT 1";

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

		$cSql = "UPDATE configuracion SET ".
			"valor = ".($this->Valor ? "'{$this->Valor}'" : 'NULL').
			"WHERE id_configuracion = '{$this->IdConfiguracion}' LIMIT 1";

		$this->DB->Query($cSql);

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return $this->IdConfiguracion;
		}
	}

	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function GuardarCampo($cNombre, $vValor) {

		$db = new Dbconnection();

		$cSql = "UPDATE configuracion SET ".
			"valor = ".($vValor ? "'{$vValor}'" : 'NULL').
			"WHERE nombre = '{$cNombre}' LIMIT 1";

		return $db->Query($cSql);

	}

	/**
	 * @desc
	 * Dispara un UPDATE sólo con el ID.
	 *
	 * @return bool
	 */
	public function Actualizar() {
		if ($this->IdConfiguracion) {
			$cSql = "UPDATE configuracion SET ".
				"valor = ".($this->Valor !== null ? "'{$this->Valor}'" : 'NULL')." ".
				"WHERE id_configuracion = '{$this->IdConfiguracion}' LIMIT 1";

			$this->DB->Query($cSql);
		}
		else {
			return false;
		}

		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		}
		else {
			$this->DB->Commit();
			return true;
		}
	}

	/**
	 * @desc
	 * Elimina un registro.
	 *
	 */
	public function Eliminar() {
		$cSql = "DELETE IGNORE FROM configuracion WHERE id_configuracion = '{$this->IdConfiguracion}' LIMIT 1";
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
		$this->IdConfiguracion = $aDatos['id_configuracion'];
		$this->Categoria = $aDatos['categoria'];
		$this->Nombre = $aDatos['nombre'];
		$this->Tipo = $aDatos['tipo'];
		$this->Valor = $aDatos['valor'];
		$this->Extra = $aDatos['extra'];
		$this->Orden = $aDatos['orden'];
		$this->Titulo = $aDatos['titulo'];
		$this->Ayuda = $aDatos['ayuda'];
	}

	/**
	 * @desc
	 * Limpia las propiedades del objeto.
	 *
	 */
	public function Limpiar() {
		$this->IdConfiguracion = $this->Categoria = $this->Nombre = $this->Tipo = $this->Valor = $this->Extra = $this->Orden = $this->Titulo = $this->Ayuda = null;
	}

	public static function BannersPosicion($id_posicion, $limit = "100") {

		$db = new Dbconnection();

		$cSql = "SELECT * FROM banners WHERE publicado = 1 AND (id_posicion = '{$id_posicion}') ORDER BY orden ASC, id_banner DESC LIMIT {$limit}";

		$db->Query($cSql);

		$aBanners = $db->GetRecordset();

		if(isset($aBanners)){
				foreach($aBanners as $key => $item){

					$id = $item['id_banner'];
					$path = APP_PATH_WEBFILES."/banners/".$id."/archivos/*.*";
					$aFiles = glob($path);
					if($aFiles){
						foreach($aFiles as $file){
								$nombre = basename($file);
								$pathUrl = APP_URL_WEBFILES."/banners/".$id."/archivos/".$nombre;
								$aBanners[$key]['archivos'][] = $pathUrl;
						}
					}
				}
		}

		$cHTML = "";

		if(isset($aBanners[0])){
				$n = 0;
				foreach($aBanners as $item){
					$n++;
					if($item['tipo'] == 'html'){

						if(($item['id_posicion'] == 10) || ($item['id_posicion'] == 1000) || ($item['id_posicion'] == 1001) || ($item['id_posicion'] == 4000) || ($item['id_posicion'] == 1500) || ($item['id_posicion'] == 1501)){

							$cHTML .= stripslashes(stripslashes($item['html']));

						} else {

							if($item['margen'] == 0){
								$cHTML .= '<!-- SIN MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
								<div class="container-fluid px-0">';
							} else {
								$cHTML .= '<!-- CON MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
										<div class="container-fluid">';
							}

							$cHTML .= stripslashes(stripslashes($item['html']));

							$cHTML .='</div>
												</div>';
						}

					}

					if($item['tipo'] == 'gif'){

						if($item['margen'] == 0){
							$cHTML .= '<!-- SIN MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
							<div class="container-fluid px-0">';
						} else {
							$cHTML .= '<!-- CON MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
									<div class="container-fluid">';
						}
						
						if($item['margen'] == 0){
							$cHTML .= '<div class="container-fluid px-0"><div class="tt-row">';
						} else {
							$cHTML .= '<div class="container"><div class="tt-row">';
						}

						if($item['enlace']){
							$cHTML .= '<a href="'.$item['enlace'].'" target="_blank"><img src="'.$item['archivos'][0].'" width="100%" class="loading" data-was-processed="true" /></a>';
						} else {
							$cHTML .= '<img src="'.$item['archivos'][0].'" width="100%" class="loading" data-was-processed="true">';
						}

						$cHTML .= '</div></div>';

						$cHTML .='</div>
							</div>';

					}

					if($item['tipo'] == 'jpg'){

						// SIN MARGEN: <div class="contanier-fluid px-0">
						if($item['margen'] == 0){
							$cHTML .= '<!-- SIN MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
							<div class="container-fluid px-0">';
						} else {
							$cHTML .= '<!-- CON MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
									<div class="container-fluid">';
						}
						
						if($item['margen'] == 0){
							$cHTML .= '<div class="container-fluid px-0"><div class="tt-row">';
						} else {
							$cHTML .= '<div class="container"><div class="tt-row">';
						}

						if($item['enlace']){
							$cHTML .= '<a href="'.$item['enlace'].'" target="_blank"><img src="'.$item['archivos'][0].'" width="100%" class="loading" data-was-processed="true" /></a>';
						} else {
							$cHTML .= '<img src="'.$item['archivos'][0].'" width="100%" class="loading" data-was-processed="true">';
						}

						$cHTML .= '</div></div>';

						$cHTML .='</div></div>';

					}

					if($item['tipo'] == 'png'){

							if($item['margen'] == 0){
								$cHTML .= '<!-- SIN MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
								<div class="container-fluid px-0">';
							} else {
								$cHTML .= '<!-- CON MARGEN --><div class="container-indent0 bannerpos-'.$item["id_posicion"].' bannerorden-'.$n.'">
										<div class="container-fluid">';
							}

							if($item['margen'] == 0){
								$cHTML .= '<div class="container-fluid px-0"><div class="tt-row">';
							} else {
								$cHTML .= '<div class="container"><div class="tt-row">';
							}

							if($item['enlace']){
								$cHTML .= '<a href="'.$item['enlace'].'" target="_blank"><img src="'.$item['archivos'][0].'" width="100%" class="loading" data-was-processed="true" /></a>';
							} else {
								$cHTML .= '<img src="'.$item['archivos'][0].'" width="100%" class="loading" data-was-processed="true">';

							}

							$cHTML .= '</div></div>';

							$cHTML .='</div>
								</div>';

					}

				}

		}

		// SALIDA HTML
		return $cHTML;

	}



	public static function ObtenerValor($cCampo) {

		// Antes de conectar a la base y consultar, me fijo si no estoy forzando la configuración.
		// Esto lo hice para poder forzar la configuración por URL y poder mostrar distintas opciones al cliente. FER. 10-04-2013 2:43am
		// Por seguridad, le agrego el prefijo 'conf_' así evito posibles futuros problemas por si alguna configuración se llama igual a algún parametro.
		if(isset($_GET['conf_'.$cCampo])){
			return $_GET['conf_'.$cCampo];
		}

		// Para no consultar todo el tiempo, obtiene los datos en preload.php
		if(isset($GLOBALS['config'][$cCampo])){
			return stripslashes($GLOBALS['config'][$cCampo]);
		} else {
			return false;
		}

	}
}
?>
