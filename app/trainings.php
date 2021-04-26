<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Trainings';
  $childView = 'views/_trainings.php';
  include('layout_manager.php');
?>