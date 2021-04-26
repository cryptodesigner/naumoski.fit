<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Measurements';
  $childView = 'views/_client_measurements.php';
  include('layout_client.php');

?>