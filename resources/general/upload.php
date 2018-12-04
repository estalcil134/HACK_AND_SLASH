<?php
session_start();
// If the folder for all the files doesn't exist, make it
if (!file_exists("../../admin/challenge_creation_page/uploaded_docs") && !mkdir("../../admin/challenge_creation_page/uploaded_docs", 0700))
{ // Print this if error occurred
  echo "Error occurred when making server upload folder";
}
// If admin's folder doesn't exist, make the folder.
if(!file_exists("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username']) && !mkdir("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username'], 0700))
{ // Print this if error occurred
  echo "Error occurred when making admin directory";
}
if(isset($_POST['submit']) && isset($_POST['challenge']) && isset($_POST['flag']) && isset($_POST['description'])) {
  // If all the required fields are set execute all of this:
  $fileDestination = ""; // Challenge file location that user will download
  $file_path = "../../user/challenges/{$_POST['challenge']}.txt";  // file path for the .txt used for ajax
  // Check if the challenge already exists by challenge name. If it does, then we don't submit it
  require "connect.php";
  $result = $connected->query("SELECT file_path FROM `challenges` WHERE creater_id = (SELECT userid FROM `users` WHERE username = '" . $_SESSION['username'] . "') AND file_path = '$file_path'");
  if (!$result->fetch()[0])
  {
    // Upload the file first
    if (is_uploaded_file($_FILES['myFile']['tmp_name']))
    { // If there was a file uploaded, then execute this block
      $file = $_FILES['myFile'];
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];
      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('html','htm');
      if(in_array($fileActualExt,$allowed)) {
        if($fileError === 0) {
          if($fileSize < 10000000) {
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination .= '../../admin/challenge_creation_page/uploaded_docs/' . $_SESSION['username'] .'/'.$fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
          }
          $error_type = "1";
        }
        $error_type = "2";
      }
      $error_type = "3";
    }
    // Then create the text file that will be outputted in the challenge landing page.
    $challenge = fopen("../../user/challenges/{$_POST['challenge']}.txt", "w");
    fwrite($challenge, "<h2>{$_POST['challenge']}</h2><p>{$_POST['description']}</p>");
    if ($fileDestination != '')
    { // If a file was submitted, add an anchor tag to that file we are writting into
      fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\">File</a>");
    }
    fclose($challenge);
    // Add the challenge to the database
    $request = $connected->prepare("INSERT INTO `challenges` (creater_id, name, file_path, flags) VALUES ((SELECT userid FROM `users` WHERE username = :u), :c_n, :f_p, :flag)");
    $request->execute(array(':u'=>$_SESSION['username'], ':c_n'=>$_POST['challenge'], ':f_p'=>$file_path, ':flag'=>$_POST['flag']));
  }
  else
  { // If the challenge already exists, redirect
    header("Location: ". substr("{$_SERVER['HTTP_REFERER']}", 0, strpos("{$_SERVER['HTTP_REFERER']}",'?=')) . "?=4");
  }
  $connected = NULL;
}
// Redirect back to the challenge creation page if successful
header("Location: " . substr("{$_SERVER['HTTP_REFERER']}", 0, strpos("{$_SERVER['HTTP_REFERER']}",'?=')) . "?=5");
exit();
?>