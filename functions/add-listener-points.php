<?php

// Ajouter des points à un auditeur

include('../cfg/config.php');

if(isset($_POST['email']) && isset($_POST['points'])){

	$email = $_POST['email'];
	$points = $_POST['points'];
	
	$req1 = mysqli_query($link, 'Select id from users where email = "'.$email.'";');

	if(mysqli_num_rows($req1)>0){
		$dnn1 = mysqli_fetch_array($req1);

		$req2 = mysqli_query($link, 'Select points from user_points where id_user = "'.$dnn1['id'].'";');
		if(mysqli_num_rows($req2)>0){
	 		$dnn2 = mysqli_fetch_array($req2);
	 		$points = $dnn2['points'] + $points;
		}

		$req3 = mysqli_query($link, "REPLACE INTO user_points (id_user, points) VALUES (".$dnn1['id'].", points + ".$points.");");
	}
}