$(document).ready(function() {
    var body = document.getElementsByClassName('entry-summary-body');
    for (var i = 0; i < body.length; i++) {
        var p = body[i].getElementsByTagName('p')[0].innerText || "";
        body[i].innerText = p;
        body[i].style.display = "block";
    }

});