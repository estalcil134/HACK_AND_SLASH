
function saveAsTxt(){
	var tut_title = document.getElementById("title").value;
	var tut_content = document.getElementById("content").value;
	var tut_html = "<!DOCTYPE html>\n<html>\n<head>\n<title>";
	tut_html += tut_title;
	tut_html += "</title>\n</head>\n<body>\n<h1>" + tut_title;
	tut_html += "</h1>\n<p>" + tut_content;
	tut_html += "</p>\n</body></html>";
	
	var blob = new Blob([tut_html], {type: "text/html"});
    var textToSaveAsURL = window.URL.createObjectURL(blob);

    var downloadLink = document.createElement("a");
    downloadLink.download = tut_title;
    downloadLink.innerHTML = "Download File";
    downloadLink.href = textToSaveAsURL;
    downloadLink.onclick = destroyClickedElement;
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);

    downloadLink.click();
}
function destroyClickedElement(event)
{
    document.body.removeChild(event.target);
}

