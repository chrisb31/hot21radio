<?php

include('../cfg/config.php');

if(isset($_POST['id'])){

	$idShow = $_POST['id'];
	$diffTime = $_POST['timezone'];
	$active_vtrs = false;
	$active_urbanmeltdown = false;
	$active_uksc = false;
	$yourTime = "";

	if($idShow >= 3 && $idShow <= 5){

		if($idShow == 3){
			$active_vtrs = true;
			$active_urbanmeltdown = false;
			$active_uksc = false;
			$img = "vtrs";
			$header = "The Vincent Tucker Radio Show";
			$statut = selectStatut($link, 1220);
			$schedule = "Monday at 9pm/ET";
			$time = 9 + 5 - $diffTime;
			if($time) $yourTime = "In your timezone : ".($time >= 12 ? "Tuesday at ".($time-12)."am" : "Monday at ".$time.($time <= -12 ? "am" : "pm"));
			$desc = 'The Vincent Tucker Radio Show addresses hot topics affecting the hip hop generation while welcoming celebrity guests, recording artists and fascinating characters in the world today. Multi-faceted entertainer & humanitarian Vincent “Heartbreak” Tucker (FOX, ABC & CNN) is joined by Myskenna, Yellostar, Remon and Charity E! – the latest addition to the crew.<br><br>
​				The Vincent Tucker Radio Show includes segments such as The Good, The Bad & The Ugly – Myskenna shares the latest celebrity news & gossip, while Tucker and the crew share their unique perspective on each story; Remon’s Reality Check – Remon delivers a critico-comical rant at celebrities and everyday people who need to be set straight; and the On Blast! Celebrity Interview series – featuring guests from over the spectrum including Kevin Hart, Tyrese, Cuba Gooding Jr., Jennifer Hudson, Dr. Ian K. Smith and more.<br><br>
​				Produced by CWC Entertainment Group L.L.C., the award-winning weekend program has been endorsed by executives at Clear Channel Satellite and CBS Radio Group. The VTRS was created by Tucker and entrepreneur Jerone Mitchell in December 2007 and began syndication in July 2008. For his work on the show, Vincent “Heartbreak” Tucker was named as one of the “2015 Best Media Professionals” by Examiner.com. <a href="https://www.vtrsonline.com/meet-the-crew" target="_blank" class="darkred">Source</a>';
		}
		elseif($idShow == 4){
			$active_urbanmeltdown = true;
			$active_vtrs = false;
			$active_uksc = false;
			$img = "urbanmeltdown";
			$header = "Urban Meltdown";
			$statut = selectStatut($link, 928);
			$schedule = "Friday at 5pm/ET";
			$time = 5 + 5 - $diffTime;
			if($time) $yourTime = "In your timezone : ".($time >= 12 ? "Saturday at ".($time-12)."am" : "Friday at ".$time.($time <= -12 ? "am" : "pm"));
			$desc = 'BRETT COSTELLO has been a tastemaker in the Australian Soul/R&B/Hip Hop scene for almost 20 years. His enthusiasm for the freshest new black music has taken him on a journey including stops at community and commercial radio.<br>
				In the clubs Brett has presented at many of Australia’s influential Urban club nights. Invited to be an Aria club chart reporting DJ some years back, Brett has also voted in the urban category for the Australian Aria Music Awards.<br>
				As a 10 year member of Europe’s premier DJ Pool (yes back in the vinyl days – and now online) and regular trips to the US and UK to stock up on the freshest sounds, Brett is always dropping the latest tracks and hottest hits around.<br><br>
				THE SHOW<br>
				Urban and Soul music with a difference: A fantastic addition to your Urban Music programming – presented in a tastemaker / specialist show format, The Urban Meltdown has enough commercial jams to keep any station music director happy, while bringing the credibility of breaking new tracks from around the globe, with an on air host with 15 years of radio and club experience. <a href="http://www.artisanbroadcast.uk/syndication/urban-meltdown/" target="_blank" class="darkred">Source</a>';
		}
		elseif($idShow == 5){
			$active_uksc = true;
			$active_vtrs = false;
			$active_urbanmeltdown = false;
			$img = "uksc";
			$header = "UK Soul Chart";
			$statut = selectStatut($link, 2236);
			$schedule = "Sunday at 9pm/ET";
			$time = 9 + 5 - $diffTime;
			if($time) $yourTime = "In your timezone : ".($time >= 12 ? "Monday at ".($time-12)."am" : "Sunday at ".$time.($time <= -12 ? "am" : "pm"));
			$desc = 'The official national top 30 soul chart is a major addition to the soul scene in both the UK and Europe. Broadcasting from the studios of Starpoint Radio in London and hosted by renown broadcaster JL the chart mixes the best of independent and mainstream international soul music. Since airing in July it has quickly established itself at the forefront of new music for soulful groovers and is unique in that it also airs contributions from the artistes themselves.<br><br>
				To date the programme has featured amongst others , Teena Marie, Candy Cream , Excellent Gentlemen, Scherrie Payne and Tour de 4Force, Kenny Barnes, Aaron Mason, Down to the Bone and Astral 22 who have all appeared live on the show. Programme host, JL states " What gives this chart the cutting edge apart from the fact that there is no other programme like it is the research by the team and listeners at Starpoint. A large number of tracks that chart have not actually been officially released yet and so I am literally preparing the programme right upto going live on air and this energy is projected to the listeners who themselves are keen to listen and support the new music. Its a very fast atmosphere where the quality of the music rises above all other considerations including the fact that I have to get through 30 tracks in two hours!" <a href="https://www.soultracks.com/story-starpoint-radio-chart" target="_blank" class="darkred">Source</a>';
		}

		// note dans bdd
		$note = "0";
		$req = mysqli_query($link, 'Select note from tracks where title like "'.$header.'%";');
		while($dnn = mysqli_fetch_array($req)){
			$note += $dnn['note'];
			if(empty($dnn)) $note = "0";
		}

		echo '<h2>Weekly Shows</h2>
				<div class="ui secondary pointing stackable menu">
				  <a class="item '.($active_vtrs ? "active" : "").'" id="vtrs" onclick="weeklyShow(3);">
				    The Vincent Tucker Radio Show
				  </a>
				  <a class="item '.($active_urbanmeltdown ? "active" : "").'" id="urbanmeltdown" onclick="weeklyShow(4);">
				    Urban Meltdown
				  </a>
				  <a class="item '.($active_uksc ? "active" : "").'" onclick="weeklyShow(5);">
				    UK Soul Chart
				  </a>
				  <div class="right menu">
				    <a class="ui item" onclick="weeklyShow(6);">
				      DJ, play your show on Hot 21 Radio !
				    </a>
				  </div>
				</div>
				<div class="ui segment lightgray-background">
					<div class="ui items">
					  <div class="item">
					    <div class="ui medium image">
					      <img src="img/'.$img.'.jpg" alt="'.$header.'" title="'.$header.'">
					    </div>
					    <div class="content">
					      <div class="header" id="header">'.$header.'</div><div class="ui right floated">'. ($statut == "enabled" ? '<b><i class="calendar icon"></i>'.$schedule.'</b><div>'.$yourTime.'</div>' : 'NOT THIS WEEK') .'</div>
					      <div class="meta">
					        <span class="price" id="chart-points">'.($note <= 1 ? $note." point in the charts" : $note." points in the charts").'</span>
					      </div>
					      <div class="description">
					        <p>'.$desc.'</p>
					      </div>
					    </div>
					  </div>
					</div>
				</div>';
	}

	elseif ($idShow == 2) {
		if(date('D')=='Mon' || (date('D')=='Tue' && date("G")<='2')){
			$active_vtrs = true;
			$active_urbanmeltdown = false;
			$active_uksc = false;
			$img = "vtrs";
			$header = "The Vincent Tucker Radio Show";
			$statut = selectStatut($link, 1220);
			$schedule = "Monday at 9pm/ET";
			$time = 9 + 5 - $diffTime;
			if($time) $yourTime = "In your timezone : ".($time >= 12 ? "Tuesday at ".($time-12)."am" : "Monday at ".$time.($time <= -12 ? "am" : "pm"));
			$desc = 'The Vincent Tucker Radio Show addresses hot topics affecting the hip hop generation while welcoming celebrity guests, recording artists and fascinating characters in the world today. Multi-faceted entertainer & humanitarian Vincent “Heartbreak” Tucker (FOX, ABC & CNN) is joined by Myskenna, Yellostar, Remon and Charity E! – the latest addition to the crew.<br><br>
​				The Vincent Tucker Radio Show includes segments such as The Good, The Bad & The Ugly – Myskenna shares the latest celebrity news & gossip, while Tucker and the crew share their unique perspective on each story; Remon’s Reality Check – Remon delivers a critico-comical rant at celebrities and everyday people who need to be set straight; and the On Blast! Celebrity Interview series – featuring guests from over the spectrum including Kevin Hart, Tyrese, Cuba Gooding Jr., Jennifer Hudson, Dr. Ian K. Smith and more.<br><br>
​				Produced by CWC Entertainment Group L.L.C., the award-winning weekend program has been endorsed by executives at Clear Channel Satellite and CBS Radio Group. The VTRS was created by Tucker and entrepreneur Jerone Mitchell in December 2007 and began syndication in July 2008. For his work on the show, Vincent “Heartbreak” Tucker was named as one of the “2015 Best Media Professionals” by Examiner.com. <a href="https://www.vtrsonline.com/meet-the-crew" target="_blank" class="darkred">Source</a>';
		}
		elseif((date('D')=='Tue' && date("G")>'2') || date('D')=='Wed' || date('D')=='Thu' || (date('D')=='Fri' && date("G")<='22')){
			$active_urbanmeltdown = true;
			$active_vtrs = false;
			$active_uksc = false;
			$img = "urbanmeltdown";
			$header = "Urban Meltdown";
			$statut = selectStatut($link, 928);
			$schedule = "Friday at 5pm/ET";
			$time = 5 + 5 - $diffTime;
			if($time) $yourTime = "In your timezone : ".($time >= 12 ? "Saturday at ".($time-12)."am" : "Friday at ".$time.($time <= -12 ? "am" : "pm"));
			$desc = 'BRETT COSTELLO has been a tastemaker in the Australian Soul/R&B/Hip Hop scene for almost 20 years. His enthusiasm for the freshest new black music has taken him on a journey including stops at community and commercial radio.<br>
				In the clubs Brett has presented at many of Australia’s influential Urban club nights. Invited to be an Aria club chart reporting DJ some years back, Brett has also voted in the urban category for the Australian Aria Music Awards.<br>
				As a 10 year member of Europe’s premier DJ Pool (yes back in the vinyl days – and now online) and regular trips to the US and UK to stock up on the freshest sounds, Brett is always dropping the latest tracks and hottest hits around.<br><br>
				THE SHOW<br>
				Urban and Soul music with a difference: A fantastic addition to your Urban Music programming – presented in a tastemaker / specialist show format, The Urban Meltdown has enough commercial jams to keep any station music director happy, while bringing the credibility of breaking new tracks from around the globe, with an on air host with 15 years of radio and club experience. <a href="http://www.artisanbroadcast.uk/syndication/urban-meltdown/" target="_blank" class="darkred">Source</a>';
		}
		elseif((date('D')=='Fri' && date("G")>'22') || date('D')=='Sat' || date('D')=='Sun' || (date('D')=='Mon' && date("G")<='2')){
			$active_uksc = true;
			$active_vtrs = false;
			$active_urbanmeltdown = false;
			$img = "uksc";
			$header = "UK Soul Chart";
			$statut = selectStatut($link, 2236);
			$schedule = "Sunday at 9pm/ET";
			$time = 9 + 5 - $diffTime;
			if($time) $yourTime = "In your timezone : ".($time >= 12 ? "Monday at ".($time-12)."am" : "Sunday at ".$time.($time <= -12 ? "am" : "pm"));
			$desc = 'The official national top 30 soul chart is a major addition to the soul scene in both the UK and Europe. Broadcasting from the studios of Starpoint Radio in London and hosted by renown broadcaster JL the chart mixes the best of independent and mainstream international soul music. Since airing in July it has quickly established itself at the forefront of new music for soulful groovers and is unique in that it also airs contributions from the artistes themselves.<br><br>
				To date the programme has featured amongst others , Teena Marie, Candy Cream , Excellent Gentlemen, Scherrie Payne and Tour de 4Force, Kenny Barnes, Aaron Mason, Down to the Bone and Astral 22 who have all appeared live on the show. Programme host, JL states " What gives this chart the cutting edge apart from the fact that there is no other programme like it is the research by the team and listeners at Starpoint. A large number of tracks that chart have not actually been officially released yet and so I am literally preparing the programme right upto going live on air and this energy is projected to the listeners who themselves are keen to listen and support the new music. Its a very fast atmosphere where the quality of the music rises above all other considerations including the fact that I have to get through 30 tracks in two hours!" <a href="https://www.soultracks.com/story-starpoint-radio-chart" target="_blank" class="darkred">Source</a>';
		}

		// note dans bdd
		$note = "0";
		$req = mysqli_query($link, 'Select note from tracks where title like "'.$header.'%";');
		while($dnn = mysqli_fetch_array($req)){
			$note += $dnn['note'];
			if(empty($dnn)) $note = "0";
		}

		echo '<h2>Weekly Shows</h2>
				<div class="ui secondary pointing stackable menu">
				  <a class="item '.($active_vtrs ? "active" : "").'" id="vtrs" onclick="weeklyShow(3);">
				    The Vincent Tucker Radio Show
				  </a>
				  <a class="item '.($active_urbanmeltdown ? "active" : "").'" id="urbanmeltdown" onclick="weeklyShow(4);">
				    Urban Meltdown
				  </a>
				  <a class="item '.($active_uksc ? "active" : "").'" onclick="weeklyShow(5);">
				    UK Soul Chart
				  </a>
				  <div class="right menu">
				    <a class="ui item" onclick="weeklyShow(6);">
				      DJ, play your show on Hot 21 Radio !
				    </a>
				  </div>
				</div>
				<div class="ui segment lightgray-background">
					<div class="ui items">
					  <div class="item">
					    <div class="ui medium image">
					      <img src="img/'.$img.'.jpg" alt="'.$header.'" title="'.$header.'">
					    </div>
					    <div class="content">
					      <div class="header" id="header">'.$header.'</div><div class="ui right floated">'. ($statut == "enabled" ? '<b><i class="calendar icon"></i>'.$schedule.'</b><div>'.$yourTime.'</div>' : 'NOT THIS WEEK') .'</div>
					      <div class="meta">
					        <span class="price" id="chart-points">'.($note <= 1 ? $note." point in the charts" : $note." points in the charts").'</span>
					      </div>
					      <div class="description">
					        <p>'.$desc.'</p>
					      </div>
					    </div>
					  </div>
					</div>
				</div>';
	}

	else{
		echo '<h2>Weekly Shows</h2>
				<div class="ui secondary pointing stackable menu">
				  <a class="item" id="vtrs" onclick="weeklyShow(3);">
				    The Vincent Tucker Radio Show
				  </a>
				  <a class="item" id="urbanmeltdown" onclick="weeklyShow(4);">
				    Urban Meltdown
				  </a>
				  <a class="item" onclick="weeklyShow(5);">
				    UK Soul Chart
				  </a>
				  <div class="right menu">
				    <a class="ui item active" onclick="weeklyShow(6);">
				      DJ, play your show on Hot 21 Radio !
				    </a>
				  </div>
				</div>
				<div class="ui segment grid lightgray-background">
				  <div class="ui form eight wide column">
				    <div class="required field">
				        <label>Your DJ username</label>
				        <input placeholder="Your DJ username" type="text">
				    </div>
				    <div class="inline field">
				      <div class="ui checkbox">
				        <input type="checkbox" tabindex="0" class="hidden">
				        <label>One shot mix</label>
				      </div>
				      <div class="ui checkbox">
				        <input type="checkbox" tabindex="1" class="hidden">
				        <label>Every week</label>
				      </div>
				    </div>
				    <div class="ui submit button">Submit</div>
				  </div>
				</div>';
	}

}

function selectStatut($link, $id){
	$req = mysqli_query($link, 'Select statut from shows where idShow = '.$id.';');
	while($dnn = mysqli_fetch_array($req)){
		return $dnn['statut'];
	}
}
