<?php
require "../resources/general/start.php";
if ($_SESSION["user-type"] != "user")
{
  // CONSIDER USING THIS FOR AUTHENTICATION echo $_SERVER['PHP_AUTH_USER'] . $_SERVER['PHP_AUTH_USER'] . $_SERVER['PHP_AUTH_TYPE'];
  //header("Location: http://" . $_SERVER["SERVER_NAME"] . )
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="descripton" content="User Home Page">
	<meta name="author" content="Arron">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HACK&/</title>
	<link rel="stylesheet" type="text/css" href="../resources/general/general_content.css">
    <link rel="stylesheet" type="text/css" href="../resources/user_home/general_content.css">
    <script type="text/javascript" src="../resources/general/footer.js"></script>
    <script type="text/javascript" src="../resources/general/cookies_enabled.js"></script>
</head>

<?php 
  require "../resources/general/logo_user.html";
  require "../resources/general/navbar_user.html";
?>

  <div id="body">
    <div id="container">
      <div class="left option" onclick="location.href='./tutorials/tutorial_landing_page.php'">
        <h4>TUTORIALS</h4>
        <img alt="Tutorials Page Image" src="https://s3.amazonaws.com/coderbytestaticimages/homepage_icons/_right1_edit.jpg"/>
      </div>
      <div class="left option" onclick="location.href='./challenges/challenge_landing_page.html'">
        <h4>CHALLENGES</h4>
        <img alt="Challenges Page Image" src="https://dmcommunity.files.wordpress.com/2014/09/challenge.jpg?w=112&h=150">
      </div>
      <div class="left option" onclick="location.href='./scoreboard/scoreboard.html'">
        <h4>SCOREBOARD</h4>
        <img alt="Scoreboard Page Image" src="http://i2.wp.com/www.maplestory2training.com/wp-content/uploads/maplestory-2-mano.png?resize=550%2C300">
      </div>
    </div>
  </div>

  <?php
    require "../resources/general/footer.html";
  ?>