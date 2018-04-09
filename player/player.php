<!DOCTYPE HTML>
<html>
<head>
	<title>Player | Hot 21 Radio</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="CACHE-CONTROL" CONTENT="NO-CACHE">

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
	</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.css">
    <script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.js"></script>

    <link rel="stylesheet" type="text/css" href="css/base-player.css">
    <link rel="stylesheet" type="text/css" href="css/player.css">

    <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  	<script type="text/javascript" src="js/mediaelement-and-player.min.js"></script>
  	<script type="text/javascript">
  		// settings player
	    $(function(){
		  $('#audio-player').mediaelementplayer({
		    alwaysShowControls: true,
		    features: ['playpause','current','volume'],
		    audioVolume: 'horizontal',
		    audioWidth: 400,
		    audioHeight: 50,
		    startVolume: 0.5,
		    hideVolumeOnTouchDevices: true,
		    iPadUseNativeControls: true,
		    iPhoneUseNativeControls: true,
		    AndroidUseNativeControls: true
		  });
		});
  	</script>

	<meta property="og:url" content="http://www.hot21radio.com/player/player.php" />
	<meta property="og:type" content="music.song" />
	<meta property="og:title" content="Player Hot 21 Radio" />
	<meta id="desc" property="og:description" content="" />
	<meta id="img" property="og:image" content="" />

</head>
	
