<?php
	require '../../resources/general/start.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hack&amp;/ Tutorial</title>
  	<link rel="stylesheet" type="text/css" href="/resources/general/general_content.css">
  	<script type="text/javascript" src="/resources/general/footer.js"></script>
	<link rel="stylesheet" type="text/css" href="title.css">
</head>
<!--this is the html for the logo and user username-->
<body onload="disappearButton()">
  <header>
    <!--Logo and link to go back to the home-->
    <a id="home" class="left bold" href=<?php echo "\"http://" . $_SERVER['SERVER_NAME'] . '/' . $_SESSION['user-type'] . '/' . $_SESSION['user-type'] . "_home_page.php\""?>>
      <img id = "logo" src="/resources/general/LOGO.png" alt="HACK AND SLASH LOGO">
    </a>
    <!--the profile picture of the person, and their username-->
    <div id="user_info" class="right">
      <div id="profile_pic_user" alt="user profile picture">
        </div>
      <?php
        $out = "<p id = 'username' class='right'>" . $_SESSION['username'] . "</p>";
        echo  $out;
      ?>
    </div>
   </header>



	<h1>Tutorial</h1>
	<form action="#" method="POST">
		<fieldset>
			<legend>Tutorial</legend>
			<label>Title: </label>
			<input type="text" name="title" value="Tutorial Title" class="title">
			<input id="submit" type="submit" name="submit" value="Submit">
		</fieldset>
	</form>

    <!--the html for the footer of the webpage-->
    <!--Go to about webpage-->
    <footer>
      <a id = "about" href="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . '/about/about.html'?>">About Page</a>
	  </footer>
    <!--Button to scroll back to the top-->
    <button onclick="topFunction()" id="topBtn" class = "right" title="Go to top">Back to Top</button>
<?php $_POST = array(); ?>
</body>
</html>