<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
      <h4>Kuljettaja</h4>

	 <form action="" method="post">
      <div class="form-group row">
	  <div class="col-xs-3">
		<input class="form-control" type="text" placeholder="Kilpanumero" name="kilpanumero" id="kilpanumero" />
	  </div>
	</div>
  <div class="form-group row">
  <div class="col-xs-3">
  <button type="button" class="btn btn-success btn-xs" id="hae" name="hae">Hae kuljettaja</button>
  </div>
  </div>
</form> 
<div style="margin-bottom:0.5cm" id="lista"></div>
  </div>
</div>
<script type="text/javascript">

		$(document).on("ready", function() {
			
			$("#hae").on("click", function() {
				$.ajax({
					url: "kuljettajatJSON.php",
					method: "get",
					data: {kilpanumero: $("#kilpanumero").val()},
					dataType: "json",
					timeout: 5000
				})
				
				.done(function(data) {
					
					$("#lista").html("");
				
					for(var i = 0; i < data.length; i++) {
						
						$("#lista").append("<p>Etunimi: " + data[i].etunimi +
						"<br/>Sukunimi: " + data[i].sukunimi +
						"<br/>Maa: " + data[i].kansalaisuus +
						"<br/>Kilpanumero: " + data[i].kilpanumero +
						"<br/>Syntymävuosi: " + data[i].syntymavuosi +
						"<br/>Lisätietoja: " + data[i].lisatietoja + "</p>");
					}
		
					if (data.length == 0) {
						$("#lista").append("Kilpanumerolla ei löytynyt yhtään kuljettajaa")
					}
				})
				.fail(function() {
					$("#lista").html("Listausta ei voida tehdä");
				});
				
			});
		});
	</script> 
</body>
</html>