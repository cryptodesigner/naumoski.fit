<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Basics';
  $childView = 'views/_client_basics_en.php';
  include('layout_client_en.php');

?>