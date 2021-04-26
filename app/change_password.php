<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Change Password';
  $childView = 'views/_change_password.php';
  include('layout_client.php');

  $client_id = $_SESSION['client_id'];
  $sql = 'SELECT * FROM clients WHERE client_id = :client_id';
  $statement = $connection->prepare($sql);
  $statement->execute([':client_id' => $client_id ]);
  $person = $statement->fetch(PDO::FETCH_OBJ);

  $message = '';
  if (isset ($_POST['newpass'])) {
    $newpass = $_POST['newpass'];
    $sql = 'UPDATE clients SET password = :newpass WHERE client_id = :client_id';
    $statement = $connection->prepare($sql);

    if ($statement->execute([':newpass' => $newpass, ':client_id' => $client_id])) {
      $message = 'Password Changed Successfully';
    }
  }

?>