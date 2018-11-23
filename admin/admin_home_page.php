<?php require '../resources/general/start.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="descripton" content="Admin Home Page">
	<meta name="author" content="Wilson">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HACK&/ Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="../resources/general/general_content.css">
	<link rel="stylesheet" type="text/css" href="../resources/admin_home/general_content.css">
	<script type="text/javascript" src="../resources/general/footer.js"></script>
</head>

<?php
require'../resources/general/logo_' . $_SESSION['user-type'] . '.html';
if ($_SESSION['user-type'] === "admin")
{
  require '../resources/general/navbar_admin.html';
}
require '../resources/general/navbar_user.html';
?>
	<p>Admin Home Page</p>
 

<?php require '../resources/general/footer.html'; ?>