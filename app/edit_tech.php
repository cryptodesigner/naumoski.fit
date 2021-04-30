<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Tech';
  $childView = 'views/_edit_tech.php';
  include('layout_manager.php');
?>