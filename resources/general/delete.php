<?php
if ($_POST)
{
  require "connect.php";
  if (isset($_POST['type']) && ($_POST['type'] == 'challenge'))
  { // If we want to delete a challenge do this:
    // Grab where the file always loaded in from ajax is first
    $request = $connected->prepare("SELECT name FROM challenges WHERE num = :num");
    $request->execute(array(':num'=>clean_input(array_keys($_POST)[0])));
    $file_path = '../../user/challenges/challenges/' . $request->fetch()[0] . '.txt';
    // Remove that entry from the table afterwards
    $request = $connected->prepare("DELETE FROM challenges WHERE num = :num");
    $request->execute(array(':num'=>array_keys($_POST)[0]));

    // Grab the file path mentioned in the text file called $file_path
    $file = fopen($file_path, 'r');
    $challenge_file_location = fgets($file);
    if (strpos($challenge_file_location, '<a id="challenge_file" href="'))
    {
      $challenge_file_location = substr($challenge_file_location, strpos($challenge_file_location, '<a id="challenge_file" href="')+29);
      $challenge_file_location = substr($challenge_file_location, 0, strpos($challenge_file_location, '">File'));
      unlink($challenge_file_location);
    }
    fclose($file);
    // Delete the files
    unlink($file_path);
  }
}
// Redirect on successful deletion
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>