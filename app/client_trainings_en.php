<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Trainings';
  $childView = 'views/_client_trainings_en.php';
  include('layout_client_en.php');

?>