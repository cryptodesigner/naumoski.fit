<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$option_id = $_GET['option_id'];
	$sql = 'DELETE FROM options WHERE option_id=:option_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':option_id' => $option_id])) {
  	header("Location: /meals.php");
	}