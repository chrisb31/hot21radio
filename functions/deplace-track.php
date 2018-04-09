<?php

// Déplace une chanson vers playlist classics

include('../cfg/config.php');

if(isset($_POST['id'])){

	$id = $_POST['id'];

	$req = mysqli_query($link, 'Update tracks set playlist = 316 where id = '.$id.';');

	echo $req;
}