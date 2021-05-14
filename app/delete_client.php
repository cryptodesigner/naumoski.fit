<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$client_id = $_GET['client_id'];
	$sql = 'DELETE FROM clients WHERE client_id=:client_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':client_id' => $client_id])) {
  	header("Location: https://app.naumoski.fit/clients.php");
	}