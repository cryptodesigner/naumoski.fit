<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$tehnika_id = $_GET['tehnika_id'];
	$sql = 'DELETE FROM tehniki WHERE tehnika_id=:tehnika_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':tehnika_id' => $tehnika_id])) {
  	header("Location: /techniques.php");
	}