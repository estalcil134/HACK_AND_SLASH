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
    <link href="tutorial_creation.css" rel="stylesheet" type="text/css"/>
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
    <form id="addForm" action="" target = "hidden-iframe" method="POST" enctype="multipart/form-data" name="addForm">
      <div id = "title_name">
        <p class = "title">Tutorial Name:</p>
        <input type="text" autocomplete="off" size="50" value="" name="tutorial" class = "inputs" id="tutorial" onkeydown = "enter();"/>
        <input type="submit" value="SUBMIT" id="save" name="submit" />
      </div>
      <div id="buttonz">
        <button class = "button_choice" id = "tutorial_button" type = "button" onclick = "tutorial_create();">Tutorial</button>
        <button class = "button_choice" id = "question_button" type = "button" onclick = "question();">Question</button>
      </div>
      <div id = "spacer">
      <ul id = "tutorial_creator">
        <li id = "button_style">
        </li>
        <li id = "tutorial_upload">
          <p class = "title">Upload a Microsoft Word Document or Microsoft Powerpoint</p>
          <br>
          <br>
          <br>
          <iframe name="hidden-iframe" style="display: none;">
            <?php
            if(!file_exists("uploaded_docs/username"))
              {
                mkdir("uploaded_docs/username", 0700);
              }
              if(isset($_POST['submit'])) {
                $file = $_FILES['file'];

                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];
                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('html','htm');
                if(in_array($fileActualExt,$allowed)) {
                  if($fileError === 0) {
                    if($fileSize < 10000000) {
                      $fileNameNew = uniqid('',true).".".$fileActualExt;
                      $fileDestination = 'uploaded_docs/username/'.$fileNameNew;
                      move_uploaded_file($fileTmpName,$fileDestination);
                    }
                    $error_type = "1";
                  }
                  $error_type = "2";
                }
                $error_type = "3";
            }
            ?>
            </iframe>
        
          <input type="file" name="file" id = "file" >
          <button type = "submit" name = "submit" onclick="file_there();">UPLOAD</button> 
          <br>
        </li> 
        
        
        
        <li id = "question">
          <div>
          </div>
          <div class = "space_top set_left">
            <p class = "title eq_width">Question:</p>
            <input type="text" autocomplete="off" value="" name="tutorial" class = "inputs" id="question_input" onkeydown = "enter();" onkeyup = "show_question();"/>
          </div>
          
          <div class = "space_top">
            <button type="button" autocomplete="off" name="answer" value="Short Answer" class = "answer" id = "short_ans" onclick="short();">Short Answer</button>
              <button type="button" name="answer" value="Multiple Choice" class = "answer" id = "multi_ans" onclick="multi();">Multiple Choice</button>
          </div>
          
          <div id = "short" class = "space_top set_left">
            <p class = "title eq_width">Short Answer:</p>
            <input type="text" autocomplete="off" value="" name="tutorial" class = "inputs" id="answer_input_short" onkeydown = "enter();" onkeyup = "show_question();"/>
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
              <input type="text" autocomplete="off" value="" name="tutorial" class = "multi_input inputs" id="one" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "second">
              <p class = "title eq_width">B:</p>
              <input type="text" autocomplete="off" value="" name="tutorial" class = "multi_input inputs" id="two" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "third">
              <p class = "title eq_width">C:</p>
              <input type="text" autocomplete="off" value="" name="tutorial" class = "multi_input inputs" id="three" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "fourth">
              <p class = "title eq_width">D:</p>
              <input type="text" autocomplete="off" value="" name="tutorial" class = "multi_input inputs" id="four" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "fifth">
              <p class = "title eq_width">E:</p>
              <input type="text" autocomplete="off" value="" name="tutorial" class = "multi_input inputs" id="five" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
          </div>
          <div id = "out_div">
            <div id = "put_div">
              <output id = "outputter"></output>
            </div>
          </div>
        </li>
      </ul>
      </div>
      <p id = "padding_extra"></p>
      <br>
      <br>
      <?php
      // Read directory, spit out links
      if ($handle = opendir('uploaded_docs/username/')) {
          $count = 0;
          while (false !== ($entry = readdir($handle))) {
              if ($entry != "." && $entry != "..") {
                  echo '<div id="div'.$count.'" class = "display_frame" ondrop="drop(event)" ondragover="allowDrop(event)"><iframe src = "uploaded_docs/username/'.$entry.'" id="drag'.$count.'" width="100%" height="100%" draggable="true" ondragstart="drag(event)"></iframe></div><br>';
                $count++;
              }
          }
          closedir($handle);
      }
      ?>
    </form> 
    <footer>
      <a id = "about" href="#">About Page</a>
	  </footer>
<!--
    <script type="text/javascript" src = "../../resources/jquery/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="../../resources/tutorial_creation_page/tutorial_creation.js"></script>
-->
    <script type="text/javascript" src = "jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="tutorial_creation.js"></script>

    </body>
</html>