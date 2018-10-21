<?php
session_start();
if (!isset($_SESSION["username"]))
{
  header("Location: http://" . $_SERVER["SERVER_NAME"] . "/index.php");
}
?>