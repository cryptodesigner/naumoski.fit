<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$basic_id = $_GET['basic_id'];
	$sql = 'DELETE FROM basics WHERE basic_id=:basic_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':basic_id' => $basic_id])) {
  	header("Location: /client_basics.php");
	}