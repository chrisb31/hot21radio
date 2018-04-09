<?php

?>

<title>Hot 21 Radio | Online hip-hop and r&b radio</title>

<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
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
<script type="text/javascript" src="js/firebase.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.css">
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/container.css">
<link rel="stylesheet" type="text/css" href="css/carousel.css">
<link rel="stylesheet" type="text/css" href="css/flux.css">
<link rel="stylesheet" type="text/css" href="css/top.css">
<link rel="stylesheet" type="text/css" href="css/recent-request.css">
<link rel="stylesheet" type="text/css" href="css/news.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">

<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.js"></script>
<script language="javascript" type="text/javascript" src="js/current-song.js"></script>

<script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<script>
  // slider homepage
  $(document).ready(function(){
    $('.slider').bxSlider({
      mode: 'fade',
      captions: true,
      auto: true,
      autoControls: true,
      stopAutoOnClick: true,
      pager: true,
      captions: false,
      speed: 700,
      randomStart: true
    });
  });
</script>

<!-- HTTPS required. HTTP will give a 403 forbidden response -->
<!-- <script src="https://sdk.accountkit.com/en_US/sdk.js"></script> -->
