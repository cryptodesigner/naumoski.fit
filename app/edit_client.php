<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Client';
  $childView = 'views/_edit_client.php';
  include('layout_manager.php');
?>