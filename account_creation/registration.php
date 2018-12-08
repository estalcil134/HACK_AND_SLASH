<?php
session_start();
$email_err = $user_err = $pass_err = '';
function clean_input_org($data)
{ // Function to clean user input
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
{ // Validating input
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
    $email = clean_input_org($_POST['Email']);
    $user = clean_input_org($_POST['Username']);
    $pass = [clean_input_org($_POST['pass1']), clean_input_org($_POST['pass2'])];
    if ($pass[0] !== $pass[1])
    {
      $pass_err = "Passwords do not match!";
    }
    else if (strlen($pass[0]) < 12)
    { // If they somehow got through the minimum of a 12 character password
      $pass_err = "Password must be at least 12 characters long!";
    }
    // Connect to database
    require "../resources/general/connect.php";
    // Check if email exists and if it is a valid email
    $request = $connected->prepare("SELECT email FROM `users` WHERE email = :email");
    $exist1 = (($request->execute(array(':email' => $email)) === True) && $request->rowCount());
    if (!filter_var(clean_input_org($_POST['Email']), FILTER_VALIDATE_EMAIL))
    { // If it is not a valid email
      $email_err = "Please enter a valid email!";
    }
    else if ($exist1)
    { // If the email already exists
      $email_err = "This email is already in use!";
    }
    
    if (strlen($user) > 20)
    { // Check if username is under 20 chars
      $user_err = "Please enter a username that is less than or equal to 20 characters!";
    }
    else
    { // Check if username exists
      $request = $connected->prepare("SELECT username FROM `users` WHERE username = :username");
      $exist2 = ($request->execute(array(':username' => $user)) === True) && $request->rowCount();
      if ($exist2)
      {
        $user_err = "This username is already in use!";
      }
    }

    if (!$exist1 && !$exist2 && ($email_err == '') && ($user_err == '') && ($pass_err == ''))
    { // Account credentials are valid so create an account in our database
      $salt = hash('sha256', uniqid(mt_rand(), true));
      $request = $connected->prepare("INSERT INTO `users` (username, email, hashed_password, salt, tut_bitstring, chall_bitstring) VALUES (:u, :e, :p, :s, '0', '0')");
      $request->execute(array(':u' => $user, ':e' => $email, ':p' => hash("sha256", $pass[0] . $salt), ':s'=>$salt));
      // Redirect to login page if successfully created
      header("Location: http://" . $_SERVER['SERVER_NAME'] . "/index.php");
      exit();
    }
    $connected=NULL;  // Terminate connection
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Arron">
  <title>HACK&amp;/ Registration</title>
  <link rel="stylesheet" href="../resources/index/index.css">
  <link rel="stylesheet" href="./account_creation.css">
  <script type="text/javascript" src="../resources/general/cookies_enabled.js" async></script>
</head>
<body>
  <h1>Welcome to HACK&/</h1>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="UTF-8" name="create_account">
    <fieldset>
      <legend>Please Create an Account</legend>
      <div class="left">
        <label class="left" for="username">Enter an Email: </label>
        <input class="right" id="email" type="text" name="Email" autofocus required>
        <span class="info"><?php echo $email_err;?></span>
      </div>
      <div class="left clear_left">
        <label class="left" for="username">Create a Username: </label>
        <input class="right" id="username" type="text" name="Username" maxlength="20" required>
        <span class="info"><?php echo $user_err;?></span>
      </div>
      <div class="left clear_left">
        <label class="left" for="password1">Enter a Password: </label>
        <input class="right" id="password1" type="password" name="pass1" minlength="12" required>
        <label class="left" for="password2">Re-enter Password: </label>
        <input class="right" id="password2" type="password" name="pass2"  minlength="12" required onblur="pass_check();">
        <span class="info"><?php echo $pass_err;?></span>
      </div>
    
      <input type="submit" value="Create Account" id="submit">
    </fieldset>
  </form>
  <p class="noaccount"><a href = "../index.php">Already have an account? Login here!</a></p>
  <p class="about"><a href = "../about/about.html">About</a></p>
  <script type="text/javascript" src="../resources/account_creation/registration.js"></script>
</body>
</html>
<!--   <div class="left">
        <label for="username">Enter an Email: </label>
        <span class="info"><?php echo $email_err;?></span>
        <label for="username">Create a Username: </label>
        <span class="info"><?php echo $user_err;?></span>
        <label for="password1">Enter a Password: </label>
        <label for="password2">Re-enter Password: </label>
        <span class="info"><?php echo $pass_err;?></span>
      </div>
      <div class="right">
        <input id="email" type="text" name="Email" autofocus required>
        <input id="username" type="text" name="Username" maxlength="20" required>
        <input id="password1" type="password" name="pass1" minlength="12" required>
        <input id="password2" type="password" name="pass2"  minlength="12" required onblur="pass_check();">
      </div> -->