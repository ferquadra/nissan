<?php
class System {
	/**
	 * @desc
	 * Log de sucesos de sistema.
	 * 
	 * @return void
	 * @param mixed $mData
	*/
	public static function Log($mData) {
		if (is_array($mData)) {
			$mData = var_export($mData, true);
		}
		
		$sFp = fopen("./system.log", "a+");
		fwrite($sFp, date('YmdHis').":\n {$mData}\n===\n");
		fclose($sFp);
	}
}
?>