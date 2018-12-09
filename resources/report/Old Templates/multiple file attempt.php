<?php
if ($_POST)
{
  require "connect.php";
  $num = clean_input(array_keys($_POST)[0]);
  $row = 0;
  if (isset($_POST['type']) && ($_POST['type'] == 'challenge'))
  { // If we want to delete a challenge do this:
    // Find the row number of the challenge to be deleted
    $numbers = $connected->query('SELECT num FROM challenges');
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
      if ((strlen($data['chall_bitstring']) > $row) && ($data['chall_bitstring'][$row] === '1'))
      { // If it was solved, shift every character over one
        $i = $row;
        $len = strlen($data['chall_bitstring']);
        while ($i < $len-1)
        {
          $data['chall_bitstring'][$i++] = $data['chall_bitstring'][$i];
        }
        $data['chall_bitstring'][$i] = '0';
        // Update that person's bitstring
        $update->execute(array(':new'=>$data['chall_bitstring'], ':score'=>($data['score']-100), ':user'=>$data['username']));
      }
    }

    // Grab where the file always loaded in from ajax is first
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
    {
      $challenge_file_location = substr($challenge_file_location, strpos($challenge_file_location, '<a id="challenge_file" href="')+29);
      $challenge_file_location = substr($challenge_file_location, 0, strpos($challenge_file_location, '" target='));
      unlink($challenge_file_location);
    }
    fclose($file);
    // Delete the files
    unlink($file_path);
  }
  else if(isset($_POST['type']) && ($_POST['type'] == 'tutorial'))
  { // If we are deletingn a tutorial, do this
    // Find the row number of the tutorial to be deleted
    $numbers = $connected->query('SELECT num FROM tutorials');
    foreach($numbers->fetchAll() as $c)
    {
      if ($c[0] == $num)
      {
        break;
      }
      $row++;
    }
    // Update all tutorial bit strings here
    $request = $connected->prepare("SELECT tut_bitstring, score, username FROM users");
    $request->execute();
    $update = $connected->prepare("UPDATE `users` SET tut_bitstring = :new, score = :score WHERE username = :user");
    foreach ($request->fetchAll() as $data)
    {
      if ((strlen($data['tut_bitstring']) > $row) && ($data['tut_bitstring'][$row] === '1'))
      {
        $i = $row;
        $len = strlen($data['tut_bitstring']);
        while ($i < $len-1)
        {
          $data['tut_bitstring'][$i++] = $data['tut_bitstring'][$i];
        }
        $data['tut_bitstring'][$i] = '0';
        $update->execute(array(':new'=>$data['tut_bitstring'], ':score'=>($data['score']-100), ':user'=>$data['username']));
      }
    }
    $request = $connected->prepare('SELECT file_path FROM tutorials WHERE num = :num');
    $request->execute(array(':num'=>$num));
    $t_file_path = $request->fetch()[0];
    $request = $connected->prepare('DELETE FROM tutorials WHERE num = :num');
    $request->execute(array(':num'=>$num));
    unlink($t_file_path);
  }
}
// Redirect on successful deletion
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>


