<?php

include('cfg/config.php');

// ajout de nouveaux titres en bdd
if(isset($_POST['title']) && isset($_POST['link']) && isset($_POST['image']) && isset($_POST['playlist'])){
	$title = $_POST['title'];
	$lien = $_POST['link'];
	$date = time();
	$image = $_POST['image'];
	$playlist = $_POST['playlist'];

	// on vérifie si le titre est déjà en BDD 
  	$req = mysqli_query($link, 'select * from tracks where title="'.$title.'"');
  	$dn = mysqli_fetch_array($req);

	// si oui 
	if($dn > 0){
		// on vérifie l'id de la playlist
		if($dn['playlist'] != $playlist){
			// s'il est différent on le change dans la BDD
			$req = mysqli_query($link, 'update tracks set playlist='.$playlist.' where id='.$dn['id']);
			if($req) echo '<div class="ui success message">
					  <p>Playlist de la chanson modifiée</p>
					</div>';
		}
		else echo '<div class="ui error message">
					  <p>Chanson déjà présente !</p>
					</div>';
	}
	// si non
	else{
		// sinon on ajoute le titre en BDD
		$req = mysqli_query($link, 'INSERT INTO tracks VALUES (null, "'.$title.'", "'.$lien.'", '.$date.', "'.$image.'", '.$playlist.', 0 );');
		if($req) echo '<div class="ui success message">
					  <p>Chanson ajoutée</p>
					</div>';
	}
}

// envoi notification
if(isset($_GET['notif']) && $_GET['notif'] == 'ok'){
	echo '<div class="ui success message">
			  <p>Notification envoyée</p>
			</div>';
}

?>

<head>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.css">
	<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.js"></script>

	<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
	<script>
	  // Initialize Firebase
	  var config = {
	    apiKey: "AIzaSyDRfNwlI8LivSygBaTed-UlkFauuqUCg4Q",
	    authDomain: "hot-21-radio.firebaseapp.com",
	    databaseURL: "https://hot-21-radio.firebaseio.com",
	    projectId: "hot-21-radio",
	    storageBucket: "hot-21-radio.appspot.com",
	    messagingSenderId: "478564292213"
	  };
	  firebase.initializeApp(config);
	  var autorized_uid = ["oro3t0yQf1ac9kbvifw0cHEXjor1",
						   "Pf2ZBWk8Z3eCmBC0Opgje0CYkWf2",
						   "BlA3CSMWjfZieqYgTEGcg1BGwzJ3"]
	  firebase.auth().onAuthStateChanged(function(user) {
		  if(!user || autorized_uid.indexOf(user.uid) == -1){
		  	window.location.replace("index.php");
		  }
		  else $("#displayName").html(user.displayName);
	  });
	</script>
</head>

