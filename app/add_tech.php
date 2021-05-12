<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Technique';
  $childView = 'views/_add_tech.php';
  include('layout_manager.php');
?>