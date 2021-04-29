<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Exercises';
  $childView = 'views/_exercises.php';
  include('layout_manager.php');
?>