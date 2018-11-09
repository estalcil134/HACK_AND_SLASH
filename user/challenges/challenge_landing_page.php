<?php
require "../../resources/general/start.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Arron">
	<meta name="description" content="List of All Challenges">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Challenges</title>
  <link rel="stylesheet" type="text/css" href="../../resources/general/general_content.css">
  <link rel="stylesheet" type="text/css" href="../../resources/tutorial_home/tutorial_home.css">
  <link rel="stylesheet" href="../../resources/challenge_home/challenge_landing_page.css" type="text/css">
</head>

<?php
require'../../resources/general/logo_' . $_SESSION['user-type'] . '.html';
if ($_SESSION['user-type'] === "admin")
{
  require '../../resources/general/navbar_admin.html';
}
require '../../resources/general/navbar_user.html';
?>
  <div id="body">
    <div id="container">
    	<div class="challenge">
    		<p class="left clear_left">Challenge 1:</p>
    		<!-- Change src depending on completed or not completed challenge -->
    		<img class="left fade" alt="Challenge 1" src="../../resources/challenge_home/new_johnny.gif" onclick="location.href='https://www.youtube.com/watch?v=Bt5rCgHN1Gc'"/>
        <div class="topic">TOPIC 1</div>
        <audio>
          <source src="../../resources/challenge_home/heres-johnny_1.mp3" type="audio/mpeg">
        </audio>
    	</div>
    	<div class="challenge">
    		<p class="left clear_left">Challenge 2:</p>
    		<img class="left fade" alt="Challenge 2" src="../../resources/challenge_home/Webp.net-resizeimage.jpg" onclick="location.href='https://www.youtube.com/watch?v=Bt5rCgHN1Gc'"/>
        <div class="topic">TOPIC 2</div>
    	</div>
    	<div class="challenge">
    		<p class="left clear_left">Challenge 3:</p>
        <img class="left fade" alt="Challenge 3" src="../../resources/challenge_home/Webp.net-resizeimage.jpg" onclick="location.href='https://www.youtube.com/watch?v=Bt5rCgHN1Gc'"/>
        <div class="topic">TOPIC 3</div>
    	</div>
    	<div class="challenge">
    		<p class="left clear_left">Challenge 4:</p>
    		<img class="left fade" alt="Challenge 4" src="../../resources/challenge_home/Webp.net-resizeimage.jpg" onclick="location.href='https://www.youtube.com/watch?v=Bt5rCgHN1Gc'"/>
        <div class="topic">TOPIC 4</div>
    	</div>
    </div>
  </div>

<script>
  window.onload = function() {
    console.log("hi");
    var audio = document.getElementsByTagName("audio")[0];
    var johnny = document.getElementsByTagName("img")[1];
    johnny.addEventListener("mouseover", function(){
      audio.play();
      /*audio.setAttribute("loop", "true");*/
    });
    johnny.addEventListener("mouseout", function(){
      /*audio.setAttribute("loop", "false");*/
      audio.pause();
      audio.currentTime=0;
    });
  };
</script>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="resources/general/cookies_enabled.js"></script>
<?php
  require "../../resources/general/footer.html"
?>