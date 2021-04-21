<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Daily Routine';
  $childView = 'views/_add_daily_routine.php';
  include('layout_manager.php');
  
//   $message = '';

//   function wh_log($log_msg)
// {
//     $log_filename = "log";
//     if (!file_exists($log_filename)) 
//     {
//         // create directory/folder uploads.
//         mkdir($log_filename, 0777, true);
//     }
//     $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
//     // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
//     file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
// } 
// // call to function

// $data = json_decode(file_get_contents('php://input'), true);
// $decoded = json_decode($data)

// wh_log($decoded);
?>