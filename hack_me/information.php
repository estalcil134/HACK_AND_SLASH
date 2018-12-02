<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Private Information</title>
	<link rel="stylesheet" href="style.css">
	<style>
		button{
			margin-left: 30%;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<h1>Bank of RPI</h1>
	<h2>Protected by RPI $tudents</h2>
	<form><fieldset>
		
		<?php
			$con=new PDO("mysql:host=127.0.0.1;dbname=hackandslash_bank","nebby","pewpew");
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$user = $_POST['username'];
			$pass = $_POST['password'];
			$result = $con->query("SELECT * FROM bank_info where Username = '$user' and Password = '$pass'");
			if ($result->rowCount() > 0){
				echo("<legend>Your Personal Information</legend>");
				foreach($result as $row){
					echo("<p><b>Name: </b>" . $row['Full_Name'] . "</p>");
					echo("<p><b>Year of Birth: </b>" . $row['Birth_Year'] . "</p>");
					echo("<p><b>Social Security Number: </b>" . $row['Social_Security'] . "</p>");
					echo("<p><b>Amount Stored: </b>$" . $row['Amount_Stored'] . "</p>");
				}
			}
			else{
				echo("<legend>Connection Error</legend>");
				echo("<p><b>Wrong password or username!</b></p>");
			}
		?>

	</fieldset></form>
	
	<a href="index.html"><button type="button">Back</button></a>
</body>
</html>