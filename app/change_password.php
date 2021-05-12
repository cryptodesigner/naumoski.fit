<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Change Password';
  $childView = 'views/_change_password.php';
  include('layout_client.php');
?>