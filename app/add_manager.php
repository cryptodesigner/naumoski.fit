<?php
  include("config.php");
  require 'db.php';

  session_start();

  $message = '';
  if (isset ($_POST['name'])  && isset($_POST['surname'])  && isset($_POST['email'])  && isset($_POST['password'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $sql = 'INSERT INTO managers(name, surname, email, password) VALUES(:name, :surname, :email, :password)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':surname' => $surname, ':email' => $email, ':password' => $password])) {
      $message = 'Manager Added Successfully';
    }  
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Manager</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:url" content="http://demo.madebytilde.com/elephant">
    <meta property="og:type" content="website">
    <meta property="og:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta property="og:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:image" content="http://demo.madebytilde.com/elephant.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@madebytilde">
    <meta name="twitter:creator" content="@madebytilde">
    <meta name="twitter:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta name="twitter:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta name="twitter:image" content="http://demo.madebytilde.com/elephant.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <!-- <link rel="icon" type="image/png" href="../static/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../static/img/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="../manifest.json"> -->
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#0288d1">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="../static/css/vendor.min.css">
    <link rel="stylesheet" href="../static/css/elephant.min.css">
    <link rel="stylesheet" href="../static/css/signup-3.min.css">
  </head>
  <body>
    <div class="signup">
      <div class="signup-body">
        <a class="signup-brand" href="{{'home'}}">
          <img class="img-responsive" src="../static/img/logo.svg" alt="Elephant">
        </a>
        <h3 class="signup-heading">Add Manager</h3>
        <?php if(!empty($message)): ?>
          <div class="alert alert-success">
            <?= $message; ?>
          </div>
        <?php endif; ?>
        <div class="signup-form">
          <form data-toggle="md-validator" action="" method="POST">
            <div class="row">
              <div class="col-sm-6">
                <div class="md-form-group md-label-floating">
                  <input class="md-form-control" type="text" name="name" id="name" spellcheck="false" data-msg-required="Please enter your first name." required>
                  <label class="md-control-label">First name</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="md-form-group md-label-floating">
                  <input class="md-form-control" type="text" name="surname" id="surname" spellcheck="false" data-msg-required="Please enter your last name." required>
                  <label class="md-control-label">Last name</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="md-form-group md-label-floating">
                  <input class="md-form-control" type="email" name="email" id="email" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." required>
                  <label class="md-control-label">Email</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="md-form-group md-label-floating">
                  <input class="md-form-control" type="password" name="password" id="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                  <label class="md-control-label">Password</label>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Add Manager</button>
          </form>
        </div>
      </div>
      <div class="signup-footer">
        Already have an account? <a href="login.php">Log in</a>
      </div>
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