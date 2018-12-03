<?php
require "../../resources/general/start.php";
$err = False;
if (isset($_POST['flag']) && isset($_POST['chall_num']) && isset($_POST['chall_path']))
{ // If they submitted a flag do this:
  require '../../resources/general/connect.php';
  // Grab the flag for that challenge from the database
  $request = $connected->prepare("SELECT flags FROM `challenges` WHERE file_path = :file");
  $request->execute(array(":file"=>clean_input($_POST['chall_path'])));
  $flag_point = $request->fetch();
  if ($flag_point[0] === clean_input($_POST['flag']))
  { // If the flag is correct, update their bitstring and their points on the database
    $request = $connected->prepare("SELECT chall_bitstring, score FROM `users` WHERE username = :user");
    $request->execute(array(":user"=>$_SESSION['username']));
    $result = $request->fetch();
    // echo "<br/>" . $result[0][clean_input($_POST['chall_num'])] . "<br/>";
    if ($result[0][clean_input($_POST['chall_num'])] == '0')
    { // To prevent users from reenabling past challenges and resubmitting check that the challenge bit string for that
      // challenge was not done yet akak the bit is 0
      $result[0][clean_input($_POST['chall_num'])] = '1'; // Mark that challenge as complete
      // Update the database
      $request = $connected->prepare("UPDATE `users` SET chall_bitstring = :new, score = :score WHERE username = :user");
      $request->execute(array(":new"=>$result[0], ":score"=>$result[1]+100, ":user"=>$_SESSION['username']));
    }
  }
  else
  { // Otherwise, their flag is incorrect so set the error to true
    $err = True;
  }
}
?>
<!DOCTYPE html>
<html oncontextmenu="return false">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Arron">
	<meta name="description" content="List of All Challenges">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hack&amp;/ Challenges</title>
  <link rel="stylesheet" type="text/css" href="../../resources/general/general_content.css">
  <link rel="stylesheet" type="text/css" href="../../resources/tutorial_home/tutorial_home.css">
  <link rel="stylesheet" href="../../resources/challenge_home/challenge_landing_page.css" type="text/css">
  <script type="text/javascript" src="../../resources/general/footer.js"></script>
</head>

<?php
// Navigation Bar
require'../../resources/general/logo_' . $_SESSION['user-type'] . '.html';
if ($_SESSION['user-type'] === "admin")
{
  require '../../resources/general/navbar_admin.html';
}
require '../../resources/general/navbar_user.html';
?>
<div id="body">
  <div id="cover"><!-- Used to shadow out the background --></div>
  <div class="pop">
    <!-- This is the popup form -->
    <div id="chall_info">
      <!-- Put Challenge Information here -->
    </div>
    <form action="./challenge_landing_page.php" method="post" accept-charset="UTF-8">
      <label class="left" for="flag">Flag:</label><br/>
      <input id="flag" name="flag" type="text" required>
      <input id="chall_num" type="hidden" name="chall_num">
      <input id="chall_path" type="hidden" name="chall_path">
      <input type="submit" value="submit">
    </form>
    <button type="button" id="close" onclick="close_pop();">Close</button>
  </div>
  <div id="container">
    <span><?php if ($err) {echo "INCORRECT FLAG!"; $err=False;} ?></span>
    <?php
      require "../../resources/general/connect.php";
      // Check if the chall_bitstring is up to date aka long enough
      $request = $connected->query("SELECT COUNT(num) FROM `challenges`"); // Get the total number of challenges first
      $max_bit_str_size = $request->fetch()[0];
      // Grab the user's challenge bit string
      $request = $connected->prepare("SELECT chall_bitstring FROM `users` WHERE username = :user");
      $request->execute(array(":user"=>$_SESSION['username']));
      $chall_bitstring = $request->fetch()[0];
      $size = strlen($chall_bitstring);
      // Update the challenge bit string if it is too short
      for ($i=$size; $i < $max_bit_str_size; $i++)
      {
        $chall_bitstring .= '0';
      }
      if ($size < $max_bit_str_size)
      { // Update the challenge bit string in the database
        $request = $connected->prepare("UPDATE `users` SET chall_bitstring = \"$chall_bitstring\" WHERE username = :user");
        $request->execute(array(":user"=>$_SESSION['username']));
      }

      // Grab the challenges
      $request = $connected->prepare("SELECT `admins`.img, `challenges`.* FROM `admins`, `challenges` WHERE `admins`.userid = `challenges`.creater_id");
      $request->execute();
      // Display the challenges
      $loop = $request->rowCount();
      if ($loop == 0)
      { // If there are no challenges, display this message
        echo "<h1>Challenges Coming Soon!</h1>";
      }
      else
      {
        echo "<h1>Challenges:</h1>";
      }
      for ($i=0; $i < $loop; $i++)
      { // For each button
        $challenge = $request->fetch();
        $button = new DOMDocument();
        if ($chall_bitstring[$i] == '1')
        { // If challenge is already done
          $content = "<button type=\"button\" style=\"background-image:url(" . $challenge['img'] . ");background-repeat:no-repeat\" class=\"challenge\" disabled>
                        <p class=\"done\">Complete!</p>
                      </button>";
        }        
        else
        { // If challenge is incomplete
          $content = "<button type=\"button\" style=\"background-image:url(" . $challenge['img'] . ");background-repeat:no-repeat\" onclick = \"open_pop($i);\" class=\"challenge curr\" value=\"" . $challenge['file_path'] . " \">
                        <p class=\"name\">" . $challenge['name'] . "</p>
                      </button>";
        }
        $button->loadHTML($content);
        echo $button->saveHTML();
      }
      $connected = NULL;  // Terminate database connection
    ?>
  </div>
</div>
<script type="text/javascript" src="../../resources/jquery/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="../../resources/challenge_home/pop_up.js" aync></script>
<script type="text/javascript" src="../../resources/general/cookies_enabled.js"></script>
<?php
  require "../../resources/general/footer.html"
?>