<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Uploaded Photos';
  $childView = 'views/_photos_en.php';
  include('layout_client_en.php');
?>