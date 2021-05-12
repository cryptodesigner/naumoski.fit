<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Exercise';
  $childView = 'views/_add_exercise.php';
  include('layout_manager.php');
?>