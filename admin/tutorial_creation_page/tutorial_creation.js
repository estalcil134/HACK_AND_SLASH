//function validate(formObj) {
//  var truth = true; //variable is true if all catagories are filled, false otherwise
//  var message = ""; //the alert message shown to the user
//  if (formObj.tutorial.value == "") {
//    if (message!="") {
//      message = message + "\n";
//    }
//    message = message + "You must enter a Tutorial Name.";
//    formObj.tutorial.focus();
//    truth = false;
//  }
//  if (!truth) {
//    alert(message);
//  }
//  return truth;
//}
function css_iframe() {
  $('iframe').contents().find("head").append($("<style type='text/css'> body {width = 500px; word-wrap: break-word;}  </style>"));
}
var question_out = "";
var short_answer = "";
var answer1 = "";
var answer2 = "";
var answer3 = "";
var answer4 = "";
var answer5 = "";
//this function allows for the user to load the page and have the cursor immediately in the first text box
var i = 0;
var classes = [];
window.onload = function() {
  getFocusText();
  question();
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  el.style.display = "none";
  el1.style.display = "block";
  tutorial_create();
  short();
  css_iframe();
}

function getFocusText() {
  document.getElementById("tutorial").focus();
}

function tutorial_create()
{
  var el = document.getElementById("question");
  var el1 = document.getElementById("tutorial_upload");
  var el2 = document.getElementById("site");
  el.style.display = "none";
  el1.style.display = "block";
}

function question()
{
  var el = document.getElementById("tutorial_upload");
  var el1 = document.getElementById("question");
  el.style.display = "none";
  el1.style.display = "block";
  show_question();
}

function show_question()
{
  var que = event.target;
  var outputting = document.getElementById("outputter");
  var el = document.getElementById("short");
  var q_event = event.keyCode;
  if(event.target.id == "question_input")
  {
    question_out = que.value;
  }
  else if(event.target.id == "answer_input_short")
  {
    short_answer = que.value;
  }
  else if(event.target.id == "one")
  {
    answer1 = que.value;
  }
  else if(event.target.id == "two")
  {
    answer2 = que.value;
  }
  else if(event.target.id == "three")
  {
    answer3 = que.value;
  }
  else if(event.target.id == "four")
  {
    answer4 = que.value;
  }
  else if(event.target.id == "five")
  {
    answer5 = que.value;
  }
  if(q_event != 13)
  {
    if(el.style.display == "block")
    {
      outputting.innerHTML = "QUESTION: " + question_out + "<br> ANSWER: " +  short_answer;
    }
    else
    {
      var output_big = "QUESTION: " + question_out + '<br><span class = "tab">A: ' + answer1 + "</span>" + '<span class = "tab">B: ' + answer2 + "</span>";
      var num = document.getElementById("quest_num").selectedIndex;
      if(num == 1)
      {
        output_big = output_big + '<span class = "tab">C: ' + answer3 + "</span>";
      }
      if(num == 2)
      {
        output_big = output_big + '<span class = "tab">C: ' + answer3 + "</span>" + '<span class = "tab">D :' + answer4 + "</span>";
      }
      if(num == 3)
      {
        output_big = output_big + '<span class = "tab">C: ' + answer3 + "</span>" + '<span class = "tab">D: ' + answer4 + "</span>" + '<span class = "tab">E: ' + answer5 + "</span>";
      }
      outputting.innerHTML = output_big;
    }
  }
}


function enter()
{
  var el2 = event.target;
  var q_event = event.keyCode;
  if (q_event == 13)
  {
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

function short()
{
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  var el2 = document.getElementById("short_ans");
  var el3 = document.getElementById("multi_ans");
  el.style.display = "none";
  el1.style.display = "block";
  el2.style.backgroundImage = "linear-gradient(#BB0303,#650404,#2E0303,#650404,#BB0303)";
  el3.style.backgroundImage = "linear-gradient(#550606,#8B0B0B,#C90F0F,#8B0B0B,#550606)";
  show_question();
}

function multi()
{
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  var el2 = document.getElementById("short_ans");
  var el3 = document.getElementById("multi_ans");
  el.style.display = "block";
  el1.style.display = "none";
  el2.style.backgroundImage = "linear-gradient(#550606,#8B0B0B,#C90F0F,#8B0B0B,#550606)";
  el3.style.backgroundImage = "linear-gradient(#BB0303,#650404,#2E0303,#650404,#BB0303)";
  num_multi();
  show_question();
}

function num_multi()
{
  var select_questions = document.getElementById("quest_num").selectedIndex;
  three = document.getElementById("third");
  four = document.getElementById("fourth");
  five = document.getElementById("fifth");
  if(select_questions == 0)
  {
    three.style.display = "none";
    four.style.display = "none";
    five.style.display = "none";
  }
  else if (select_questions == 1)
  {
    three.style.display = "block";
    four.style.display = "none";
    five.style.display = "none";
  }
  else if (select_questions == 2)
  {
    three.style.display = "block";
    four.style.display = "block";
    five.style.display = "none";
  }
  else if (select_questions == 3)
  {
    three.style.display = "block";
    four.style.display = "block";
    five.style.display = "block";
  }
}
function file_there() {
  
  $("form").submit(function(e){
    if($("#file").val() == ''){
         // your validation error action
        valid = false;
        e.preventDefault();
     }
  });
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}