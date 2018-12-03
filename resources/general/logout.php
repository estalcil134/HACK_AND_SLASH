<?php
session_start();
// To Logout, destroy the session and cookie if they are logged in
if (isset($_SESSION['username']))
{
  session_destroy();
  setcookie("PHPSESSID", "", -1, "/");
}
// Redirect to login page
header('Location:' . 'http://' . $_SERVER['SERVER_NAME'] . '/index.php');
exit();
?>