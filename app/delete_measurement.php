<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$measurement_id = $_GET['measurement_id'];
	$sql = 'DELETE FROM measurements WHERE measurement_id=:measurement_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':measurement_id' => $measurement_id])) {
  	header("Location: /client_measurements.php");
	}