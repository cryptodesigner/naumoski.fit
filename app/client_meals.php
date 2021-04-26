<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Client Meals';
  $childView = 'views/_client_meals.php';
  include('layout_client.php');

?>