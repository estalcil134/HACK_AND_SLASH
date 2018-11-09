<?php
require "../../resources/general/start.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset = "UTF-8">
  <meta name="author" content="Arron">
  <title>Tutorials</title>
  <link rel="stylesheet" type="text/css" href="../../resources/general/general_content.css">
  <link rel="stylesheet" type="text/css" href="../../resources/tutorial_home/tutorial_home.css">
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
  <table>
    <thead>
      <tr>
        <th>Untouched Tutorials</th>
        <th>Completed Tutorials</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //Connect
        require '../../resources/general/connect.php';
        $connected->exec("SELECT * FROM `users` WHERE userid");
        //TO BE FINISHED ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $start = "<tr>";
        $end = "</tr>";
        $cell_start = "<td>";
        $cell_end = "</td>";

        $connected=null;
  	  ?>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="resources/general/cookies_enabled.js"></script>
<?php require '../../resources/general/footer.html'; ?>
