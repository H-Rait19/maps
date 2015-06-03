var xmlhttp;

//Home page AJAX JS
 
function fetchrooms(CharsSoFar) //used to retrieve search results for map search
{    
    xmlhttp = new XMLHttpRequest();
    var url = "https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapajax_controller/lookup?t="+CharsSoFar;
   
    xmlhttp.onreadystatechange = setToDiv;

    xmlhttp.open("GET",url);
    xmlhttp.send();
}
function setToDiv() //set search results to div
{
    if (xmlhttp != null && xmlhttp.readyState == 4) {
        var txt = xmlhttp.responseText;
        document.getElementById('ajaxsearchresultsdiv').innerHTML = txt;
    }
}


function fetchstaffposts(name) //retrieve staff posts
{    
    xmlhttp = new XMLHttpRequest();
    var url = "https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapajax_controller/lookupName?t="+name;
   
    xmlhttp.onreadystatechange = setToLiveFeedDiv;

    xmlhttp.open("GET",url);
    xmlhttp.send();
}
function fetchpostmatches(name, CharsSoFar) //used to retrieve the staff live post search matches if any 
{    
    xmlhttp = new XMLHttpRequest();
    var url = "https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapajax_controller/lookupKeywordMatch?t="+name+"&c="+CharsSoFar;
   
    xmlhttp.onreadystatechange = setToLiveFeedDiv;

    xmlhttp.open("GET",url);
    xmlhttp.send();
}
function setToLiveFeedDiv() //set live post search result to panel
{
    if (xmlhttp != null && xmlhttp.readyState == 4) {
        var posts = xmlhttp.responseText;
        document.getElementById('ajaxpostsdiv').innerHTML = posts;
    }
}
