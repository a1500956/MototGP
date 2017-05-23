<?php
class Kuljettaja implements JsonSerializable {
	
	private static $virhelista = array (
			- 1 => "Virheellinen tieto",
			0 => "",
			11 => "Etunimi on pakollinen",
			15 => "Sukunimi on pakollinen",
			12 => "Etunimi on liian lyhyt",
			13 => "Etunimi on liian pitkä",
			60 => "Sukunimi on liian lyhyt",
			61 => "Sukunimi on liian pitkä",
			14 => "Maata ei löydy, kuljettajan tulee olla Pohjoismaista",
			16 => "Maa on pakollinen",
			24 => "Etunimessä saa olla vain kirjaimia sekä merkki -",
			25 => "Sukunimessä saa olla vain kirjaimia sekä merkki -",
			31 => "Kilpanumero on pakollinen",
			32 => "Kilpanumeron tulee olla kokonaisluku väliltä 1-99",
			34 => "Syntymävuosi ei voi olla tulevaisuudessa",
			39 => "Kuljettajan täytyy olla täysi-ikäinen, mutta alle 60 vuotias. ",
			53 => "Lisätietoja- kentässä liikaa merkkejä, max 35 merkkiä",
			54 => "Lisätietoja- kentässä saa olla vain kirjaimia, numeroita sekä merkit - ,.!?)(",
			57 => "Syntymävuosi on pakollinen",
			58 => "Syntymävuoden täytyy olla tältä tai edelliseltä vuosituhannelta",
			59 => "Syntymävuoden tulee olla nelinumeroinen kokonaisluku",
			55 => "Lisätietoja- kentässä täytyy olla vähintään 3 merkkiä"			
	);
	
	private $etunimi;
	private $sukunimi;
	private $kansalaisuus;
	private $kilpanumero;
	private $syntymavuosi;
	private $lisatietoja;
	private $kuljettaja_id;
	
	public function jsonSerialize() {
		return array ( 
				"etunimi" => $this->etunimi,
				"sukunimi" => $this->sukunimi,
				"kansalaisuus" => $this->kansalaisuus,
				"kilpanumero" => $this->kilpanumero,
				"syntymavuosi" => $this->syntymavuosi,
				"lisatietoja" => $this->lisatietoja,
				"kuljettaja_id" => $this->kuljettaja_id 
		);
	}
	
	function __construct($etunimi = "", $sukunimi = "", $kansalaisuus = "", $kilpanumero = "", $syntymavuosi = "" , $lisatietoja = "", $kuljettaja_id = 0) {
		
		$this->etunimi = trim ( $etunimi );
		$this->sukunimi = trim ( $sukunimi );
		$this->kansalaisuus = trim ( $kansalaisuus );
		$this->kilpanumero = trim ( $kilpanumero );
		$this->syntymavuosi = trim ( $syntymavuosi );
		$this->lisatietoja = trim ( $lisatietoja );
		$this->kuljettaja_id = $kuljettaja_id;
		
	}
	
	public function setEtunimi($etunimi) {
		
		$Enimi = trim ( $etunimi );
		$Enimi = mb_convert_case ( $Enimi, MB_CASE_LOWER, "UTF-8" );
		$Enimi = mb_convert_case ( $Enimi, MB_CASE_TITLE, "UTF-8" );
		
		$this->etunimi = $Enimi;
	}
	public function getEtunimi() {
		
		return $this->etunimi;
	}

	public function checkEtunimi($required = true, $min = 2, $max = 20) {
		
		if ($required == false && strlen ( $this->etunimi ) == 0) {
			
			return 0;
		}
			
		if ($required == true && strlen ( $this->etunimi ) == 0) {
			
			return 11;
		}
			
		if (strlen ( $this->etunimi ) < $min) {
			
			return 12;
		}
			
		if (strlen ( $this->etunimi ) > $max) {
			
			return 13;
		}
		
		if (preg_match ( "/[^a-zöåä \-]/i", $this->etunimi )) {
			
			return 24;
		}
	
		return 0;
	}
	public function setSukunimi($sukunimi) {
		
		$Snimi = trim ( $sukunimi );
		$Snimi = mb_convert_case ( $Snimi, MB_CASE_LOWER, "UTF-8" );
		$Snimi = mb_convert_case ( $Snimi, MB_CASE_TITLE, "UTF-8" );
		
		$this->sukunimi = $Snimi;
	}
	public function getSukunimi() {
		
		return $this->sukunimi;
	}
	
