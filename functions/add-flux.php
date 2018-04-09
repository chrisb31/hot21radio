<?php

// Ajouter un post dans le fil d'actu

include('../cfg/config.php');

if(isset($_POST)){

	$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : null;
	$action = isset($_POST['action']) ? $_POST['action'] : null; // joined us, posted, said, voted for...
	$message = isset($_POST['message']) ? $_POST['message'] : null;
	$date = time();
	$image1 = isset($_POST['image1']) ? $_POST['image1'] : null;
	$image2 = isset($_POST['image2']) ? $_POST['image2'] : null;
	
	$req = mysqli_query($link, 'Insert into flux (id_user, action, message, date, image1, image2) VALUES ("'.$idUser.'", "'.$action.'", "'.htmlspecialchars(addslashes($message)).'", '.$date.', "'.$image1.'", "'.$image2.'");');

	echo $req;
}

/* model d'ajout

$.post(
  '../functions/add-flux.php', // on les envoie en ajax au fichier add-flux.php
  { 
      idUser: userId,
      action: "liked",
      message: artist+" - "+title,
      image1: cover
  },
  function(data){
  	console.log(data);
  });

*/