<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Basics';
  $childView = 'views/_add_basics.php';
  include('layout_client.php');
?>