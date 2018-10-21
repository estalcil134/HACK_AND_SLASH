In the HACK&/ folder structure we utilize snake case directory and file names to keep the organization and naming consistent.

Way to Start the files:
<?php
  required "FILEPATHTO /resources/general/start.php";
?>

<!DOCTYPE html>
<html>
<head>
  stuff
</head>

<?php 
  require "FILEPATHTO /resources/general/logo_user.html";               <<<<< Contains the <body> start tag
  require "FILEPATHTO /resources/general/navbar_user.html";
?>

Stuff for your body stuff

<?php
  require "../resources/general/footer.html";                           <<<<< Contains the </body> </html> close tags
?>