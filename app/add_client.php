<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Client';
  $childView = 'views/_add_client.php';
  include('layout_manager.php');
?>