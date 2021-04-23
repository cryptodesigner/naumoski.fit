<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Basics';
  $childView = 'views/_client_basics.php';
  include('layout_client.php');

?>