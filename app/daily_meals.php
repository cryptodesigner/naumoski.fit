<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Daily Meals';
  $childView = 'views/_daily_meals.php';
  include('layout_manager.php');
?>