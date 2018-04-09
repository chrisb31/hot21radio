<div id="request-form">
  <h2>Play This Song ! 
    <span data-inverted="" data-tooltip="Request a song to be played. If it's in our playlist it will be played in few minutes." data-position="bottom center"><i class="info circle icon"></i></span>
  </h2>

  <div id="cc_req_result_hotradio" class="ui positive message" style="display:none;"><i class="close icon"></i></div>
  <p id="logged" style="display:none;">You have to be logged to request a song</p>
  <button id="login-request" class="ui button red" style="display:none;">Sign in</button>
  <form class="ui form" id="request-form">
    <div class="required field">
      <label>Song artist: </label>
      <input type="text" id="cc_req_artist_hotradio" name="request[artist]" size="40" maxlength="127" />
    </div><br />
    <div class="required field">
      <label>Song title: </label>
      <input type="text" id="cc_req_title_hotradio" name="request[title]" size="40" maxlength="127" />
    </div><br />
    <input type="hidden" id="cc_req_dedi_hotradio" name="request[dedication]" size="40" maxlength="127" />
    <input type="hidden" id="cc_req_sender_hotradio" name="request[sender]" size="40" maxlength="127" />
    <div class="required field"><label>Your E-mail: </label><input type="text" id="cc_req_email_hotradio" name="request[email]" size="40" maxlength="127" /></div><br />
    <input type="button" id="cc_req_button_hotradio" class="cc_request_form ui button" value="Submit song request" />
  </form>
</div>

<script type="text/javascript">
  // Quand un champ a été laissé vide il devient rouge et on le remet blanc quand on écrit dedans
  $(".ui.form input").keypress(function(){
    $(this).css("background-color", "transparent");
  });
  $("#cc_req_throbber_hotradio").css("z-index", "10000");

  $("form div.field").addClass( "disabled" );
  $("form input.cc_request_form").addClass( "disabled" );
  $("#login-request").css("display", "inline-block");
  $("#logged").css("display", "block");

</script>