//the variables used throughout the JAVASCRIPT
var question_out = "";                  //the string of what the question output is
var short_answer = "NOTHING INPUT";     //the string to show the short question answer
var mulitple_answer = "NOTHING INPUT";  //the string to show the multiple choice question answer
var answer1 = "NOTHING INPUT";          //the string for the first multiple choice answer displayed
var answer2 = "NOTHING INPUT";          //the string for the second multiple choice answer displayed
var answer3 = "NOTHING INPUT";          //the string for the third multiple choice answer displayed
var answer4 = "NOTHING INPUT";          //the string for the fourth multiple choice answer displayed
var answer5 = "NOTHING INPUT";          //the string for the fifth multiple choice answer displayed
var prev_div;

//when the window for the tutorial creation loads hide the multiple choice question, show the short answer question
//then call other functions
window.onload = function() {
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  el.style.display = "none";
  el1.style.display = "block";
  tutorial_create();
  short();
  css_iframe();
}

//this function adds css to a particular iframe by finding its head within its source and adds the css into the iframe code
function css_iframe() {
  $('iframe').contents().find("head").append($("<style type='text/css'> body {width = 500px; word-wrap: break-word;}  </style>"));
}

//this function makes the questions part of the page hidden and the upload documents page show to the admin
function tutorial_create()
{
  var el = document.getElementById("question");
  var el1 = document.getElementById("tutorial_upload");
  el.style.display = "none";
  el1.style.display = "block";
}

//this function hides the upload documents and shows the admin the question creation while calling on the show_question function
function question()
{
  var el = document.getElementById("tutorial_upload");
  var el1 = document.getElementById("question");
  el.style.display = "none";
  el1.style.display = "block";
  show_question(event);
}

