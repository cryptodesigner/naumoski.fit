<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Basics';
  $childView = 'views/_add_basics_en.php';
  include('layout_client_en.php');
?>