<?php
if ($_POST)
{
  require "connect.php";
  $num = clean_input(array_keys($_POST)[0]); // From the name of the input submit
  $row = 0;
  if (isset($_POST['type']) && ($_POST['type'] == 'challenge'))
  { // If we want to delete a challenge do this:
    // Find the row number of the challenge to be deleted
    $numbers = $connected->query('SELECT num FROM challenges ORDER BY num ASC');
    foreach($numbers->fetchAll() as $c)
    {
      if ($c[0] == $num)
      {
        break;
      }
      $row++;
    }
    // Update all challenge bit strings here
    $request = $connected->prepare("SELECT chall_bitstring, score, username FROM users");
    $request->execute();
    $update = $connected->prepare("UPDATE `users` SET chall_bitstring = :new, score = :score WHERE username = :user");
    foreach ($request->fetchAll() as $data)
    {
      if (strlen($data['chall_bitstring']) > $row)
      { // If it is recorded in the bitstring, shift every character over one
        $i = $row;
        if ($data['chall_bitstring'][$i] == '1')
        {
          $new_score = ($data['score']-100 > 0 ? $data['score']-100:0);
        }
        else
        {
          $new_score = $data['score'];
        }
        $len = strlen($data['chall_bitstring']);
        while ($i < $len-1)
        {
          $data['chall_bitstring'][$i++] = $data['chall_bitstring'][$i];
        }
        $data['chall_bitstring'][$i] = '0';
        // Update that person's bitstring
        $update->execute(array(':new'=>$data['chall_bitstring'], ':score'=>$new_score, ':user'=>$data['username']));
      }
    }

    // Grab where the file that is always loaded in from an ajax call is first
    // aka the challenge content containing name, description, and filepath
    $request = $connected->prepare("SELECT name FROM challenges WHERE num = :num");
    $request->execute(array(':num'=>$num));
    $file_path = '../../user/challenges/challenges/' . $request->fetch()[0] . '.txt';
    // Remove that entry from the table afterwards
    $request = $connected->prepare("DELETE FROM challenges WHERE num = :num");
    $request->execute(array(':num'=>$num));

    // Grab the file path mentioned in the text file called $file_path
    $file = fopen($file_path, 'r');
    $challenge_file_location = fgets($file);
    if (strpos($challenge_file_location, '<a id="challenge_file" href="'))
    { // If there is anothe file to delete referenced here, delete it
      $challenge_file_location = substr($challenge_file_location, strpos($challenge_file_location, '<a id="challenge_file" href="')+29);
      $challenge_file_location = substr($challenge_file_location, 0, strpos($challenge_file_location, '" target='));
      unlink($challenge_file_location);
    }
    fclose($file);
    // Delete the txt file
    unlink($file_path);
  }
  else if(isset($_POST['type']) && ($_POST['type'] == 'tutorial'))
  { // If we are deleting a tutorial, do this
    // Find the row number of the tutorial to be deleted
    $numbers = $connected->query('SELECT num FROM tutorials ORDER BY num ASC');
    foreach($numbers->fetchAll() as $c)
    {
      if ($c[0] == $num)
      {
        break;
      }
      $row++;
    }
    // Update all tutorial bit strings here
    $request = $connected->prepare("SELECT tut_bitstring, username FROM users");
    $request->execute();
    $update = $connected->prepare("UPDATE `users` SET tut_bitstring = :new WHERE username = :user");
    foreach ($request->fetchAll() as $data)
    {
      if (strlen($data['tut_bitstring']) > $row)
      { // If the tutorial exists in the bitstring, shift all the characters over by one
        $i = $row;
        $len = strlen($data['tut_bitstring']);
        while ($i < $len-1)
        {
          $data['tut_bitstring'][$i++] = $data['tut_bitstring'][$i];
        }
        $data['tut_bitstring'][$i] = '0';
        // Update the bitstring
        $update->execute(array(':new'=>$data['tut_bitstring'], ':user'=>$data['username']));
      }
    }

    // Delete the tutorial commences here
    $request = $connected->prepare('SELECT file_path FROM tutorials WHERE num = :num');
    $request->execute(array(':num'=>$num));
    $t_file_path = $request->fetch()[0];
    $t_file_path = substr($t_file_path, 0, strpos($t_file_path, "0.html"));
    if (is_dir($t_file_path) && ($directory = opendir($t_file_path)))
    { // Successfilly opened directory, so read each file in and delete them
      readdir($directory);  // Ignore the . directory
      readdir($directory);   // Ignore the .. directory
      while (($file_name = readdir($directory)) !== False)
      {
        unlink($t_file_path . $file_name);
      }
      closedir($directory);
      // Delete the directory
      rmdir($t_file_path);
    }
    $request = $connected->prepare('DELETE FROM tutorials WHERE num = :num');
    $request->execute(array(':num'=>$num));
  }
}
// Redirect on successful deletion
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>