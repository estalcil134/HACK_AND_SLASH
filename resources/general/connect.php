<?php
function clean_input($data)
{ // Clean input function by getting rid of special html characters and other
  // special characters that we should ignore
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Login Credentials
$servername = "hackand.slash";
$username = "root";
$password = "websys@rpi";
$dbname = "hack_and_slash";

try {
  /*Try connecting*/
  $connected = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
  $connected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  /*Throw error*/
}
catch (PDOException $e)
{
  /*Error if connection failed*/
  echo "Connection failed: " . $e->getMessage();
}
?>
