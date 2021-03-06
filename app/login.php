<?php
  
   include("config.php");
  
  session_start();
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $manager_id = mysqli_real_escape_string($db, $_GET['manager_id']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
  
    $sql = "SELECT * FROM managers WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];
  
    $count = mysqli_num_rows($result);
  
    if($count == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $_SESSION['manager_id'] = $row["manager_id"];

      header("location: manager_profile.php");
    } else {
      $error = "Your Login Email or Password is Invalid";
    }
  }


  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = mysqli_real_escape_string($db, $_GET['client_id']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
  
    $sql = "SELECT * FROM clients WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];
  
    $count = mysqli_num_rows($result);
  
    if($count == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $_SESSION['client_id'] = $row["client_id"];

      header("location: client_profile.php");
    } else {
      $error = "Your Login Email or Password is Invalid";
    }
  }
  
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="Online coaching">
    <meta property="og:url" content="https://app.naumoski.fit/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="The fastest way to build your body.">
    <meta property="og:description" content="Online coaching. The fastest way to build your body.">
    <meta property="og:image" content="https://app.naumoski.fit/static/img/avatar-logo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="Online coaching. The fastest way to build your body.">
    <meta name="twitter:description" content="Online coaching. The fastest way to build your body.">
    <meta name="twitter:image" content="https://app.naumoski.fit/static/img/avatar-logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <!-- <link rel="icon" type="image/png" href="../static/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../static/img/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="../manifest.json"> -->
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#0288d1">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="../static/css/vendor.min.css">
    <link rel="stylesheet" href="../static/css/elephant.min.css">
    <link rel="stylesheet" href="../static/css/login-3.min.css">
  </head>
  <body>
    <div class="login">
      <div class="login-body">
        <a class="login-brand" href="#">
          <img class="img-responsive" src="../static/img/logo.svg" alt="Naumoski">
        </a>
        <h3 class="login-heading">Sign in</h3>
        <div class="login-form">
          <form data-toggle="md-validator" action="" method="POST">
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="email" name="email" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." required>
              <label class="md-control-label">Email</label>
            </div>
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
              <label class="md-control-label">Password</label>
            </div>
            <div class="md-form-group md-custom-controls">
              <label class="custom-control custom-control-primary custom-checkbox">
                <input class="custom-control-input" type="checkbox" checked="checked">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-label">Keep me signed in? </span>
              </label>
              <a href="reset_pass.php">Forgot password?</a>
            </div>
            <button class="btn btn-primary btn-block" type="submit" value="Submit">Sign in</button>
          </form>
        </div>
      </div>
      <!-- <div class="login-footer">
        Don't have an account? <a href="{{url_for('signup')}}">Sign Up</a>
      </div> -->
    </div>
    <script src="../static/js/vendor.min.js"></script>
    <script src="../static/js/elephant.min.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-83990101-1', 'auto');
      ga('send', 'pageview');
    </script>
  </body>
</html>