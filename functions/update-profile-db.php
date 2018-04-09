<?php

include('../cfg/config.php');

if(isset($_POST['email'])){

	$email = addslashes($_POST['email']);

	if(isset($_POST['username']) && $_POST['username'] != null && isset($_POST['avatar']) && $_POST['avatar'] != null){

		$req1 = mysqli_query($link, 'Select * from users where email = "'.$email.'";');

		$username = addslashes($_POST['username']);
		$avatar = addslashes($_POST['avatar']);

		if(mysqli_num_rows($req1)>0){
			$dnn1 = mysqli_fetch_array($req1);

			if($dnn1["id"] != "1") $req2 = mysqli_query($link, 'Update users set username = "'.$username.'", avatar = "'.$avatar.'" where id = "'.$dnn1["id"].'";');

			echo $req2;
		}
		else{
			$date = time();

			$req3 = mysqli_query($link, 'Insert into users (username, email, avatar, signup_date) VALUES ("'.$username.'", "'.$email.'", "'.$avatar.'", '.$date.');');

			if($req3){
				// on ajoute un flux
				$req4 = mysqli_query($link, 'Select id from users where email = "'.$email.'";');
				$dnn4 = mysqli_fetch_array($req4);
				mysqli_query($link, 'Insert into flux (id_user, action, message, date) VALUES ("'.$dnn4['id'].'", "joined us", "Welcome '.$username.' !", '.$date.');');
				echo $req3;
			}
		}
	}
}
