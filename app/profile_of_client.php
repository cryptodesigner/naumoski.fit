<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Profile of Client';
  $childView = 'views/_profile_of_client.php';
  include('layout_manager.php');
?>