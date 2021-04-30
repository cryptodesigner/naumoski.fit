<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$vezba_id = $_GET['vezba_id'];
	$sql = 'DELETE FROM vezbi WHERE vezba_id=:vezba_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':vezba_id' => $vezba_id])) {
  	header("Location: /exercises.php");
	}