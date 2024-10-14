<?
class WebServices {
	/**
	 * Conexión.
	 * @var soapClient
	 */
	private $soap;
	// 'http://gbp11.gbpglobal.com/marstech/app_webservices/wsBasicQuery.asmx?WSDL',
	function __construct() {
		$this->soap = new soapClient(
			'http://gbp7.globalbluepoint.com/marstech/app_webservices/wsBasicQuery.asmx?WSDL',
			array(
				'soap_version' 			=> SOAP_1_1,
				'location'     			=> 'http://gbp7.globalbluepoint.com/marstech/app_webservices/wsBasicQuery.asmx',
				'exceptions'	   		=> true,
				//'features'     		=> SOAP_USE_XSI_ARRAY_TYPE + SOAP_SINGLE_ELEMENT_ARRAYS,
				'trace'        			=> 1,
				'connection_timeout'	=> 5,
				'encoding'				=> 'utf-8',
				//'compression'			=> SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_DEFLATE,
				'cache_wsdl'			=> WSDL_CACHE_NONE,
			)
		);
	}
	
	/**
	 * Autenticación de usuario.
	 * @param string $pUsername
	 * @param string $pPassword
	 * @param int $pCompany
	 * @param int $pWebWervice
	 * return bool
	 */
	public function AutenticarUsuario($pUsername = 'WebService', $pPassword = '987654', $pCompany = 1, $pWebWervice = 1000) {
		$this->datos = new stdClass();
		$this->datos->pUsername = (string) $pUsername;
		$this->datos->pPassword = (string) $pPassword;
		$this->datos->pCompany = (int) $pCompany;
		$this->datos->pWebWervice = (int) $pWebWervice;
		
		$header = new SoapHeader('http://microsoft.com/webservices/','wsBasicQueryHeader',$this->datos);
		$this->soap->__setSoapHeaders($header);
		
		$this->resultado = $this->soap->AuthenticateUser();
		
		$this->datos->pAuthenticatedToken = (string) $this->resultado->AuthenticateUserResult;
		
		$header = new SoapHeader('http://microsoft.com/webservices/','wsBasicQueryHeader',$this->datos);
		$this->soap->__setSoapHeaders($header);
		
		return (bool) $this->datos->pAuthenticatedToken;
	}
	
	/**
	 * Devuelve todas las categorías.
	 * @return array
	 */
	public function Categorias() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->Category_funGetXMLData()->Category_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_categoria' => (int) $item->cat_id,
				'nombre' => (string) $item->cat_desc,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve todas las subcategorías.
	 * Filtra por ID de categoría opcionalmente.
	 * @param int $nIdCategoria
	 * @return array
	 */
	public function Subcategorias($nIdCategoria = -1) {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->SubCategory_funGetXMLData(array('pCategory' => (int) $nIdCategoria))->SubCategory_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_subcategoria' => (int) $item->subcat_id,
				'id_categoria' => (int) $item->cat_id,
				'nombre' => (string) $item->subcat_desc,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve todas las marcas.
	 * @return array
	 */
	public function Marcas() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->Brand_funGetXMLData()->Brand_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_marca' => (int) $item->brand_id,
				'nombre' => (string) $item->brand_desc,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve todos los productos.
	 * @return array
	 */
	public function Productos() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->ItemBasicData_funGetXMLData()->ItemBasicData_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_producto' => (int) $item->item_id,
				'codigo' => (string) $item->item_code,
				'nombre' => (string) $item->item_desc,
				'id_categoria' => (int) $item->cat_id,
				'id_subcategoria' => (int) $item->subcat_id,
				'id_marca' => (int) $item->brand_id,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve todas las sucursales.
	 * @return array
	 */
	public function Sucursales() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->Branch_funGetXMLData()->Branch_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_sucursal' => (int) $item->bra_id,
				'nombre' => (string) $item->bra_desc,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve el stock.
	 * Permite filtrar por sucursal y producto.
	 * 
	 * @param int $nIdSucursal
	 * @param int $nIdProducto
	 * @return array
	 */
	public function Stock($nIdSucursal = -1, $nIdProducto = -1) {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->ItemStorage_funGetXMLData(array('intStor_id' => (int) $nIdSucursal, 'intItem_id' => (int) $nIdProducto))->ItemStorage_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_producto' => (int) $item->item_id,
				'id_deposito' => (int) $item->stor_id,
				'stock_fisico' => (float) $item->FS,
				'stock_potencial' => (float) $item->PS,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve las listas de precio.
	 * 
	 * @return array
	 */
	public function ListasPrecio() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->PriceList_funGetXMLData()->PriceList_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_listaprecio' => (int) $item->prli_id,
				'nombre' => (string) $item->prli_desc,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve los precios según la lista $nIdLista.
	 * @param int $nIdLista
	 * @return array
	 */
	public function Precios($nIdLista) {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->PriceListItems_funGetXMLData(array('pPriceList' => $nIdLista, 'pItem' => -1))->PriceListItems_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_listaprecio' => (int) $item->prli_id,
				'id_producto' => (int) $item->item_id,
				'precio' => (float) $item->prli_price,
				'id_moneda' => (int) $item->curr_id,
				'codigo' => (string) $item->item_code,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve todos los productos con el método completo.
	 * @return array
	 */
	public function ProductosWeb() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->Item_funGetXMLData()->Item_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_producto' => (int) $item->item_id,
				'codigo' => (string) $item->item_code,
				'nombre' => (string) $item->item_desc,
				'id_categoria' => (int) $item->cat_id,
				'id_subcategoria' => (int) $item->subcat_id,
				'id_marca' => (int) $item->brand_id,
				'impuesto1' => (int) $item->tax_id,
				'impuesto2' => (int) $item->tax_id_II,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve las monedas.
	 * @return array
	 */
	public function Monedas() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->Currency_funGetXMLData()->Currency_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_moneda' => (int) $item->curr_id,
				'simbolo' => trim((string) $item->curr_symbol),
				'nombre' => (string) $item->curr_desc,
			);
		}
		
		return $aRet;
	}
	
	/**
	 * Devuelve los impuestos.
	 * @return array
	 */
	public function Impuestos() {
		$aRet = array();
		
		$this->resultado = simplexml_load_string($this->soap->TaxName_funGetXMLData()->TaxName_funGetXMLDataResult);
		
		foreach ($this->resultado as $item) {
			$aRet[] = array(
				'id_impuesto' => (int) $item->tax_id,
				'descripcion' => trim((string) $item->tax_desc),
				'porcentaje' => (float) $item->tax_percentage,
			);
		}
		
		return $aRet;
	}
}
?>