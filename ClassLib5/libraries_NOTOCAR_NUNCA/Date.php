<?php
/**
 * @desc
 * Clase para trabajar con fechas.
 * 
 */
class Date {
	
	const ATOM						= 'Y-m-d\TH:i:sP';
	const COOKIE					= 'l, d-M-y H:i:s T';
	const ISO8601					= 'Y-m-d\TH:i:sO';
	const RFC822					= 'D, d M y H:i:s O';
	const RFC850					= 'l, d-M-y H:i:s T';
	const RFC1036					= 'D, d M y H:i:s O';
	const RFC1123					= 'D, d M Y H:i:s O';
	const RFC2822					= 'D, d M Y H:i:s O';
	const RFC3339					= 'Y-m-d\TH:i:sP';
	const RSS						= 'D, d M Y H:i:s O';
	const W3C						= 'Y-m-d\TH:i:sP';
	const NUMERIC					= 'YmdHis';
	const SPANISH_DATE			= 'd/m/Y';
	const SPANISH_DATETIME		= 'd/m/Y H:i:s';
	const TIME						= 'H:i:s';
	const MYSQL						= 'Y-m-d H:i:s';
	
	/**
	 * @desc
	 * DateTime.
	 *
	 * @var DateTime
	 */
	private $Date = null;
	
	private $DefaultTimeZone = 'America/Argentina/Buenos_Aires';
	
	function __construct($mTime=null) {
		date_default_timezone_set($this->DefaultTimeZone);
		
		$cTime = null;
		if (is_numeric($mTime)) {
			$cTime = date(self::ATOM, $mTime);
		}
		
		$this->Date = new DateTime($cTime);
	}
	
	function __tostring() {
		return $this->Date->format(self::NUMERIC);
	}
	
	public function SetDefaultTimeZone($cTimeZone) {
		$this->DefaultTimeZone = $cTimeZone;
		date_default_timezone_set($this->DefaultTimeZone);
	}
	
	public function SetTimestamp($nTimestamp) {
		$this->Date->setDate(date('Y', $nTimestamp), date('m', $nTimestamp), date('d', $nTimestamp));
		$this->Date->setTime(date('H', $nTimestamp), date('i', $nTimestamp), date('s', $nTimestamp));
	}
	
	public function SetDate($nYear, $nMonth, $nDay) {
		$this->Date->setDate($nYear, $nMonth, $nDay);
	}
	
	public function SetTime($nHour, $nMinute, $nSecond) {
		$this->Date->setTime($nHour, $nMinute, $nSecond);
	}
	
	public function GetDate($cFormat=self::NUMERIC) {
		return $this->Date->format($cFormat);
	}
	
	public function Add() {
		
	}
	
	public function Substract() {
		
	}
	
	public function Diff($mDate, $cFormat=self::ATOM) {
		$nTimeObj = strtotime($this->Date->format(self::ATOM));
		
		if (is_numeric($mDate)) {
			$nTimeComp = $mDate;
		}
		elseif (is_object($mDate)) {
			$nTimeComp = strtotime($mDate->GetDate(self::ATOM));
		}
		
		// Diferencia en segundos.
		$nDiff = $nTimeObj - $nTimeComp;
		
		// Usa un nuevo objeto para devolver la fecha con el formato adecuado.
		$oDate = new Date();
		$oDate->SetDate(1, 1, floor($nDiff/86400)+1);
		$oDate->SetTime(floor($nDiff/3600)%24, floor($nDiff/60)%60, $nDiff%60);
		
		// Devuelve la fecha.
		return $oDate->GetDate($cFormat);
	}
}

$b = new Date(time());
$b->SetTime(0, 0, 0);
echo $b;
echo "\n";

$a = new Date();
$a->SetTime(10, 20, 30);
echo $a;
echo "\n";

echo $a->Diff($b, Date::TIME);
?>