	public function checkSukunimi($required = true, $min = 2, $max = 30) {

		if ($required == false && strlen ( $this->sukunimi ) == 0) {
			
			return 0;
		}

		if ($required == true && strlen ( $this->sukunimi ) == 0) {
			
			return 15;
		}

		if (strlen ( $this->sukunimi ) < $min) {
			
			return 60;
		}

		if (strlen ( $this->sukunimi ) > $max) {
			
			return 61;
		}

		if (preg_match ( "/[^a-zöåä \-]/i", $this->sukunimi )) {
			
			return 25;
		}
		
		return 0;
	}
	
	public function setKansalaisuus ($kansalaisuus) {
		
		$Maa = trim ( $kansalaisuus );
		$Maa = mb_convert_case ( $Maa, MB_CASE_LOWER, "UTF-8" );
		$Maa = mb_convert_case ( $Maa, MB_CASE_TITLE, "UTF-8" );
		$this->kansalaisuus = $Maa;
	}
	
	public function getKansalaisuus() {
		
		return $this->kansalaisuus;
	}
	
	public function checkKansalaisuus($required = true) {
		
		if ($required == true && strlen ( $this->kansalaisuus ) == 0) {
			
			return 16;
		}
			
		$maat = array("Suomi", "Ruotsi", "Tanska", "Norja", "Islanti");

		if (!in_array(mb_convert_case($this->kansalaisuus, MB_CASE_TITLE, "UTF-8"), $maat)) {
			
		return 14;
		
		}
		
		return 0;
	}
	
	public function setKilpanumero ($kilpanumero) {
		
		$this->kilpanumero = $kilpanumero;
	}
	
	public function getKilpanumero() {
		
		return $this->kilpanumero;
	}
	
	public function checkKilpanumero($required = true) {
		
		$numeroMin = 1;
		$numeroMax = 99;
			
		if ($required == true && strlen ( $this->kilpanumero ) == 0) {
			
			return 31;
		}
		
		
		if (preg_match ( '~^[1-9]{1}[0-9]{0,1}+$~u', $this->kilpanumero )) {
			
			if ($this->kilpanumero < $numeroMin || $this->kilpanumero > $numeroMax) {
				
				return 32;
		
			}else{
			
				return 0;	
			}
		
			
		}else{
			
			return 32;
			
		}
		
		return 0;
	}
	
	public function setLisatietoja($lisatietoja) {
		$this->lisatietoja = trim ( $lisatietoja );
	}
	
	public function getLisatietoja() {
		return $this->lisatietoja;
	}

	public function checkLisatietoja($required = true, $min = 3, $max = 35) {
		
		if ($required == false && strlen ( $this->lisatietoja ) == 0) {
			
			return 0;
		}	
		
		if (strlen ( $this->lisatietoja ) > $max) {
			
			return 53;
		}
		
		if (strlen ( $this->lisatietoja ) < $min) {
			
			return 55;
		}

		if (preg_match ('~^[a-zöåäA-ZÖÅÄ0-9\-.,!?()\s]+$~u', $this->lisatietoja )) {
			
			return 0;
			
		}else{
			
			return 54;
		}
		
		return 0;
	}
	
	public function setSyntymavuosi($syntymavuosi) {
		$this->syntymavuosi = $syntymavuosi;
	}
	
	public function getSyntymavuosi() {
		return $this->syntymavuosi;
	}

	public function checkSyntymavuosi($required = true) {
		
		if ($required == true && strlen ( $this->syntymavuosi ) == 0) {
			
			return 57;
		}
		
		if (! preg_match ('~^[1-9][0-9]{3}+$~u', $this->syntymavuosi )) {
			
			return 59;	
		}
		
		if (! preg_match ('~^[1-2][0-9]{3}+$~u', $this->syntymavuosi )) {
			
			return 58;	
		}
		
		$vuosi = date ( "Y", time () );
		if ($this->syntymavuosi > $vuosi) {
			
			return 34;
		}
		
		$vuosi = date ( "Y", time () );
		if ($vuosi - $this->syntymavuosi > 60 || $vuosi - $this->syntymavuosi < 18) {
			
			return 39;
		}
		
		return 0;
	}
	
	public function setKuljettaja_id($kuljettaja_id) {
		$this->kuljettaja_id = $kuljettaja_id;
	}
	
	public function getKuljettaja_id() {
		return $this->kuljettaja_id;
	}
	
	public static function getError($virhekoodi) {
		
		if (isset ( self::$virhelista [$virhekoodi] ))
			return self::$virhelista [$virhekoodi];
		
		return self::$virhelista [- 1];
	}
}
?>