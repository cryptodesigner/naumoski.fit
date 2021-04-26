<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Profile';
  $childView = 'views/_client_profile.php';
  include('layout_client.php');
?>