<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Manager Profile';
  $childView = 'views/_manager_profile.php';
  include('layout_manager.php');
?>
<!-- Facebook Messenger -->
<div class="fb-customerchat"
 page_id="105973318241762"
 greeting_dialog_display="hide"
 theme_color="#A38800">
</div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '912333495590130',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.11'
    });
  };
(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<!-- End Facebook Messenger -->