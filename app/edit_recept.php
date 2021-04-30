<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Edit Recept';
  $childView = 'views/_edit_recept.php';
  include('layout_manager.php');
?>