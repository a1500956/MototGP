<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require_once "kuljettaja.php";

session_start ();

if (isset ( $_SESSION ["kuljettaja"] )) {
	
	$kuljettaja = $_SESSION ["kuljettaja"];
	
} else {
	
	$kuljettaja = new Kuljettaja ();
}

if (isset ( $_POST ["takaisin"] )) {
	unset ( $_SESSION ["kuljettaja"] );
	header ( "location: kuljettajat.php" );
	exit ();
}	
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
  <title>MototGP - Näytä kuljettaja</title>
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
<form action="" method="post">
  <ul class="nav nav-tabs">
    <li><a href="index.php">Etusivu</a></li>
    <li><a href="lomake.php">Lisää kuljettaja</a></li>
	<li><a href="kuljettajat.php">Kuljettajat</a></li>
    <li><a href="haeKuljettajatJSON.php">Hae kuljettaja</a></li>
    <li><a href="asetukset.php">Asetukset</a></li>
  </ul>
  <div class="tab-content">
  <div class="form-group row">
  <div class="col-xs-6">
  <button type="submit" class="btn btn-info btn-xs" name="takaisin">Takaisin</button>
  <h4>Kuljettajan tiedot:</h4>
<?php
print ("<p>Etunimi: " . $kuljettaja->getEtuNimi ()) ;
print ("<br/>Sukunimi: " . $kuljettaja->getSukunimi ()) ;
print ("<br/>Maa: " . $kuljettaja->getKansalaisuus ()) ;
print ("<br/>Kilpanumero: " . $kuljettaja->getKilpanumero ()) ;
print ("<br/>Syntymävuosi: " . $kuljettaja->getSyntymavuosi ()) ;
print ("<br/><br/>Lisätietoja: " . $kuljettaja->getLisatietoja () . "</p>") ;
?>
</div>
</div>
  </div>
 </form>
 </div>   
</body>
</html>
