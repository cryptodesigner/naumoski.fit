<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Exercise';
  $childView = 'views/_edit_exercise.php';
  include('layout_manager.php');
?>