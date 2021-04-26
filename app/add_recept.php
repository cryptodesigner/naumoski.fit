<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Recept';
  $childView = 'views/_add_recept.php';
  include('layout_manager.php');

  $message = '';
  if (isset ($_POST['name']) && isset ($_POST['description']) && isset ($_POST['link'])) {
  	$managers_manager_id = $_SESSION["manager_id"];
  	$name = $_POST['name'];
  	$description = $_POST['description'];
  	$link = $_POST['link'];
  
  	$sql = 'INSERT INTO recepts(managers_manager_id, name, description, link) VALUES(:managers_manager_id, :name, :description, :link)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':managers_manager_id' => $managers_manager_id, ':name' => $name, ':description' => $description, ':link' => $link])) {
  	  $message = 'Client Added Successfully';
  	}
  }

?>