<?php
  session_start();
  echo($_POST['final_tutorial_title']);
  if($_POST['final_tutorial_title'] == "")
  {
    unlink('uploaded_docs/'.$_SESSION['username'].'/'.$_POST['filename']);
    header("Location:tutor_create.php");
  }
  else
  {
    if(count(scandir("uploaded_docs/".$_SESSION['username'])) - 2 != 0)
    {
      $fileString = $_POST['final_tutorial_title'];
      $fileString = str_replace ("\\","_",$_POST['final_tutorial_title']);
      $fileString = str_replace ("/","_",$fileString);
      $fileString = str_replace (":","_",$fileString);
      $fileString = str_replace ('"',"_",$fileString);
      $fileString = str_replace ("<","_",$fileString);
      $fileString = str_replace (">","_",$fileString);
      $fileString = str_replace ("|","_",$fileString);
      $fileString = str_replace ("?","_",$fileString);
      if(!is_dir("../../user/tutorials/".$fileString))
      { 
        mkdir("../../user/tutorials/".$fileString, 0700, true);
        // Add entry in database
        require "../../resources/general/connect.php";
        $request = $connected->prepare("INSERT INTO tutorials (creater_id, name, file_path) VALUES ((SELECT userid FROM users WHERE username = '" . $_SESSION['username'] . "'), :t_n, :f_p)");
        $request->execute(array(':t_n'=>$fileString, ':f_p'=>"../../user/tutorials/".$fileString. "/0.html"));
        if ($handle = opendir("uploaded_docs/".$_SESSION['username'])) {
        $count = 0;
        $num_file = count(scandir("uploaded_docs/".$_SESSION['username'])) - 2;
        while (false !== ($entry = readdir($handle))) 
        {        
          if ($entry != "." && $entry != "..") 
          {            
            $challenge = fopen($_SERVER['DOCUMENT_ROOT']."/user/tutorials/".$fileString.'/'.$count.'.html', "w");
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
                  <img id = "logo" src="/resources/general/LOGO.png" alt="HACK AND SLASH LOGO" onclick="location.href=\'/index.php\'">
                </header>
              <div id="code">';
              if($count != 0)
              {
                $output_big = $output_big.'<button class="buttoff b_right" onclick="location.href=\''.($count-1).'.html\'">BACK</button>';
              }
              else
              {
                $output_big = $output_big.'<button class="buttoff b_right" onclick=\'' . 'location.href="../tutorial_landing_page.php"' . '\'>BACK</button>';
              }
              $output_big = $output_big.'<iframe width = "100%" height = "100%" src = "'.$count.'_page.html"></iframe>';
              if($count != ($num_file-1))
              {
                $output_big = $output_big.'<button class="buttoff b_left" type="button" onclick="'. "location.href='".($count+1).".html'" . '">NEXT</button>';
              }
              else
              {
                $output_big = $output_big.'<form action="../../../admin/tutorial_creation_page/check.php" method="POST"><input name="fin" type="hidden" value="' . $fileString . '"><button class="buttoff b_left" type="submit">END</button></form>';
              }
              $output_big = $output_big.'</div><button id="return" type="button" onclick="location.href=\'../tutorial_landing_page.php\'">Return</button><footer><a id = "about" href="http://' . $_SERVER['SERVER_NAME'] . '/about/about.html">About Page</a></footer><script src="/resources/general/cookies_enabled.js"></script><script src="/resources/jquery/jquery-1.4.3.min.js"></script></script><script src="/resources/general/answer.js"></script></body></html>';
              fwrite($challenge, $output_big);
              fclose($challenge);
              $count++;
            }
          }
          closedir($handle);
        }
        $count = 0;
        $fileDestination = $_SERVER['DOCUMENT_ROOT']."/user/tutorials/".$fileString.'/';
          echo("<br>");
        foreach($_POST as $key => $value) {
            if($key != 'final_tutorial_title' && $key != 'filename')
            {
              echo("key ".$key); 
              echo("<br>");
              echo("val ".$value); 
              echo("<br>");
              echo("<br>");
              echo("<br>");
              $newKey = substr_replace($key,".html",strlen($key)-5,5);
              echo("<br>");
             $file = file_get_contents('uploaded_docs/'.$_SESSION['username'].'/'.$newKey); 
              rename ('uploaded_docs/'.$_SESSION['username'].'/'.$newKey, $fileDestination.$value.'_page.html');
            }
        }
      } 
      $error_type = 0;
    }
    else
    {
      $error_type = "7";
    }
    foreach ($_POST as $key => $value) {
      unset($_POST[$key]);
    }
    if($error_type)
    {
      header("Location: tutor_create.php?=$error_type");
    }
    else
    {
      header("Location: tutor_create.php");
    }
    exit();
  }
?>