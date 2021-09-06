<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Measurement';
  $childView = 'views/_edit_measurement_en.php';
  include('layout_client_en.php');
?>