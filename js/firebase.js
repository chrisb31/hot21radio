/**
 * Handles the sign in button press.
 */
function toggleSignIn() {
  if (firebase.auth().currentUser) {
    // [START signout]
    firebase.auth().signOut();

    signout();
    
    // [END signout]
  } else {
    var email = document.getElementById('email-login').value;
    var password = document.getElementById('password-login').value;
    if (email.length < 4) {
      //alert('Please enter an email address.');
      $(".msg-login").html('<div class="ui negative message"><i class="close icon"></i><span>Please enter an email address.</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
      $("#email-login").val("");
      return;
    }
    if (password.length < 4) {
      //alert('Please enter a password.');
      $(".msg-login").html('<div class="ui negative message"><i class="close icon"></i><span>Please enter a password.</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
      $("#password-login").val("");
      return;
    }
    // Sign in with email and pass.
    // [START authwithemail]
    firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      // [START_EXCLUDE]
      if (errorCode === 'auth/wrong-password') {
        //alert('Wrong password.');
        $(".msg-login").html('<div class="ui negative message"><i class="close icon"></i><span>Wrong password.</span></div>');
        $('.message .close')
        .on('click', function() {
          $(this)
            .closest('.message')
            .transition('fade')
          ;
        });
        $("#password-login").val("");
      } else {
        //alert(errorMessage);
        $(".msg-login").html('<div class="ui negative message"><i class="close icon"></i><span>'+errorMessage+'</span></div>');
        $('.message .close')
        .on('click', function() {
          $(this)
            .closest('.message')
            .transition('fade')
          ;
        });
        $("#email-login").val("");
        $("#password-login").val("");
      }
      //console.log(error);
      document.getElementById('quickstart-sign-in').disabled = false;
      // [END_EXCLUDE]
    });
    // [END authwithemail]
  }
  //document.getElementById('quickstart-sign-in').disabled = true;
}
/**
 * Handles the sign up button press.
 */
function handleSignUp() {
  var username = document.getElementById('username').value;
  var email = document.getElementById('email-signup').value;
  var password = document.getElementById('password-signup').value;

  // vérification username déjà pris
  $.ajax({
      method: "POST",
      url: "functions/verif-profile-db.php",
      data: { username: username }
    })
      .done(function( msg ) {
          if(msg == "used"){
            $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>The username is already used.</span></div>');
            $('.message .close')
            .on('click', function() {
              $(this)
                .closest('.message')
                .transition('fade')
              ;
            });
            $("#username").val("");
            return;
          }
      });
  // vérification username trop court
  if (username.length < 3) {
    if(username.length == 0){
      $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>Please enter an username.</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
    }
    else{
      $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>The username is too short (minimum of 3 characters)</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
    }
    $("#username").val("");
    return;
  }
  // vérification email trop court ou email invalide
  if (email.length < 4) {
    $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>Please enter an email address.</span></div>');
    $('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade')
      ;
    });
    $("#email-signup").val("");
    return;
  }
  // vérification password trop court
  if (password.length < 6) {
    //alert('Please enter a password.');
    if(password.length == 0){
      $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>Please enter a password.</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
    }
    else{
      $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>The password is too short (minimum of 6 characters)</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
    }
    $("#password-signup").val("");
    return;
  }
  // vérification recaptcha
  var response = grecaptcha.getResponse();
  if(response == ""){
    $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>Please complete the captcha box.</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
    return;
  }
  else{
    $.ajax({
      method: "POST",
      url: "functions/is_valid_captcha.php",
      data: { recaptcha: response }
    })
      .done(function( msg ) {
          if(msg == "bot") return;
      });
  }
  // Sign in with email and pass.
  // [START createwithemail]
  firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {

    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    // [START_EXCLUDE]
    if (errorCode == 'auth/weak-password') {
      $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>The password is too weak.</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
      $("#password-signup").val("");
    } else {
      $(".msg-signup").html('<div class="ui negative message"><i class="close icon"></i><span>'+errorMessage+'</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
      $("#email-signup").val("");
      $("#password-signup").val("");
    }
    //console.log(error);
    // [END_EXCLUDE]
  });
  // [END createwithemail]
}
/**
 * Sends an email verification to the user.
 */
