<!DOCTYPE html>
<?php
function exists_and_correct($user, $pass, $pdo_obj)
{
  // Checks both users and admins table in mysql db to see if 
  // 1) There is a user with that username
  // 2) If the password matches
  // Returns an array of [#, user/admin] depending on what happens and whether they are a user or admin
  // Returns 0 if it works out
  // Returns 1 if it is the wrong password
  // Returns 2 if it the user doesn't exist
  $result = [2, 'user'];  // Default is doesn't exist and is user

  //Look through users first
  $users = $pdo_obj->query("SELECT username, hashed_password from `users`");
  foreach ($users as $u)
  {
  	if ($user === $u['username'])
  	{
  	  if ($pass === $u['hashed_password'])
  	  { // Password matches
  	  	$result[0] = 0;
  	  	return $result;
  	  }
  	  else
  	  { // Password doesn't match
  	  	$result[0] = 1;
  	  	return $result;
  	  }
  	}
  }
  //Look through admins
  $admins = $pdo_obj->query("SELECT username, hashed_password from `admins`");
  foreach ($admins as $a)
  {
  	if ($user === $a['username'])
  	{
  	  if ($pass === $a['hashed_password'])
  	  { // Password matches
  	  	$result[0] = 0;
  	  	$result[1] = "admin";
  	  	return $result;
  	  }
  	  else
  	  { // Password doesn't match
  	  	$result[0] = 1;
  	  	$result[1] = "admin";
  	  	return $result;
  	  }
  	}
  }
  return $result;
}


// Grab username and password
$user_name = $_POST['username'];
$pass = $_POST['password'];

// Check if user is in database
require "connect.php";
//Debugging process
/*$hi = exists_and_correct($user_name, $pass, $connected);
echo $hi[0] . " " . $hi[1];*/
$code = exists_and_correct($user_name, $pass, $connected);
$connect = NULL; // Close connection

if ($code[0] === 0)
{ // If user exists, do this:
  $loc = "$code[1]";
  // Create user cookie info here storing username and tutstring and challstring
  setcookie("username", $user_name, time() + (86400*30), "/","",FALSE,TRUE); // 30 day cookie
  $loc = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $loc . '/' . $loc . '_home_page.html';
}
else if ($code[0] === 1)
{ // If user's password is incorrect, do this:
  $loc = "http://" . $_SERVER['SERVER_NAME'] . "/index.html?" . ".";
}
else if  ($code[0] === 2)
{ // If account doesn't exist, do this:
  $loc = "http://" . $_SERVER['SERVER_NAME'] . "/index.html?" . "-";
}

// Redirect based on what $loc was set equal to based on all three possible login results
echo "<html><script>window.location = '$loc' </script></html>";
?>
<html>
</html>