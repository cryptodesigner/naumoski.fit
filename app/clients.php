<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Clients';
  $childView = 'views/_clients.php';
  include('layout_manager.php');

?>