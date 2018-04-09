<?php

// on vérifie si un utilisateur a déjà voté pour un titre

include("../cfg/config.php");

if(isset($_POST)){

	// récupération des variables $_POST
	$title = $_POST['title'];
	$userId = $_POST['idUser'];

	// on vérifie si le user a déjà voté pour ce titre
    $req = mysqli_query($link, 'select * from user_has_voted where id_user='.$userId.' and id_track=(select id from tracks where title="'.$title.'")');
    $dn = mysqli_fetch_array($req);

    if($dn>0) echo 'Success';
}