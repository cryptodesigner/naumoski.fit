<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Meal';
  $childView = 'views/_add_meal.php';
  include('layout_manager.php');
?>