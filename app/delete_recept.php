<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$recept_id = $_GET['recept_id'];
	$sql = 'DELETE FROM recepts WHERE recept_id=:recept_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':recept_id' => $recept_id])) {
  	header("Location: /recepts.php");
	}