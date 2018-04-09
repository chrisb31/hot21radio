$( document ).ready(function() {

	// ouverture modal login
	$("#login-button, #login-request").click(function(){
		$('.ui.modal.login')
		  .modal({
    		blurring: true
  			})
		  .modal('setting', 'transition', 'fade up')
		  .modal('show')
		;
	});

	// ouverture modal signup
	$("#signup-button").click(function(){
		$('.ui.modal.signup')
		  .modal({
    		blurring: true
  			})
		  .modal('setting', 'transition', 'fade up')
		  .modal('show')
		;
	});

	// ouverture modal profile
	$("#profile-button").click(function(){
      	$('.ui.modal.profile')
		  .modal({
    		blurring: true
  			})
		  .modal('setting', 'transition', 'fade up')
		  .modal('show')
		;
	});

	// affichage top 3 classics & sponsored
    $.ajax({
      method: "POST",
      url: "functions/display-top-classics-sponsored.php"
    })
      .done(function( html ) {
        	$("#second-top").append(html);
      }); 

    // effet jiggle sur les social boutons au chargement de la page
    $('header a button')
	  .transition({
	    animation : 'jiggle',
	    duration  : 800,
	    interval  : 200
	  });

	// effet tada sur bouton sign in au chargement de la page
	$('button#login-button')
	  .transition('tada', '2000ms');

});


// fonction du choix des pages et d'affichage du top recent
function pageTop(item, offset, limit){
	$.ajax({
      method: "POST",
      url: "functions/display-top-recent.php",
      data: { id: 315, offset: offset, limit: limit }
    })
      .done(function( html ) {
        	$("#top-recent").html(html);
      });
}
pageTop(1, 0, 10);


// blocage/déblocage des contenus selon si user connecté ou non
function signout(){
	// boutons
	$("#login-button").css("display", "inline-block");
	$("#signup-button").css("display", "inline-block");

	// profile
	$("#profile").html("");
	$("#profile-dropdown").css("display", "none");

	// request a song
    $("form div.field").addClass( "disabled" );
    $("form input.cc_request_form").addClass( "disabled" );
    $("#login-request").css("display", "inline-block");
    $("#logged").css("display", "block");

    // chat textarea
	$('#chat-textarea').html('');
}

function signin(){

	var user = firebase.auth().currentUser;

	// boutons
	$("#login-button").css("display", "none");
	$("#signup-button").css("display", "none");

	// profile
	$("#profile-dropdown").css("display", "block");

	if(user.photoURL != null || user.displayName != null){
		// profile
		$("#profile").html('<img src="'+user.photoURL+'" class="ui avatar image" alt="Avatar">&nbsp;<span>'+user.displayName+'</span>');
		// modal add comment
		$('#add-comment').html('<div class="label"><img src="'+user.photoURL+'" alt="Avatar"></div><div class="content"><div class="summary"><span class="user">'+user.displayName+'</span></div><form class="ui reply form"><div class="field"><textarea style="background: lightgrey;height: 4em;min-height: 4em;max-height: 4em;" placeholder="What\'s up ??" name="textarea"></textarea></div><div class="ui red labeled submit icon button" id="submit-comment"><i class="icon edit"></i> Submit </div><div class="error-message" id="error-message"></div></form></div>');
	}
	else{
		$.ajax({
	      method: "POST",
	      url: "functions/verif-profile-db.php",
	      data: { email: user.email },
	      dataType: "json" // Set the data type so jQuery can parse it for you
	    })
	      .done(function( data ) {
	      		// profile
	        	$("#profile").html('<img src="'+(data.avatar == "" ? "img/anon.png" : data.avatar)+'" class="ui avatar image" alt="Avatar">&nbsp;<span>'+data.username+'</span>');
	        	// modal add comment
	        	$('#add-comment').html('<div class="label"><img src="'+(data.avatar == "" ? "img/anon.png" : data.avatar)+'" alt="Avatar"></div><div class="content"><div class="summary"><span class="user">'+data.username+'</span></div><form class="ui reply form"><div class="field"><textarea style="background: lightgrey;height: 4em;min-height: 4em;max-height: 4em;" name="textarea"></textarea></div><div class="ui red labeled submit icon button" id="submit-comment"><i class="icon edit"></i> Submit </div><div class=" id="error-message"" id="error-message"></div></form></div>');
	      });
	}

	$.ajax({
        method: "POST",
        url: "functions/verif-profile-db.php",
        data: { email: user.providerData[0].email },
        dataType: "json" // Set the data type so jQuery can parse it for you
      })
        .done(function( data ) {
        	if(user.providerData[0].photoURL != null && user.providerData[0].displayName != null){
	           	// avatar
	       		$("img#profile-avatar").attr('src', user.providerData[0].photoURL);
	        	// username
	        	$("div#profile-display-name").html(user.providerData[0].displayName);
			    // profile created date
			    $("span#profile-joined-at").html("Created "+user.metadata.creationTime);
	      	}
	      	else{
                // avatar
                $("img#profile-avatar").attr('src', (data.avatar == "" ? "img/anon.png" : data.avatar));
                // username
                $("div#profile-display-name").html(data.username);
                // profile created date
			    $("span#profile-joined-at").html("Created "+new Date(data.date*1000));
        	}
        	// points
        	$("#user-points").html(data.points+" <i class='star icon'></i>");
        	// location
        	if(data.ville != "" && data.ville != null && data.pays != "" && data.pays != null){
        		$("span#location").html(data.ville+" ("+data.pays+")");
        		if(data.pays == "United States of America") data.pays = "america";
        		$("i#flag").addClass(data.pays);
        	}
        	else $("span#location").html("somewhere...");
        	// favorite song
        	if(data.song != "" && data.song != null) $("div#profile-fav-song").html("<i class='music icon'></i><span>"+data.song+"</span>");
        	else $("div#profile-fav-song").html("");
        });

    // chat textarea
    $('#chat-textarea').html('<div class="ui red labeled submit icon button"><i class="icon edit"></i> Add Comment </div>');
	// request a song
	$("form div.field").removeClass( "disabled" );
    $("form input.cc_request_form").removeClass( "disabled" );
    $("#login-request").css("display", "none");
    $("#logged").css("display", "none");
    $("input#cc_req_email_hotradio").val(user.providerData[0].email);

    // fermeture modal login
	$('.ui.modal.login').modal('hide');

	// validation et soumission du formulaire d'ajout de commentaires
	$("#submit-comment").click(function(){
		if( $("#add-comment textarea").val() != '' && $("#add-comment textarea").val().length >= 5 && $("#add-comment textarea").val().length <= 140) {
	      $.ajax({
	        method: "POST",
	        url: "functions/select-id-user.php",
	        data: { email: user.providerData[0].email },
	        dataType: "json" // Set the data type so jQuery can parse it for you
	      })
	        .done(function( data ) {
	        	$.ajax({
			        method: "POST",
			        url: "functions/add-flux.php",
			        data: { idUser: data, action: "said", message: $("#add-comment textarea").val()},
			        dataType: "json" // Set the data type so jQuery can parse it for you
			      })
			        .done(function( data ) {
			        	$('.ui.modal.add-comment').modal('hide');
			        });
	        });
    	}
    	else if($("#add-comment textarea").val() == ''){
    		$("div#error-message").html("Your message can't be empty");
    	}
    	else if($("#add-comment textarea").val().length < 5){
    		$("div#error-message").html("Your message can't be shorter than 5 caracters");
    	}
    	else if($("#add-comment textarea").val().length > 140){
    		$("div#error-message").html("Your message can't be longer than 140 caracters");
    	}
    });
}