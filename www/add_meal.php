<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Meal';
  $childView = 'views/_add_meal.php';
  include('layout_manager.php');

  $message = '';
  if (isset ($_POST['name'])  && isset($_POST['sostojki'])  && isset($_POST['proteins'])  && isset($_POST['carbohydrates']) && isset($_POST['fats']) && isset($_POST['description'])) {
    $name = $_POST['name'];
    $sostojki = $_POST['sostojki'];
    $proteins = $_POST['proteins'];
    $carbohydrates = $_POST['carbohydrates'];
    $fats = $_POST['fats'];
    $description = $_POST['description'];

    $sql = 'INSERT INTO options(name, sostojki, proteins, carbohydrates, fats, description) VALUES(:name, :sostojki, :proteins, :carbohydrates, :fats, :description)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':name' => $name, ':sostojki' => $sostojki, ':proteins' => $proteins, ':carbohydrates' => $carbohydrates, ':fats' => $fats, ':description' => $description])) {
      $message = 'Meal Added Successfully';
    }  
  }

?>