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
  <title>Hack&/ Challenge Deletion</title>
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
          //Connect
          require '../../resources/general/connect.php';
          $result = $connected->prepare("SELECT name, num FROM challenges WHERE creater_id = (SELECT userid FROM users WHERE username = :u)");
          $result->execute(array(':u'=>$_SESSION['username']));
          if (!$result->rowCount())
          {
            echo "<span>NO CHALLENGES LEFT</span>";
          }
          else
          {
            foreach ($result->fetchAll() as $challenge)
            {
              echo "<span class=\"left clear_left\">" . $challenge[0] . "<input class=\"right\" type=\"submit\" name=\"" . $challenge[1] ."\" value=\"DELETE\"></span><br/>";
            }
          }
          $connected=null;
        ?>
      </div>
      <input type="hidden" name="type" value="challenge">
    </fieldset>
  </form>
</div>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="../../resources/general/cookies_enabled.js"></script>
<?php require '../../resources/general/footer.html'; ?>
