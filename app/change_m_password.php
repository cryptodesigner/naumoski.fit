<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Change Password';
  $childView = 'views/_change_m_password.php';
  include('layout_manager.php');

  $manager_id = $_SESSION['manager_id'];
  $sql = 'SELECT * FROM managers WHERE manager_id = :manager_id';
  $statement = $connection->prepare($sql);
  $statement->execute([':manager_id' => $manager_id ]);
  $person = $statement->fetch(PDO::FETCH_OBJ);

  $message = '';
  if (isset ($_POST['newpass'])) {
    $newpass = $_POST['newpass'];
    $newpass = md5($newpass);
    $sql = 'UPDATE managers SET password = :newpass WHERE manager_id = :manager_id';
    $statement = $connection->prepare($sql);

    if ($statement->execute([':newpass' => $newpass, ':manager_id' => $manager_id])) {
      $message = 'Password Changed Successfully';
    }
  }

?>