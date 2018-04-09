<?php

// cron toutes les semaines pour ajouter dans le flux un message concernant le titre numéro 1 du classement

include('../cfg/config.php');

$req = mysqli_query($link, 'SELECT * FROM `tracks` WHERE playlist = 315 order by note desc limit 0,1;');
$dnn = mysqli_fetch_array($req);

$date = time();
$title = $dnn['title'];
$url = $dnn['link'];
$note = $dnn['note'];
$message = "#1 in the charts this week : <br><a target='_blank' class='darkred' href='".$url."'>".$title."</a> with ".$note." points";
$image = $dnn['img'];
mysqli_query($link, 'Insert into flux (id_user, action, message, date, image1) VALUES ("1", "said", "'.$message.'", '.$date.', "'.$image.'");');
