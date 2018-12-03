<?php
require "../../resources/general/start.php";
if ($_SESSION['user-type'] !== "admin")
{ // Redirect if user is not admin
  header("Location: http://" . $_SERVER['SERVER_NAME']);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset = "UTF-8">
  <meta name="author" content="Arron">
  <title>Hack&amp;/ Challenge Deletion</title>
  <link rel="stylesheet" type="text/css" href="../../resources/general/general_content.css">
  <link rel="stylesheet" type="text/css" href="../../resources/general/deletion_page.css">
</head>
<?php
 // Navigation bars
  require'../../resources/general/logo_' . $_SESSION['user-type'] . '.html';
  require '../../resources/general/navbar_admin.html';
  require '../../resources/general/navbar_user.html';
?>

<div id="body">
  <form action="../../resources/general/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete that challenge?');">
    <fieldset>
      <legend>Challenges Made:</legend>
      <div id="deletion">
        <?php
          // Connect to database
          require '../../resources/general/connect.php';
          // Grab all the challenges
          $result = $connected->prepare("SELECT name, num FROM challenges WHERE creater_id = (SELECT userid FROM users WHERE username = :u)");
          $result->execute(array(':u'=>$_SESSION['username']));
          if (!$result->rowCount())
          { // Output this if there are no challenges in the database
            echo "<span>NO CHALLENGES LEFT</span>";
          }
          else
          { // Output all the challenges with a button next to it to delete that challenge
            foreach ($result->fetchAll() as $challenge)
            {
              echo "<span class=\"left clear_left\">" . $challenge[0] . "<input class=\"right\" type=\"submit\" name=\"" . $challenge[1] ."\" value=\"DELETE\"></span><br/>";
            }
          }
          $connected=null;  // Terminate connection
        ?>
      </div>
      <!-- Used to indicate whether we are deleting a challenge or a tutorial -->
      <input type="hidden" name="type" value="challenge">
    </fieldset>
  </form>
</div>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="../../resources/general/cookies_enabled.js"></script>
<?php require '../../resources/general/footer.html'; ?>
