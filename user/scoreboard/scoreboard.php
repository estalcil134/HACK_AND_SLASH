<?php
require "../../resources/general/start.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Wilson/Arron">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name = "description" content = "Scoreboard">
	<title>HACK&/ Scoreboard</title>
  <script src="../../resources/general/cookies_enabled.js"></script>
	<script src="../../resources/general/footer.js"></script>
	<link href="../../resources/general/general_content.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../../resources/scoreboard/general_content.css">
</head>

<?php
  // Basic UI
  require "../../resources/general/logo_" . $_SESSION['user-type'] . ".html";
  if ($_SESSION['user-type'] == 'admin')
  {
    require "../../resources/general/navbar_admin.html";
  }
  require "../../resources/general/navbar_user.html";

  // Connection to grab scoreboard data
  require "../../resources/general/connect.php";
  $request = $connected->prepare("SELECT username FROM `users` ORDER BY score DESC, username ASC LIMIT 10");
  $request->execute();
  // Output the scoreboard table here
  echo "<table><thead><th colspan=2>Rankings</th></thead><tbody>";
  $loop = $request->rowCount();
  for ($i=0; $i < $loop; $i++)
  {
    if ($i == 0)
    {
      echo "<tr class='first rank'><td>";
    }
    else if ($i == 1)
    {
      echo "<tr class='rank second'><td>";
    }
    else if ($i == 2)
    {
      echo "<tr class='rank third'><td>";
    }
    else
    {
      echo "<tr><td>";
    }
    echo (string)($i+1) . "</td><td>" . $request->fetch()[0] . "</td></tr>";
  }
  // Grab your ranking
  $request = $connected->prepare("SELECT username FROM `users` ORDER BY score, username");
  $request->execute();
  $rank = 1;
  while ($request->fetch()[0] != $_SESSION['username'])
  {
    $rank++;
  }
  echo "<tr><td>Your Rank</td><td>$rank</td></tr></tbody></table>";
  $connected = NULL;
?>
<?php require "../../resources/general/footer.html"; ?>