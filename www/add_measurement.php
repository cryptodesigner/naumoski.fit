<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Measurement';
  $childView = 'views/_add_measurement.php';
  include('layout_client.php');



  $message = '';
  if (isset ($_POST['tezina']) && isset ($_POST['vrat']) && isset ($_POST['gradi']) && isset ($_POST['pod_gradi']) && isset ($_POST['papok']) && isset ($_POST['kolk']) && isset ($_POST['raka']) && isset ($_POST['but'])) {
  	$clients_client_id = $_SESSION["client_id"];
  	$tezina = $_POST['tezina'];
  	$vrat = $_POST['vrat'];
  	$gradi = $_POST['gradi'];
  	$pod_gradi = $_POST['pod_gradi'];
    $papok = $_POST['papok'];
    $kolk = $_POST['kolk'];
    $raka = $_POST['raka'];
    $but = $_POST['but'];
    $cur_date = date("Y-m-d");
  	$sql = 'INSERT INTO measurements(clients_client_id, tezina, vrat, gradi, pod_gradi, papok, kolk, raka, but, cur_date) VALUES(:clients_client_id, :tezina, :vrat, :gradi, :pod_gradi, :papok, :kolk, :raka, :but, :cur_date)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':clients_client_id' => $clients_client_id, ':tezina' => $tezina, ':vrat' => $vrat, ':gradi' => $gradi, ':pod_gradi' => $pod_gradi, ':papok' => $papok, ':kolk' => $kolk, ':raka' => $raka, ':but' => $but, ':cur_date' => $cur_date])) {
  	  $message = 'Measurement Added Successfully';
  	}
  }
  
?>