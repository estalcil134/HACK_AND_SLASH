<?php
session_start();
require "../../resources/general/connect.php";
if (isset($_POST['fin']))
{
  $name = clean_input($_POST['fin']);
  $request = $connected->prepare("SELECT tut_bitstring FROM users WHERE username = :user");
  $request->execute(array(':user'=>$_SESSION['username']));
  $tut_bitstring = $request->fetch()[0];
  $all = $connected->prepare("SELECT * FROM tutorials");
  $all->execute();
  // Extend the tut_bitstring
  $size = strlen($tut_bitstring);
  while($size < $all->rowCount())
  {
    $tut_bitstring .= '0';
    $size++;
  }
  // Find the location in the bitstring
  $i=0;
  foreach($all->fetchAll() as $tutorial)
  {
    if ($tutorial['name']==$name)
    {
      break;
    }
    $i++;
  }
  $tut_bitstring[$i] = '1';
  $request = $connected->prepare("UPDATE `users` SET tut_bitstring = :new WHERE username = :user");
  $request->execute(array(':new'=>$tut_bitstring,':user'=>$_SESSION['username']));
}
$connected=NULL;
header("Location: http://" . $_SERVER['SERVER_NAME'] . '/user/tutorial/tutorial_landing_page.php');
exit();
?>