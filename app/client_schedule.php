<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Schedule';
  $childView = 'views/_client_schedule.php';
  include('layout_client.php');

?>