//this function updates the output demo shown to the admin of what the question they are creating looks like. It updates the html to
//show how the question and answers would look like when used in their own tutorial
function show_question(e)
{
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  var que = event.target;
  var outputting = document.getElementById("outputter");
  var el = document.getElementById("short");
  var q_event = event.keyCode;
  if(event.target.id == "question_input") //if the question input is being updated then update the text shown in the demo div
  {
    question_out = que.value;
  }
  else if(event.target.id == "answer_input_short") //if the short question answer is being updated then update the text shown in the demo div
  {
    short_answer = que.value;
    if(short_answer == "")
    {
      short_answer = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "one") //if the first multiple choice question is being updated
  {
    answer1 = que.value;
    if(answer1 == "")
    {
      answer1 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "two") //if the second multiple choice question is being updated
  {
    answer2 = que.value;
    if(answer2 == "")
    {
      answer2 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "three") //if the third multiple choice question is being updated
  {
    answer3 = que.value;
    if(answer3 == "")
    {
      answer3 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "four") //if the fourth multiple choice question is being updated
  {
    answer4 = que.value;
    if(answer4 == "")
    {
      answer4 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "five") //if the fifth multiple choice question is being updated
  {
    answer5 = que.value;
    if(answer5 == "")
    {
      answer5 = "NOTHING INPUT";
    }
  }
  if(q_event != 13) //if the key pressed is not the enter key
  {
    if(el.style.display == "block") //if the short answer question needs to be displayed then update the demo div to show the new short answer question demo
    {
      outputting.innerHTML = "QUESTION: " + question_out + '<br><br><input type="text" autocomplete="off" value="" name="short_ans" class = "inputs" id="user_input" onkeydown = "enter1(event);"/><br><br><button type = "button" onclick = "show_ans();">SHOW ANSWER</button><br><br><div id = "showanswer">ANSWER: ' + short_answer + '</div>';
      $('input:hidden[name=actual_answer_short]').val(short_answer);
    }
    else //if the multiple choice question needs to be displayed then the demo div is updated to show the new multiple choice question
    {
      //there will always at least be the first two answers considering the choices for the number of multiple choice questions is from 2-5
      var output_big = "QUESTION: " + question_out + '<br><div class = "tab" id = "A"><input type="radio" name="mult" value="A" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">A: ' + answer1 + "</span></div>" + '<div class = "tab" id = "B"><input type="radio" name="mult" value="B" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">B: ' + answer2 + "</span></div>";
      var num = document.getElementById("quest_num").selectedIndex;
      if(num == 1) //if three multiple choice answers need to be displayed update the demo div to show three answers
      {
        output_big = output_big + '<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">C: ' + answer3 + "</span></div>";
      }
      if(num == 2) //if four multiple choice answers need to be displayed update the demo div to show four answers
      {
        output_big = output_big + '<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">C: ' + answer3 + "</span></div>" + '<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">D: ' + answer4 + "</span></div>";
      }
      if(num == 3) //if five multiple choice answers need to be displayed update the demo div to show five answers
      {
        output_big = output_big + '<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">C: ' + answer3 + "</span></div>" + '<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">D: ' + answer4 + "</span></div>" + '<div class = "tab" id = "E"><input type="radio" name="mult" value="E" onclick = "show_ans1(event);"><span onclick = "selectRadio1(event);">E: ' + answer5 + "</span></div>";
      }
      output_big = output_big + '<br><br><div id = "showanswer1">ANSWER: ' + mulitple_answer + '</div>';
      outputting.innerHTML = output_big; //ACTUALLY CHANGE THE HTML OF THE DEMO DIV WITH THE NEW QUESTION HTML
    }
  }
}

//when enter is pressed on an input that won't be submitting then go to the next input shown
function enter(e)
{
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  var el2 = event.target;
  var q_event = event.keyCode;
  if (q_event == 13) //if the enter button is pressed within the input
  {
    event.preventDefault();
    el2.blur();
    var index = $('.inputs').index(el2);
    if(index == 1)
    {
      var el = document.getElementById("multi");
      if(el.style.display == "block")
      {
        index += 2;
      }
      else
      {
        index +=1;
      }
    }
    else
    {
      index +=1;
    }
    $('.inputs').eq(index).focus();
  }
}

//this function shows the short answer question while hiding the multiple choice question
//while also ensuring all the inputs are filled out that are required
function short()
{
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  var el2 = document.getElementById("short_ans");
  var el3 = document.getElementById("multi_ans");
  el.style.display = "none";
  el1.style.display = "block";
  el2.style.backgroundImage = "linear-gradient(#BB0303,#2E0303,#2E0303,#2E0303,#BB0303)";
  el3.style.backgroundImage = "linear-gradient(#8B0B0B,#C90F0F,#C90F0F,#C90F0F,#8B0B0B)";
  $('input:hidden[name=question_type]').val("short");
  show_question();
  document.getElementsByName("mult_inp")[0].removeAttribute("required");
  $("input[name^=answer]").attr("required", false);
  $("input[name=short_answer]").attr("required", true);
}

//this function shows the multiple choice question while hiding the short answer question
//while also ensuring all the inputs are filled out that are required
function multi()
{
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  var el2 = document.getElementById("short_ans");
  var el3 = document.getElementById("multi_ans");
  el.style.display = "block";
  el1.style.display = "none";
  el2.style.backgroundImage = "linear-gradient(#8B0B0B,#C90F0F,#C90F0F,#C90F0F,#8B0B0B)";
  el3.style.backgroundImage = "linear-gradient(#BB0303,#2E0303,#2E0303,#2E0303,#BB0303)";
  num_multi();
  $('input:hidden[name=question_type]').val("multi");
  show_question();
  document.getElementsByName("mult_inp")[0].setAttribute("required", "");
  $("input[name=answer1]").attr("required", true);
  $("input[name=answer2]").attr("required", true);
  $("input[name=short_answer]").attr("required", false);
}

//this function changes the number of required inputs to be filled out in the question creation
//to be the same as the number of multiple choice answers. It also changes how many multiple choice answers
//are displayed to be the number selected by the admin
function num_multi()
{
  var select_questions = document.getElementById("quest_num").selectedIndex;
  var num = "" + (select_questions + 2);
  $('input:hidden[name=question_type]').val(num);
  three = document.getElementById("third");
  four = document.getElementById("fourth");
  five = document.getElementById("fifth");
  $('input:hidden[name=num_multiple]').val(num);
  if(select_questions == 0) //if there are two multiple choice answers
  {
    three.style.display = "none";
    four.style.display = "none";
    five.style.display = "none";
    $("input[name=answer3]").attr("required", false);
    $("input[name=answer4]").attr("required", false);
    $("input[name=answer5]").attr("required", false);
  }
  else if (select_questions == 1) //if there are three multiple choice answers
  {
    three.style.display = "block";
    four.style.display = "none";
    five.style.display = "none";
    $("input[name=answer3]").attr("required", true);
    $("input[name=answer4]").attr("required", false);
    $("input[name=answer5]").attr("required", false);
  }
  else if (select_questions == 2) //if there are four multiple choice answers
  {
    three.style.display = "block";
    four.style.display = "block";
    five.style.display = "none";
    $("input[name=answer3]").attr("required", true);
    $("input[name=answer4]").attr("required", true);
    $("input[name=answer5]").attr("required", false);
  }
  else if (select_questions == 3) //if there are five multiple choice answers
  {
    $("input[name^=answer]").attr("required", false);
    three.style.display = "block";
    four.style.display = "block";
    five.style.display = "block";
  }
}

//determines if there is a file to even upload when file upload button is pressed
//if there are no files to upload stop the upload event from occurring
function file_there() {
  $('#file').html($('#file').html());
  $("form").submit(function(e){
    if($("#file").val() == ''){
         // your validation error action
        valid = false;
        e.preventDefault();
     }
  });
}

//stops a drag event
function allowDrop(ev) {
  ev.preventDefault();
}

//finds the parent element of the previous div
function find_parent(ev) {
  prev_div = ev.target.parentElement;
}

//allows for the drag event by transfering the data to the other drag allowing place
function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

//when the tutorial file is dragged into another box then switch the content of each box so that the tutorial files switch
function drop(ev) {
  var reciever; //the recieving div of the content
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");

  //since the drag event is finickey, some if statements are used for when there are mistakes in the drag event
  if(ev.target.className == "display_frame") //if the drag target ends up being the parent dive
  {
    var transfer = ev.target.children[0];
  }
  else if(ev.target.className == "file_show" || ev.target.className == "click delete") //otherwise if the drag target is a child of the div to be switched
  {
    var transfer = ev.target.parentElement;
  }
  else //if the target is the correct div
  {
    var transfer = ev.target;
  }

  data1 = document.getElementById(data);

  if(data1.className == "file_show" || data1.className == "click delete") //if the data to be transfered is the child of the div to be transfered
  {
    var data1 = data1.parentElement;
  }
  if(ev.target.parentElement.className == "parental") //if the data to be data to be transfered is the correct div
  {
    var reciever = ev.target;
  }
  else if(ev.target.className != "in_div") //if the data to be transfered is the parent of the parent of the current element
  {
    var reciever = ev.target.parentElement.parentElement;
  }
  else //if the data to be transfered is the parent of the current element
  {
    var reciever = ev.target.parentElement; 
  }

  //obtain the values for ordering and switch the values of the two tutorial files that are being uploaded. This way switching
  //the tutorial files actuall changes their order
  var num1 = reciever.id.substr(3,reciever.id.length);  
  var num2 = prev_div.id.substr(3,prev_div.id.length);
  var first_div = prev_div.childNodes[0].childNodes[1];
  var second_div = reciever.childNodes[0].childNodes[1];
  first_div.value = num1;
  second_div.value = num2;

  //switch the two div contents of the tutorial files that need to be switched
  prev_div.appendChild(transfer);
  reciever.appendChild(data1);
}

//when the preview of the tutorial file needs to be displayed show it and show the html of that file 
//the way it will be diplayed in the tutorial
function on(ev) {
  if(ev.target.className != "click delete")
  {
    if(ev.target.className != "file_show")
    {
      var contentz = $(ev.target.childNodes[3]).contents().find("html").html();
      document.getElementById("overlay").style.display = "block";
      document.getElementById("preview").srcdoc = contentz;
    }
    else
    {
      var contentz = $(ev.target.parentElement.childNodes[3]).contents().find("html").html();
      document.getElementById("overlay").style.display = "block";
      if (false || !!document.documentMode)
      { // If it is internet explorer, set the iframe's src
        document.getElementById("preview").src = ev.target.parentElement.childNodes[3].src;
      }
      else
      { // All other browsers, set the iframe's srcdoc
        document.getElementById("preview").srcdoc = contentz;
      }
    }
  }
}

//when the title submssion of the entire new tutorial is displayed for the admin
function on2()
{
  $("#overlay2").css({display: "block"});
  $("#final_title").attr("required", true);
}

//when the display of the tutorial file preview needs to be hidden again
function off() {
    $("#overlay").css({display: "none"});
}

//when the title of the tutorial submission gets hidden
function off2(e) {
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  if (event.target.nodeName =='DIV')
  {
    document.getElementById("overlay2").style.display = "none";
    document.getElementById("final_title").removeAttribute("required");
  }
}

//this function shows the answer when the demo button to "show answer" is pressed or when the 
//demo answer inputhas the correct answer entered into it
function show_ans() {
  var $el = $("#showanswer").css( "display" );
  if($el == "block")
  {
    $("#showanswer").css({display: "none"});
  }
  else
  {
    $("#showanswer").css({display: "block"});
  }
}

//when the admin clicks the right answer for the multiple choice demo to show the answer
function show_ans1(e) {
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  var $el = $("#showanswer1").css( "display" );
  if(event.target.parentElement.id == mulitple_answer)
  {
    if($el == "none")
    {
      $("#showanswer1").css({display: "block"});
    }
  }
  else
  {
    if($el == "block")
    {
      $("#showanswer1").css({display: "none"});
    }
  }
}

//when an enter is pressed on the input within the short answer question demo show the answer if the 
//input admin answer is correct
function enter1(e) {
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  var el = document.getElementById("showanswer").innerHTML;
  var el2 = event.target;

  var q_event = event.keyCode;
  if (q_event == 13)
  {
    if(el2.value == (el).substr(8,el.length))
    {
      $("#showanswer").css({display: "block"});
    }
    el2.blur();
  }
}

//ensures that when span of the mulptiple choice answer to choose the answer of the question is pressed,
//also click the radio of that particular answer
function selectRadio(e) {
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  $('input:radio[name=mult_inp][value=' + event.target.innerHTML.substr(0,1) + '_1]').click();
  mulitple_answer = event.target.innerHTML.substr(0,1);
  $("#showanswer1").css({display: "none"})
  show_question();
  $('input:hidden[name=actual_answer_multi]').val(mulitple_answer);
}

//ensures that when span of the mulptiple choice answer in the demo is pressed,
//also click the radio of that particular answer
function selectRadio1(e) {
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  $('input:radio[name=mult][value=' + event.target.innerHTML.substr(0,1) + ']').click();

}

//sets the answer of the multiple choice question depending on which radio is chosen
function set_answer(e)
{
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  mulitple_answer = event.target.value.substr(0,1);
  show_question();
  $('input:hidden[name=actual_answer_multi]').val(mulitple_answer);
}

//sets the hidden input's value to the uploaded file
function setFile(e) {
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  $('input:hidden[name=filename]').val(event.target.id);
}
