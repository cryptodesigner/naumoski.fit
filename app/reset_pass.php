<?php
  include("config.php");
  require 'db.php';

  require_once("php/PHPMailerAutoload.php");
    
  require("php/PHPMailer.php");
  require("php/SMTP.php");
  require("php/Exception.php");

  $mail = new PHPMailer\PHPMailer\PHPMailer();
  
  $mail->SMTPDebug = 2;
  $mail->Debugoutput = 'html';
  $mail->Host = 'localhost';
  $mail->Port = 25;

  //Authentication
  $mail->Username = "reset@naumoski.fit";
  $mail->Password = "Naumoski@2021";

  if(isset($_POST['email'])){
    $email = $_POST['email'];

    $sql = "SELECT * FROM clients WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1){
      $password = generateRandomString();

      $encPassword = md5($password);
      
      $sql = 'UPDATE clients SET password=:encPassword WHERE email=:email';
      $statement = $connection->prepare($sql);
    
      if ($statement->execute([':encPassword' => $encPassword, ':email' => $email])) {
        // header("location: clients.php");
      }

      //Set Params
      $mail->SetFrom("reset@naumoski.fit");
      $mail->AddAddress($email);
      $mail->Subject = "Reset Password";
      $mail->Body = $password;

      if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        echo "Message has been sent";
      }
    }

    $sql = "SELECT * FROM managers WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1){
      $password = generateRandomString();

      $encPassword = md5($password);
      
      $sql = 'UPDATE managers SET password=:encPassword WHERE email=:email';
      $statement = $connection->prepare($sql);
    
      if ($statement->execute([':encPassword' => $encPassword, ':email' => $email])) {
        // header("location: clients.php");
      }

      //Set Params
      $mail->SetFrom("reset@naumoski.fit");
      $mail->AddAddress($email);
      $mail->Subject = "Reset Password";
      $mail->Body = $password;

      if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        echo "Message has been sent";
      }
    }

    if($count != 1){
      echo "Email not in Database";
    }
  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password</title>
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
    <link rel="manifest" href="manifest.json"> -->
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
        <a class="login-brand" href="index.html">
          <img class="img-responsive" src="../static/img/logo.svg" alt="Elephant">
        </a>
        <div class="login-form">
          <form data-toggle="md-validator" action="" method="POST">
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="email" name="email" id="email" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." placeholder="Email" required>
              <span class="md-help-block">We'll send you an email to reset your password.</span>
            </div>
            <br>
            <button class="btn btn-primary btn-block" type="submit">Send password reset email</button>
          </form>
        </div>
      </div>
      <div class="login-footer">
        You already have an account? <a href="login.php">Log In</a>
      </div>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/elephant.min.js"></script>
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