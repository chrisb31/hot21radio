<div class="ui modal signup">

      <!-- Modal signup -->

      <div class="header">
        <h3>Register</h3>
      </div>

      <div class="msg-signup"></div>

      <div class="content">
        <div class="ui two column middle aligned very relaxed stackable grid">
          <div class="column">
            <div class="ui form">
              <div class="field">
                <label>Username</label>
                <div class="ui left icon input">
                  <input class="mdl-textfield__input" style="display:inline;width:auto;" type="text" id="username" name="username" placeholder="Username" maxlength="50" required />
                  <i class="user icon"></i>
                </div>
              </div>
              <div class="field">
                <label>Email</label>
                <div class="ui left icon input">
                  <input class="mdl-textfield__input" style="display:inline;width:auto;" type="text" id="email-signup" name="email" placeholder="Email" maxlength="50" required/>
                  <i class="at icon"></i>
                </div>
              </div>
              <div class="field">
                <label>Password</label>
                <div class="ui left icon input">
                  <input class="mdl-textfield__input" style="display:inline;width:auto;" type="password" id="password-signup" name="password" placeholder="Password" maxlength="50" required/>
                  <i class="lock icon"></i>
                </div>
              </div>
              <div class="g-recaptcha" data-sitekey="6Lem4j4UAAAAAERpEV2jyfQ42Uhk2ZU-M-YILL58"></div>
              <button class="ui red submit button" id="quickstart-sign-up" name="signup">Register</button>
              <br>
              <!-- <button class="mdl-button mdl-js-button mdl-button--raised" disabled id="quickstart-verify-email" name="verify-email">Send Email Verification</button> -->
            </div>
          </div>
          <div class="ui vertical divider" style="left:50% !important;height: 25% !important;">
            Or
          </div>
          <div class="center aligned column">
              <button class="ui twitter button" id="twitter-button" onclick="firebase.auth().signInWithPopup(new firebase.auth.TwitterAuthProvider());">
                <i class="twitter icon"></i>
                Register with Twitter
              </button>
              <button class="ui facebook button" id="facebook-button" onclick="firebase.auth().signInWithPopup(new firebase.auth.FacebookAuthProvider());">
                <i class="facebook icon"></i>
                Register with Facebook
              </button>

          </div>
        </div>
      </div>

</div>