<body style="padding: 2rem;">

	<h1 class="ui block header">Salut <span id="displayName"></span>!</h1>

	<div class="ui grid">

  		<div class="eight wide column">

			<section>
				<h2>Ajouter une chanson:</h2>
				<form class="ui form" method="post">
					<div class="fields">
					  <div class="field">
					    <label>Artist - Title (twitter)</label>
					    <input type="text" name="title" placeholder="title" required>
					  </div>
					  <div class="field">
					    <label>Image</label>
					    <input type="text" name="image" placeholder="image">
					  </div>
					  <div class="field">
					    <label>Link</label>
					    <input type="text" name="link" placeholder="link">
					  </div>
					  <div class="field">
					  	<label>Playlist</label>
					    <select name="playlist" required>
					      <option></option>
					      <option value="1067">Chansons vendues</option>
					      <option value="315">Main playlist</option>
					    </select>
					  </div>
					</div>
					<button class="ui button" type="submit">Submit</button>
				</form>
			</section>

		</div>

		<div class="eight wide column">

			<section>
				<h2>Envoyer une notification:</h2>
				<form class="ui form" method="post" action="functions/envoi-notif.php">
					<div class="fields">
					  <div class="field">
					    <label>Texte *</label>
					    <input type="text" name="texte-notif" placeholder="texte" required>
					  </div>
					  <div class="field">
					    <label>Image **</label>
					    <input type="text" name="image-notif" placeholder="image" required>
					  </div>
					</div>
					<p>* Si le texte contient un caractère spéciale (apostrophe...) ajouter un antislash ( \ )</p>
					<p>** L'url de l'image doit commencer par https</p>
					<button class="ui button" type="submit">Submit</button>
				</form>
			</section>

		</div>

	</div>

	<hr>

	<div class="ui grid">

  		<div class="eight wide column">

			<section>
				<h2>Playlist chansons vendues:</h2>
				<table class="ui collapsing compact celled table">
				  <thead>
				    <tr>
				      <th></th>
				      <th>Title</th>
				      <th>Supprimer</th>
				    </tr>
				  </thead>
				  <tbody id="chansons-vendues">

				  	<?php
				  		$req = mysqli_query($link, 'Select * from tracks where playlist = 1067;');
				  		$i = 1;
						while($dnn = mysqli_fetch_array($req)){
							?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $dnn['title']; ?></td>
								<td><i class="remove circle link icon deleteTrack"><?= $dnn['id']; ?></i></td>
							</tr>
						    <?php
						    $i++;
						}
				  	?>

				  </tbody>
				</table>
			</section>

			<hr>

			<section>
				<h2>Statut des weekly shows:</h2>
				<table class="ui collapsing compact celled definition table">
				  <thead>
				    <tr>
				      <th></th>
				      <th>Name</th>
				      <th>Id</th>
				      <th>Statut</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<?php
				  		$req = mysqli_query($link, 'Select * from shows;');
						while($dnn = mysqli_fetch_array($req)){
							?>
							<tr>
						      <td class="collapsing">
						        <div class="ui fitted slider checkbox">
						          <input class="changeStatut" type="checkbox" <?= $dnn['statut'] == 'enabled' ? 'checked' : ''; ?> value="<?= $dnn['idShow']; ?>"><label></label>
						        </div>
						      </td>
						      <td><?= $dnn['idShow'] == 928 ? "Urban Meltdown" : ($dnn['idShow'] == 1220 ? "The Vincent Tucker Radio Show" : "UK Soul Chart") ?></td>
						      <td><?= $dnn['idShow']; ?></td>
						      <td class="statut"><?= $dnn['statut']; ?></td>
						    </tr>
						    <?php
						}
				  	?>

				  </tbody>
				</table>
			</section>

		</div>

		<div class="eight wide column">
			
			<section>
				<h2>Main playlist:</h2>
				<table class="ui collapsing compact celled table">
				  <thead>
				    <tr>
				      <th></th>
				      <th>Title</th>
				      <th>Retirer de main playlist</th>
				    </tr>
				  </thead>
				  <tbody id="main-playlist">

				  	<?php
				  		$req = mysqli_query($link, 'Select * from tracks where playlist = 315 order by title;');
				  		$i = 1;
						while($dnn = mysqli_fetch_array($req)){
							?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $dnn['title']; ?></td>
								<td><i class="remove circle link icon deplaceTrack"><?= $dnn['id']; ?></i></td>
							</tr>
						    <?php
						    $i++;
						}
				  	?>

				  </tbody>
				</table>
			</section>

		</div>

	</div>

	<hr>

	<script type="text/javascript">
		$(".changeStatut").click(function(){
			$.ajax({
			    method: "POST",
			    url: "functions/update-show-statut.php",
	      		data: { id: $(this).val(), statut: $(this).is(':checked') == true ? "enabled" : "disabled" },
			    dataType: "json" // Set the data type so jQuery can parse it for you
			  })
			    .done(function( data ) {
			    });
		});

		$(document).ready(function(){
			$(".deleteTrack").click(function(){
				var tr = $(this).parent().parent();
				$.ajax({
				    method: "POST",
				    url: "functions/delete-track.php",
		      		data: { id: $(this).html() },
				    dataType: "json" // Set the data type so jQuery can parse it for you
				  })
				    .done(function( data ) {
				    	if(data) tr.remove();
				    });
			});

			$(".deplaceTrack").click(function(){
				var tr = $(this).parent().parent();
				$.ajax({
				    method: "POST",
				    url: "functions/deplace-track.php",
		      		data: { id: $(this).html() },
				    dataType: "json" // Set the data type so jQuery can parse it for you
				  })
				    .done(function( data ) {
				    	if(data) tr.remove();
				    });
			});
		});
	</script>

</body>