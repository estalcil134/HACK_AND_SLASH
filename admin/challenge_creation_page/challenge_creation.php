<?php
  require "../../resources/general/start.php";
  if ($_SESSION['user-type'] !== "admin")
  { // Redirect if user is not admin
    header("Location: http://" . $_SERVER['SERVER_NAME']);
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hack&amp;/ Challenge Creation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="../../resources/challenge_creation_page/challenge_creation.css" rel="stylesheet" type="text/css"/>
    <link href="../../resources/general/general_content.css" rel="stylesheet" type="text/css"/>
  </head>
  <?php
    // Navigation Bars
    require'../../resources/general/logo_' . $_SESSION['user-type'] . '.html';
    require '../../resources/general/navbar_admin.html';
    require '../../resources/general/navbar_user.html';
  ?>
<div id="body">
  <form id="addForm" method="POST" action="../../resources/general/upload.php" enctype="multipart/form-data">
    <h1>Create a Challenge</h1>
    <div id = "title_name">
      <p class = "title">Challenge Name:</p>
      <input type="text" name="challenge" autocomplete="off" size="50" value="" class = "inputs" id="tutorial" onkeydown = "enter();" onkeyup = "show_question();" required>        
      <input type="submit" value="SUBMIT" id="save" name="submit" />
    </div>
    <div id = "spacer">
      <div id = "question">
        <div class = "space_top set_left">
          <p class = "title eq_width">Description:</p>
          <input type="text" name="description" autocomplete="off" value="" class = "inputs" id="desc" onkeydown = "enter();" onkeyup = "show_question();" required>
        </div>
        <br/>
        <div id = "challenge_upload">
          <p class = "title">Upload your challenge files here: </p>
          <input type="file" name="myFile[]" multiple>
        </div> 
          
        <div id = "multi" class = "space_top">
          <p class = "title">Flag</p>
          <input type="text" name="flag" autocomplete="off" value=""  class = "multi_input inputs" id="flag" onkeydown = "enter();" onkeyup = "show_question();" required>
        </div>
        <br/>
        <br/>
        <h3>Preview:</h3>
        <div id = "out_div">
          <div id = "put_div">
            <output id = "outputter"></output>
          </div>
        </div>
      </div>
    </div>
    <p id = "padding_extra"></p>
    <br>
    <br>
  </form>
</div>
<script type="text/javascript" src="../../resources/jquery/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="../../resources/challenge_creation_page/challenge_creation.js"></script>
<script type="text/javascript" src="../../resources/general/footer.js"></script>
<script type="text/javascript" src="../../resources/general/cookies_enabled.js"></script>
<?php
require '../../resources/general/footer.html';
if (isset($_SERVER['QUERY_STRING']))
{
  $msg = substr($_SERVER['QUERY_STRING'], 1);
  if ($msg == '4')
  {
    echo "<script>alert('Challenge Already Exists!');</script>";
  }
  else if ($msg == '5')
  {
    echo "<script>alert('Challenge Successfully Created!');</script>";
  }
}
?>
