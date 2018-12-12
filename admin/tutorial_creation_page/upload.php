<?php
  //this php uploads html files uploaded by the admin and puts them into that admin's specific folder

  //this is the error type to display to the admin if file upload goes wrong
  $error_type='';
  //start the session
  session_start();
  //the admin username
  $sess = $_SESSION['username'];
  //if there is no directory to upload into then create the directory based on that admin's unique username
  if(!is_dir("uploaded_docs/$sess"))
  {
    mkdir("uploaded_docs/$sess", 0700,true);
  }
  
  $num_file = count(scandir("uploaded_docs/".$_SESSION['username'])) - 2; //number of files within that admin's folder

  if($num_file < 21) //if the number of files already in the admin's folder is less than 21(LIMITS TUTORIAL LENGTH TO 20 PAGES)
  {
    if(isset($_POST['submit'])) //if there is a file to submit
    {
      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];
      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $fileString = str_replace (" ","_",$fileName);
      $allowed = array('html','htm');
      
      if(in_array($fileActualExt,$allowed)) //ensures that the file extansion is an html and allowed to be uploaded (sanitization)
      {
        if($fileError === 0) //ensures there was no file upload error
        {
          if($fileSize < 10000000) //ensures the file size isn;t too large
          {
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'uploaded_docs/'.$_SESSION['username'].'/'.$fileString;
            if(move_uploaded_file($fileTmpName,$fileDestination)) //actually move the file they uploaded into the folder created for the admin
            {
              $error_type = "1"; //correctly moved the file into the necessary folder
            }
          }
          else
          {
            $error_type = "2"; //error in having too large a file
          }
        }
        else
        {
          $error_type = "3"; //error in having an upload file error
        }
      }
      else
      {
        $error_type = "4"; //error in the file type
      }
    }
  }
  //unset any posts so uploads don't propogate
  foreach ($_POST as $key => $value) 
  {
    unset($_POST[$key]);
  }
  //redirect the page to the tutorial creation pagewith the correct message to display to admin on upload status
  if($error_type)
  {
    header("Location: tutor_create.php?=$error_type");
  }
  else
  {
    header("Location: tutor_create.php");
  }
?>