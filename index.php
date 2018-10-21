<?php
$loc = "";
session_start();
if (isset($_SESSION['user-type']) && isset($_SESSION['username']))
{
  header("Location: http://" . $_SERVER['SERVER_NAME'] . "/" . $_SESSION['user-type'] . "/" . $_SESSION['user-type'] . "_home_page.php");
}
if (isset($_POST["username"]))
{ // If there was a username entered, do login procedure
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
    $request = $pdo_obj->prepare("SELECT username, hashed_password FROM `users` WHERE username = :username");
    if (($request->execute(array(':username' => $user)) === true) && $request->rowCount())
    {
      /*echo "user pass check";*/
      $user = $request->fetch();
      // Check password
  	  if ($pass === $user['hashed_password'])
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
    //Look through admins
    $request = $pdo_obj->prepare("SELECT username, hashed_password FROM `admins` WHERE username = :username");
    if (($request->execute(array(":username"=>$user)) === true) && $request->rowCount())
    {
      $admin = $request->fetch();
      /*echo 'admin pass check';*/
      if ($pass === $admin['hashed_password'])
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
/*    echo "return correct";*/
    }
    
  // If no users matched it and no admins matche it, so no account exists and just return default $result
  return $result;
  }


  // Grab username and password
  $user_name = $_POST['username'];
  $pass = $_POST['password'];

  // Check if user is in database
  require "connect.php";
  //Debugging process*/
  /*$hi = exists_and_correct($user_name, $pass, $connected);
  echo $hi[0] . " " . $hi[1];*/
  $code = exists_and_correct($user_name, $pass, $connected);
  $connect = NULL; // Close connection
  if ($code[0] === 0)
  { // If user exists, do this:
    $loc = "$code[1]";
    // Create user session info here storing username and tutstring and challstring
    //setcookie("username", $user_name, time() + (86400*30), "/","",FALSE,TRUE); // 30 day cookie
    $_SESSION['user-type'] = $loc;
    $_SESSION['username'] = $user_name;
    // Redirect
    header("Location: http://" . $_SERVER['SERVER_NAME'] . '/' . $loc . '/' . $loc . '_home_page.php');
  }
  else if ($code[0] === 1)
  { // If user's password is incorrect, do this:
    $loc="Incorrect Username or Password";
  }
  else if  ($code[0] === 2)
  { // If account doesn't exist, do this:
    $loc = "Account Does Not Exist";
  }
  // Redirect based on what $loc was set equal to based on all three possible login results
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<meta name = "description" content = "Log In Page">
	<title>HACK&/ Log In</title>
	<link rel="stylesheet" href="./resources/index/index.css">
	<script type="text/javascript" src="resources/general/cookies_enabled.js"></script>
</head>

<body>
	<h1>Welcome to HACK&/</h1>
	<p class="signin">Please Sign In</p>
	<form action="./" method="post" onsubmit="validate(this);">
  		<table>
			<tr><td><label for="username">Username: </label></td><td><input id="username" type="text" name="username" maxlength="20" required></td></tr>
			<tr><td><label for="password">Password: </label></td><td><input id="password" type="password" name="password" required></td></tr>
		</table>
  		<input type="submit" value="Submit">
      <?php
        if($loc !== "")
        {
          echo $loc;
        }
      ?>
	</form>

	<p class="noaccount"><a href = "registration.php">No Account? No Problem!</a></p>

	<p class="about"><a href = "about/about.html">About</a></p>

</body>
</html>