<?php

include('cfg/config.php');

// Affichage des derniers membres inscrits
$req = mysqli_query($link, 'Select id, username, avatar from users order by signup_date desc limit 0,7;');
  echo "<div>Last joined : ";
  while($dnn = mysqli_fetch_array($req)){
    $img = $dnn['avatar'] == null ? "img/anon.png" : $dnn['avatar'];
    $username = $dnn['username'];
    $id = $dnn['id'];
    echo '<img class="ui avatar image pointer" src="'.$img.'" alt="avatar" title="'.$username.'"  onclick="modalProfile('.$id.');">';
  }
  echo "</div>";
///////////////

// Affichage du Top Members
$k2 = 1;
$req2 = mysqli_query($link, 'SELECT users.id, users.username, users.avatar, user_points.points FROM `users` inner join user_points on users.id = user_points.id_user where not users.id = 1 order by user_points.points desc limit 0,3;');
echo '<div class="gris-clair-background margin-top-1rem padding-5px">
        <h2 class="inline-block">Top Members&nbsp;</h2><span><a class="darkred" href="" onclick="open(\'player/player.php\', \'Popup\', \'scrollbars=0,resizable=0,height=980,width=435,left=50\'); return false;">( 1 minute listening = 1<i class="star icon"></i>)</a></span>
        <div class="ui middle aligned selection list">';
while($dnn2 = mysqli_fetch_array($req2)){
  $img2 = $dnn2['avatar'] == null ? "img/anon.png" : $dnn2['avatar'];
  $id = $dnn2['id'];
  echo '<div class="item" onclick="modalProfile('.$id.');">
          '.$k2.'
          <img class="ui avatar image" src="'.$img2.'">
          <div class="content">
            <div class="header">'.$dnn2["username"].'</div>
            '.$dnn2['points'].' <i class="star icon"></i>
          </div>
        </div>';
        $k2++;
}
echo '</div></div>';
///////////////

?>
<div class="ui feed">
  <div id="chat-textarea"></div>
</div>

<div class="ui feed" id="display-flux">

</div>

<script type="text/javascript">
  function displayFlux(){
    $.ajax({
      method: "POST",
      url: "functions/display-flux.php"
    })
      .done(function( data ) {
        $("#display-flux").html(data);
      });
  }
  displayFlux();
  setInterval(displayFlux, 5000);

  function modalProfile(id){
    $.ajax({
        method: "POST",
        url: "functions/verif-profile-db.php",
        data: { id: id },
        dataType: "json" // Set the data type so jQuery can parse it for you
      })
        .done(function( data ) {
          // modal title + réseaux sociaux pour id=1
          if(id == "1") $("h3#modal-title").html(data.username+'<div class="inline-block float-right"><a href="https://twitter.com/hot21radio" target="_blank"><button class="ui circular twitter icon button" title="Follow us on Twitter"><i class="twitter icon"></i></button></a><a href="http://www.facebook.com/hot21radio" target="_blank"><button class="ui circular facebook icon button" title="Follow us on Facebook"><i class="facebook icon"></i></button></a><a href="https://www.instagram.com/hot21radio/" target="_blank"><button class="ui circular instagram icon button" title="Follow us on Instagram"><i class="instagram icon"></i></button></a></div><div class="clear-both"></div>');
          // modal title + points
          else $("h3#modal-title").html(data.username+'<div class="inline-block float-right ui mini horizontal statistic"><div class="value">'+data.points+'</div><div class="label"><i class="star icon"></i></div></div><div class="clear-both"></div>');
          // avatar
          $("img#user-profile-avatar").attr('src', (data.avatar == "" || data.avatar == null ? "img/anon.png" : data.avatar));
          // username
          $("div#user-profile-display-name").html(data.username);
          // profile created date
          var date = new Date(data.date*1000);
          var day = date.getDate();
          var monthNames = ["January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];
          var year = date.getFullYear();
          $("span#user-profile-joined-at").html("Joined on "+monthNames[date.getMonth()]+" "+day+", "+year);
          // location
          if(data.ville != "" && data.pays != "" && data.ville != null && data.pays != null){
            if(data.pays == "United States of America") data.pays = "america";
            $("span#user-location").html(data.ville+" ("+(data.pays == "america" ? "USA" : data.pays)+")&nbsp;<i class='flag "+data.pays.toLowerCase()+"' id='user-flag'></i>");
          }
          else $("div#description").html('From <span id="user-location">somewhere...</span>');
        });
        $('.ui.modal.user-profile')
          .modal({
            blurring: true
            })
          .modal('setting', 'transition', 'fade up')
          .modal('show')
      ;
  }

  function visitorLike(idFlux){
    $.ajax({
        method: "POST",
        url: "functions/add-like-flux.php",
        data: { id: idFlux, ip: "<?= $_SERVER['REMOTE_ADDR']; ?>" },
        dataType: "json" // Set the data type so jQuery can parse it for you
      })
        .done(function( data ) {
          console.log(data);
          $("#meta-"+idFlux).html('<span class="like"><i class="like icon"></i> You liked</span>')
        });
  }

  $("#chat-textarea").click(function(){
    $("#add-comment textarea").val('');
    $("div#error-message").html('');
    $('.ui.modal.add-comment')
          .modal({
            blurring: true
            })
          .modal('setting', 'transition', 'fade up')
          .modal('show')
      ;
  });
</script>