<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Exercise';
  $childView = 'views/_add_exercise.php';
  include('layout_manager.php');

  $message = '';
  if (isset ($_POST['name'])  && isset($_POST['link_vezba'])  && isset($_POST['muskulna_grupa'])  && isset($_POST['description'])) {
    $name = $_POST['name'];
    $link_vezba = $_POST['link_vezba'];
    $muskulna_grupa = $_POST['muskulna_grupa'];
    $description = $_POST['description'];

    $sql = 'INSERT INTO vezbi(name, link_vezba, muskulna_grupa, description) VALUES(:name, :link_vezba, :muskulna_grupa, :description)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':link_vezba' => $link_vezba, ':muskulna_grupa' => $muskulna_grupa, ':description' => $description])) {
      $message = 'Exercise Added Successfully';
    }  
  }

?>