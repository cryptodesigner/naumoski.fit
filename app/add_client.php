<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Client';
  $childView = 'views/_add_client.php';
  include('layout_manager.php');



  $message = '';
  if (isset ($_POST['name']) && isset ($_POST['surname']) && isset ($_POST['email']) && isset ($_POST['password'])) {
  	$managers_manager_id = $_SESSION["manager_id"];
  	$name = $_POST['name'];
  	$surname = $_POST['surname'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
    $password = md5($password);
  	$sql = 'INSERT INTO clients(managers_manager_id, name, surname, email, password) VALUES(:managers_manager_id, :name, :surname, :email, :password)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':managers_manager_id' => $managers_manager_id, ':name' => $name, ':surname' => $surname, ':email' => $email, ':password' => $password])) {
  	  $message = 'Client Added Successfully';
  	}
  }
  
?>