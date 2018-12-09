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
var filelink = "";
//this function allows for the user to load the page and have the cursor immediately in the first text box
var i = 0;
var classes = [];

window.onload = function() {
  getFocusText();
  var el = document.getElementById("multi");
  el.style.display = "block";
  
  show_question();
  css_iframe();
}

function getFocusText() {
  document.getElementById("tutorial").focus();
}

function show_question(event)
{ // Function to show the demo
  var que = event.target;
  var outputting = document.getElementById("outputter");
  var q_event = event.keyCode;
  if(event.target.id == "tutorial")
  {
    question_out = que.value;
  }
  else if(event.target.id == "desc")
  {
    answer1 = que.value;
  }
  else if (event.target.id == "file")
  {
    filelink = '<p class="center"><a id="fileobj">file</a></p>';
  }
  if(q_event != 13)
  {
    var output_big = "<div id=\"mini_contain\"><h3 id='display'>" + question_out + '</h3><p class = "center" name="description">' + answer1 + "</p>" + filelink +'<span class="tab" id="file"></span>' + '<p class="center">Enter flag here: <input type="text" disabled></p></div>';
    
    outputting.innerHTML = output_big;
  }
}

function enter(event)
{ // On this call, focus on the next input tag
  var el2 = event.target;
  var q_event = event.keyCode;
  if (q_event == 13)
  {
    el2.blur();
    var index = $('.inputs').index(el2) + 1;
    $('.inputs').eq(index).focus();
    event.preventDefault();
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