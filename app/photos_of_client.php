<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Photos of Client';
  $childView = 'views/_photos_of_client.php';
  include('layout_manager.php');
?>