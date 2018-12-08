<?php require '../resources/general/start.php';
if ($_SESSION["user-type"] != "admin")
{
  header("Location: http://" . $_SERVER["SERVER_NAME"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="descripton" content="Admin Home Page">
	<meta name="author" content="Wilson">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HACK&amp;/ Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="../resources/general/general_content.css">
	<link rel="stylesheet" type="text/css" href="../resources/admin_home/admin_home.css">
	<script type="text/javascript" src="../resources/general/footer.js"></script>
</head>

<?php
require'../resources/general/logo_' . $_SESSION['user-type'] . '.html';
?>

<body>
	<nav>
		<ul id="naver">
			<li class="nav right" id = "nav_right"><a class="right nav" href="../resources/general/logout.php">Logout</a></li>
		</ul>
	</nav>
	<h1>Admin Home Page</h1>
	<div class="w_container">
		<div class="w_left">
			<a href="tutorial_creation_page/tutor_create.php"><p>Tutorial Creation</p></a>
			<a href="tutorial_deletion_page/tutorial_deletion_page.php"><p>Tutorial Deletion</p></a>
			<a href="../user/tutorials/tutorial_landing_page.php"><p>Tutorials</p></a>
			<a href="meta_tutorial/meta_tutorial.html"><p>MetaTutorial</p></a>
		</div>
		<div class="w_right">
			<a href="challenge_creation_page/challenge_creation.php"><p>Challenge Creation</p></a>
			<a href="challenge_deletion_page/challenge_deletion_page.php"><p>Challenge Deletion</p></a>
			<a href="../user/challenges/challenge_landing_page.php"><p>Challenges</p></a>
			<a href="../user/scoreboard/scoreboard.php"><p>Scoreboard</p></a>
		</div>
	</div>
	
<?php require '../resources/general/footer.html'; ?>