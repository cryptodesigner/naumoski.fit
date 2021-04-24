<?php
  session_start();
  include("config.php");
  require 'db.php';
  include_once 'db.php';
  $title = 'Upload Photo';
  $childView = 'views/_upload_photo.php';
  include('layout_client.php');



  $userID = $_SESSION["client_id"];

  $folderPath = "/uploads/$userID";
  // Check to see if directory already exists
  $exist = is_dir($folderPath);

  // If directory doesn't exist, create directory
  if(!$exist) {
  mkdir("$folderPath");
  chmod("$folderPath", 0755);
  }
  else { echo "Folder already exists"; }

  // Set initial/temporary upload location
  //   temp_uploads must have proper read/write permissions (755 or 777)
  $target_path = "/uploads/temp_uploads/";

  // Append the name of the uploaded file to the temp directory
  $target_path .= basename( $_FILES['uploadedfile']['name']);

  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
  $filename = basename( $_FILES['uploadedfile']['name']);

  // Location where temporary file is being stored
  $temp_location = '/uploads/temp_uploads/' . basename( $_FILES['uploadedfile']['name']);

  // Final destination where file will be located
  $destination = "/uploads/$folderPath/$filename";

  rename($temp_location, $destination);
  }
  
  


// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }
?>