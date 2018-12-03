<?php
//Login Credentials
$servername = "hackandslash";
$username = "nebby";
$password = "pewpew";
$dbname = "hack_and_slash";

try {
  /*Try connecting*/
  $connected = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
  $connected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  /*Throw error*/
  /*echo "Connected successfully";*/
}
catch (PDOException $e)
{
  /*Error if connection failed*/
  echo "Connection failed: " . $e->getMessage();
}
?>