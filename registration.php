<?php
session_start();
if (isset($_SESSION['user-type']) && isset($_SESSION['username']))
{
  header("Location: http://" . $_SERVER['SERVER_NAME'] . "/" . $_SESSION['user-type'] . "/" . $_SESSION['user-type'] . "_home_page.php");
}
if (isset($_POST['username']))
{
  /*header("Location: http://" . $_SERVER['SERVER_NAME'] . "/index.php");
  session_destroy();
  setcookie("PHPSESSID", "", -1, "/");*/
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Arron">
  <title>HACK&/</title>
  <link rel="stylesheet" href="./resources/index/index.css">
  <script type="text/javascript" src="resources/general/cookies_enabled.js"></script>
</head>
<body>
  <h1>Welcome to HACK&/</h1>
  <p class="signin">Please Create an Account</p>
  <form action="./" method="post" onsubmit="">
  	<input type="text" name="Username" required>
  	<input type="text" name="Password" required>
  	<input type="text" name="password" required>
  	<input type="submit" value="Submit">
  </form>
  <p class="noaccount"><a href = "index.php">Already have an account? Login here!</a></p>
  <p class="about"><a href = "about/about.html">About</a></p>
</body>
</html>