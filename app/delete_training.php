<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$training_id = $_GET['training_id'];
	$sql = 'DELETE FROM trainings WHERE training_id=:training_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':training_id' => $training_id])) {
  	header("Location: /trainings.php");
	}