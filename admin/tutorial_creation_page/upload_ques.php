<?php
  session_start();
  // Then create the text file that will be outputted in the challenge landing page.
  $fileNameNew = uniqid('',true).".".$_POST['tutorial'];
  echo($fileNameNew);
  $fileString = $fileNameNew."";
  $challenge = fopen('uploaded_docs/'.$_SESSION['username'].'/'.$fileString}.'html', "w");
  $output_big = "";
  $fileDestination = file_exists("uploaded_docs/username/{$fileString}html");
  if($_POST['question_type'] == "short")
  {
    $output_big = $output_big."QUESTION: ".$_POST['tutorial'].'<br><br><input type="text" autocomplete="off" value="" name="short_ans" class = "inputs" id="user_input" onkeydown = "enter1();"/><br><br><button type = "button" onclick = "show_ans();">SHOW ANSWER</button><br><br><div id = "showanswer">ANSWER: '.$_POST['short_answer'].'</div>';
  }
  else
  {
    $output_big = $output_big."QUESTION: ".$_POST['tutorial'].'<br><div class = "tab" id = "A"><input type="radio" name="mult" value="A" onclick = "show_ans1();"><span onclick = "selectRadio1();">A: '.$_POST['answer1']."</span></div>".'<div class = "tab" id = "B"><input type="radio" name="mult" value="B" onclick = "show_ans1();"><span onclick = "selectRadio1();">B: '.$_POST['answer2']."</span></div>";
    $num = $_POST['num_multi'];
    if($num == 1)
    {
      $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>";
    }
    if($num == 2)
    {
      $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>".'<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: '.$_POST['answer4']."</span></div>";
    }
    if($num == 3)
    {
      $output_big = $output_big.'<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: '.$_POST['answer3']."</span></div>".'<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: '.$_POST['answer4']."</span></div>".'<div class = "tab" id = "E"><input type="radio" name="mult" value="E" onclick = "show_ans1();"><span onclick = "selectRadio1();">E: '.$_POST['answer5']."</span></div>";
    }
    $output_big = $output_big.'<br><br><div id = "showanswer1">ANSWER: '.$_POST['actual_answer_multi'].'</div>';
  }
  fwrite($challenge, $output_big);
  if ($fileDestination)
  {
    echo"works";
  }
  fclose($challenge);
  //header("Location:index.php");


?>

