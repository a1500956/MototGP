<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require_once "kuljettaja.php";
session_start ();

if (isset ( $_POST ["poista"] )) {
	
	$kuljettaja_id = intval($_POST["id"]);

try {
			require_once "mototgpPDO.php";
			
			$kantakasittely = new kuljettajaPDO ();
			
			$kantakasittely->poistaKuljettaja ( $kuljettaja_id );
			
			
		} catch ( Exception $error ) {
			session_write_close ();
			header ( "location: virhe.php?sivu=" . urlencode ( "Lisäys" ) . "&virhe=" . $error->getMessage () );
			exit ();
		}
		
	}else {
	
   $kuljettaja_id = 0;
}

if (isset ( $_POST ["nayta"] )) {
	
	$kuljettaja_id = intval($_POST["id"]);
	
			require_once "mototgpPDO.php";
			
			$kantakasittely = new kuljettajaPDO ();
			$kuljettaja = new kuljettaja();
			$kuljettaja = $kantakasittely->naytaKuljettaja ( $kuljettaja_id );
			
			$_SESSION ["kuljettaja"] = $kuljettaja;
	
		
		session_write_close ();
		header ( "location: naytaKuljettaja2.php" );
		exit ();

	}else {
	
   $kuljettaja_id = 0;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
  <title>MototGP - Hae kuljettaja</title>
  <link href="http://fonts.googleapis.com/css?family=Vollkorn:400,400,700" rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="http://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
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
   <div class="form-group row">
      <h3>Kuljettajat</h3>
<?php
try
{
   require_once "mototgpPDO.php";

   $kantakasittely = new kuljettajaPDO();

   $rivit = $kantakasittely->kaikkiKuljettajat();

   foreach ($rivit as $kuljettaja) {
	$kuljettaja_id = $kuljettaja->getKuljettaja_id();
	print("<form action='' method='post'>");
	print("\n<div class='col-xs-6'>");
   	print("<p class='paksut'>Kilpanumero: " . $kuljettaja->getKilpanumero());
	print("<button type='submit' class='btn btn-success btn-xs kaksi' name='nayta'>Näytä</button><button type='submit' class='btn btn-danger btn-xs kaksi' name='poista'>Poista</button>");
   	print("<br/>Nimi: " . $kuljettaja->getEtunimi());
	print(" " . $kuljettaja->getSukunimi() . "</p>\n");
	print("<input type='hidden' name='id' value='$kuljettaja_id'/>");
	print("</div>");
	print("</form>");
	
   }
} catch (Exception $error) {
	 header("location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage());
	 exit;
}

?>
  
 </div>
</div>
</div>
</body>
</html>