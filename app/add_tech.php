<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Technique';
  $childView = 'views/_add_tech.php';
  include('layout_manager.php');

  $message = '';
  if (isset ($_POST['name'])  && isset($_POST['link'])  && isset($_POST['description'])) {
    $name = $_POST['name'];
    $link = $_POST['link'];
    $description = $_POST['description'];

    $sql = 'INSERT INTO tehniki(name, link, description) VALUES(:name, :link, :description)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':link' => $link, ':description' => $description])) {
      $message = 'Technique Added Successfully';
    }  
  }

?>