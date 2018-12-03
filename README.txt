In the HACK&/ folder structure we utilize snake case directory and file names to keep the organization and naming consistent.

The log in page is the index.php and is the first page a user will land on when visiting this website. 
Visiting another page on this website requires the user to log in with his/her account. Navigating to any other page without logging in will redirect him/her back to the log in page. 

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
