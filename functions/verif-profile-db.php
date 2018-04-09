<?php

include('../cfg/config.php');

if(isset($_POST['email']) || isset($_POST['id'])){

	if(isset($_POST['email'])) $req = mysqli_query($link, 'Select * from users where email = "'.$_POST['email'].'";');
	elseif(isset($_POST['id'])) $req = mysqli_query($link, 'Select * from users where id = "'.$_POST['id'].'";');

	if(mysqli_num_rows($req)>0){
		$dnn = mysqli_fetch_array($req);

		$req2 = mysqli_query($link, 'Select points from user_points where id_user = '.$dnn['id'].';');
		$dnn2 = mysqli_fetch_array($req2);
		$points = count($dnn2) > 0 ? $dnn2['points'] : 0;

		echo json_encode(array("avatar" => $dnn["avatar"], "username" => $dnn["username"], "song" => $dnn["song"], "date" => $dnn["signup_date"], "ville" => $dnn["ville"], "pays" => $dnn["pays"], "points" => $points));
	}
}

if(isset($_POST['username'])){

	$username = $_POST['username'];

	$req = mysqli_query($link, 'Select * from users where username = "'.$username.'";');

	if(mysqli_num_rows($req)>0){
		echo "used";
	}
}
