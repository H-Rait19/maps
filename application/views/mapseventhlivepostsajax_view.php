	<?php
		//IF NOT LIVE POST SEARCH RESULTS THEN DISPLAY THIS
		if ($isSearchResult == "") { 
		
	    	foreach ($posts->result() as $line) 
	    	{ 
	    		echo 
	    		"<h3 style=\"color:#6CF0B4\">".$line->postedby."</h3>
					<p style=\"color:#6CF0B4\"><b>Post</b></p>
					<p>".$line->post."</p>
					<p style=\"color:#6CF0B4\"><b>Date and Time<b></p>
					<p>".$line->postdate." ".$line->posttime."</p>
				";
				echo "<div style=\"width:70%; height: 5px; border-radius:2px; background-color: #6CF0B4; margin-left:auto; margin-right:auto;\"></div>";

	    	} 
    	}
    	//IF IT IS LIVE POST SEARCH RESULTS THEN DISPLAY THIS DUE TO DIFFERENT FOREACH LOOP CONDITIONS
    	elseif ($isSearchResult == "yes") { 
		
	    	foreach ($posts as $line) 
	    	{ 
	    		echo 
	    		"<h3 style=\"color:#6CF0B4\">".$line->postedby."</h3>
					<p style=\"color:#6CF0B4\"><b>Post</b></p>
					<p>".$line->post."</p>
					<p style=\"color:#6CF0B4\"><b>Date and Time<b></p>
					<p>".$line->postdate." ".$line->posttime."</p>
				";
				echo "<div style=\"width:70%; height: 5px; border-radius:2px; background-color: #6CF0B4; margin-left:auto; margin-right:auto;\"></div>";

	    	} 
    	}
	?>


