<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Meals';
  $childView = 'views/_meals.php';
  include('layout_manager.php');
?>