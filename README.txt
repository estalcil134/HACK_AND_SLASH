In the HACK&/ folder structure we utilize snake case directory and file names to keep the organization and naming consistent.

The log in page is the index.php and is the first page a user will land on when visiting this website. 
Visiting another page on this website requires the user to log in with his/her account. Navigating to any other page without logging in will redirect him/her back to the log in page. 

---------- HOW "index.php" WORKS ----------
- session_start() at the very top of the page creates a new session for the current user or reconnects to any existing session stored in a cookie.
- The code at the top checks if the user is logged in. If they are, the user is redirected to their homepage based on usertype.
- If the user entered a username and password in an attempt to log in, then the else if statement -- which contains two functions -- first sanitizes the input by removing slashes, html special characters, and removing white spaces. It would then check if the user exists in the "users" table and if they do, then it would check if the user is an admin. If the user's credentials check out with an existing entry, then the user is redirected to their homepage after storing the username and user type in the session. Otherwise, the page would continue to load, setting the PHP error variables to be outputted in the login form. At the very end, there is an attempt to unset the $_POST array to clear what was posted and prevent form resubmission.
View /resources/index to see the CSS for this page.
Note that the script tag calls the script to check if cookies are enabled after loading in the style sheet so we are able to check if the user is using cookies or not.


---------- Dev Notes ----------

Way to Start the files:
<?php
  required "FILEPATHTO /resources/general/start.php";
?>

<!DOCTYPE html>
<html>
<head>
  stuff -- MAKE SURE TO FIX THE FILE PATHS FOR THE REQUIRED CSS PAGES FOR THE LOGO AND SCRIPTS FOR THE 
</head>

<?php 
  require "FILEPATHTO /resources/general/logo_user.html";               <<<<< Contains the <body> start tag
  require "FILEPATHTO /resources/general/navbar_user.html";
?>

Stuff for your body stuff

<?php
  require "../resources/general/footer.html";                           <<<<< Contains the </body> </html> close tags
?>

