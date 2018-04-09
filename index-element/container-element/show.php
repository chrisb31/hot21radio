<?php

?>

<script type="text/javascript">
	// fonction permettant d'afficher le show sur lequel on clique
	function weeklyShow(item){
        var x = new Date();
	    var differenceFuseauxEnHeures = x.getTimezoneOffset() / 60;
		$.ajax({
	      method: "POST",
	      url: "functions/display-show.php",
	      data: { id: item, timezone: differenceFuseauxEnHeures }
	    })
	      .done(function( html ) {
	        	$("div#next-show").html(html);
	      });
	}
	weeklyShow(2);
</script>

<div id="next-show"></div>