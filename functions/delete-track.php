<?php

// Supprimer une chanson

include('../cfg/config.php');

if(isset($_POST['id'])){

	$id = $_POST['id'];

	$req = mysqli_query($link, 'Delete from tracks where id = '.$id.';');

	echo $req;
}