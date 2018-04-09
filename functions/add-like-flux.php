<?php

// Ajouter un like dans le fil d'actu

include('../cfg/config.php');

if(isset($_POST['id']) && isset($_POST['ip'])){

	$id = $_POST['id'];
	$ip = $_POST['ip'];
	
	$req = mysqli_query($link, 'Insert into visitor_has_liked (id_flux, ip) VALUES ('.$id.', "'.$ip.'");');

	echo $req;
}