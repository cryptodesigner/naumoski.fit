<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$meal_id = $_GET['meal_id'];
	$sql = 'DELETE FROM meals WHERE meal_id=:meal_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':meal_id' => $meal_id])) {
  	header("Location: /daily_meals.php");
	}