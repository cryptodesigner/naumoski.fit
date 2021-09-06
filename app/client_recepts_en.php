<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Recepts';
  $childView = 'views/_client_recepts_en.php';
  include('layout_client_en.php');

?>