<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Basics';
  $childView = 'views/_edit_basic.php';
  include('layout_client.php');
?>