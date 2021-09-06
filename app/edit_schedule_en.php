<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Schedule';
  $childView = 'views/_edit_schedule_en.php';
  include('layout_client_en.php');
?>