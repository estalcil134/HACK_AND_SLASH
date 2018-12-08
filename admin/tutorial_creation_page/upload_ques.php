<?php
  session_start();
  $sess = $_SESSION['username'];
  if(!is_dir("uploaded_docs/$sess"))
  {
    mkdir("uploaded_docs/$sess", 0700,true);
  }
  $num_file = count(scandir("uploaded_docs/".$_SESSION['username'])) - 2;
  if($num_file < 21)
  {
    // Then create the text file that will be outputted in the challenge landing page.
    $fileString = str_replace ("\\","_",$_POST['tutorial']);
    $fileString = str_replace ("/","_",$fileString);
    $fileString = str_replace (":","_",$fileString);
    $fileString = str_replace ('"',"_",$fileString);
    $fileString = str_replace ("<","_",$fileString);
    $fileString = str_replace (">","_",$fileString);
    $fileString = str_replace ("|","_",$fileString);
    $fileString = str_replace ("?","_",$fileString.".");

    $challenge = fopen('uploaded_docs/'.$_SESSION['username'].'/'.$fileString.'html', "w");
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
    <header>
        <img id = "logo" src="/resources/general/LOGO.png" alt="HACK AND SLASH LOGO">
      </header>
    <div id="code"><div>';

    $fileDestination = file_exists("uploaded_docs/username/{$fileString}html");
    if($_POST['question_type'] == "short")
    {
      $output_big = $output_big."QUESTION: ".$_POST['tutorial'].'<br><br><input type="text" autocomplete="off" value="" name="short_ans" class = "inputs" id="user_input" onkeydown = "enter1();"/><br><br><button type = "button" onclick = "show_ans();">SHOW ANSWER</button><br><br><div id = "showanswer">ANSWER: '.$_POST['short_answer'].'</div>';
    }
    else
    {
      $output_big = $output_big."QUESTION: ".$_POST['tutorial'].'<br><div class = "m_choice"><div class = "tab" id = "A"><input type="radio" name="mult" value="A" onclick = "show_ans1();"><span onclick = "selectRadio1();">A: '.$_POST['answer1']."</span></div>".'<div class = "tab" id = "B"><input type="radio" name="mult" value="B" onclick = "show_ans1();"><span onclick = "selectRadio1();">B: '.$_POST['answer2']."</span></div>";
      $num = $_POST['num_multiple'];
      if($num == "3")
      {
        $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>";
      }
      if($num == "4")
      {
        $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>".'<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: '.$_POST['answer4']."</span></div>";
      }
      if($num == "5")
      {
        $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>".'<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: '.$_POST['answer4']."</span></div>".'<div class = "tab" id = "E"><input type="radio" name="mult" value="E" onclick = "show_ans1();"><span onclick = "selectRadio1();">E: '.$_POST['answer5']."</span></div>";
      }
      $output_big = $output_big.'</div><br><br><div id = "showanswer1">ANSWER: <span id = "answer">'.$_POST['actual_answer_multi'].'</span></div>';
    }
    $output_big = $output_big.'</div></div><footer><a id = "about" href="<?php echo \'http://\' . $_SERVER[\'SERVER_NAME\'] . \'/about/about.html\'?>">About Page</a></footer><script src="/resources/general/cookies_enabled.js"></script><script src="/resources/jquery/jquery-1.4.3.min.js"></script></script><script src="/resources/general/answer.js"></script></body></html>';
    fwrite($challenge, $output_big);
    if ($fileDestination)
    {
      echo"works";
    }
    fclose($challenge);
  }
  foreach ($_POST as $key => $value) {
    unset($_POST[$key]);
  }
  header("Location:tutor_create.php");


?>

