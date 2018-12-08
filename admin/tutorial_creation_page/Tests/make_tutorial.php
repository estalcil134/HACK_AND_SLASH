<?php
  session_start();
  if(!file_exists("/user/tutorials/".$_POST['final_tutorial_title'], 0700)
  {
    mkdir("/user/tutorials/".$_POST['final_tutorial_title'], 0700);
  }
  if ($handle = opendir("/user/tutorials/".$_POST['final_tutorial_title'].'/')) {
  $count = 0;
  $num_file = count(scandir("/user/tutorials/".$_POST['final_tutorial_title'].'/')) - 2;
  echo('$num_file');
  while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
        $challenge = fopen("/user/tutorials/".$_POST['final_tutorial_title'].'/'.$count.'html', "w");
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
          <div id="code">';
          if($count != 0)
          {
            $output_big = $output_big.'<a href="'.($count-1).'.html">BACK</a>';
          }
          else
          {
            $output_big = $output_big.'<a href="../tutorial_landing_page.php">BACK</a>';
          }
          $output_big = $output_big.'<iframe width = "100%" height = "100%" srcdoc = "'.$count.'_page.html"></iframe>'
          if($count != ($num_file-1))
          {
            $output_big = $output_big.'$output_big = $output_big.<a href="'.($count+1).'.html">NEXT</a>';
          }
          else
          {
            $output_big = $output_big.'<a href="../tutorial_landing_page.php">END</a>';
          }
          $output_big = $output_big.'</div><footer><a id = "about" href="<?php echo \'http://\' . $_SERVER[\'SERVER_NAME\'] . \'/about/about.html\'?>">About Page</a></footer><script src="/resources/general/cookies_enabled.js"></script><script src="/resources/jquery/jquery-1.4.3.min.js"></script></script><script src="/resources/general/answer.js"></script></body></html>';
          fwrite($challenge, $output_big);
          if ($fileDestination)
          {
            echo"works";
          }
          fclose($challenge);
                $count++;
              }
          }
        closedir($handle);
  }
  $count = 0;
  $fileDestination = "/user/tutorials/".$_POST['final_tutorial_title'].'/';
     
  foreach ($_POST as $key => $value) {
      if($key != 'final_tutorial_title')
      {
        move_uploaded_file($key,$fileDestination.$value.'_page.html');
      }
  }
     
    foreach ($_POST as $key => $value) {
      unset($_POST[$key]);
    }
    
  ?>