<body>

	<!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.11&appId=122563454480639';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<script>

	var nombre = 1;	
	
	function currentSong() {
	  // Current song, listeners
	  $.ajax({
	      method: "GET",
	      url: "http://makkystream.com:2199/rpc/hotradio/streaminfo.get"
	    })
	  .done(function( json ){
	  	console.log(json);
	  	if(typeof json.data[0] != "undefined"){
			var artist = json.data[0]['track']['artist'];
			var title = json.data[0]['track']['title'];
		  	var cover = (json.data[0]['track']['imageurl'] == null || json.data[0]['track']['imageurl'] == "http://makkystream.com:2197/static/hotradio/covers/nocover.png") ? "../img/logo.jpg" : json.data[0]['track']['imageurl'];
		  	var songTitle = json.data[0]['rawmeta'];
		  	var buyurl = json.data[0]['track']['buyurl'];

		  	// title in player
		  	$(".mejs-title").html(songTitle);
		  	// titre et image dans balise meta
		  	$("meta#desc").attr("content", "I am listening to "+songTitle+" on Hot 21 Radio");
		  	$("meta#img").attr("content", cover);

		  	if(typeof json.data[0]['track']['playlist'] === 'undefined'){
		  		var playlist = "";
		  	}
		  	else{
		  		var playlist = json.data[0]['track']['playlist']['id'] != null ? json.data[0]['track']['playlist']['id'] : "";
		  	}
		  	$("#titre-en-cours").html(songTitle);
		  	$(".image #cover").attr("src", "../img/loading.gif");
		    $(".image #cover").attr("src", cover);
		    $(".image #cover").error(function() {
			  $(this).attr("src", "../img/logo.jpg");
			});
		    $(".image #cover").attr("title", songTitle);
		    $(".content #download").attr("href", buyurl);

		    var text = encodeURIComponent("I'm listening "+songTitle+" on Hot 21 Radio");
		    var tweet = "https://twitter.com/intent/tweet?text="+text+"&via=hot21radio&url="+encodeURIComponent('http://www.hot21radio.com')+"&hashtags=Radio, NowPlaying, HipHop, RnB";
		    $("a#tweet-song").attr("href", tweet);

		    var playlistVote = [315, // id des playlists pour lesquelles on affiche les boutons de vote
								1067,
								316,
								2325];
		    if(playlistVote.indexOf(playlist) !== -1){
			    // affichage du nombre de point du titre en cours
			    $.ajax({
			      method: "POST",
			      url: "../functions/display-song-points.php",
			      data: { song: json.data[0]['song'] }
			    })
			      .done(function( data ) {
			      		if(data>1) var point = data+" points";
			      		else if(data=="") var point = "0 point";
			      		else var point = data+" point";
			      		// vérification user connecté pour boutons vote
			      		firebase.auth().onAuthStateChanged(function(user) {
							  console.log (user);
							  if(user){
							  	  	// partie vote
							  	  	$.ajax({
								      method: "POST",
								      url: "../functions/select-id-user.php",
								      data: { email: user['providerData'][0]['email'] }
								    })
								      .done(function( data ) {
								      	var idUser = data;
									  	$.post(
							                '../functions/verif-vote.php', // on les envoie en ajax au fichier Verif-vote.php
							                { 
							                    title : artist+" - "+title, idUser: idUser
							                },
							                function(data){ 
							                  if(data == 'Success'){
							                    $("#vote").html('<i class="thumbs outline up big icon" title="You have already vote for this song"></i> <span id="note-song" title="'+point+' in the charts">'+point+'</span> <i class="thumbs outline down big icon" title="You have already vote for this song"></i>');
							                  }
							                  else{
							                    $("#vote").html('<a href="#" id="plus" onclick="vote(1, '+idUser+');" title="Like"><i class="thumbs outline up big icon green"></i></a> <span id="note-song" title="'+point+' in the charts">'+point+'</span> <a href="#" id="moins" onclick="vote(-1, '+idUser+');" title="Dislike"><i class="thumbs outline down big icon red"></i></a>');
							                  }
							                },
							                'text' // Nous souhaitons recevoir "Success", donc on indique text !
							             );
									  });
						        }
								else{
								  	$("#vote").html('<i class="thumbs outline up big icon" title="You must be logged to vote"></i> <span id="note-song" title="'+point+' in the charts">'+point+'</span> <i class="thumbs outline down big icon" title="You must be logged to vote"></i>');
								}
						});
			      });
		  	}

		  	// titres à exclure
			var excludedArtist = ["Jingle", "Hot 21", "Hot 21 Radio", "The Vincent Tucker Radio Show", "UK Soul Chart", "Urban Meltdown"];

			// affichage du concert relatif à l'artiste en cours
		  	if (nombre%2 == 0 && excludedArtist.indexOf(artist) == -1){
		  		$.ajax({
				  type:"GET",
				  url:"https://app.ticketmaster.com/discovery/v2/events.json?size=1&apikey=3W5PCGNLp8B6Yar8Bqjv03X1T2EO4TzZ&keyword="+artist,
				  async:true,
				  dataType: "json",
				  success: function(json) {
				              console.log(json);
				              // si il n'y a pas de résultat
				              if(json['page']['totalElements'] == 0){
				              	//nombre++;
				              	$("div#actu").html('<div class="column"><article class="ui segment"><div class="ui black ribbon label"><i class="amazon icon"></i> MP3</div><a class="black hover-darkred" target="_blank" href="https://www.amazon.com/gp/search?ie=UTF8&tag=hot21radio0d-20&linkCode=ur2&linkId=3b65fa11dfd52949dc97642b7d100a61&camp=1789&creative=9325&index=digital-music&keywords='+artist+'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3 class="black hover-darkred">More about '+artist+'</h3></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=hot21radio0d-20&l=ur2&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /><img src="../img/logo.jpg" title="Hot 21 Radio" alt="Logo"></article></div>');
				              }
				              else{
					              var name = json['_embedded']['events'][0]['name'];
					              var url = json['_embedded']['events'][0]['url'];
					              var img = json['_embedded']['events'][0]['images'][0]['url'];
					              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
								  var date  = new Date(json['_embedded']['events'][0]['dates']['start']['localDate']);
								  var concertDate = date.toLocaleDateString("en-US",options);
					              var city = json['_embedded']['events'][0]['_embedded']['venues'][0]['city']['name'];
					              var country = json['_embedded']['events'][0]['_embedded']['venues'][0]['country']['countryCode'];
					              $("div#actu").html('<div class="column"><article class="ui segment"><div class="ui black ribbon label"><i class="calendar icon"></i> Concert</div><a href="'+url+'" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3 class="black hover-darkred">'+name+'</h3></a><img src="'+img+'" alt="News" width="100%"><p><i class="icon history"></i>'+concertDate+' <br><i class="icon marker"></i>'+city+' - '+country+' <i class="'+country.toLowerCase()+' flag"></i></p></article></div>');
				          	  }
				           },
				  error: function(xhr, status, err) {
				              nombre++;
				           }
				});    
		  	}
		  	if (nombre%2 != 0){
			  	// affichage de la news relative à l'artiste en cours
			  	var request = json.data[0]['track']['artist'];
			  	if(request.split(' ').length == 1) request = json.data[0]['song'];
			  	Date.prototype.addDays = function(days) {
				  var dat = new Date(this.valueOf());
				  dat.setDate(dat.getDate() + days);
				  return dat;
				}
				console.log(request);
				var dat = new Date();
				var daysAgo = dat.addDays(-7).toDateString(); // news de -7 jours
				var today = dat.toDateString();
				var url = 'https://newsapi.org/v2/everything?' +
						  'q="'+encodeURI(request)+'"&' +
						  'to='+daysAgo+'&' +
						  'from='+today+'&' +
						  'sortBy=relevancy&' + // popularity, relevancy or publishedAt
						  'language=en&' +
						  'apiKey=cf5f09b532154cf4856a0e16a520b89b';
				// url des articles à exclure
				var excludedSource = ["Deviantart.com", 
									  "Dribbble.com", 
									  "Apple.com", 
									  "Thingiverse.com", 
									  "Adsoftheworld.com", 
									  "Slashdot.org",
									  "Flickr.com",
									  "Indianexpress.com",
									  "Hotukdeals.com",
									  "Blogspot.com",
									  "Alcademics.com",
									  "Linux.com",
									  "Rlsbb.ru",
									  "Mozilla.org",
									  "Hvper.com"];				

				$.ajax({
				    method: "GET",
				    url: url,
				    dataType: "json" // Set the data type so jQuery can parse it for you
				  })
				    .done(function( data ) {
				    	console.log(data);
				    	console.log(excludedArtist.indexOf(artist));
				    	// si l'artiste en cours est présent dans le tableau des artistes exclus
				    	if(excludedArtist.indexOf(artist) != -1){
				    		$("div#actu").html('');
				    		return;
				    	}
				    	// si il y a des résultats
				    	if(data.articles.length > 0){
				    		// pour chaque article
				    		for(var i=0 ; i<data.articles.length ; i++){
				    			// si la source de l'article est présente dans le tableau des sources exclues
				    			if(excludedSource.indexOf(data.articles[i].source.name) != -1) continue;
				    			// si la recherche est le titre de la chanson en entier ou que le titre de l'article contient le nom de l'artiste en cours
				    			if(request == json.data[0]['song'] || data.articles[i].title.indexOf(artist) != -1){
							    	var link = data.articles[i].url;
						    		var title = data.articles[i].title;
						    		var image = (data.articles[i].urlToImage == null ? "../img/logo.jpg" : data.articles[i].urlToImage);
						    		if(image.endsWith(".jpg") == false && image.endsWith(".png") == false && image.endsWith(".gif") == false && image.endsWith(".jpeg") == false) image = "../img/logo.jpg";
							    	$("div#actu").html('<div class="column"><article class="ui segment"><div class="ui black ribbon label"><i class="newspaper icon"></i> News</div><a href="'+link+'" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3 class="black hover-darkred">'+title+'</h3></a><img src="'+image+'" alt="News"></article></div>');
							    	//break;
						    	}
						    	else $("div#actu").html('<div class="column"><article class="ui segment"><div class="ui black ribbon label"><i class="amazon icon"></i> MP3</div><a class="black hover-darkred" target="_blank" href="https://www.amazon.com/gp/search?ie=UTF8&tag=hot21radio0d-20&linkCode=ur2&linkId=3b65fa11dfd52949dc97642b7d100a61&camp=1789&creative=9325&index=digital-music&keywords='+artist+'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3 class="black hover-darkred">More about '+artist+'</h3></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=hot21radio0d-20&l=ur2&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /><img src="../img/logo.jpg" title="Hot 21 Radio" alt="Logo"></article></div>');
					    	}
				    	}
				    	else $("div#actu").html('<div class="column"><article class="ui segment"><div class="ui black ribbon label"><i class="amazon icon"></i> MP3</div><a class="black hover-darkred" target="_blank" href="https://www.amazon.com/gp/search?ie=UTF8&tag=hot21radio0d-20&linkCode=ur2&linkId=3b65fa11dfd52949dc97642b7d100a61&camp=1789&creative=9325&index=digital-music&keywords='+artist+'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3 class="black hover-darkred">More about '+artist+'</h3></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=hot21radio0d-20&l=ur2&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /><img src="../img/logo.jpg" title="Hot 21 Radio" alt="Logo"></article></div>');
				});
			}
			console.log(nombre);
			nombre++;
		}
	  });
	}
	currentSong();
	setInterval(currentSong, 10000);
	</script>

	<div id="player-card" class="display-inline-block">
		<div class="ui fluid card">
		  <div class="content">
		  	<div class="right floated meta darkred" id="live">LIVE</div>
		    <div class="header">
		    	<span id="titre-en-cours"></span>
		    </div>
		  </div>

		  <div class="ui large image">
		  	<div class="ui dimmer">
		    	<div class="content">
		      		<div class="center">
		        		<span><a id="tweet-song" class="twitter-share-button" href="" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><button class="mini ui twitter icon button"><i class="twitter icon"></i>Tweet</button></a></span>
		    			<span class="fb-share-button display-inline" data-href="http://www.hot21radio.com/player/player.php" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.hot21radio.com%2Fplayer%2Fplayer.php&amp;src=sdkpreparse">Partager</a></span>
		    			<br><br>
		    			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- Hot 21 Radio - player -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:320px;height:100px"
						     data-ad-client="ca-pub-1980163497827066"
						     data-ad-slot="7369997444"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
		      		</div>
		    	</div>
		  	</div>
		  	<a class="ui left corner label darkred">
	        	<i class="share alternate icon"></i>
	      	</a>
		  	<img class="ui medium image" id="cover" src="" title="" alt="Cover">
		  </div>

		  <div class="content">
		  	<span class="right floated" id="vote"></span> 
		  	<a class="darkred" href="" id="download" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100');return false;"><i class="download big icon"></i> Download </a>
		  </div>
		  <div class="extra content" id="extra-flashradio">
			  <div id="w">
			    <div id="content">
			      <div class="audio-player">
			        <audio id="audio-player" autoplay src="http://184.164.135.70:8074/;stream.mp3" type="audio/mp3" controls="controls"></audio>
			        <div class="mejs-title"></div>
			      </div><!-- @end .audio-player -->
			    </div><!-- @end #content -->
			  </div><!-- @end #w -->
		  </div>
		  <div class="extra content">
		  	<div id="news-card" class="display-inline-block">
				  <div class="content" id="actu">
				  </div>
			</div>
		  </div>
		</div>
	</div>

	<script type="text/javascript">

		// Points attribués à l'auditeur selon sa durée d'écoute
		firebase.auth().onAuthStateChanged(function(user) {
			if(user){
				function setPoints(){
					var aud = document.getElementById("audio-player");
					if(!aud.paused){
						var userEmail = user.providerData[0].email;
					    $.ajax({
					      method: "POST",
					      url: "../functions/add-listener-points.php",
					      data: { email: userEmail, points: 1 }
					    })
					      .done(function( data ) {});
					}
				}
				setInterval(setPoints, 60000); // 1 minute = 1 point
			}
		});
		/////////

	    $('.image')
		  .dimmer({
		    on: 'hover'
		  })
		;

		// effet tada sur "live" au chargement de la page
		$('div#live')
		    .transition('set looping')
  			.transition('tada', '2000ms');

  		// ajouter un vote à un titre
  		function vote(note, userId){
	      $.getJSON( "http://makkystream.com:2199/rpc/hotradio/streaminfo.get")
	        .done(function( json ){
	        	var artist = json.data[0]['track']['artist'];
				var title = json.data[0]['track']['title'];
			  	var cover = (json.data[0]['track']['imageurl'] == null || json.data[0]['track']['imageurl'] == "http://makkystream.com:2197/static/hotradio/covers/nocover.png") ? "../img/logo.jpg" : json.data[0]['track']['imageurl'];
			  	var buyurl = json.data[0]['track']['buyurl'];
			  	if(typeof json.data[0]['track']['playlist'] === 'undefined'){
			  		var playlist = "";
			  	}
			  	else{
			  		var playlist = json.data[0]['track']['playlist']['id'] != null ? json.data[0]['track']['playlist']['id'] : "";
			  	}

	            $.post(
	              '../functions/vote.php', // on les envoie en ajax au fichier vote.php
	              { 
	                  title : artist+" - "+title,
	                  link : buyurl,
	                  img : cover,
	                  playlist : playlist,
	                  note : note > 0 ? 1 : -1,
	                  idUser: userId
	              },
	              function(data){
	              	console.log(data);
	              	$("#vote").html("<p>Loading...</p>");
	                if(data == 'Success'){
	                  $("#vote").html("<p>Thank you !</p>");
	                }
	              },
	              'text' // Nous souhaitons recevoir "Success", donc on indique text !
	           );
	            if(note >= 1 && userId != "1"){
		           $.post(
		              '../functions/add-flux.php', // on les envoie en ajax au fichier add-flux.php
		              { 
		                  idUser: userId,
		                  action: "liked",
		                  message: artist+" - "+title,
		                  image1: cover
		              },
		              function(data){
		              	console.log(data);
		              });
	       		}
	        });
	    }	
	</script>

</body>
</html>