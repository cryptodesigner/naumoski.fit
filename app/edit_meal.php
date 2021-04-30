<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Meal';
  $childView = 'views/_edit_meal.php';
  include('layout_manager.php');
?>