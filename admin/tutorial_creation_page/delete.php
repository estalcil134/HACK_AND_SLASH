<?php
  session_start();
  unlink('uploaded_docs/'.$_SESSION['username'].'/'.$_POST['filename']);
  header("Location:index.php");
?>