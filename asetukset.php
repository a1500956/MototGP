<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start ();

$kayttaja = "";

if (isset ( $_POST ["tallenna"] )) {
	
	$kayttaja = $_POST ["kayttajanimi"];
	$_SESSION ["kayttaja"] = $kayttaja;
	setcookie ( "kayttaja", $kayttaja, time() + 60*60*24*7);
	header ( "location: index.php" );
	exit ();
	
}else {
	
	if (isset ( $_SESSION ["kayttaja"] )) {
		
		$kayttaja = $_SESSION ["kayttaja"];
	}else{
	
	$kayttaja = "";
	
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
  <title>MototGP - Asetukset</title>
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
  <h4>Käyttäjä</h4>
	<form action="asetukset.php" method="post">
      <div class="form-group row">
	  <div class="col-xs-3">
		<input class="form-control" type="text" placeholder="Käyttäjänimi" name="kayttajanimi" value="<?php print($kayttaja); ?>" />
	  </div>
	</div>
  <div class="form-group row">
  <div class="col-xs-3">
  <button type="submit" class="btn btn-success btn-xs" name="tallenna">Muuta nimeä</button>
  </div>
  </div>
</form>  
  </div>
 </div>   
</body>
</html>