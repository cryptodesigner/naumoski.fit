<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Schedule';
  $childView = 'views/_add_schedule.php';
  include('layout_client.php');
?>