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
    <?php
      require "../../resources/general/connect.php";
      // Check if the chall_bitstring is up to date aka long enough
      $request = $connected->query("SELECT MAX(chall_bitstring) FROM `users`");
      $max_bit_str_size = strlen($request->fetch()[0]);
      $request = $connected->prepare("SELECT chall_bitstring FROM `users` WHERE username = :user");
      $request->execute(array(":user"=>$_SESSION['username']));
      $chall_bitstring = $request->fetch()[0];
      $size = strlen($chall_bitstring);
      for ($i=$size; $i < $max_bit_str_size; $i++)
      {
        $chall_bitstring .= '0';
      }
      if ($size < $max_bit_str_size)
      { // Update the challenge bit string for the user since it was too short
        $request = $connected->prepare("UPDATE `users` SET chall_bitstring = \"$chall_bitstring\" WHERE username = :user");
        $request->execute(array(":user"=>$_SESSION['username']));
      }

      // Grab the challenges
      $request = $connected->prepare("SELECT `admins`.img, `challenges`.* FROM `admins`, `challenges` WHERE `admins`.userid = `challenges`.creater_id");
      $request->execute();
      //print_r($request->fetchAll());
      $i = 1;
      while ($challenge = $request->fetch())
      {
        echo "<div class=\"challenge\">
                <p class=\"left clear_left\">Challenge $i</p>
                <img class=\"left fade\" alt=\"Challenge $i\" src=\"" . $challenge['img'] . "\" onclick = \"location.href='" . $challenge['file_path'] . "'\"/>
                <div class=\"topic\">TOPIC $i</div>";
        if ($challenge['creater_id'] == 3)
        {
          echo "<audio>
                  <source src=\"../../resources/challenge_home/heres-johnny_1.mp3\" type=\"audio/mpeg\">
                </audio></div>";
        }
        else
        {
          echo "</div>";
        }
        $i++;
      }
      $connected = NULL;
    ?>
  	  
  </div>
</div>

<script>
  window.onload = function() {
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
<script type="text/javascript" src="../../resources/general/cookies_enabled.js"></script>
<?php
  require "../../resources/general/footer.html"
?>