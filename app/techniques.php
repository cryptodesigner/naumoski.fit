<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Techniques';
  $childView = 'views/_techniques.php';
  include('layout_manager.php');
?>