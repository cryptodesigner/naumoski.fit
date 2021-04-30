<?php
	include("config.php");
 	require 'db.php';
  	include_once 'db.php';

  	$schedule_id = $_GET['schedule_id'];
	$sql = 'DELETE FROM schedules WHERE schedule_id=:schedule_id';
	$statement = $connection->prepare($sql);
	if ($statement->execute([':schedule_id' => $schedule_id])) {
  	header("Location: /client_schedule.php");
	}