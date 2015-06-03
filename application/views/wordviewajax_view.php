<p style="color: #6CF0B4; text-shadow:none">Results</p>
<?php
	
    foreach ($words as $w) {
    	//used for displaying AJAX results in div on map homepage
        echo "<form action=\"https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapviewroomcontroller\" method=\"POST\" data-ajax=\"false\" enctype=\"multipart/form-data\">
                <input value=\"$w\" type=\"text\" name=\"roomname\" readonly>
               <input value=\"View Room\" type=\"submit\">
            </form> <br/>";
    }
?>
