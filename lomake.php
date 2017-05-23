<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once "kuljettaja.php";
session_start ();

if (isset ( $_POST ["seuraava"] )) {
	
	$kuljettaja = new kuljettaja ( $_POST ["etunimi"], $_POST ["sukunimi"], $_POST ["kansalaisuus"], $_POST ["kilpanumero"], $_POST ["syntymavuosi"], $_POST ["lisatietoja"]);
	
	$_SESSION ["kuljettaja"] = $kuljettaja;
	
	$etunimiVirhe = $kuljettaja->checkEtunimi ();
	$sukunimiVirhe = $kuljettaja->checkSukunimi ();
	$kansalaisuusVirhe = $kuljettaja->checkKansalaisuus ();
	$kilpanumeroVirhe = $kuljettaja->checkKilpanumero ();
	$syntymavuosiVirhe = $kuljettaja->checkSyntymavuosi ();
	$lisatietojaVirhe = $kuljettaja->checkLisatietoja ( false );
	
	if ($etunimiVirhe == 0 && $sukunimiVirhe == 0 && $kansalaisuusVirhe == 0 && $kilpanumeroVirhe == 0 && $syntymavuosiVirhe == 0 && $lisatietojaVirhe == 0) {
		
		session_write_close ();
		header ( "location: naytaKuljettaja.php" );
		exit ();
	}

	
}elseif (isset ( $_POST ["peruuta"] )) {
	
	unset ( $_SESSION ["kuljettaja"] );
	
	header ( "location: index.php" );
	exit ();
	
}else {

	if (isset ( $_SESSION ["kuljettaja"] )) {
		
		$kuljettaja = $_SESSION ["kuljettaja"];
		
		$etunimiVirhe = $kuljettaja->checkEtunimi ();
		$sukunimiVirhe = $kuljettaja->checkSukunimi ();
		$kansalaisuusVirhe = $kuljettaja->checkKansalaisuus ();
		$kilpanumeroVirhe = $kuljettaja->checkKilpanumero ();
		$syntymavuosiVirhe = $kuljettaja->checkSyntymavuosi ();
		$lisatietojaVirhe = $kuljettaja->checkLisatietoja ( false );
		
		
}else {
	
		$kuljettaja = new Kuljettaja ();
		
		$etunimiVirhe = 0;
		$sukunimiVirhe = 0;
		$kansalaisuusVirhe = 0;
		$kilpanumeroVirhe = 0;
		$syntymavuosiVirhe = 0;
		$lisatietojaVirhe = 0;
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
  <title>MototGP - Lisää kuljettaja</title>
  <link href="http://fonts.googleapis.com/css?family=Vollkorn:400,400,700" rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <meta name="author" content="Jukka Nilsson" />
</head>
<body>
<img class="pyorat" src="img/kisa.jpg" alt="moottoripyorat" />
<div class="custom-container container">
<div class="log">
<?php
if (isset($_COOKIE["kayttaja"])) {
  print("<p>Kirjautuneena: " . $_COOKIE["kayttaja"] . "</p>");
}
?>
</div>
  <ul class="nav nav-tabs">
    <li><a href="index.php">Etusivu</a></li>
    <li><a href="lomake.php">Lisää kuljettaja</a></li>
	<li><a href="kuljettajat.php">Kuljettajat</a></li>
    <li><a href="haeKuljettajatJSON.php">Hae kuljettaja</a></li>
    <li><a href="asetukset.php">Asetukset</a></li>
  </ul>

  <div class="tab-content">
      <h3>Kuljettaja</h3>
	  <form action="lomake.php" method="post">
      <div class="form-group row">
  <input type="hidden" name="kuljettaja_id"
				value="<?php print($kuljettaja->getKuljettaja_id()); ?>">
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Etunimi" name="etunimi" value="<?php print(htmlentities($kuljettaja->getEtunimi(), ENT_QUOTES));?>" />
	<?php
print ("<span class='virhe'>" . $kuljettaja->getError ( $etunimiVirhe ) . "</span>") ;
?> 
  </div>
</div>
<div class="form-group row">
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Sukunimi" name="sukunimi" value="<?php print(htmlentities($kuljettaja->getSukunimi(), ENT_QUOTES));?>" />
	<?php
print ("<span class='virhe'>" . $kuljettaja->getError ( $sukunimiVirhe ) . "</span>") ;
?> 
  </div>
</div>
<div class="form-group row">
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Maa (vain Pohjoismaat)" name="kansalaisuus" value="<?php print(htmlentities($kuljettaja->getKansalaisuus(), ENT_QUOTES));?>" />
	<?php
print ("<span class='virhe'>" . $kuljettaja->getError ( $kansalaisuusVirhe ) . "</span>") ;
?> 
  </div>
</div>
<div class="form-group row">
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Kilpanumero" name="kilpanumero" value="<?php print(htmlentities($kuljettaja->getKilpanumero(), ENT_QUOTES));?>" />
	<?php
print ("<span class='virhe'>" . $kuljettaja->getError ( $kilpanumeroVirhe ) . "</span>") ;
?> 
  </div>
</div>
<div class="form-group row">
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Syntymävuosi" name="syntymavuosi" value="<?php print(htmlentities($kuljettaja->getSyntymavuosi(), ENT_QUOTES));?>" />
	<?php
print ("<span class='virhe'>" . $kuljettaja->getError ( $syntymavuosiVirhe ) . "</span>") ;
?> 
  </div>
</div>
<div class="form-group row">
<div class="col-xs-5">
    <textarea class="form-control" rows="3" cols="" placeholder="Lisätietoja..." name="lisatietoja"><?php print(htmlentities($kuljettaja->getLisatietoja(), ENT_QUOTES));?></textarea>
	<?php
print ("<span class='virhe'>" . $kuljettaja->getError ( $lisatietojaVirhe ) . "</span>") ;
?> 
	</div>
  </div>
  <div class="form-group row">
  <div class="col-xs-5">
  <button type="submit" class="btn btn-primary btn-sm" name="seuraava">Seuraava</button>
  <button type="submit" class="btn btn-default btn-sm" name="peruuta">Peruuta</button>
  </div>
  </div>
</form>
</div>
</div>
</body>
</html>