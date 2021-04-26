<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';
	
	$client_id = $_GET['client_id'];
	$sql = 'DELETE FROM clients WHERE client_id=:client_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':client_id' => $client_id])) {
  	header("Location: /clients.php");
	}


	$tehnika_id = $_GET['tehnika_id'];
	$sql = 'DELETE FROM tehniki WHERE tehnika_id=:tehnika_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':tehnika_id' => $tehnika_id])) {
  	header("Location: /techniques.php");
	}


	$option_id = $_GET['option_id'];
	$sql = 'DELETE FROM options WHERE option_id=:option_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':option_id' => $option_id])) {
  	header("Location: /meals.php");
	}


	$training_id = $_GET['training_id'];
	$sql = 'DELETE FROM trainings WHERE training_id=:training_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':training_id' => $training_id])) {
  	header("Location: /trainings.php");
	}


	$meal_id = $_GET['meal_id'];
	$sql = 'DELETE FROM meals WHERE meal_id=:meal_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':meal_id' => $meal_id])) {
  	header("Location: /daily_meals.php");
	}


	$recept_id = $_GET['recept_id'];
	$sql = 'DELETE FROM recepts WHERE recept_id=:recept_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':recept_id' => $recept_id])) {
  	header("Location: /recepts.php");
	}