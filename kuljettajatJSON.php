<?php
try {
	require_once "mototgpPDO.php";
	
	$kantakasittely = new kuljettajaPDO ();

	if (isset ( $_GET ["kilpanumero"] )) {

		$tulos = $kantakasittely->haeKuljettaja ( $_GET ["kilpanumero"] );
		
		print (json_encode ( $tulos )) ;
	} 	
	
	else {
		$tulos = $kantakasittely->kaikkiKuljettajat ();
	
		print json_encode ( $tulos );
	}
} catch ( Exception $error ) {
}
?>