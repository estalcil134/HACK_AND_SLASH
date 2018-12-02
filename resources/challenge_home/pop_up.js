function open_pop(loc)
{
  var path = document.getElementsByClassName("challenge")[loc].value;
  document.getElementById("chall_path").setAttribute("value", path);
  document.getElementById("chall_num").setAttribute("value", loc);
  var ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function ()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("chall_info").innerHTML = this.responseText;
    }
  };
  ajax.open("GET", path, true);
  ajax.send();
  document.getElementById("cover").style.display="block";
  document.getElementsByClassName("pop")[0].style.display="block";
  document.getElementById("container").children[0].innerHTML="";
}
function close_pop()
{
  document.getElementById("cover").style.display="none";
  document.getElementsByClassName("pop")[0].style.display="none";
}