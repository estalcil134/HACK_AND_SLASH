<?php
session_start();
// To Logout, destroy the session if they are logged in
if (isset($_SESSION['username']))
{
  session_destroy();
  setcookie("PHPSESSID", "", -1, "/");
}
header('Location:' . 'http://' . $_SERVER['SERVER_NAME'] . '/index.php');
?>