<?php

?>

<header>
	<div class="ui large menu black-background grid sixteen wide column three column row">

	  	<div class="header item">
	    	<a href="http://www.hot21radio.com">
	    		<h1 class="ui header">
				  <img src="img/logo.jpg">
				  <div class="content white">
				    Hot 21 Radio
				    <div class="sub header white">We The Best Hip-Hop and R&B</div>
				  </div>
				</h1>
			</a>
	  	</div>

	  	<div class="item">
		  	<a href="" onclick="open('player/player.php', 'Popup', 'scrollbars=0,resizable=0,height=980,width=435,left=50'); return false;">
				<div class="ui animated fade inverted red button" tabindex="0">
		  			<div class="visible content base-font-size">
		  				<i class="play icon"></i>		  			
						LISTEN LIVE
		  			</div>
		  			<div class="hidden content base-font-size">
		    			Popup player
		  			</div>
				</div>
			</a>
			<img class="ui avatar image" src="img/equalizer.gif">
			<span class="now-playing white"></span>
		</div>

	    <div class="right item">
			<div id="profile-dropdown" style="display: none;">
				<div class="ui floating dropdown button">
				  	<div class="text"><span id="profile"></span></div>
				  	<i class="dropdown icon"></i>
				  	<div class="menu">
					    <a class="item" id="profile-button"><i class="user icon"></i> Profile</a>
					    <a class="item" href="#anchor-request"><i class="play icon"></i> Request a song</a>
					    <a class="item" href="#" onclick="_speakpipe_open_widget(); return false;"><i class="unmute icon"></i> Send a voice message</a>
					    <a class="item" id="signout-button" onclick="toggleSignIn();"><i class="sign out icon"></i> Sign out</a>
					</div>
				</div>
			</div>
			<script type="text/javascript">
			$('#profile-dropdown .dropdown')
			  .dropdown({
			    action: 'hide'
			  });
			</script>

			<button id="login-button" class="ui button darkred-background white">Sign in</button>
			<button id="signup-button" class="ui button red">Sign up</button>

			<a href="https://twitter.com/hot21radio" target="_blank">
				<button class="ui circular twitter icon button" title="Follow us on Twitter">
					<i class="twitter icon"></i>
				</button>
			</a>
			<a href="http://www.facebook.com/hot21radio" target="_blank">
				<button class="ui circular facebook icon button" title="Follow us on Facebook">
					<i class="facebook icon"></i>
				</button>
			</a>
			<a href="https://www.instagram.com/hot21radio/" target="_blank">
				<button class="ui circular instagram icon button" title="Follow us on Instagram">
					<i class="instagram icon"></i>
				</button>
			</a>
			<!-- <a href="" id="tunein">
				<img src="img/tunein.png" id="tunein" alt="TuneIn" title="TuneIn">
			</a> -->
			<a href="https://play.google.com/store/apps/details?id=com.nobexinc.wls_07287102.rc&hl=fr" target="_blank">
				<button class="ui circular android icon button" title="Download our Android App">
					<i class="android icon"></i>
				</button>
			</a>
			<a href="https://itunes.apple.com/us/app/hot-21-radio/id959598229?mt=8" target="_blank">
				<button class="ui circular apple icon button" title="Download our Apple App">
					<i class="apple icon"></i>
				</button>
			</a>
	    </div>

	</div>
</header>