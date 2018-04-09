<?php

// voter pour un titre

include("../cfg/config.php");

if(isset($_POST)){

	// récupération des variables $_POST
  $title = $_POST['title'];
  $linkurl = $_POST['link'];
  $img = $_POST['img'];
  $playlist = $_POST['playlist'];
  $note = $_POST['note'];
  $userId = $_POST['idUser'];

	// on vérifie si le titre est déjà en BDD 
  $req = mysqli_query($link, 'select * from tracks where title="'.$title.'"');
  $dn = mysqli_fetch_array($req);

	// si oui 
	if($dn > 0){
		// on vérifie l'id de la playlist
		if($dn['playlist'] != $playlist){
			// s'il est différent on le change dans la BDD
			mysqli_query($link, 'update tracks set playlist='.$playlist.' where id='.$dn['id']); 
		}
		// on modifie la note avec celle votée
		if(mysqli_query($link, 'update tracks set note= note+'.$note.' where id='.$dn['id']) && mysqli_query($link, 'insert into user_has_voted(id_user, id_track) values('.$userId.','.$dn['id'].')')){
		  echo 'Success';
		}
	}
	// si non
	else{
	// sinon on ajoute le vote en BDD (id, title, link, date, img, playlist, note)
		if(mysqli_query($link, 'insert into tracks(id, title, link, date, img, playlist, note) values(null, "'.$title.'", "'.$linkurl.'", "'.time().'", "'.$img.'", "'.$playlist.'", "'.$note.'")')){
			$req3 = mysqli_query($link, 'SELECT id FROM tracks WHERE id=LAST_INSERT_ID()');
			$dn3 = mysqli_fetch_array($req3);
			$last_id3 = $dn3['id'];

			if(mysqli_query($link, 'insert into user_has_voted(id_user, id_track) values('.$userId.','.$last_id3.')'))
			echo 'Success';
		}
	}
}