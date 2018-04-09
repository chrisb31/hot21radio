<?php
include('cfg/config.php');
?>

<!DOCTYPE html>
<html>
<head>
	
	<?php
	include('head.php');
	?>

</head>
<body>

	<?php
	include('index-element/header.php');
	
	include('index-element/container.php');

	//include('index-element/player_fixe.php');

	// modals
	include('index-element/modals/modal-login.php');
	include('index-element/modals/modal-signup.php');
	include('index-element/modals/modal-forgot-password.php');
	include('index-element/modals/modal-profile.php');
	include('index-element/modals/modal-user-profile.php');
	include('index-element/modals/modal-add-comment.php');

	include('index-element/footer.php');
	?>

	<script type="text/javascript">
		currentSong();
		setInterval(currentSong, 5000);
	</script>

	<script language="javascript" type="text/javascript" src="http://makkystream.com:2199/system/request.js"></script>

	<script type="text/javascript" src="js/index.js"></script>

	<!-- Initialization push notifications -->
	<script>
	(function(w,d,s,i,n){w[n]=w[n]||{q:[],init:function(o){w[n].initOpts=o;},ready:function(c){w[n].q.push(c);}};
	setTimeout(function(j,k){if(!d.getElementById(i)){k=d.getElementsByTagName(s)[0];j=d.createElement(s);j.id=i;
	j.src="https://cdn.by.wonderpush.com/sdk/1.1/wonderpush-loader.min.js";k.parentNode.insertBefore(j,k);}},0);
	}(window,document,"script","wonderpush-jssdk-loader","WonderPush"));

	WonderPush.init({
	    webKey: "9dd67d53dd8cff1be2abfc6825d43f49330fd98a361fcb92d875a6315e961fc9",
	    optInOptions: {
	        // Vous pouvez modifier ou traduire les chaînes suivantes :
	        externalBoxMessage: "We will send you personalized notifications.",
	        externalBoxExampleTitle: "Notification example",
	        externalBoxExampleMessage: "This is an example of notification",
	        externalBoxDisclaimer: "You can always unsubscribe at any time.",
	        externalBoxProcessingMessage: "Subscribing...",
	        externalBoxSuccessMessage: "Thanks for subscribing!",
	        externalBoxFailureMessage: "Sorry, something went wrong.",
	        externalBoxTooLongHint: "Poor connection or private browsing?",
	        externalBoxCloseHint: "Close",
	        modalBoxMessage: "We will send you personalized notifications.<br/>You can always unsubscribe at any time.",
	        modalBoxButton: "Got it!"
	    }
	});
	</script>

	<!-- Begin SpeakPipe code -->
	<script type="text/javascript">
	(function(d){
	var app = d.createElement('script'); app.type = 'text/javascript'; app.async = true;
	var pt = ('https:' == document.location.protocol ? 'https://' : 'http://');
	app.src = pt + 'www.speakpipe.com/loader/1sfxql859zxuhnyqnazxivmjqtf0rgtq.js';
	var s = d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(app, s);
	})(document);
	</script>
	<!-- End SpeakPipe code -->

</body>
</html>