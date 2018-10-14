<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset = "UTF-8">
  <meta name="author" content="Arron">
  <title>Tutorials</title>
  <link rel="stylesheet" type="text/css" href="../../resources/general/general_content.css">
  <link rel="stylesheet" type="text/css" href="../../resources/tutorial_home/tutorial_home.css">
  <script type="text/javascript" src="../../resources/general/footer.js"></script>
  <script type="text/javascript" src="resources/general/cookies_enabled.js"></script>
</head>
<?php
require'../../resources/general/logo_user.html';
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

<?php require '../../resources/general/footer.html'; ?>
