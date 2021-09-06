<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Change Password';
  $childView = 'views/_change_password_en.php';
  include('layout_client_en.php');
?>