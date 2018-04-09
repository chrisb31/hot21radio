<?php

include('../cfg/config.php');

if(isset($_POST['song'])){

	$song = $_POST['song'];

	$req = mysqli_query($link, 'Select note from tracks where title = "'.$song.'";');

	while($dnn = mysqli_fetch_array($req)){

		echo $dnn['note'];      

	}
}