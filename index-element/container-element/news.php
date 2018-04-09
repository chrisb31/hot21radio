<?php

?>

<script type="text/javascript">

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

var dat = new Date();
var twoDaysAgo = dat.addDays(-2).toDateString();
var today = dat.toDateString();

var url = 'https://newsapi.org/v2/everything?' +
  'q=rap%20OR%20hip%20hop%20OR%20r%26b&' +
  'to='+twoDaysAgo+'&' +
  'from='+today+'&' +
  'sortBy=relevancy&' +
  'language=en&' +
  'apiKey=cf5f09b532154cf4856a0e16a520b89b';
  
$.ajax({
    method: "GET",
    url: url,
    dataType: "json" // Set the data type so jQuery can parse it for you
  })
    .done(function( data ) {
      var titres = Array();
    	for(var i=0 ; i<data.articles.length ; i++){
    		if(i == 7) continue; // si on est sur l'article Fiverr
    		var link = data.articles[i].url;
    		var title = data.articles[i].title;
        if(titres.indexOf(title.toLowerCase()) != -1) continue; // si 2 titres sont identiques
    		var description = data.articles[i].description;
    		var image = data.articles[i].urlToImage == null ? "img/logo.jpg" : data.articles[i].urlToImage;
        if(image.endsWith(".jpg") == false && image.endsWith(".png") == false && image.endsWith(".gif") == false && image.endsWith(".jpeg") == false) image = "img/logo.jpg";
    		var d = new Date(data.articles[i].publishedAt);
    		var date = d.toDateString();
    		var author = data.articles[i].author == null ? "Unknown" : data.articles[i].author;
    		if(i >= 0 && i <= 6){ 
          // si on est avant l'article Fiverr
    			$("div#articles").prepend('<div class="three wide computer five wide tablet sixteen wide mobile column"><article class="ui segment"><a href="'+link+'" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3>'+title+'</h3><img class="ui medium image" src="'+image+'"><p>'+description+'</p><footer><p><i class="icon history"></i>'+date+'</p><p><i class="icon write"></i>'+author+'</p></footer></a></article></div>');
          // articles dans le slider de la homepage
          $("#news-"+i).html('<a href="#anchor-news"><h2>'+title+'</h2><img src="'+image+'" alt="'+title+'"></a>');
    		}
    		else{ 
          // si on est après l'article Fiverr
    			$("div#articles").append('<div class="three wide computer five wide tablet sixteen wide mobile column"><article class="ui segment"><a href="'+link+'" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;"><h3>'+title+'</h3><img class="ui medium image" src="'+image+'"><p>'+description+'</p><footer><p><i class="icon history"></i>'+date+'</p><p><i class="icon write"></i>'+author+'</p></footer></a></article></div>');
    		}
    		// list in footer
    		if(i >= 0 && i <= 13) $("div#list-news").append('<div class="item"><a href="'+link+'" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=1500,left=100\');return false;">'+title+'</a></div>');
        titres.push(title.toLowerCase());
    	}
    });

</script>

<h2>News</h2>

<div class="ui five column grid" id="articles">
	<!-- Put this code anywhere in the body of your page where you want the badge to show up. -->
	<div class="three wide computer five wide tablet sixteen wide mobile column" style="text-align: center;width: min-content !important;">
		<article class="ui segment">
			<a itemprop='url' href=https://www.fiverr.com/hot21radio rel="nofollow" target="_blank">
				<h3>Get your song or advert played on Hot 21 Radio !</h3>
				<div itemscope itemtype='http://schema.org/Person' class='fiverr-seller-widget' style='display: inline-block;'>     
			        <div class='fiverr-seller-content' id='fiverr-seller-widget-content-e3352ee1-ee35-4751-ba8e-2c28a51a95e6' itemprop='contentURL' style='display: none;'></div>
			        <div id='fiverr-widget-seller-data' style='display: none;'>
			            <div itemprop='name' >hot21radio</div>
			            <div itemscope itemtype='http://schema.org/Organization'><span itemprop='name'>Fiverr</span></div>
			            <div itemprop='jobtitle'>Seller</div>
			            <div itemprop='description'>Hot 21 Radio is an online hip hop and r&b radio station. Heard all over the world, the young listeners (15-25yo) find out 24/7 all the classics and new hits in rap, urban, hip hop and r&b music. Check out our website and listen to our station.</div>
			        </div>
				</div>
			</a>
		</article>
	</div>

	<script id='fiverr-seller-widget-script-e3352ee1-ee35-4751-ba8e-2c28a51a95e6' src='https://widgets.fiverr.com/api/v1/seller/hot21radio?widget_id=e3352ee1-ee35-4751-ba8e-2c28a51a95e6' data-config='{"category_name":"\n                                    Digital Marketing\n\n                            "}' async='true' defer='true'></script>

</div>