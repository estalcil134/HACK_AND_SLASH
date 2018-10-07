function validate(formObj) {
  var truth = true; //variable is true if all catagories are filled, false otherwise
  var message = ""; //the alert message shown to the user
  if (formObj.tutorial.value == "") {
    if (message!="") {
      message = message + "\n";
    }
    message = message + "You must enter a Tutorial Name.";
    formObj.tutorial.focus();
    truth = false;
  }
  if (!truth) {
    alert(message);
  }
  return truth;
}

//this function allows for the user to load the page and have the cursor immediately in the first text box
function getFocusText() {
  document.getElementById("tutorial").focus();
}