<!--  -->
<?php
session_start();
// If the folder for all the files doesn't exist, make it
if (!file_exists("../../admin/challenge_creation_page/uploaded_docs") && !mkdir("../../admin/challenge_creation_page/uploaded_docs", 0700))
{ // Print this if error occurred
  echo "Error occurred when making server upload folder";
}
// If admin's folder doesn't exist, make the folder.
if(!file_exists("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username']) && !mkdir("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username'], 0700))
{ // Print this if error occurred
  echo "Error occurred when making admin directory";
}
if(isset($_POST['submit']) && isset($_POST['challenge']) && isset($_POST['flag']) && isset($_POST['description'])) {
  // If all the required fields are set execute all of this:
  $fileDestination = ""; // Challenge file location that user will download
  $file_path = "../../user/challenges/challenges/{$_POST['challenge']}.txt";  // file path for the .txt used for ajax
  // Check if the challenge already exists by challenge name. If it does, then we don't submit it
  require "connect.php";
  $result = $connected->query("SELECT file_path FROM `challenges` WHERE creater_id = (SELECT userid FROM `users` WHERE username = '" . $_SESSION['username'] . "') AND file_path = '$file_path'");
  if (!$result->fetch()[0])
  {
    // Upload the file first
    if (is_uploaded_file($_FILES['myFile']['tmp_name']))
    { // If there was a file uploaded, then execute this block
      $file = $_FILES['myFile'];
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];
      $fileExt = explode('.',$fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('html','htm','txt','sql');
      if(in_array($fileActualExt,$allowed)) {
        if($fileError === 0) {
          if($fileSize < 10000000) {
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination .= '../../admin/challenge_creation_page/uploaded_docs/' . $_SESSION['username'] .'/'.$fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
          }
          $error_type = "1";
        }
        $error_type = "2";
      }
      $error_type = "3";
    }
    // Then create the text file that will be outputted in the challenge landing page.
    $challenge = fopen("$file_path", "w");
    fwrite($challenge, "<h2>{$_POST['challenge']}</h2><p>{$_POST['description']}</p>");
    if ($fileDestination != '')
    { // If a file was submitted, add an anchor tag to that file we are writting into
      fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\" target=\"_blank\">File</a>");
      //fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\" download=\"{$_POST['challenge']}\">File</a>");
    }
    fclose($challenge);
    // Add the challenge to the database
    $request = $connected->prepare("INSERT INTO `challenges` (creater_id, name, file_path, flags) VALUES ((SELECT userid FROM `users` WHERE username = :u), :c_n, :f_p, :flag)");
    $request->execute(array(':u'=>$_SESSION['username'], ':c_n'=>$_POST['challenge'], ':f_p'=>$file_path, ':flag'=>$_POST['flag']));
  }
  else
  { // If the challenge already exists, redirect
    header("Location: http://{$_SERVER['SERVER_NAME']}/admin/challenge_creation_page/challenge_creation.php?=4");
    exit();
  }
  $connected = NULL;
}
// Redirect back to the challenge creation page if successful
header("Location: http://{$_SERVER['SERVER_NAME']}/admin/challenge_creation_page/challenge_creation.php?=5");
exit();
?>


<!--  -->
<?php
session_start();
// If the folder for all the files doesn't exist, make it
if (!file_exists("../../admin/challenge_creation_page/uploaded_docs") && !mkdir("../../admin/challenge_creation_page/uploaded_docs", 0700))
{ // Print this if error occurred
  echo "Error occurred when making server upload folder";
}
// If admin's folder doesn't exist, make the folder.
if(!file_exists("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username']) && !mkdir("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username'], 0700))
{ // Print this if error occurred
  echo "Error occurred when making admin directory";
}
if(isset($_POST['submit']) && isset($_POST['challenge']) && isset($_POST['flag']) && isset($_POST['description'])) {
  // If all the required fields are set execute all of this:
  $fileDestination = ""; // Challenge file location that user will download
  $file_path = "../../user/challenges/challenges/{$_POST['challenge']}.txt";  // file path for the .txt used for ajax
  // Check if the challenge already exists by challenge name. If it does, then we don't submit it
  require "connect.php";
  $result = $connected->query("SELECT file_path FROM `challenges` WHERE creater_id = (SELECT userid FROM `users` WHERE username = '" . $_SESSION['username'] . "') AND file_path = '$file_path'");
  if (!$result->fetch()[0])
  {
    // Create the folder for that tutorial
    $loc = "../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username'] . "/{$_POST['challenge']}";
    if (!file_exists($loc) && !mkdir($loc, 0700))
    {
      echo "Error occurred when making specific challenge directory";
    }
    // Upload the files first
    if (count($_FILES['myFile']['tmp_name']))
    { // If there was a file uploaded, then execute this block
      $
      foreach($_FILES['myFile'] as $file)
      {
        //[name] => index.html [type] => text/html [tmp_name] => C:\xampp\tmp\phpF547.tmp [error] => 0 [size] => 677 
        $fileName[] = $file[0];
        $fileTmpName[] = $file[2];
        $fileSize[] = $file[4];
        $fileError[] = $file[3];
        $fileType[] = $file[1];
        $fileExt = explode('.',$fileName);
        $fileActualExt[] = strtolower(end($fileExt));
      }
      foreach()
    }
    // Then create the text file that will be outputted in the challenge landing page.
    /*$challenge = fopen("$file_path", "w");
    fwrite($challenge, "<h2>{$_POST['challenge']}</h2><p>{$_POST['description']}</p>");
    if ($fileDestination != '')
    { // If a file was submitted, add an anchor tag to that file we are writting into
      fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\" target=\"_blank\">File</a>");
      //fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\" download=\"{$_POST['challenge']}\">File</a>");
    }
    fclose($challenge);
    // Add the challenge to the database
    $request = $connected->prepare("INSERT INTO `challenges` (creater_id, name, file_path, flags) VALUES ((SELECT userid FROM `users` WHERE username = :u), :c_n, :f_p, :flag)");
    $request->execute(array(':u'=>$_SESSION['username'], ':c_n'=>$_POST['challenge'], ':f_p'=>$file_path, ':flag'=>$_POST['flag']));*/
  }
  else
  { // If the challenge already exists, redirect
    header("Location: http://{$_SERVER['SERVER_NAME']}/admin/challenge_creation_page/challenge_creation.php?=4");
    exit();
  }
  $connected = NULL;
}
// Redirect back to the challenge creation page if successful
//header("Location: http://{$_SERVER['SERVER_NAME']}/admin/challenge_creation_page/challenge_creation.php?=5");
exit();
?>



<!--  -->

<?php
session_start();
// If the folder for all the files doesn't exist, make it
if (!file_exists("../../admin/challenge_creation_page/uploaded_docs") && !mkdir("../../admin/challenge_creation_page/uploaded_docs", 0700))
{ // Print this if error occurred
  echo "Error occurred when making server upload folder";
}
// If admin's folder doesn't exist, make the folder.
if(!file_exists("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username']) && !mkdir("../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username'], 0700))
{ // Print this if error occurred
  echo "Error occurred when making admin directory";
}
if(isset($_POST['submit']) && isset($_POST['challenge']) && isset($_POST['flag']) && isset($_POST['description'])) {
  // If all the required fields are set execute all of this:
  $fileDestination = ""; // Challenge file location that user will download
  $file_path = "../../user/challenges/challenges/{$_POST['challenge']}.txt";  // file path for the .txt used for ajax
  // Check if the challenge already exists by challenge name. If it does, then we don't submit it
  require "connect.php";
  $result = $connected->query("SELECT file_path FROM `challenges` WHERE creater_id = (SELECT userid FROM `users` WHERE username = '" . $_SESSION['username'] . "') AND file_path = '$file_path'");
  if (!$result->fetch()[0])
  {
    // Create the folder for that tutorial
    $loc = "../../admin/challenge_creation_page/uploaded_docs/" . $_SESSION['username'] . "/{$_POST['challenge']}";
    if (!file_exists($loc) && !mkdir($loc, 0700))
    {
      echo "Error occurred when making specific challenge directory";
    }
    // Upload the files first
    if (count($_FILES['myFile']['tmp_name']))
    { // If there was a file uploaded, then execute this block
      $
      foreach($_FILES['myFile'] as $file)
      {
        //[name] => index.html [type] => text/html [tmp_name] => C:\xampp\tmp\phpF547.tmp [error] => 0 [size] => 677 
        $fileName[] = $file[0];
        $fileTmpName[] = $file[2];
        $fileSize[] = $file[4];
        $fileError[] = $file[3];
        $fileType[] = $file[1];
        $fileExt = explode('.',$fileName);
        $fileActualExt[] = strtolower(end($fileExt));
      }
      foreach()
    }
    // Then create the text file that will be outputted in the challenge landing page.
    /*$challenge = fopen("$file_path", "w");
    fwrite($challenge, "<h2>{$_POST['challenge']}</h2><p>{$_POST['description']}</p>");
    if ($fileDestination != '')
    { // If a file was submitted, add an anchor tag to that file we are writting into
      fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\" target=\"_blank\">File</a>");
      //fwrite($challenge, "<a id=\"challenge_file\" href=\"$fileDestination\" download=\"{$_POST['challenge']}\">File</a>");
    }
    fclose($challenge);
    // Add the challenge to the database
    $request = $connected->prepare("INSERT INTO `challenges` (creater_id, name, file_path, flags) VALUES ((SELECT userid FROM `users` WHERE username = :u), :c_n, :f_p, :flag)");
    $request->execute(array(':u'=>$_SESSION['username'], ':c_n'=>$_POST['challenge'], ':f_p'=>$file_path, ':flag'=>$_POST['flag']));*/
  }
  else
  { // If the challenge already exists, redirect
    header("Location: http://{$_SERVER['SERVER_NAME']}/admin/challenge_creation_page/challenge_creation.php?=4");
    exit();
  }
  $connected = NULL;
}
// Redirect back to the challenge creation page if successful
//header("Location: http://{$_SERVER['SERVER_NAME']}/admin/challenge_creation_page/challenge_creation.php?=5");
exit();
?>