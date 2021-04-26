<?php
	include("config.php");
	require 'db.php';
	include_once 'db.php';

	$json = file_get_contents('php://input');
	$data = json_decode($json);
	$theInt = (int)$data;

	$sql = 'SELECT * FROM options WHERE option_id = '.$theInt.';';
	$statement = $connection->prepare($sql);
	$statement->execute();
	$option = $statement->fetchAll(PDO::FETCH_OBJ);
	header('Content-Type: application/json');
	echo json_encode($option);

?>