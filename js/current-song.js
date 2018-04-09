function currentSong() {
  // Current song, listeners
  $.getJSON( "http://makkystream.com:2199/rpc/hotradio/streaminfo.get")
  .done(function( json ){
  	var cover = (json.data[0]['track']['imageurl'] == null || json.data[0]['track']['imageurl'] == "http://makkystream.com:2197/static/hotradio/covers/nocover.png") ? "img/logo.jpg" : json.data[0]['track']['imageurl'];
	var songTitle = json.data[0]['song'];
    $(".now-playing").html(songTitle);
    $(".now-cover").attr("src", cover);
    $(".now-cover").attr("title", songTitle);
  });
}