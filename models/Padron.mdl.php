<?
class Padron extends Model {
	
	function __construct() {
		parent::__construct();
	}
	
	
	/**
	 * @desc
	 * Guarda un registro y devuelve su ID.
	 *
	 * @return int
	 */
	public function Insert($aData) {
		
		$nId = 0;
		
		$cSql = "INSERT INTO padron SET ";
		
		// Solo graba los campos que no tienen la "x" adelante.
		//  muy util para agregar campos en el form y que no interfieran en la grabación.
		//  por ejemplo: x_impuestos_varios
		foreach($aData as $key => $val){
			if(substr($key, 0, 1) != "x"){
				$cSql.= $key." = '".$val."', ";
			}
		}
		
		$cSql = substr($cSql,0, -2);
		
		$this->DB->Begin();
		
		$nId = $this->DB->QueryInsert($cSql);
		
		if ($this->DB->GetLastError()) {
			$this->DB->Rollback();
			return 0;
		} else {
			$this->DB->Commit();
			return $nId;
		}
	}
}
?>