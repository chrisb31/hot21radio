<?php
    	
	// Ma clé privée
	$secret = "6Lem4j4UAAAAAEANLpe9vFk9dWdoHkDeNo9SgIAt";
	// Paramètre renvoyé par le recaptcha
	$response = $_POST['recaptcha'];
	// On récupère l'IP de l'utilisateur
	$remoteip = $_SERVER['REMOTE_ADDR'];
	
	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    . $secret
	    . "&response=" . $response
	    . "&remoteip=" . $remoteip ;
	
	$decode = json_decode(file_get_contents($api_url), true);
	
	if ($decode['success'] == true) {
		// C'est un humain
		echo "human";
	}
	
	else {
		// C'est un robot ou le code de vérification est incorrecte
		echo "bot";
	}
		
?>