<?php

// Affichage du Flux

include('../cfg/config.php');

if(isset($_POST)){

	$i = 1;
	$req3 = mysqli_query($link, 'SELECT flux.*, users.username as username, users.avatar as avatar FROM `flux` inner join users on flux.id_user = users.id order by flux.date desc limit 0,20;');

	while($dnn3 = mysqli_fetch_array($req3)){

		$id = $dnn3['id'];
		$idUser = $dnn3['id_user'];
		$img3 = $dnn3['avatar'] == null ? "img/anon.png" : ($id == "1" ? "img/logo.jpg" : $dnn3['avatar']);
		$username = $id == "1" ? "Hot 21 Radio" : $dnn3['username'];
		$action = $dnn3['action'] == null ? "" : $dnn3['action'];
		
		$min = (time() - $dnn3['date'])/60;
	    if($min<60) $time = round($min).' min.';
	    elseif($min>=60 && $min<90) $time = (round($min/60)).' hour';
	    elseif($min>=90 && $min<1380) $time = (round($min/60)).' hours';
	    elseif($min>=1380 && $min<2160) $time = (round($min/1440)).' day';
	    elseif($min>=2160) $time = (round($min/1440)).' days';

		$message = $dnn3['message'] == null ? "" : $dnn3['message'];
		$image1 = $dnn3['image1'] == null ? "" : $dnn3['image1'];
		$image2 = $dnn3['image2'] == null ? "" : $dnn3['image2'];
		$img1 = $image1 == "" ? "" : '<img src="'.$image1.'" alt="cover">';
		$img2 = $image2 == "" ? "" : '<img src="'.$image2.'" alt="cover">';

		$req4 = mysqli_query($link, 'SELECT count(*) as count FROM visitor_has_liked WHERE id_flux = '.$id.';');
		if($req4 != null){
			$dnn4 = mysqli_fetch_array($req4);
			$count = $dnn4['count'];
		}
		else $count = "0";

		$userLike = "";
		$ip = $_SERVER['REMOTE_ADDR'];
		$req5 = mysqli_query($link, 'SELECT count(*) as count FROM visitor_has_liked WHERE id_flux = '.$id.' AND ip = "'.$ip.'";');
		$dnn5 = mysqli_fetch_array($req5);
		if($dnn5['count'] > 0){
			$userLike = '<span class="like"><i class="red like icon"></i> '.($count > 1 ? $count." Likes" : $count." Like").'</span>';
		}
		else{
			$userLike = '<a class="like" onclick="visitorLike('.$id.');"><i class="like icon"></i> '.($count > 1 ? $count." Likes" : $count." Like").'</a>';
		}

		echo '<div class="event">
		        <div class="label">
		          <img src="'.$img3.'" class="pointer" onclick="modalProfile('.$idUser.');">
		        </div>
		        <div class="content">
		          <div class="summary">
		              <a class="darkred pointer" onclick="modalProfile('.$idUser.');">'.$username.'</a> '.$action.'
		              <div class="date">
		                  '.$time.' ago
		              </div>
		          </div>
		          <div class="extra text">
		              '.$message.'
		          </div>
		          <div class="extra images">
		            '.$img1.'
		            '.$img2.'
		          </div>
		          <div class="meta" id="meta-'.$id.'">
		          '.$userLike.'
		          </div>
		        </div>
		      </div>';

		 if($i === 4){
		 	echo '<div class="event">
					<div class="label">
					  <img src="img/logo.jpg" class="pointer" onclick="modalProfile(1);">
					</div>
					<div class="content">
					  <div class="summary">
					    <a class="darkred pointer" onclick="modalProfile(1);">Hot 21 Radio</a> said
					  </div>
					  <div class="extra text">
					    <div>
					      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					      <!-- Hot 21 Radio - flux3 -->
					      <ins class="adsbygoogle"
					           style="display:inline-block;width:180px;height:150px"
					           data-ad-client="ca-pub-1980163497827066"
					           data-ad-slot="3923847775"></ins>
					      <script>
					      (adsbygoogle = window.adsbygoogle || []).push({});
					      </script>
					    </div>
					  </div>
					</div>
				</div>';
		 }
		 $i++;
	}
}

// /// PUB
// <div class="event">
// 	<div class="label">
// 	  <img src="img/logo.jpg">
// 	</div>
// 	<div class="content">
// 	  <div class="summary">
// 	    <a>Hot 21 Radio</a> said
// 	    <div class="date">
// 	      4 days ago
// 	    </div>
// 	  </div>
// 	  <div class="extra images">
// 	    <!-- <a><img src="img/ad.jpg"></a> -->
// 	    <div>
// 	      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
// 	      <!-- Hot 21 Radio - flux3 -->
// 	      <ins class="adsbygoogle"
// 	           style="display:inline-block;width:180px;height:150px"
// 	           data-ad-client="ca-pub-1980163497827066"
// 	           data-ad-slot="3923847775"></ins>
// 	      <script>
// 	      (adsbygoogle = window.adsbygoogle || []).push({});
// 	      </script>
// 	    </div>
// 	  </div>
// 	  <div class="meta">
// 	    <a class="like">
// 	      <i class="like icon"></i> 1 Like
// 	    </a>
// 	  </div>
// 	</div>
// </div>


// <!-- MODELE
//   <div class="event">
//     <div class="label">
//       <img src="img/ad.jpg">
//     </div>
//     <div class="content">
//       <div class="summary">
//         <a>Joe Henderson</a> posted on his page
//         <div class="date">
//           3 days ago
//         </div>
//       </div>
//       <div class="extra text">
//         Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
//       </div>
//       <div class="extra images">
//         <a><img src="img/ad.jpg"></a>
//         <a><img src="img/ad.jpg"></a>
//       </div>
//       <div class="meta">
//         <a class="like">
//           <i class="like icon"></i> 5 Likes
//         </a>
//       </div>
//     </div>
//   </div> -->