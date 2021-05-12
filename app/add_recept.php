<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Recept';
  $childView = 'views/_add_recept.php';
  include('layout_manager.php');
?>