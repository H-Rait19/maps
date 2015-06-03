var xmlhttp;

//Home page AJAX JS
 
function fetchrooms(CharsSoFar)
{    
	
    xmlhttp = new XMLHttpRequest();
    
    var url = "https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/adminajax_controller/lookup?t="+CharsSoFar;
   
    xmlhttp.onreadystatechange = setToDiv;

    xmlhttp.open("GET",url);
    xmlhttp.send();
}
 
function setToDiv()
{
    if (xmlhttp != null && xmlhttp.readyState == 4) {
        var txt = xmlhttp.responseText;
        document.getElementById('formdiv').innerHTML = txt;
    }
}
