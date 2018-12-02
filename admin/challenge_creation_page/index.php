<!--
<?php 
  foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
?>
-->

<!DOCTYPE html>
<html>
  <head>
    <title>Hack&/</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>    
<!--
    <link href="../../resources/tutorial_creation_page/tutorial_creation.css" rel="stylesheet" type="text/css"/>
    <link href="../../resources/general/general_content.css" rel="stylesheet" type="text/css"/>
-->
    <link href="challenge_creation.css" rel="stylesheet" type="text/css"/>
    <link href="general_content.css" rel="stylesheet" type="text/css"/>
  </head>
  <body onload="disappearButton();">
    <header>
<!--		  <a id="home" class="left" href="#"><img id = "logo" src="../../resources/general/LOGO.png" alt="HACK AND SLASH LOGO"></a>-->
      <a id="home" class="left" href="#"><img id = "logo" src="LOGO.png" alt="HACK AND SLASH LOGO"></a>
		  <div id="user_info" class="right">
		    <div id="profile_pic_user">
        </div>
			 <p id = "username" class="right">INSERT USERNAME</p>
		  </div>
	   </header>
    <nav>
      <ul id = "naver">
	  	  <li class="nav left"><a class="left nav" href="#">Tutorial Creation</a></li>
        <li class="nav left"><a class="left nav" href="#">Tutorial Deletion</a></li>
	  	  <li class="nav left"><a class="left nav" href="#">Challenge Creation</a></li>
        <li class="nav left"><a class="left nav" href="#">Challenge Deletion</a></li>
	  	  <li class="nav right" id = "nav_right"><a class="right nav" href="#">Logout</a></li>
	    </ul>
    </nav>
<!--    onsubmit="return validate(this);"-->
    <form id="addForm" onsubmit="" enctype="multipart/form-data">
      <div id = "title_name">
        <p class = "title">Challenge Name:</p>
        <input type="text" autocomplete="off" size="50" value="" class = "inputs" id="tutorial" onkeydown = "enter();"/>
        <input type="submit" value="SUBMIT" id="save" name="submit" />
      </div>
      <div id = "spacer">
        <div id = "question">
          <div class = "space_top set_left">
            <p class = "title eq_width">Question:</p>
            <input type="text" autocomplete="off" value="" class = "inputs" id="question_input" onkeydown = "enter();" onkeyup = "show_question();"/>
          </div>
            
          <div id = "multi" class = "space_top">
            <p class = "title">Number of Answers:</p>
            <select id = "quest_num" onchange="num_multi(); show_question();">
              <option value="two">2</option>
              <option value="three">3</option>
              <option value="four">4</option>
              <option value="five">5</option>
            </select>
            <div id = "first" class = "space_top">
              <p class = "title eq_width">A:</p>
              <input type="text" autocomplete="off" value=""  class = "multi_input inputs" id="one" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "second">
              <p class = "title eq_width">B:</p>
              <input type="text" autocomplete="off" value="" class = "multi_input inputs" id="two" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "third">
              <p class = "title eq_width">C:</p>
              <input type="text" autocomplete="off" value=""  class = "multi_input inputs" id="three" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "fourth">
              <p class = "title eq_width">D:</p>
              <input type="text" autocomplete="off" value=""  class = "multi_input inputs" id="four" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "fifth">
              <p class = "title eq_width">E:</p>
              <input type="text" autocomplete="off" value=""  class = "multi_input inputs" id="five" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
          </div>
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
    <footer>
      <a id = "about" href="#">About Page</a>
	  </footer>
<!--
    <script type="text/javascript" src = "../../resources/jquery/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="../../resources/tutorial_creation_page/tutorial_creation.js"></script>
-->
    <script type="text/javascript" src = "jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="challenge_creation.js"></script>

    </body>
</html>