<?php
$error_type='';
  session_start();
  $sess = $_SESSION['username'];
    echo($sess);
    if(!is_dir("uploaded_docs/$sess"))
    {
      mkdir("uploaded_docs/$sess", 0700,true);
    }
    $num_file = count(scandir("uploaded_docs/".$_SESSION['username'])) - 2;
    if($num_file < 21)
    {
    if(isset($_POST['submit'])) {
      $file = $_FILES['file'];

      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];
      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('html','htm');
      if(in_array($fileActualExt,$allowed)) {
        if($fileError === 0) {
          if($fileSize < 10000000) {
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'uploaded_docs/'.$_SESSION['username'].'/'.$fileName;
            if(move_uploaded_file($fileTmpName,$fileDestination)) {
              $error_type = "1";
            }
          }
          else
          {
            $error_type = "2";
          }
        }
        else
        {
          $error_type = "3";
        }
      }
      else
      {
        $error_type = "4";
      }
    }
    }
  foreach ($_POST as $key => $value) {
    unset($_POST[$key]);
  }
if ($error_type)
{
  header("Location: index.php?=$error_type");
}
else
{
  header("Location: index.php");
}
?>