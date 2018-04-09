<?php

include('../cfg/config.php');

if(isset($_POST['id']) && isset($_POST['offset']) && isset($_POST['limit'])){

	$idPlaylist = $_POST['id'];
	$offset = $_POST['offset'];
	$limit = $_POST['limit'];

	$i = $offset + 1;

	$req = mysqli_query($link, 'Select * from tracks where playlist = "'.$idPlaylist.'" order by note desc, title asc limit '.$offset.','.$limit.';');

	echo '<table class="ui celled striped table red">
			<thead>
			   <tr>
			     <th colspan="5">
			      <h2>Top Recent</h2>
			      <div class="ui right floated pagination menu" id="top-menu">
			        <a class="item '.($i==1 ? "active" : "").'" id="menu-top-1" onclick="pageTop(1,0,10);">1</a>
			        <a class="item '.($i==11 ? "active" : "").'" id="menu-top-2" onclick="pageTop(2,10,10);">2</a>
			        <a class="item '.($i==21 ? "active" : "").'" id="menu-top-3" onclick="pageTop(3,20,10);">3</a>
			        <a class="item '.($i==31 ? "active" : "").'" id="menu-top-4" onclick="pageTop(4,30,10);">4</a>
			        <a class="item '.($i==41 ? "active" : "").'" id="menu-top-5" onclick="pageTop(5,40,10);">5</a>
			      </div>
			     </th>
			   </tr>
			</thead>
		    <tbody>';

	while($dnn = mysqli_fetch_array($req)){

		$min = (time() - $dnn['date'])/60;
	    if($min<60) $time = round($min).' min.';
	    elseif($min>=60 && $min<90) $time = (round($min/60)).' hour';
	    elseif($min>=90 && $min<1380) $time = (round($min/60)).' hours';
	    elseif($min>=1380 && $min<2160) $time = (round($min/1440)).' day';
	    elseif($min>=2160) $time = (round($min/1440)).' days';  

		echo '<tr>
				<td class="ribbon'.$i.'"><div class="ui ribbon label">'.$i.'</div>'.($min < 11520 ? '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaBAMAAABbZFH9AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAwUExURQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFo/HAsAAAAQdFJOUwT82OsatSQ2SV3Fks5upX7kDIbsAAAA6ElEQVQYGWNgAALubQxTG0AMMLgoGCRoAmWzVQoCgVR5ApivCOIAgTyIxwJhCwqKgnjsMJ4QiOcK4wleYGDgN4TzZAoYEuEcQcEABibBw8IHzxwGEkKKHxj4hTjlfNhLM6W5RD4mMPAKMazz4Tl8TYJf4aADg7MQf54PW2qAwvQtgg8YHgoxpfswCgpMP9ApKAHiBfiwxkjwi/ABeazCxbJN5bVyRfLFghMYGBbCLZQFuiwQzpMA8hbCeZIYPF+YUusGoBwDJ0SpMIgNBIZgrjSEw3Bx9UJB6UdmUB4wQIUb4GwgowXCAQCjKDM6PhffZQAAAABJRU5ErkJggg==">' : '').'</td>
		      	<td>
		        	<a href="'.$dnn["link"].'" target="_blank" class="header red" title="Download"><img class="ui middle aligned mini image" src="'.$dnn['img'].'" alt="Cover" title="'.$dnn["title"].'"></a>
		      	</td>
		      	<td><a href="'.$dnn["link"].'" target="_blank" class="header darkred" title="Download">'.$dnn["title"].'</a></td>
		      	<td class="single line"><div class="ui mini horizontal statistic"><div class="value">'.$dnn['note'].'</div><div class="label">'.($dnn['note']<=1 ? 'pt' : 'pts').'</div></div></td>
		      	<td class="single line" title="In the charts since"><i class="history icon"></i>'.$time.'</td>
		      </tr>'; 

		$i++;      

	}

	echo '</tbody></table>';
}