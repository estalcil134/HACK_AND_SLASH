<?php
if ($_POST)
{
  require "connect.php";
  if (isset($_POST['type']) && ($_POST['type'] == 'challenge'))
  {
    // Grab where the file always loaded in from ajax is first
    $request = $connected->prepare("SELECT name FROM challenges WHERE num = :num");
    $request->execute(array(':num'=>clean_input(array_keys($_POST)[0])));
    $file_path = '../../user/challenges/' . $request->fetch()[0] . '.txt';
    // Remove that entry from the table afterwards
    $request = $connected->prepare("DELETE FROM challenges WHERE num = :num");
    $request->execute(array(':num'=>array_keys($_POST)[0]));

    // Grab the file path mentioned in the text file
    $file = fopen($file_path, 'r');
    $challenge_file_location = fgets($file);
    $challenge_file_location = substr($challenge_file_location, strpos($challenge_file_location, '<a id="challenge_file" href="')+29);
    $challenge_file_location = substr($challenge_file_location, 0, strpos($challenge_file_location, '">File'));
    fclose($file);

    // Delete the files
    unlink($challenge_file_location);
    unlink($file_path);
  }
  else if (isset($_POST['type']) && ($_POST['type'] == 'tutorial'))
  {
    // Grab where the tutorial name
    $request = $connected->prepare("SELECT file_path FROM tutorials WHERE num = :num");
    $request->execute(array(':num'=>clean_input(array_keys($_POST)[0])));

    // Remove the entry from the tutorials table
    /*$request = $connected->prepare("DELETE FROM tutorials WHERE num = :num");
    $request->execute(array(':num'=>clean_input(array_keys($_POST)[0])));*/

    // Delete the files
    //unlink();
  }
}
//header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>