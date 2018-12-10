
function css_iframe() {
  $('iframe').contents().find("head").append($("<style type='text/css'> body {width = 500px; word-wrap: break-word;}  </style>"));
}
var question_out = "";
var short_answer = "NOTHING INPUT";
var mulitple_answer = "NOTHING INPUT";
var answer1 = "NOTHING INPUT";
var answer2 = "NOTHING INPUT";
var answer3 = "NOTHING INPUT";
var answer4 = "NOTHING INPUT";
var answer5 = "NOTHING INPUT";

//this function allows for the user to load the page and have the cursor immediately in the first text box
var i = 0;
var classes = [];
window.onload = function() {
  //getFocusText();
  var el = document.getElementById("multi");
  var el1 = document.getElementById("short");
  el.style.display = "none";
  el1.style.display = "block";
  tutorial_create();
  short();
  css_iframe();
}

//function getFocusText() {
//  document.getElementById("tutorial").focus();
//}

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
  show_question(event);
}

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
  if(event.target.id == "question_input")
  {
    question_out = que.value;
  }
  else if(event.target.id == "answer_input_short")
  {
    short_answer = que.value;
    if(short_answer == "")
    {
      short_answer = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "one")
  {
    answer1 = que.value;
    if(answer1 == "")
    {
      answer1 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "two")
  {
    answer2 = que.value;
    if(answer2 == "")
    {
      answer2 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "three")
  {
    answer3 = que.value;
    if(answer3 == "")
    {
      answer3 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "four")
  {
    answer4 = que.value;
    if(answer4 == "")
    {
      answer4 = "NOTHING INPUT";
    }
  }
  else if(event.target.id == "five")
  {
    answer5 = que.value;
    if(answer5 == "")
    {
      answer5 = "NOTHING INPUT";
    }
  }
  if(q_event != 13)
  {
    if(el.style.display == "block")
    {

      outputting.innerHTML = "QUESTION: " + question_out + '<br><br><input type="text" autocomplete="off" value="" name="short_ans" class = "inputs" id="user_input" onkeydown = "enter1();"/><br><br><button type = "button" onclick = "show_ans();">SHOW ANSWER</button><br><br><div id = "showanswer">ANSWER: ' + short_answer + '</div>';
      $('input:hidden[name=actual_answer_short]').val(short_answer);
    }
    else
    {
      var output_big = "QUESTION: " + question_out + '<br><div class = "tab" id = "A"><input type="radio" name="mult" value="A" onclick = "show_ans1();"><span onclick = "selectRadio1();">A: ' + answer1 + "</span></div>" + '<div class = "tab" id = "B"><input type="radio" name="mult" value="B" onclick = "show_ans1();"><span onclick = "selectRadio1();">B: ' + answer2 + "</span></div>";
      var num = document.getElementById("quest_num").selectedIndex;
      if(num == 1)
      {
        output_big = output_big + '<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: ' + answer3 + "</span></div>";
      }
      if(num == 2)
      {
        output_big = output_big + '<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: ' + answer3 + "</span></div>" + '<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: ' + answer4 + "</span></div>";
      }
      if(num == 3)
      {
        output_big = output_big + '<div class = "tab" id = "C"><input type="radio" name="mult" value="C" onclick = "show_ans1();"><span onclick = "selectRadio1();">C: ' + answer3 + "</span></div>" + '<div class = "tab" id = "D"><input type="radio" name="mult" value="D" onclick = "show_ans1();"><span onclick = "selectRadio1();">D: ' + answer4 + "</span></div>" + '<div class = "tab" id = "E"><input type="radio" name="mult" value="E" onclick = "show_ans1();"><span onclick = "selectRadio1();">E: ' + answer5 + "</span></div>";
      }
      output_big = output_big + '<br><br><div id = "showanswer1">ANSWER: ' + mulitple_answer + '</div>';
      outputting.innerHTML = output_big;
    }
  }
}


function enter(e)
{
  if (!window.event)
  { // If firefox, set event to the passed event
    event = e;
  }
  var el2 = event.target;
  var q_event = event.keyCode;
  if (q_event == 13)
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
  // Change here
  //document.getElementsByName("short_answer").removeAttribute("required");
  document.getElementsByName("mult_inp")[0].removeAttribute("required");
  $("input[name^=answer]").attr("required", false);
  $("input[name=short_answer]").attr("required", true);
}

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
  // Change here
  document.getElementsByName("mult_inp")[0].setAttribute("required", "");
  $("input[name=answer1]").attr("required", true);
  $("input[name=answer2]").attr("required", true);
  $("input[name=short_answer]").attr("required", false);
}

function num_multi()
{
  var select_questions = document.getElementById("quest_num").selectedIndex;
  var num = "" + (select_questions + 2);
  $('input:hidden[name=question_type]').val(num);
  three = document.getElementById("third");
  four = document.getElementById("fourth");
  five = document.getElementById("fifth");
  $('input:hidden[name=num_multiple]').val(num);
  if(select_questions == 0)
  {
    three.style.display = "none";
    four.style.display = "none";
    five.style.display = "none";
    $("input[name=answer3]").attr("required", false);
    $("input[name=answer4]").attr("required", false);
    $("input[name=answer5]").attr("required", false);
  }
  else if (select_questions == 1)
  {
    three.style.display = "block";
    four.style.display = "none";
    five.style.display = "none";
    $("input[name=answer3]").attr("required", true);
    $("input[name=answer4]").attr("required", false);
    $("input[name=answer5]").attr("required", false);
  }
  else if (select_questions == 2)
  {
    three.style.display = "block";
    four.style.display = "block";
    five.style.display = "none";
    $("input[name=answer3]").attr("required", true);
    $("input[name=answer4]").attr("required", true);
    $("input[name=answer5]").attr("required", false);
  }
  else if (select_questions == 3)
  {
    $("input[name^=answer]").attr("required", false);
    three.style.display = "block";
    four.style.display = "block";
    five.style.display = "block";
  }
}
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

var prev_div;

function allowDrop(ev) {
    ev.preventDefault();
}

function find_parent(ev) {
  prev_div = ev.target.parentElement;
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    var reciever;
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    if(ev.target.className == "display_frame")
    {
      var transfer = ev.target.children[0];
    }
    else if(ev.target.className == "file_show" || ev.target.className == "click delete")
    {
      var transfer = ev.target.parentElement;
    }
    else
    {
      var transfer = ev.target;
    }
    data1 = document.getElementById(data);
    if(data1.className == "file_show" || data1.className == "click delete")
    {
      var data1 = data1.parentElement;
    }
    if(ev.target.parentElement.className == "parental")
    {
      var reciever = ev.target;
    }
    else if(ev.target.className != "in_div")
    {
      var reciever = ev.target.parentElement.parentElement;
    }
    else
    {
      var reciever = ev.target.parentElement;
    }
    var num1 = reciever.id.substr(3,reciever.id.length);
    var num2 = prev_div.id.substr(3,prev_div.id.length);
    var first_div = prev_div.childNodes[0].childNodes[1];
    var second_div = reciever.childNodes[0].childNodes[1];
    first_div.value = num1;
    second_div.value = num2;
    prev_div.appendChild(transfer);
    reciever.appendChild(data1);
}

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

function on2()
{
  $("#overlay2").css({display: "block"});
}

function off() {
    $("#overlay").css({display: "none"});
}
function off2() {
  if (event.target.nodeName =='DIV')
  {
    document.getElementById("overlay2").style.display = "none";
  }
}

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

function show_ans1() {
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

function enter1() {
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

function selectRadio() {
  $('input:radio[name=mult_inp][value=' + event.target.innerHTML.substr(0,1) + '_1]').click();
  mulitple_answer = event.target.innerHTML.substr(0,1);
  $("#showanswer1").css({display: "none"})
  show_question();
  $('input:hidden[name=actual_answer_multi]').val(mulitple_answer);
}

function selectRadio1() {
  $('input:radio[name=mult][value=' + event.target.innerHTML.substr(0,1) + ']').click();

}
function set_answer()
{
  mulitple_answer = event.target.value.substr(0,1);
  show_question();
  $('input:hidden[name=actual_answer_multi]').val(mulitple_answer);
}
function setFile() {
  $('input:hidden[name=filename]').val(event.target.id);
}
