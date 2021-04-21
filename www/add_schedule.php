<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Schedule';
  $childView = 'views/_add_schedule.php';
  include('layout_client.php');



  $message = '';
  if (isset ($_POST['stanuvanje']) && isset ($_POST['legnuvanje']) && isset ($_POST['rabota']) && isset ($_POST['pauzi']) && isset ($_POST['trening']) && isset ($_POST['cardio']) && isset ($_POST['description'])) {
  	$clients_client_id = $_SESSION["client_id"];
  	$stanuvanje = $_POST['stanuvanje'];
  	$legnuvanje = $_POST['legnuvanje'];
  	$rabota = $_POST['rabota'];
  	$pauzi = $_POST['pauzi'];
    $trening = $_POST['trening'];
    $cardio = $_POST['cardio'];
    $description = $_POST['description'];
   
  	$sql = 'INSERT INTO schedules(clients_client_id, stanuvanje, legnuvanje, rabota, pauzi, trening, cardio, description) VALUES(:clients_client_id, :stanuvanje, :legnuvanje, :rabota, :pauzi, :trening, :cardio, :description)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':clients_client_id' => $clients_client_id, ':stanuvanje' => $stanuvanje, ':legnuvanje' => $legnuvanje, ':rabota' => $rabota, ':pauzi' => $pauzi, ':trening' => $trening, ':cardio' => $cardio, ':description' => $description])) {
  	  $message = 'Schedule Added Successfully';
  	}
  }
  
?>