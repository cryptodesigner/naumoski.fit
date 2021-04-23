<?php
	session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Daily Routine';
  $childView = 'views/_add_daily_routine.php';
  include('layout_manager.php');

  $json = file_get_contents('php://input');
  $data = (int)json_decode($json);

	$sql = "SELECT * FROM tehniki WHERE tehnika_id = :'$data.';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	$tehniki = $statement->fetchAll(PDO::FETCH_OBJ);
?>