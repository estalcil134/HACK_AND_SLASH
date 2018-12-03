function pass_check()
{ // Check if the two passwords are different. If they are, display error
  p1 = document.getElementById("password1").value;
  p2 = document.getElementById("password2").value;
  if ((p2 !== '') && (p1 !== p2))
  {
    document.getElementsByClassName("info")[1].innerHTML = "Passwords do not match!";
  }
  else
  {
    document.getElementsByClassName("info")[1].innerHTML = "";
  }
}