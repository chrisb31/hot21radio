<?php

if(isset($_POST["text"]) && isset($_POST["image"])){ // image url must begin by https

  $test = $_POST["text"];
  $image = $_POST["image"];
?>

<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  
  $.ajax({
        method: "POST",
        url: "https://management-api.wonderpush.com/v1/deliveries",
        data: { accessToken: "ZThlZDY5ZTYzNDdjYjYwYjE5OTE5MTk4YTVkZWVmOWJmMjkzNDNmZTM0NDQyY2Y5NDllZTY2OTUyMzkzNjJlZg", targetSegmentIds: "@ALL", notification: {"alert":{"text": <?= $text; ?> ,"web":{"image": <?= $image; ?> }}} },
        campaignId: "Envoi automatique",
        dataType: "json" // Set the data type so jQuery can parse it for you
      })
        .done(function( data ) {
            console.log(data);
        });

</script>

<?php

}

?>