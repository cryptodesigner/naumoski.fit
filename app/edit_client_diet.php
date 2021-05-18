<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Client Diet';
  $childView = 'views/_edit_client_diet.php';
  include('layout_manager.php');
?>