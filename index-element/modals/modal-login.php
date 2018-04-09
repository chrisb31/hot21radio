<div class="ui modal login">

      <!-- Modal login -->

      <div class="header">
        <h3>Sign in</h3>
      </div>

      <div class="msg-login"></div>

      <div class="content">
        <div class="ui two column middle aligned very relaxed stackable grid">
          <div class="column">
            <div class="ui form">
              <div class="field">
                <label>Email</label>
                <div class="ui left icon input">
                  <input class="mdl-textfield__input" style="display:inline;width:auto;" type="text" id="email-login" name="email" placeholder="Email"/>
                  <i class="at icon"></i>
                </div>
              </div>
              <div class="field">
                <label>Password</label>
                <div class="ui left icon input">
                  <input class="mdl-textfield__input" style="display:inline;width:auto;" type="password" id="password-login" name="password" placeholder="Password"/>
                  <i class="lock icon"></i>
                </div>
              </div>
              <p><a class="darkred pointer" id="forgot">Forgot your password?</a></p>
              <button class="ui red submit button" id="quickstart-sign-in" name="signin">Sign in</button>
            </div>
          </div>
          <div class="ui vertical divider" style="left:50% !important;height: 25% !important;">
            Or
          </div>
          <div class="center aligned column">
              <button class="ui twitter button" id="twitter-button" onclick="firebase.auth().signInWithPopup(new firebase.auth.TwitterAuthProvider());">
                <i class="twitter icon"></i>
                Sign in  with Twitter
              </button>
              <button class="ui facebook button" id="facebook-button" onclick="firebase.auth().signInWithPopup(new firebase.auth.FacebookAuthProvider());">
                <i class="facebook icon"></i>
                Sign in with Facebook
              </button>

          </div>
        </div>
        <p style="text-align: center;">Not a member yet? <a class="darkred pointer" id="open-signup">Sign up</a></p>
      </div>

</div>

<script type="text/javascript">
  // ouverture modal password reset
  $("#forgot").click(function(){
    $('.ui.modal.forgot')
      .modal({
        blurring: true
        })
      .modal('setting', 'transition', 'fade up')
      .modal('show')
    ;
  });
  // ouverture modal signup
  $("#open-signup").click(function(){
    $('.ui.modal.signup')
      .modal({
        blurring: true
        })
      .modal('setting', 'transition', 'fade up')
      .modal('show')
    ;
  });
</script>