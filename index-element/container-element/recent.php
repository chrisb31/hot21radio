<div>
  <h2>Recently Played</h2>
  <div id="titre-recent" class="ui relaxed divided list"></div>
</div>


<script>
    function recharge(){
      $.getJSON('http://makkystream.com:2199/recentfeed/hotradio/json/', function(data) {
        document.getElementById('titre-recent').innerHTML = '';
          for(var i in data['items']) {
              var now = Date.now();
              var img = ((data['items'][i]['enclosure']['url'] == null || data['items'][i]['enclosure']['url'] == "http://makkystream.com:2197/static/hotradio/covers/nocover.png") ? "img/logo.jpg" : data['items'][i]['enclosure']['url']);
              var title = data['items'][i]['title'];
              var date = data['items'][i]['date'];
              var ago = Math.round(((now/1000)-date)/60)+' min. ago';
              var link = data['items'][i]['link'];
              var tweet = encodeURIComponent("Hot 21 Radio just played "+title);

              if(title.indexOf("Jingle")==-1 && title.indexOf("Advert")==-1) document.getElementById('titre-recent').innerHTML += 
                '<div class="item"><div class="right floated content" id="tweet-recently"><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text='+tweet+'&via=hot21radio&url='+encodeURIComponent("http://www.hot21radio.com")+'&hashtags=Radio, JustPlayed, HipHop, RnB" data-size="large" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"><button class="ui twitter button"><i class="twitter icon"></i>Tweet</button></a></div><img class="ui tiny avatar image" src="'+img+'" alt="Cover" title="'+title+'"><div class="content"><a href="'+link+'" target="_blank" class="header">'+title+'</a><div class="description">Played '+ago+'</div><div class="extra"><div class="ui label"><a href="'+link+'" target="_blank"><i class="download icon"></i>Download</a></div></div></div></div>';
          }
      });
    }
    recharge();
    setInterval(recharge, 60000);
</script>