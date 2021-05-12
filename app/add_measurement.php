<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Measurement';
  $childView = 'views/_add_measurement.php';
  include('layout_client.php');
?>