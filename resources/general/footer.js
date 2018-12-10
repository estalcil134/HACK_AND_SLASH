// When the button is clicked, scroll to the top of the page
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
//when the page scrolls wun the scrollFunction
window.onscroll = function() {scrollFunction()};

//when the page is at the top no button is seen, but once the page 
//is scrolled the button appears
function scrollFunction() 
{
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) 
    {
        document.getElementById("topBtn").style.display = "block";
    } 
    else 
    {
        disappearButton();
    }
}

//when the page is at the top and on page load don't show 
//the button
function disappearButton()
{
  document.getElementById("topBtn").style.display = "none";
}