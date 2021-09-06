<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Measurements';
  $childView = 'views/_client_measurements_en.php';
  include('layout_client_en.php');

?>