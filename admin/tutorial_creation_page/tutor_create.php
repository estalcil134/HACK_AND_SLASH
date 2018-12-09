<?php
require "../../resources/general/start.php";
if ($_SESSION["user-type"] != "admin")
{ // If it is an user, redirect to the login page to determine what to do
  header("Location: http://" . $_SERVER["SERVER_NAME"]);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hack&amp;/ Tutorial Creation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="/resources/tutorial_creation_page/tutorial_creation.css" rel="stylesheet" type="text/css"/>
    <link href="/resources/general/general_content.css" rel="stylesheet" type="text/css"/>
  </head>
<?php
  require "../../resources/general/logo_user.html";
  require "../../resources/general/navbar_admin.html";
  require "../../resources/general/navbar_user.html";
?>
    <div id="overlay" onclick = "off();">
      <div id = "preview_look_good">
        <p id = "para_preview">Preview</p>
        <iframe src = "" id = "preview" width = "100%" height = "100%">

        </iframe>
      </div>
    </div>
    <br>
  <br>
  <div id="body">
    <div id="addForm">

      <br>
      <div id="buttonz">
        <button class = "button_choice" id = "tutorial_button" type = "button" onclick = "tutorial_create();">Tutorial</button>
        <button class = "button_choice" id = "question_button" type = "button" onclick = "question();">Question</button>
      </div>
      <div id = "spacer">
      <ul id = "tutorial_creator">
        <li id = "button_style">
        </li>
        <li id = "tutorial_upload">
          <form id="form_tutor" action="upload.php" method="POST" enctype="multipart/form-data" name="addForm">
            <br>
            <p class = "title space_top">Upload a HTML Document</p>
            <br>
            <br>
            <p class = "info">If you don't know how to write html, it's fine! Just go to your Microsoft Word Document, and click "Save As", then "Browse". From there you will see a window pop up. In this window click on the "Save as Type" bar and choose either "Web Page, Filtered (*.htm;*.html)" or "Web Page (*.htm;*.html)". THen find your file destination you wish to save this new html at and you're done. Now you can upload html to our tutorial creator! If you already have an html
            file then you're good to go!</p>

            <?php
              if($_SERVER['QUERY_STRING'] && $_SERVER['QUERY_STRING'] != '=7')
              {
                echo('<p class = "alertz">');
              }
              if($_SERVER['QUERY_STRING'] == '=1')
              {
                echo('File Uploaded Successfully!');
              }
              else if($_SERVER['QUERY_STRING'] == '=2')
              {
                echo('File Size Too Large.');
              }
              else if($_SERVER['QUERY_STRING'] == '=3')
              {
                echo('There was an error when uploading your file.');
              }
              else if($_SERVER['QUERY_STRING'] == '=4')
              {
                echo('You cannot upload this file type.');
              }
              if($_SERVER['QUERY_STRING'] && $_SERVER['QUERY_STRING'] != '=7')
              {
                echo('</p>');
              }
            ?>
            <input type="file" name="file" id = "file">
            <button type = "submit" class = "answer click" name = "submit" onclick="file_there();">UPLOAD</button>
            <br>
          </form>
        </li>

        <li id = "question">


          <form id="form_ques" action="upload_ques.php" method="POST" enctype="multipart/form-data" name="addForm">
          <br>
          <p class="info">
            To upload a question please enter the question title, specify type of question and input answer before uploading.
            There is a preview box down below for you to see how the question will appear!
          </p>
          <div class = "space_top set_left">
            <p class = "title eq_width">Question:</p>
            <input type="text" autocomplete="off" value="" name="tutorial" class = "inputs" id="question_input" onkeydown = "enter();" onkeyup = "show_question();" required>
          </div>

          <div class = "space_top">
            <button type="button" autocomplete="off" name="answer" value="Short Answer" class = "answer" id = "short_ans" onclick="short();">Short Answer</button>
              <button type="button" name="answer" value="Multiple Choice" class = "answer" id = "multi_ans" onclick="multi();">Multiple Choice</button>
          </div>

          <div id = "short" class = "space_top set_left">
            <p class = "title eq_width">Answer:</p>
            <input type="text" autocomplete="off" value="" name="short_answer" class = "inputs" id="answer_input_short" onkeydown = "enter();" onkeyup = "show_question();" required>
          </div>

          <div id = "multi" class = "space_top">
            <p class = "title">Number of Answers:</p>
            <select id = "quest_num" onchange="num_multi(); show_question();">
              <option value="two">2</option>
              <option value="three">3</option>
              <option value="four">4</option>
              <option value="five">5</option>
            </select>
            <div id = "ans_text">
              <p class = "title eq_width" id = "answer_text">SET Answer</p>
            </div>
            <div id = "first">
              <input type="radio" name="mult_inp" value="A_1" onclick = "set_answer();">
              <p class = "title eq_width" onclick="selectRadio();">A:</p>
              <input type="text" autocomplete="off" value="" name="answer1" class = "multi_input inputs" id="one" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "second">
              <input type="radio" name="mult_inp" value="B_1" onclick = "set_answer();">
              <p class = "title eq_width" onclick="selectRadio();">B:</p>
              <input type="text" autocomplete="off" value="" name="answer2" class = "multi_input inputs" id="two" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "third">
              <input type="radio" name="mult_inp" value="C_1" onclick = "set_answer();">
              <p class = "title eq_width" onclick="selectRadio();">C:</p>
              <input type="text" autocomplete="off" value="" name="answer3" class = "multi_input inputs" id="three" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "fourth">
              <input type="radio" name="mult_inp" value="D_1" onclick = "set_answer();">
              <p class = "title eq_width" onclick="selectRadio();">D:</p>
              <input type="text" autocomplete="off" value="" name="answer4" class = "multi_input inputs" id="four" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
            <div id = "fifth">
              <input type="radio" name="mult_inp" value="E_1" onclick = "set_answer();">
              <p class = "title eq_width" onclick="selectRadio();">E:</p>
              <input type="text" autocomplete="off" value="" name="answer5" class = "multi_input inputs" id="five" onkeydown = "enter();" onkeyup = "show_question();"/>
            </div>
          </div>
          <div id = "out_div">
            <div id = "put_div">
              <div id = "outputter"></div>
            </div>
          </div>
          <input type ="hidden" name = "question_type" value = "">
          <input type ="hidden" name = "actual_answer_multi" value = "">
          <input type ="hidden" name = "actual_answer_short" value = "">
          <input type ="hidden" name = "num_multiple" value = "">
          <div id = "create_ques">
            <button class = "answer click" id = "ques_submit" type = "submit">CREATE QUESTION PAGE</button>
          </div>
          </form>
        </li>
      </ul>
      </div>
      <p class="info">
        Please ensure all the files/questions are in the correct and final order before submitting the tutorial!
      </p>
      <div id = "tutor_out">
      <form action="delete.php" method="POST" enctype="multipart/form-data" name="addForm">
        <div id="overlay2" onclick = "off2();">
          <div id = "preview_look_good2">
            <div id="inner">
              <label class="left" for="final_title" id = "title_para">Tutorial Title</label>
              <input class="left clear_left" id = "final_title" type = "text" name = "final_tutorial_title" value = "" minlength="1" required/>
            </div>
          </div>
        </div>
        <input type ="hidden" name = "filename" value = "">
        <?php
        // Read directory, spit out links
        $sess = $_SESSION['username'];
        if(!is_dir("uploaded_docs/$sess"))
        {
          mkdir("uploaded_docs/$sess", 0700,true);
        }
        if ($handle = opendir("uploaded_docs/$sess/")) {
            $count = 0;
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo '<div class = "parental" id="'.$count.'"><p class = "number">'.($count+1).'</p><div id="div'.$count.'" class = "display_frame" ondrop="drop(event);" draggable="false" ondragover="allowDrop(event);"><div id = "inside_div'.$count.'" class = "in_div" draggable="true" ondragstart="find_parent(event); drag(event);" onclick = "on(event);"><button class = "click delete" id = "'.$entry.'" onclick = "setFile();" type = "submit">DELETE</button><input type ="hidden" name = "'.$entry.'" value = "'.$count.'"><div id = "'.$entry.'" class = "file_show">(Click to Preview) '.$entry.'</div><iframe src = "uploaded_docs/'.$_SESSION['username'].'/'.$entry.'" id="drag'.$count.'" class = "small_frame" contenteditable = "false"></iframe></div></div></div>';
                  $count++;
                }
            }
            closedir($handle);
        }
        ?>
      </form>
      </div>
      <?php
        if($_SERVER['QUERY_STRING'] == '=7')
        {
            echo('<p class = "alertz">You must create a page for your tutorial before submitting!</p>');
        }
      ?>
      <div id = "title_name">
        <p  id = "final_words">Click "Submit" when you are done making the Tutorial</p>
       <button class = "answer" id="save" onclick = "on2();">SUBMIT</button>
        </div>
    </div>
  </div>
    <script type="text/javascript" src = "/resources/jquery/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="/resources/tutorial_creation_page/tutorial_creation.js"></script>
    <?php require "../../resources/general/footer.html"; ?>
