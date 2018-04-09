<?php

include('../cfg/config.php');

// top classics

$i = 1;

$req = mysqli_query($link, 'Select * from tracks where playlist = "2325" order by note desc, title asc limit 0, 3;');

echo '<table class="ui celled striped table red">
		<thead>
		   <tr>
		     <th colspan="4">
		      <h2>Top Classics</h2>
		     </th>
		   </tr>
		</thead>
	    <tbody>';

while($dnn = mysqli_fetch_array($req)){

	echo '<tr>
			<td class="ribbon'.$i.'"><div class="ui ribbon label">'.$i.'</div></td>
	      	<td>
	        	<a href="'.$dnn["link"].'" target="_blank" class="header red" title="Download"><img class="ui middle aligned mini image" src="'.$dnn['img'].'" alt="Cover" title="'.$dnn["title"].'"></a>
	      	</td>
	      	<td><a href="'.$dnn["link"].'" target="_blank" class="header darkred" title="Download">'.$dnn["title"].'</a></td>
	      	<td class="single line"><div class="ui mini horizontal statistic"><div class="value">'.$dnn['note'].'</div><div class="label">'.($dnn['note']<=1 ? 'pt' : 'pts').'</div></div></td>
	      </tr>'; 

	$i++;      

}

echo '</tbody></table>';

// top sponsored

$k = 1;

$req2 = mysqli_query($link, 'Select * from tracks where playlist = "1067" order by note desc, title asc limit 0, 3;');

echo '<table class="ui celled striped table red">
		<thead>
		   <tr>
		     <th colspan="4">
		      <h2>Top Sponsored</h2>
		     </th>
		   </tr>
		</thead>
	    <tbody>';

while($dnn2 = mysqli_fetch_array($req2)){

	echo '<tr>
			<td class="ribbon'.$k.'"><div class="ui ribbon label">'.$k.'</div></td>
	      	<td>
	        	<a href="'.$dnn2["link"].'" target="_blank" class="header red" title="Download"><img class="ui middle aligned mini image" src="'.$dnn2['img'].'" alt="Cover" title="'.$dnn2["title"].'"></a>
	      	</td>
	      	<td><a href="'.$dnn2["link"].'" target="_blank" class="header darkred" title="Download">'.$dnn2["title"].'</a></td>
	      	<td class="single line"><div class="ui mini horizontal statistic"><div class="value">'.$dnn2['note'].'</div><div class="label">'.($dnn2['note']<=1 ? 'pt' : 'pts').'</div></div></td>
	      </tr>'; 

	$k++;      

}

echo '</tbody></table>';