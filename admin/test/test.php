<?php
	
	//something something idk i need more research points
	//this code is ho yeet hay (热气)

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$o1 = $_POST['title'];
    	$o2 = $_POST['content'];
  	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="test.css">
	<meta charset = "UTF-8">
	<title>Test Submission</title>
</head>

<body>
	<form method="post" action="done.html">
		<fieldset>
			<legend>New Tutorial</legend>
			Title:<br>
			<input id="title" type="text" name="title" value="Tutorial Title"></br>
			Content:<br>
			<textarea id="content" name="content" rows="20" cols="50">Content goes here</textarea></br>
			<input type="submit" name="submit" value="Publish Me!">
		</fieldset>
	</form>
</body>

</html>
