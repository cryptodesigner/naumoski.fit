<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Manager Profile';
  $childView = 'views/_manager_profile.php';
  include('layout_manager.php');
?>