<?php
    foreach ($selectedroom->result() as $line) 
    { 
    	//used for displaying AJAX results in admin view
    	$id = $line->id;
    	$name = $line->roomname;
    	$floor = $line->roomfloor;
    	$detail = $line->roomdetails;
    	$type = $line->roomType;
    	$res = $line->roomResources;
    	$imgname = $line->roomImageName;
    }

    //Dynamic AJAX form for updating room details and uploading room images
    echo "  </br>
            <div style=\"width:98%; margin-left:auto; margin-right:auto\">
        		<form action=\"https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller/updateRoom\" data-ajax=\"false\" method=\"post\" enctype=\"multipart/form-data\">

        		    <input value=\"$id\" type=\"hidden\" name=\"roomid\" id=\"rid1\" readonly/>

        		    <label for=\"rname\">Room Name:</label>
                    <input value=\"$name\" type=\"text\" name=\"roomname\" id=\"rname\" style=\"width:100%;\"/>

                    <label for=\"rfloor\">Room Floor:</label>
                    <input value=\"$floor\" type=\"text\" name=\"roomfloor\" id=\"rfloor\" style=\"width:100%; color:white; background-color:grey\" readonly/>

                    <label for=\"rdetails\">Room Details:</label>
                    <input value=\"$detail\" type=\"text\" name=\"roomdetails\" id=\"rdetails\" style=\"width:100%;\"/>

                    <label for=\"rtype\">Room Type:</label>
                    <input value=\"$type\" type=\"text\" name=\"roomtype\" id=\"rtype\" style=\"width:100%;\"/>

                    <label for=\"rresources\">Room Resources:</label>
                    <input value=\"$res\" type=\"text\" name=\"roomresources\" id=\"rresources\" style=\"width:100%;\"/>

                    <br/>
                    <input value=\"Update Room\" type=\"submit\" name=\"submit\"/>

                </form> <br/><br/>


                <span>Upload New Image</span>

                <form action=\"https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller/updateImage\" data-ajax=\"false\" method=\"post\" enctype=\"multipart/form-data\">
                    <input value=\"$id\" type=\"hidden\" name=\"roomidforimage\" id=\"imageid\" readonly/>
                    <input type=\"file\" name=\"userfile\"/>

                    <input value=\"Upload Image\" type=\"submit\" name=\"submit2\"/>
                </form> <br/>
            </div>
        
            <!-- display room image -->
            <div id=\"imageholder\" style=\"width:100%; height:30vh; background-color:black \">
                <img src=\"https://users.wmin.ac.uk/~w1377159/phpcw2/cimap/images/$imgname\" alt=\"Room Image\" id=\"image\">
            </div> ";
?>