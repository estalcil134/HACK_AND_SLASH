// How to prevent people from modifying our ajax call to steal data
// Courtesy of https://www.quora.com/How-do-I-block-inspect-element-on-my-website
$(document).ready(function()
{
  // Block right click and ctrl key shortcuts for developer tools
  var body = document.getElementsByTagName("body")[0];
  body.setAttribute('oncontextmenu', 'return false');
  body.setAttribute('onkeydown','return false');
  body.setAttribute('onmousedown','return false');
});

$(document).keydown(function(e){
  // Block the use of f12
  if(e.which === 123){
     return false;
  }
});

function open_pop(loc)
{
  // Find out which challenge it is
  var path = document.getElementsByClassName("challenge")[loc].value;
  // Set the challenge path and the challenge number in the form
  // to compare the flag with the right challenge
  document.getElementById("chall_path").setAttribute("value", path);
  document.getElementById("chall_num").setAttribute("value", loc);
  var ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function ()
  {
    if (this.readyState == 4 && this.status == 200)
    { // Populate the popup block with the information
      document.getElementById("chall_info").innerHTML = this.responseText;
    }
  };
  ajax.open("GET", path, true);
  ajax.send();
  // Show the popup block
  document.getElementById("cover").style.display="block";
  document.getElementsByClassName("pop")[0].style.display="block";
  document.getElementById("container").children[0].innerHTML="";
  // Enable keydown and mouse input
  var body = document.getElementsByTagName("body")[0];
  body.setAttribute('onkeydown','return true');
  body.setAttribute('onmousedown','return true');
}

function close_pop()
{ // Close the popup block
  document.getElementById("cover").style.display="none";
  document.getElementsByClassName("pop")[0].style.display="none";
  // Disable keydown and mouse input
  var body = document.getElementsByTagName("body")[0];
  body.setAttribute('onkeydown','return true');
  body.setAttribute('onmousedown','return true');
}