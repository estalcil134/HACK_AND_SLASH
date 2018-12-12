<?php
  //this page creates tutorials for the admins

  //ensure the scurity of the page so that only admins have access
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
    <link href="../../resources/tutorial_creation_page/tutorial_creation.css" rel="stylesheet" type="text/css"/>
    <link href="../../resources/general/general_content.css" rel="stylesheet" type="text/css"/>
  </head>
    <?php
      //add in the generic logo, navbar, and logout
      require "../../resources/general/logo_user.html";
      require "../../resources/general/navbar_admin.html";
      require "../../resources/general/navbar_user.html";
    ?>
    <!--This is the overlay hidden iframe that will display previews of tutorial page html for the admin-->
    <div id="overlay" onclick = "off();">
      <div id = "preview_look_good">
        <p id = "para_preview">Preview</p>
        <iframe src = "" id = "preview" width = "100%" height = "100%"></iframe>
      </div>
    </div>
    <br>
    <br>
    <!--the main part of the page-->
    <div id="body">
      <div id="addForm">
        <br>
        
        <!-- These are the buttons to choose tutorial upload and question creation -->
        <div id="buttonz">
          <button class = "button_choice" id = "tutorial_button" type = "button" onclick = "tutorial_create();">Tutorial</button>
          <button class = "button_choice" id = "question_button" type = "button" onclick = "question();">Question</button>
        </div>
        
        
        <div id = "spacer">
          <!-- this is the admin's individual tutorial upload and question part of the page -->
          <ul id = "tutorial_creator">
            <li id = "button_style">
            </li>
            
            <!-- the html upload part of the website -->
            <li id = "tutorial_upload">
              <form id="form_tutor" action="upload.php" method="POST" enctype="multipart/form-data" name="addForm">
                <br>
                <p class = "title space_top">Upload a HTML Document</p>
                <br>
                <br>
                <!-- information for how to and what should be uploaded-->
                <p class = "info">If you don't know how to write html, it's fine! Just go to your Microsoft Word Document, and click "Save As", then "Browse". From there you will see a window pop up. In this window click on the "Save as Type" bar and choose either "Web Page, Filtered (*.htm;*.html)" or "Web Page (*.htm;*.html)". Then find your file destination you wish to save this new html at and you're done. Now you can upload html to our tutorial creator! If you already have an html
                file then you can upload and are good to go!</p>

                <?php
                  //information given to the admin on upload status
                  if($_SERVER['QUERY_STRING'] && $_SERVER['QUERY_STRING'] != '=7')
                  {
                    echo('<p class = "alertz">');
                  }
                  if($_SERVER['QUERY_STRING'] == '=1') //file uploaded successfully
                  {
                    echo('File Uploaded Successfully!');
                  }
                  else if($_SERVER['QUERY_STRING'] == '=2') //file uploaded was too large
                  {
                    echo('File Size Too Large.');
                  }
                  else if($_SERVER['QUERY_STRING'] == '=3') //error in file upload
                  {
                    echo('There was an error when uploading your file.');
                  }
                  else if($_SERVER['QUERY_STRING'] == '=4') //this file type can't be uploaded
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

            <!-- the question creation part of the website -->
            <li id = "question">
              <form id="form_ques" action="upload_ques.php" method="POST" enctype="multipart/form-data" name="addForm">
                <br>
                <!-- information on how to create a question -->
                <p class="info">
                  To upload a question please enter the question title, specify type of question and input answer before uploading.
                  There is a preview box down below for you to see how the question will appear!
                </p>
                
                <!-- the question that is being asked/created -->
                <div class = "space_top set_left">
                  <p class = "title eq_width">Question:</p>
                  <input type="text" autocomplete="off" value="" name="tutorial" class = "inputs" id="question_input" onkeydown = "enter(event);" onkeyup = "show_question(event);" required>
                </div>
                
                <!-- the buttons to choose if the admin wants to create a multiple choice question or a short answer question -->
                <div class = "space_top">
                  <button type="button" autocomplete="off" name="answer" value="Short Answer" class = "answer" id = "short_ans" onclick="short();">Short Answer</button>
                  <button type="button" name="answer" value="Multiple Choice" class = "answer" id = "multi_ans" onclick="multi();">Multiple Choice</button>
                </div>

                <!-- the short answer to the question -->
                <div id = "short" class = "space_top set_left">
                  <p class = "title eq_width">Answer:</p>
                  <input type="text" autocomplete="off" value="" name="short_answer" class = "inputs" id="answer_input_short" onkeydown = "enter(event);" onkeyup = "show_question(event);" required>
                </div>

                <!-- the smultiple choice answers to the question -->
                <div id = "multi" class = "space_top">
                  <p class = "title">Number of Answers:</p>
                  <!-- choose the number from 2 to 5 of answers for the multiple choice question -->
                  <select id = "quest_num" onchange="num_multi(); show_question(event);">
                    <option value="two">2</option>
                    <option value="three">3</option>
                    <option value="four">4</option>
                    <option value="five">5</option>
                  </select>
                  <div id = "ans_text">
                    <p class = "title eq_width" id = "answer_text">SET Answer</p>
                  </div>
                  
                  <!-- the first answer A -->
                  <div id = "first">
                    <input type="radio" name="mult_inp" value="A_1" onclick = "set_answer(event);">
                    <p class = "title eq_width" onclick="selectRadio(event);">A:</p>
                    <input type="text" autocomplete="off" value="" name="answer1" class = "multi_input inputs" id="one" onkeydown = "enter(event);" onkeyup = "show_question(event);"/>
                  </div>
                  <!-- the second answer B -->
                  <div id = "second">
                    <input type="radio" name="mult_inp" value="B_1" onclick = "set_answer(event);">
                    <p class = "title eq_width" onclick="selectRadio(event);">B:</p>
                    <input type="text" autocomplete="off" value="" name="answer2" class = "multi_input inputs" id="two" onkeydown = "enter(event);" onkeyup = "show_question(event);"/>
                  </div>
                  <!-- the third answer C -->
                  <div id = "third">
                    <input type="radio" name="mult_inp" value="C_1" onclick = "set_answer(event);">
                    <p class = "title eq_width" onclick="selectRadio(event);">C:</p>
                    <input type="text" autocomplete="off" value="" name="answer3" class = "multi_input inputs" id="three" onkeydown = "enter(event);" onkeyup = "show_question(event);"/>
                  </div>
                  <!-- the fourth answer D -->
                  <div id = "fourth">
                    <input type="radio" name="mult_inp" value="D_1" onclick = "set_answer(event);">
                    <p class = "title eq_width" onclick="selectRadio(event);">D:</p>
                    <input type="text" autocomplete="off" value="" name="answer4" class = "multi_input inputs" id="four" onkeydown = "enter(event);" onkeyup = "show_question(event);"/>
                  </div>
                  <!-- the fifth answer E -->
                  <div id = "fifth">
                    <input type="radio" name="mult_inp" value="E_1" onclick = "set_answer(event);">
                    <p class = "title eq_width" onclick="selectRadio(event);">E:</p>
                    <input type="text" autocomplete="off" value="" name="answer5" class = "multi_input inputs" id="five" onkeydown = "enter(event);" onkeyup = "show_question(event);"/>
                  </div>
                </div>
                
                <!-- this is the output div where the demo of the question is shown -->
                <div id = "out_div">
                  <div id = "put_div">
                    <div id = "outputter"></div>
                  </div>
                </div>
                
                <!-- hidden input to be posted if a question is to be created -->
                <input type ="hidden" name = "question_type" value = "">
                <input type ="hidden" name = "actual_answer_multi" value = "">
                <input type ="hidden" name = "actual_answer_short" value = "">
                <input type ="hidden" name = "num_multiple" value = "">
                
                <!-- finally create the question button -->
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
        
        <!-- this div shows what tutorial files have already been created/uploaded -->
        <div id = "tutor_out">
          <form action="delete.php" method="POST" enctype="multipart/form-data" name="addForm">
            
            <!--this div is what is displayed when the admin is finished making the tutorial. This is where they input the tutorial name -->
            <div id="overlay2" onclick = "off2(event);">
              <div id = "preview_look_good2">
                <div id="inner">
                  <label class="left" for="final_title" id = "title_para">Tutorial Title</label>
                  <input class="left clear_left" id = "final_title" type = "text" name = "final_tutorial_title" value = "" minlength="1"/>
                </div>
              </div>
            </div>
            
            <input type ="hidden" name = "filename" value = "">
            
            <!-- this php goes through all of the files currently in the current admin's directory and displays them for that admin to be deleted, previewed or reordered -->
            <?php
              $sess = $_SESSION['username'];
              if(!is_dir("uploaded_docs/$sess"))
              {
                mkdir("uploaded_docs/$sess", 0700,true);
              }
              if ($handle = opendir("uploaded_docs/$sess/")) 
              {
                $count = 0;
                while (false !== ($entry = readdir($handle))) 
                {
                  if ($entry != "." && $entry != "..") 
                  {
                    echo '<div class = "parental" id="'.$count.'"><p class = "number">'.($count+1).'</p><div id="div'.$count.'" class = "display_frame" ondrop="drop(event);" draggable="false" ondragover="allowDrop(event);"><div id = "inside_div'.$count.'" class = "in_div" draggable="true" ondragstart="find_parent(event); drag(event);" onclick = "on(event);"><button class = "click delete" id = "'.$entry.'" onclick = "setFile(event);" type = "submit">DELETE</button><input type ="hidden" name = "'.$entry.'" value = "'.$count.'"><div id = "'.$entry.'" class = "file_show">(Click to Preview) '.$entry.'</div><iframe src = "uploaded_docs/'.$_SESSION['username'].'/'.$entry.'" id="drag'.$count.'" class = "small_frame" contenteditable = "false"></iframe></div></div></div>';
                    $count++;
                  }
                }
                closedir($handle);
              }
            ?>
          </form>
        </div>
        
        <!-- this displays if there are no files to be uploaded but the admin tried to make a tutorial anyway -->
        <?php
          if($_SERVER['QUERY_STRING'] == '=7')
          {
            echo('<p class = "alertz">You must create a page for your tutorial before submitting!</p>');
          }
        ?>
        
        <!-- what to click when the admin is done creating their tutorial -->
        <div id = "title_name">
          <p  id = "final_words">Click "Submit" when you are done making the Tutorial</p>
          <button class = "answer" id="save" onclick = "on2();">SUBMIT</button>
        </div>
    </div>
  </div>
<!-- include the jquery and javascript needed to run this site -->
<script type="text/javascript" src = "../../resources/jquery/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="../../resources/tutorial_creation_page/tutorial_creation.js"></script>
<!-- adds in the footer and end to the html -->
<?php require "../../resources/general/footer.html"; ?>
