<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Basics';
  $childView = 'views/_edit_basic_en.php';
  include('layout_client_en.php');
?>