<?php
  session_start();
  if(!file_exists("/".$_SESSION['username']))
  {
    mkdir("uploaded_docs/".$_SESSION['username'], 0700);
  }