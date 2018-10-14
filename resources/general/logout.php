<?php
// To Logout, remove the cookie assuming they are already logged in
if (isset($_COOKIE['username'])){
  unset($_COOKIE['username']);
  setcookie("username", "", -1, "/");
}

header('Location:' . 'http://' . $_SERVER['SERVER_NAME'] . '/index.html');
?>