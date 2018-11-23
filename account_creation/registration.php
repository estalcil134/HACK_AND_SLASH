<?php
session_start();
$email_err = $user_err = $pass_err = '';
function clean_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Redirect if already logged in to a session
if (isset($_SESSION['user-type']) && isset($_SESSION['username']))
{
  header("Location: http://" . $_SERVER['SERVER_NAME'] . "/" . $_SESSION['user-type'] . "/" . $_SESSION['user-type'] . "_home_page.php");
}
else if (isset($_POST['Email']) || isset($_POST['Username']) || isset($_POST['pass1']) || isset($_POST['pass2']))
{
  if (!isset($_POST['Email']) || !isset($_POST['Username']) || !isset($_POST['pass1']) || !isset($_POST['pass2']))
  { // If they actually avoided the required fields
    if (!isset($_POST['Email']))
    {
      $email_err = "Please enter an email.";
    }
    if (!isset($_POST['Username']))
    {
      $user_err = "Please enter a Username.";
    }
    if (!isset($_POST['pass1']) || !isset($_POST['pass2']))
    {
      $pass_err = "Please make a password!";
    }
  }
  else
  { // Assuming the inputted data is valid:
    // exist1 is true if the email is already taken; exist2 is true if the username is already taken
    $exist1 = $exist2 = False;
    $email = clean_input($_POST['Email']);
    $user = clean_input($_POST['Username']);
    $pass = [clean_input($_POST['pass1']), clean_input($_POST['pass2'])];
    if ($pass[0] !== $pass[1])
    {
      $pass_err = "Passwords do not match!";
    }
    require "../resources/general/connect.php";
    // Check if email exists
    $request = $connected->prepare("SELECT email FROM `users` WHERE email = :email");
    $exist1 = (($request->execute(array(':email' => $email)) === True) && $request->rowCount());
    if (!filter_var(clean_input($_POST['Email']), FILTER_VALIDATE_EMAIL))
    {
      $email_err = "Please enter a valid email!";
    }
    else if ($exist1)
    {
      $email_err = "This email is already in use!";
    }
    // Check if username exists
    $request = $connected->prepare("SELECT username FROM `users` WHERE username = :username");
    $exist2 = ($request->execute(array(':username' => $user)) === True) && $request->rowCount();
    if ($exist2)
    {
      $user_err = "This username is already in use!";
    }
    if (!$exist1 && !$exist2 && ($email_err == '') && ($user_err == '') && ($pass_err == ''))
    { // Account credentials are valid so create it
      $request = $connected->prepare("SELECT MAX(userid) FROM `users`");
      $request->execute();
      $salt = $request->fetch()[0] + 1;
      $request = $connected->prepare("INSERT INTO `users` (userid, username, email, hashed_password, tut_bitstring, chall_bitstring) VALUES (:id, :u, :e, :p, '0', '0')");
      $request->execute(array('id'=>$salt, ':u' => $user, ':e' => $email, ':p' => hash("sha256", $pass[0] . $salt)));
      header("Location: http://" . $_SERVER['SERVER_NAME'] . "/index.php");
    }
    $connected=NULL;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Arron">
  <title>HACK&/</title>
  <link rel="stylesheet" href="../resources/index/index.css">
  <link rel="stylesheet" href="./account_creation.css">
  <script type="text/javascript" src="../resources/general/cookies_enabled.js" async></script>
</head>
<body>
  <h1>Welcome to HACK&/</h1>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="UTF-8" name="create_account">
    <fieldset>
      <legend>Please Create an Account</legend>
      <label for="username">Enter an Email:</label>
      <input id="email" type="text" name="Email" autofocus required>
      <span class="info"><?php echo $email_err;?></span>
      <label for="username">Create a Username:</label>
      <input id="username" type="text" name="Username" maxlength="20" required>
      <span class="info"><?php echo $user_err;?></span>
      <label for="password1">Enter a Password:</label>
      <input id="password1" type="password" name="pass1" required>
      <label for="password2">Renter a Password:</label>
      <input id="password2" type="password" name="pass2" required onblur="pass_check();">
      <span class="info"><?php echo $pass_err;?></span>
    </fieldset>
    <input type="submit" value="Create Account">
  </form>
  <p class="noaccount"><a href = "../index.php">Already have an account? Login here!</a></p>
  <p class="about"><a href = "../about/about.html">About</a></p>
  <script type="text/javascript">
    function pass_check()
    {
      p1 = document.getElementById("password1").value;
      p2 = document.getElementById("password2").value;
      if ((p2 !== '') && (p1 !== p2))
      {
        document.getElementsByClassName("info")[1].innerHTML = "Passwords do not match!";
      }
      else
      {
        document.getElementsByClassName("info")[1].innerHTML = "";
      }
    }
  </script>
</body>
</html>