<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Measurement';
  $childView = 'views/_add_measurement_en.php';
  include('layout_client_en.php');
?>