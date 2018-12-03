<?php
require "../../resources/general/start.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset = "UTF-8">
  <meta name="author" content="Arron">
  <title>Hack&amp;/ Tutorials</title>
  <link rel="stylesheet" type="text/css" href="../../resources/general/general_content.css">
  <link rel="stylesheet" type="text/css" href="../../resources/tutorial_home/tutorial_home.css">
</head>
<?php
// Include av bars
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
        //Connect to the database
        require '../../resources/general/connect.php';
        // Grab all the tutorials
        $result = $connected->prepare("SELECT * FROM tutorials");
        $result->execute();
        $result = $result->fetchAll();
        // The total number of tutorials
        $num_tuts = count($result);

        // Grab the tutorial bit string for the current user
        $query = $connected->query("SELECT tut_bitstring FROM `users` WHERE username = \"" . $_SESSION['username'] . '"');
        $tut_bitstring = $query->fetchAll()[0]['tut_bitstring'];
        $length = strlen($tut_bitstring);
        if ($length < $num_tuts)
        {
          while ($length < $num_tuts)
          { // Update the bitstring if necessary (if the user's tutorial bitstring is not long enough)
            $tut_bitstring .= '0';
            $length++;
          }
          // Send the updated tutorial bit string back to the database for the current user
          $connected->exec("UPDATE `users` SET tut_bitstring = \"$tut_bitstring\" WHERE username = \"" . $_SESSION['username'] . '"');
        }
        $connected=null; // End connection
        $tut_bitstring = str_split($tut_bitstring);
        $complete = array();      // To Array of completed tutorials
        $c_link = array();        // To be Array of links for each Completed tutorial
        $incomplete = array();    // To be Array of incompleted tutorials
        $i_link = array();        // To be Array of links for each Incompleted tutorial
        // Sort the tutorials into COMPLETED and INCOMPLETE for that user based on the tutorial string
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
        // Out put the content of each array into the table
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
  	  ?>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="../../resources/general/cookies_enabled.js"></script>
<?php require '../../resources/general/footer.html'; ?>