function sendEmailVerification() {
  // [START sendemailverification]
  firebase.auth().currentUser.sendEmailVerification().then(function() {
    // Email Verification sent!
    // [START_EXCLUDE]
    alert('Email Verification Sent!');
    // [END_EXCLUDE]
  });
  // [END sendemailverification]
}
function sendPasswordReset() {
  var email = document.getElementById('email-forgot').value;
  // vérification email trop court
  if (email.length < 4) {
    $(".msg-forgot").html('<div class="ui negative message"><i class="close icon"></i><span>Please enter an email address.</span></div>');
    $('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade')
      ;
    });
    $("#email-forgot").val("");
    return;
  }
  // [START sendpasswordemail]
  firebase.auth().sendPasswordResetEmail(email).then(function() {
    // Password Reset Email Sent!
    // [START_EXCLUDE]
    //alert('Password Reset Email Sent!');
    // message de succès
    $(".msg-forgot").html('<div class="ui success message"><i class="close icon"></i><span>Password reset email sent!</span></div>');
    $('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade')
      ;
    });
    $("#email-forgot").val("");
    // [END_EXCLUDE]
  }).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    // [START_EXCLUDE]
    if (errorCode == 'auth/invalid-email') {
      //alert(errorMessage);
      // message d'erreur
      $(".msg-forgot").html('<div class="ui negative message"><i class="close icon"></i><span>'+errorMessage+'</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
      $("#email-forgot").val("");
    } else if (errorCode == 'auth/user-not-found') {
      //alert(errorMessage);
      // message d'erreur
      $(".msg-forgot").html('<div class="ui negative message"><i class="close icon"></i><span>'+errorMessage+'</span></div>');
      $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      });
      $("#email-forgot").val("");
    }
    //console.log(error);
    // [END_EXCLUDE]
  });
  // [END sendpasswordemail];
}
/**
 * initApp handles setting up UI event listeners and registering Firebase auth listeners:
 *  - firebase.auth().onAuthStateChanged: This listener is called when the user is signed in or
 *    out, and that is where we update the UI.
 */
function initApp() {
  // Listening for auth state changes.
  // [START authstatelistener]
  firebase.auth().onAuthStateChanged(function(user) {
    // [START_EXCLUDE silent]
    //document.getElementById('quickstart-verify-email').disabled = true;
    // [END_EXCLUDE]
    if (user) {

      // mise à jour du displayName à l'inscription
      if(document.getElementById('username').value != ""){
        var username = document.getElementById('username').value;
        // Updates the user attributes:
        user.updateProfile({
          displayName: username,
          photoURL: "img/anon.png"
        }).then(function() {
          // Profile updated successfully!
          // "Jane Q. User"
          var displayName = user.displayName;
          // "https://example.com/jane-q-user/profile.jpg"
          var photoURL = user.photoURL;
          window.location.reload();
        }, function(error) {
          // An error happened.
          console.log(error);
        });
      }
      
      // User is signed in.
      var displayName = user.displayName;
      var email = user.email;
      var emailVerified = user.emailVerified;
      var photoURL = user.photoURL;
      var isAnonymous = user.isAnonymous;
      var uid = user.uid;
      var providerData = user.providerData;

      // update or insert profile data
      $.ajax({
          method: "POST",
          url: "functions/update-profile-db.php",
          data: { email: providerData[0].email, username: providerData[0].displayName, avatar: providerData[0].photoURL },
          dataType: "json" // Set the data type so jQuery can parse it for you
        })
          .done(function( data ) {
              //console.log(data);
          });
      ///////////

      // [START_EXCLUDE]
      //document.getElementById('quickstart-sign-in-status').textContent = 'Signed in';
      //document.getElementById('quickstart-sign-in').textContent = 'Sign out';
      //document.getElementById('quickstart-account-details').textContent = JSON.stringify(user, null, '  ');
    
      signin();

      /*if (!emailVerified) {
        document.getElementById('quickstart-verify-email').disabled = false;
      }*/
      // [END_EXCLUDE]
    } else {
      // User is signed out.
      // [START_EXCLUDE]
      // document.getElementById('quickstart-sign-in-status').textContent = 'Signed out';
      // document.getElementById('quickstart-sign-in').textContent = 'Sign in';
      // document.getElementById('quickstart-account-details').textContent = 'null';
      // [END_EXCLUDE]
    }
    // [START_EXCLUDE silent]
    //document.getElementById('quickstart-sign-in').disabled = false;
    // [END_EXCLUDE]
  });
  // [END authstatelistener]
  document.getElementById('quickstart-sign-in').addEventListener('click', toggleSignIn, false);
  document.getElementById('quickstart-sign-up').addEventListener('click', handleSignUp, false);
  //document.getElementById('quickstart-verify-email').addEventListener('click', sendEmailVerification, false);
  document.getElementById('quickstart-password-reset').addEventListener('click', sendPasswordReset, false);
}

window.onload = function() {
  initApp();
};