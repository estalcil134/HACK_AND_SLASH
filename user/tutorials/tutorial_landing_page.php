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
        $result = $connected->prepare("SELECT * FROM tutorials");
        $result->execute();
        $result = $result->fetchAll();

        $num_tuts = $connected->prepare("SELECT COUNT(num) FROM tutorials");
        $num_tuts->execute();
        $num_tuts = $num_tuts->fetch()['COUNT(num)'];

        $query = $connected->query("SELECT tut_bitstring FROM `users` WHERE username = \"" . $_SESSION['username'] . '"');
        $tut_bitstring = $query->fetchAll()[0]['tut_bitstring'];
        $length = strlen($tut_bitstring);
        if ($length < $num_tuts)
        {
          while ($length < $num_tuts)
          { // Update the bitstring if necessary
            $tut_bitstring .= '0';
            $length++;
          }
          $connected->exec("UPDATE `users` SET tut_bitstring = \"$tut_bitstring\" WHERE username = \"" . $_SESSION['username'] . '"');
        }
        $tut_bitstring = str_split($tut_bitstring);
        $complete = array();
        $c_link = array();
        $incomplete = array();
        $i_link = array();
        for ($i=0; $i < $num_tuts; $i++)
        {
          if ($tut_bitstring[$i] == '1')
          {
            $complete[] = $result[$i]['name'];
            $c_link[] = $result[$i]['file_path'];
          }
          else
          {
            $incomplete[] = $result[$i]['name'];
            $i_link[] = $result[$i]['file_path'];
          }
        }
        $num_rows = min(array(count($complete), count($incomplete)));
        for ($i = 0; $i < $num_rows; $i++)
        {
          echo "<tr><td><a href=\"$c_link[$i]\">$complete[$i]</a></td><td><a href=\"$i_link[$i]\">$incomplete[$i]</a></td></tr>";
        }
        while (!empty($complete[$i]))
        {
          echo "<tr><td><a href=\"$c_link[$i]\">$complete[$i]</a></td><td></td></tr>";
          $i++;
        }
        while (!empty($incomplete[$i]))
        {
          echo "<tr><td></td><td><a href=\"$i_link[$i]\">$incomplete[$i]</a></td></tr>";
          $i++;
        }
        
        $connected=null;
  	  ?>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="resources/general/cookies_enabled.js"></script>
<?php require '../../resources/general/footer.html'; ?>
