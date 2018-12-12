<?php
  //start the session in order to get the username of the admin
  session_start();
  
  //if the tutorial file is to be deleted
  if($_POST['final_tutorial_title'] == "")
  {
    unlink('uploaded_docs/'.$_SESSION['username'].'/'.$_POST['filename']); //unlink that tutorial file
    header("Location:tutor_create.php"); //redirect to the tutorial creation
  }
  else //if the tutorial is to be finally uploaded
  {
    if(count(scandir("uploaded_docs/".$_SESSION['username'])) - 2 != 0) //if there are actually any files to upload
    {
      //replace any characters in the tutorial title name that aren't allowed in the file structure
      $fileString = $_POST['final_tutorial_title'];
      $fileString = str_replace ("\\","_",$_POST['final_tutorial_title']);
      $fileString = str_replace ("/","_",$fileString);
      $fileString = str_replace (":","_",$fileString);
      $fileString = str_replace ('"',"_",$fileString);
      $fileString = str_replace ("<","_",$fileString);
      $fileString = str_replace (">","_",$fileString);
      $fileString = str_replace ("|","_",$fileString);
      $fileString = str_replace ("?","_",$fileString);
      $fileString = str_replace (" ","_",$fileString);
      
      if(!is_dir("../../user/tutorials/".$fileString)) //if there is not already a directory of that tutorial
      { 
        mkdir("../../user/tutorials/".$fileString, 0700, true); //make the directory to put the tutorial files into
        
        // Add entry in database
        require "../../resources/general/connect.php";
        $request = $connected->prepare("INSERT INTO tutorials (creater_id, name, file_path) VALUES ((SELECT userid FROM users WHERE username = '" . $_SESSION['username'] . "'), :t_n, :f_p)");
        $request->execute(array(':t_n'=>$fileString, ':f_p'=>"../../user/tutorials/".$fileString. "/0.html"));
        
        //if the handling of the opening of the admin's directory works
        if ($handle = opendir("uploaded_docs/".$_SESSION['username'])) 
        {
          $count = 0;
          $num_file = count(scandir("uploaded_docs/".$_SESSION['username'])) - 2;
          
          //go through all of the files within the directory that will be transferred
          while (false !== ($entry = readdir($handle))) 
          {        
            if ($entry != "." && $entry != "..") 
            {         
              //create files in the tutorial directory that will handle all of the transitions and html of the tutorial files the admin has already created
              
              $challenge = fopen($_SERVER['DOCUMENT_ROOT']."/user/tutorials/".$fileString.'/'.$count.'.html', "w"); //create the new template html of the tutorial
              //add in the start of the generic template
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
              
                if($count != 0) //if the page being created is not the first created then link the back button to the previous number page of the tutorial
                {
                  $output_big = $output_big.'<button class="buttoff b_right" onclick="location.href=\''.($count-1).'.html\'">BACK</button>';
                }
                else //if the page being created is the first page then the back button goes to the general tutorial page
                {
                  $output_big = $output_big.'<button class="buttoff b_right" onclick=\'' . 'location.href="../tutorial_landing_page.php"' . '\'>BACK</button>';
                }
              
                //insert the iframe linked to that numberth page for the html to be displayed in the tutorial
                $output_big = $output_big.'<iframe width = "100%" height = "100%" src = "'.$count.'_page.html"></iframe>';
              
                if($count != ($num_file-1)) //if the page being created is not the last button then the next button is linked to the next number page in the tutorial
                {
                  $output_big = $output_big.'<button class="buttoff b_left" type="button" onclick="'. "location.href='".($count+1).".html'" . '">NEXT</button>';
                }
                else //if the page being created is the last then create the button that links to the general tutorial page and completes the tutorial
                {
                  $output_big = $output_big.'<form action="../../../admin/tutorial_creation_page/check.php" method="POST"><input name="fin" type="hidden" value="' . $fileString . '"><button class="buttoff b_left" type="submit">END</button></form>';
                }
              
                //add in the ending html to complete the template html
                $output_big = $output_big.'</div><button id="return" type="button" onclick="location.href=\'../tutorial_landing_page.php\'">Return</button><footer><a id = "about" href="http://' . $_SERVER['SERVER_NAME'] . '/about/about.html">About Page</a></footer><script src="/resources/general/cookies_enabled.js"></script><script src="/resources/jquery/jquery-1.4.3.min.js"></script></script><script src="/resources/general/answer.js"></script></body></html>';
                fwrite($challenge, $output_big); //write the contents to the newly made template page
                fclose($challenge); //close the newly made tutorial page
                $count++;
              }
            }
            closedir($handle); //close the directory being run through to find all of its files
          }
        
        $count = 0;
        //create the file destination which is the new directory being uploaded too
        $fileDestination = $_SERVER['DOCUMENT_ROOT']."/user/tutorials/".$fileString.'/';
        foreach($_POST as $key => $value) //for every file to be transferred to the new tutorial from the created tutorial pages of the admin
        {
            if($key != 'final_tutorial_title' && $key != 'filename') //ensure the post key in question isn't the tutorial name or the filename post
            {
              $newKey = substr_replace($key,".html",strlen($key)-5,5); //make these pages clearly html pages
              //cut the current file and rename it so that it is in the order that the admin created in the tutorial creation page
              rename ('uploaded_docs/'.$_SESSION['username'].'/'.$newKey, $fileDestination.$value.'_page.html'); 
            }
        }
      } 
      $error_type = 0;
    }
    else
    {
      $error_type = "7"; //if the tutorial has no pages to upload tell the admin
    }
    
    //unset all of the posts so that they don't propogate
    foreach ($_POST as $key => $value) {
      unset($_POST[$key]);
    }
    //redirect to the tutorial creation page, with an error if need be
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