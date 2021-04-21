<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Basics';
  $childView = 'views/_add_basics.php';
  include('layout_client.php');



  $message = '';
  if (isset ($_POST['pol']) && isset ($_POST['godini']) && isset ($_POST['visina']) && isset ($_POST['tezina']) && isset ($_POST['alergija']) && isset ($_POST['netolerantnost']) && isset ($_POST['odbivnost']) && isset ($_POST['zaboluvanja']) && isset ($_POST['iskustvo'])) {
  	$clients_client_id = $_SESSION["client_id"];
  	$pol = $_POST['pol'];
  	$godini = $_POST['godini'];
  	$visina = $_POST['visina'];
  	$tezina = $_POST['tezina'];
    $alergija = $_POST['alergija'];
    $netolerantnost = $_POST['netolerantnost'];
    $odbivnost = $_POST['odbivnost'];
    $zaboluvanja = $_POST['zaboluvanja'];
    $iskustvo = $_POST['iskustvo'];
  	$sql = 'INSERT INTO basics(clients_client_id, pol, godini, visina, tezina, alergija, netolerantnost, odbivnost, zaboluvanja, iskustvo) VALUES(:clients_client_id, :pol, :godini, :visina, :tezina, :alergija, :netolerantnost, :odbivnost, :zaboluvanja, :iskustvo)';
  	$statement = $connection->prepare($sql);
  	if ($statement->execute([':clients_client_id' => $clients_client_id, ':pol' => $pol, ':godini' => $godini, ':visina' => $visina, ':tezina' => $tezina, ':alergija' => $alergija, ':netolerantnost' => $netolerantnost, ':odbivnost' => $odbivnost, ':zaboluvanja' => $zaboluvanja, ':iskustvo' => $iskustvo])) {
  	  $message = 'Basics Added Successfully';
  	}
  }
  
?>