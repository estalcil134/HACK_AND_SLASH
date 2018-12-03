<?php
session_start();
if (!isset($_SESSION["username"]))
{ // Redirect to login if user is not logged into an account
  header("Location: http://" . $_SERVER["SERVER_NAME"] . "/index.php");
}
?>