<?php
session_start();
require "../../resources/general/connect.php";
if (isset($_POST['fin']))
{ //Clean the input
  $name = clean_input($_POST['fin']);
  // Grab the tutorial bitstring for the current user
  $request = $connected->prepare("SELECT tut_bitstring FROM users WHERE username = :user");
  $request->execute(array(':user'=>$_SESSION['username']));
  $tut_bitstring = $request->fetch()[0];
  // Grab all the tutorials
  $all = $connected->prepare("SELECT * FROM tutorials ORDER BY num ASC");
  $all->execute();
  // Extend the tut_bitstring if necessary
  $size = strlen($tut_bitstring);
  while($size < $all->rowCount())
  {
    $tut_bitstring .= '0';
    $size++;
  }
  // Find the location of the character in the bitstring
  $i=0;
  foreach($all->fetchAll() as $tutorial)
  {
    if ($tutorial['name']==$name)
    {
      break;
    }
    $i++;
  }
  // Set the character in the tutorial bitstring to 1 to mark it as complete
  $tut_bitstring[$i] = '1';
  // Update the tutorial bitstring
  $request = $connected->prepare("UPDATE `users` SET tut_bitstring = :new WHERE username = :user");
  $request->execute(array(':new'=>$tut_bitstring,':user'=>$_SESSION['username']));
}
$connected=NULL;
header("Location: http://" . $_SERVER['SERVER_NAME'] . '/user/tutorials/tutorial_landing_page.php');
exit();
?>