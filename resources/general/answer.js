/*
  File contains the JavaScript functions used for a question html file
  that is generated when using the GUI to create questions when an admin is
  creating a tutorial. This file automatically gets referenced by the question
  html file that is created when the admin creates a question.
*/

function selectRadio1() {
  /*Function used to allow clicking on the text to select the radio button
    associated with that text answer for a multiple choice question, similar to
    a label with a "for" attribute to an input tag. This function is attached to
    span tags that follow an input tag*/
  $('input:radio[name=mult][value=' + event.target.innerHTML.substr(0,1) + ']').click();
}

function enter1() {
  /* This function is used to automatically show the answer when a user submits
  an answer to a short answer question. It is attached to the input tag that
  takes in the answer to a short answer question*/
  var el = document.getElementById("showanswer").innerHTML;
  var el2 = event.target;
  
  var q_event = event.keyCode;
  if (q_event == 13)
  {
    el2.blur();
    if(el2.value == (el).substr(8,el.length))
    {
      $("#showanswer").css({display: "block"});
    }
  }
}

function show_ans() {
  /*Used to toggle the display of the answer to a short answer question. This
  function is attached to the SHOW ANSWER button on a question page*/
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
  /* Function used to toggle the display of the answer to a multiple
  choice question. This function is attached to the radio input associated
  with the correct answer */
  var answ = document.getElementById("answer").innerHTML;
  var $el = $("#showanswer1").css( "display" );
  if(event.target.parentElement.id == answ)
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
