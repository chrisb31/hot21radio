<?php

// Changer le statut des weekly shows

include('../cfg/config.php');

if(isset($_POST['id']) && isset($_POST['statut'])){

	$idShow = $_POST['id'];
	$newStatut = $_POST['statut'];

	$req = mysqli_query($link, 'Update shows set statut = "'.$newStatut.'" where idShow = '.$idShow.';');

	echo $req;
}