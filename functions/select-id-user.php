<?php

include('../cfg/config.php');

if(isset($_POST['email'])){

	$req = mysqli_query($link, 'Select * from users where email = "'.$_POST['email'].'";');

	if(mysqli_num_rows($req)>0){
		$dnn = mysqli_fetch_array($req);

		echo $dnn["id"];
	}
}