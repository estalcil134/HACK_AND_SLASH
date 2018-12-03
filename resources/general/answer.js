var short_answer = "NOTHING INPUT";
var mulitple_answer = "NOTHING INPUT";

function selectRadio1() {
  $('input:radio[name=mult][value=' + event.target.innerHTML.substr(0,1) + ']').click();
  
}

function enter1() {
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