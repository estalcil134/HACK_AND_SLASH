<?php
  //this php creates based on the admin's question creation, a working question html to be input into the tutorial

  //start the session
  session_start();
  //the admin username
  $sess = $_SESSION['username'];

  //if there is no directory to upload into then create the directory based on that admin's unique username
  if(!is_dir("uploaded_docs/$sess"))
  {
    mkdir("uploaded_docs/$sess", 0700,true);
  }

  $num_file = count(scandir("uploaded_docs/".$_SESSION['username'])) - 2; //number of files within that admin's folder
  
  if($num_file < 21) //if the number of files already in the admin's folder is less than 21(LIMITS TUTORIAL LENGTH TO 20 PAGES)
  {
    //replace any characters in the tutorial title name that aren't allowed in the file structure
    $fileString = str_replace ("\\","_",$_POST['tutorial']);
    $fileString = str_replace ("/","_",$fileString);
    $fileString = str_replace (" ","_",$fileString);
    $fileString = str_replace (":","_",$fileString);
    $fileString = str_replace ('"',"_",$fileString);
    $fileString = str_replace ("<","_",$fileString);
    $fileString = str_replace (">","_",$fileString);
    $fileString = str_replace ("|","_",$fileString);
    $fileString = str_replace ("?","_",$fileString.".");

    //create a new html page for that current question
    $challenge = fopen('uploaded_docs/'.$_SESSION['username'].'/'.$fileString.'html', "w");
    //create the initial start fthat is generic for the creation of the question html
    $output_big = '<!DOCTYPE HTML>
                  <html lang="en">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Tutorial</title>
                    <link href="/resources/general/general_content.css" rel="stylesheet" type="text/css">
                    <link href="/resources/empty_div.css" rel="stylesheet" type="text/css">
                    <link href="/resources/general/general_content.css" rel="stylesheet" type="text/css">
                    <link href="/resources/general/answer.css" rel="stylesheet" type="text/css">
                  </head>
                  <body>
                    <div id="code"><div>';
    $fileDestination = file_exists("uploaded_docs/username/{$fileString}html"); //if the file was created correctly this is true
    
    if($_POST['question_type'] == "short")  //if the question type that will be created is a short answer question
    {
      //add in the short answer html
      $output_big = $output_big."QUESTION: ".$_POST['tutorial'].'<br><br><input type="text" autocomplete="off" value="" name="short_ans" class = "inputs" id="user_input" onkeydown = "enter1();"/><br><br><button type = "button" onclick = "show_ans();">SHOW ANSWER</button><br><br><div id = "showanswer">ANSWER: '.$_POST['short_answer'].'</div>';
    }
    else //if the question type that will be created is a multiple choice type of question
    {
      //add in the multiple choice question html. Starting with two answer since there will be at least two multiple choice answers
      $output_big = $output_big."QUESTION: ".$_POST['tutorial'].'<br><div class = "m_choice"><div class = "tab" id = "A"><input type="radio" name="mult" value="A" onclick = "show_ans1();"><span onclick = "selectRadio1();">A: '.$_POST['answer1']."</span></div>".'<div class = "tab" id = "B"><input type="radio" name="mult" value="B" onclick = "show_ans1();"><span onclick = "selectRadio1();">B: '.$_POST['answer2']."</span></div>";
      
      $num = $_POST['num_multiple'];
      
      if($num == "3") //if the number of answers is 3
      {
        $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>";
      }
      if($num == "4") //if the number of answers is 4
      {
        $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>".'<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: '.$_POST['answer4']."</span></div>";
      }
      if($num == "5") //if the number of answers is 5
      {
        $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>".'<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: '.$_POST['answer4']."</span></div>".'<div class = "tab" id = "E"><input type="radio" name="mult" value="E" onclick = "show_ans1();"><span onclick = "selectRadio1();">E: '.$_POST['answer5']."</span></div>";
      }
      $output_big = $output_big.'</div><br><br><div id = "showanswer1">ANSWER: <span id = "answer">'.$_POST['actual_answer_multi'].'</span></div>';
    }
    
    //add in the ending html for the question html
    $output_big = $output_big.'</div></div><script src="/resources/general/cookies_enabled.js"></script><script src="/resources/jquery/jquery-1.4.3.min.js"></script></script><script src="/resources/general/answer.js"></script></body></html>';
    
    fwrite($challenge, $output_big); //write the actual data of the question html content to the newly created question file
    if ($fileDestination) //if the question creation file was created
    {
      echo"works";
    }
    fclose($challenge); //close the question file
  }
  //unset all of the post to ensure no question creation propogates
  foreach ($_POST as $key => $value) {
    unset($_POST[$key]);
  }
  //redirect to the tutorial creation page
  header("Location:tutor_create.php");


?>

