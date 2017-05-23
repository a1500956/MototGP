<?php
require_once "kuljettaja.php";
class kuljettajaPDO {

	private $db;
	private $lkm;

	function __construct($dsn = "mysql:host=localhost;dbname=a1500956", $user = "root", $password = "salainen") {
		
		$this->db = new PDO ( $dsn, $user, $password );

		$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		$this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );

		$this->lkm = 0;
	}

	
	function getLkm() {
		return $this->lkm;
	}

	public function kaikkiKuljettajat() {
		$sql = "SELECT kuljettaja_id, etunimi, sukunimi, maa, kilpanumero, syntymavuosi, lisatietoja
		        FROM kuljettaja";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();

			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();

			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$tulos = array ();

		while ( $row = $stmt->fetchObject () ) {
			
			$kuljettaja = new Kuljettaja ();

			$kuljettaja->setKuljettaja_id ( $row->kuljettaja_id );
			$kuljettaja->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$kuljettaja->setSukunimi ( utf8_encode ( $row->sukunimi ) );
			$kuljettaja->setKansalaisuus ( utf8_encode ( $row->maa ) );
			$kuljettaja->setKilpanumero ( $row->kilpanumero );
			$kuljettaja->setSyntymavuosi ( $row->syntymavuosi );
			$kuljettaja->setLisatietoja ( utf8_encode ( $row->lisatietoja ) );

			$tulos [] = $kuljettaja;
		}

		$this->lkm = $stmt->rowCount ();

		return $tulos;
	}

	public function haeKuljettaja($kilpanumero) {
		$sql = "SELECT kuljettaja_id, etunimi, sukunimi, maa, kilpanumero, syntymavuosi, lisatietoja
		        FROM kuljettaja
				WHERE kilpanumero like :kilpanumero";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$kilpaNro = "%" . ( $kilpanumero )  . "%";
		$stmt->bindValue ( ":kilpanumero", $kilpaNro, PDO::PARAM_STR );

		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();

			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}

			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$tulos = array ();

		while ( $row = $stmt->fetchObject () ) {
			$kuljettaja = new Kuljettaja ();

			$kuljettaja->setKuljettaja_id ( $row->kuljettaja_id );
			$kuljettaja->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$kuljettaja->setSukunimi ( utf8_encode ( $row->sukunimi ) );
			$kuljettaja->setKansalaisuus ( utf8_encode ( $row->maa ) );
			$kuljettaja->setKilpanumero ( $row->kilpanumero );
			$kuljettaja->setSyntymavuosi ( $row->syntymavuosi );
			$kuljettaja->setLisatietoja ( utf8_encode ( $row->lisatietoja ) );

			$tulos [] = $kuljettaja;
		}

		$this->lkm = $stmt->rowCount ();

		return $tulos;
	}
	
	public function poistaKuljettaja($kuljettaja_id) {
		$sql = "Delete FROM kuljettaja
				WHERE kuljettaja_id like :kuljettaja_id";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$id = "%" . ( $kuljettaja_id ) . "%";
		$stmt->bindValue ( ":kuljettaja_id", $id, PDO::PARAM_STR );

		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();

			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}

			throw new PDOException ( $virhe [2], $virhe [1] );
		}
	}
	
	public function naytaKuljettaja($kuljettaja_id) {
		$sql = "SELECT kuljettaja_id, etunimi, sukunimi, maa, kilpanumero, syntymavuosi, lisatietoja
		        FROM kuljettaja WHERE kuljettaja_id like :kuljettaja_id";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();

			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$kuljId = "%" . ( $kuljettaja_id )  . "%";
		$stmt->bindValue ( ":kuljettaja_id", $kuljId, PDO::PARAM_STR );
		
		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();

			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$haettuKuljettaja = new Kuljettaja ();

		while ( $row = $stmt->fetchObject () ) {
		
			$kuljettaja = new Kuljettaja ();

			$kuljettaja->setKuljettaja_id ( $row->kuljettaja_id );
			$kuljettaja->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$kuljettaja->setSukunimi ( utf8_encode ( $row->sukunimi ) );
			$kuljettaja->setKansalaisuus ( utf8_encode ( $row->maa ) );
			$kuljettaja->setKilpanumero ( $row->kilpanumero );
			$kuljettaja->setSyntymavuosi ( $row->syntymavuosi );
			$kuljettaja->setLisatietoja ( utf8_encode ( $row->lisatietoja ) );

			$haettuKuljettaja = $kuljettaja;
		}

		$this->lkm = $stmt->rowCount ();

		return $haettuKuljettaja;
	}
	
	function lisaaKuljettaja($kuljettaja) {
		$sql = "insert into kuljettaja (etunimi, sukunimi, maa, kilpanumero, syntymavuosi, lisatietoja)
		        values (:etunimi, :sukunimi, :maa, :kilpanumero, :syntymavuosi, :lisatietoja)";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}

		$stmt->bindValue ( ":etunimi", utf8_decode ( $kuljettaja->getEtunimi () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":sukunimi", utf8_decode ( $kuljettaja->getSukunimi () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":maa", utf8_decode ( $kuljettaja->getKansalaisuus () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":kilpanumero", $kuljettaja->getKilpanumero (), PDO::PARAM_INT );
		$stmt->bindValue ( ":syntymavuosi", $kuljettaja->getSyntymavuosi (), PDO::PARAM_INT );
		$stmt->bindValue ( ":lisatietoja", utf8_decode ( $kuljettaja->getLisatietoja () ), PDO::PARAM_STR );

		$this->db->beginTransaction();

		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();

			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}
			$this->db->rollBack();
			
			throw new PDOException ( $virhe [2], $virhe [1] );
		}

	
		$kuljettaja_id = $this->db->lastInsertId ();

		$this->db->commit();

		return $kuljettaja_id;
	}
}
?>