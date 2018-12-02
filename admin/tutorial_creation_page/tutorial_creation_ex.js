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

//this function allows for the user to load the page and have the cursor immediately in the first text box
var i = 0;
var classes = [];
window.onload = function() {
  getFocusText();
  //question();
}
function getFocusText() {
  document.getElementById("tutorial").focus();
}

//function bolden()
//{
//  var editFrame = document.getElementById('tutorial_page');
//  var content = $(editFrame).contents().find("html").html();
//  var bbutton = document.getElementById("bold_button");
//  var starter = 0;
//  
//  var editText = document.getElementById('edit_tutorial_text');
//  if(bbutton.style.borderStyle === 'inset')
//  {
//    bbutton.style.borderStyle = 'outset';
//    starter = content.lastIndexOf('<br');
//    if(starter == -1)
//    {
//      starter = content.lastIndexOf('</body>');
//    }
//    var editFrame = document.getElementById('tutorial_page');
//    var content = $(editFrame).contents().find("html").html();
//    document.getElementById("tutorial_page").srcdoc = insert(starter,'<div class = "normal">I</div> ',content);
//  }
//  else
//  {
//    bbutton.style.borderStyle = 'inset';
//    starter = content.lastIndexOf('<br');
//    if(starter == -1)
//    {
//      starter = content.lastIndexOf('</body>');
//    }
//    document.getElementById("tutorial_page").srcdoc = insert(starter,'<div class = "bold" id = "1">I</div> ',content);
//  }
//}
//
//function italicize()
//{
//  var editFrame = document.getElementById('tutorial_page');
//  var content = $(editFrame).contents().find("html").html();
//  var bbutton = document.getElementById("it_button");
//  var starter = 0;
//  
//  var editText = document.getElementById('edit_tutorial_text');
//  if(bbutton.style.borderStyle === 'inset')
//  {
//    bbutton.style.borderStyle = 'outset';
//    starter = content.lastIndexOf('<br');
//    if(starter == -1)
//    {
//      starter = content.lastIndexOf('</body>');
//    }
//    var editFrame = document.getElementById('tutorial_page');
//    var content = $(editFrame).contents().find("html").html();
//    document.getElementById("tutorial_page").srcdoc = insert(starter,'<div class = "normal">I</div> ',content);
//  }
//  else
//  {
//    bbutton.style.borderStyle = 'inset';
//    starter = content.lastIndexOf('<br');
//    if(starter == -1)
//    {
//      starter = content.lastIndexOf('</body>');
//    }
//    
//    document.getElementById("tutorial_page").srcdoc = insert(starter,'<div class = "italicize" id = "1">I</div> ',content);
//  }
//}
//
//function insert(start, small_String , big_String) 
//{
//        return (big_String.slice(0, start) + small_String + big_String.slice(start));
//}
//
//function focuser()
//{
//  var editFrame = document.getElementById('tutorial_page');
//  var content = $(editFrame).contents().getElementById("edit_tutorial").focus();
//}

function cursor_in()
{
  var el = document.getElementById("tutorial_page");
  var el1 = document.getElementById("outer_div");
  var range = document.createRange();
  var e = window.event;
  if(e.target.className == "outer")
  {
    var sel = window.getSelection();
    console.log(el.childElementCount);
    console.log(el1.childNodes[1].childNodes.length);
    console.log(el1.childNodes[1].textContent);
    if(el1.childNodes[1].childNodes.length != 0 && el1.childNodes[1].textContent)
    {      range.setStartAfter(el1.childNodes[1].childNodes[el1.childNodes[1].childNodes.length-1], 0);
    }
    else if(el1.childNodes[1].childNodes.length != 0)
    {
      range.setStartAfter(el1.childNodes[1].childNodes[0], 0);
    }
    else 
    {
      range.setStart(el1.childNodes[1],0);
    }
    range.collapse(true);
    sel.removeAllRanges();
    console.log(e.target.className);
    sel.addRange(range);
  }  
}


//function tutorial_create()
//{
//  var el = document.getElementById("question");
//  var el1 = document.getElementById("tutorial_upload");
//  el.style.display = "none";
//  el1.style.display = "block";
//}
//
//function question()
//{
//  var el = document.getElementById("tutorial_upload");
//  var el1 = document.getElementById("question");
//  el.style.display = "none";
//  el1.style.display = "block";
//}
//function bolden()
//{
//  var bbutton = document.getElementById("bold");
//  if(bbutton.style.borderStyle === 'inset')
//  {
//    bbutton.style.borderStyle = 'outset';
//    
//  }
//  else
//  {
//    bbutton.style.borderStyle = 'inset';
//  }
//}
//function show_question()
//{
//  var el = event.target;
//  var el1 = document.getElementById(event.target.id + 1);
//  var q_event = event.keyCode;
//  console.log(event.target.id + 1);
//  if(q_event != 13)
//  {
//    el1.innerHTML = el.value;
//  }
//  
//}
//
//function enter()
//{
//  var el = event.target;
//  var el1 = document.getElementById(event.target.id + 1);
//  var q_event = event.keyCode;
//  if (q_event == 13)
//  {
//    el.blur();
//  }
//  
//}