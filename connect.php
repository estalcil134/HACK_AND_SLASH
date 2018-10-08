<?php
$servername = "hack.and.slash";
$username = "root";
$password = "insertpasswordhere";
$dbname = "hack_and_slash";

try {
  $connected = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
  $connected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
}
catch (PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
}
?>