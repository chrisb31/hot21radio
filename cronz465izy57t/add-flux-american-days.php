<?php

// cron tous les jours pour ajouter dans le flux un message concernant un jour de fête

include('../cfg/config.php');

$message = "";
$image = "";

if(date("d-m") == "01-01"){ // 1er janvier
	$message = "Happy New Year !";
	$image = "https://upload.wikimedia.org/wikipedia/commons/9/93/Fuochi_d%27artificio.gif";
}
elseif(date("W") == "3" && date("N") == "1"){ // 3ème lundi de janvier
	$message = "Happy Martin Luther King Day !";
	$image = "https://media.defense.gov/2018/Jan/12/2001865141/-1/-1/0/180112-F-NC874-0001.JPG";
}
elseif(date("n") == "2" && date("N") == "1" && date("j") >= "15" && date("j") < "22"){ // 3ème lundi de février
	$message = "Happy Presidents Day !";
	$image = "https://c1.staticflickr.com/1/430/32876675381_f3e46f3cd9_b.jpg";
}
elseif(date("n") == "5" && date("N") == "1" && date("j") >= "25" && date("j") <= "31"){ // dernier lundi de mai
	$message = "Happy Memorial Day !";
	$image = "https://media.defense.gov/2011/Jun/09/2000248569/780/780/0/110608-F-BD983-007.JPG";
}
elseif(date("d-m") == "04-07"){ // 4 juillet
	$message = "Happy Independence Day !";
	$image = "https://media.defense.gov/2010/Jul/01/2000346268/780/780/0/100701-F-9876P-113.JPG";
}
elseif(date("n") == "9" && date("N") == "1" && date("j") >= "1" && date("j") < "8"){ // 1er lundi de septembre
	$message = "Happy Labor Day !";
	$image = "https://media.defense.gov/2017/Aug/26/2001798684/780/780/0/170818-F-VU622-1001.JPG";
}
elseif(date("n") == "10" && date("N") == "1" && date("j") >= "8" && date("j") < "15"){ // 2ème lundi d'octobre
	$message = "Happy Columbus Day !";
	$image = "https://upload.wikimedia.org/wikipedia/commons/f/f3/Columbus-day.jpg";
}
elseif(date("d-m") == "11-11"){ // 11 novembre
	$message = "Happy Veterans Day !";
	$image = "http://alaska.coastguard.dodlive.mil/files/2011/11/veteransday_wktv.jpg";
}
elseif(date("n") == "11" && date("N") == "4" && date("j") >= "22" && date("j") < "29"){ // 4ème jeudi de novembre
	$message = "Happy Thanksgiving !";
	$image = "https://www.publicdomainpictures.net/pictures/60000/nahled/thanksgiving-turkey-dinner.jpg";
}
elseif(date("d-m") == "25-12"){ // 25 décembre
	$message = "Merry Christmas !";
	$image = "https://upload.wikimedia.org/wikipedia/commons/a/aa/Weihnachten10.gif";
}

if($message != "" && $image != ""){
	$date = time();
	mysqli_query($link, 'Insert into flux (id_user, action, message, date, image1) VALUES ("1", "said", "'.$message.'", '.$date.', "'.$image.'");');
}

/* base

elseif(){
	$message = "";
	$image = "";
}*/