<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin - View Staff Posts</title>
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	</head>

	<div style="background-color: #1D1D1D" data-role="page" class="adminreportedissuespage"> 
		<body>
			<head>
				<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'/>
				<style type="text/css">
					html, body 
					{
						height: 92vh; 
						background-color: #1D1D1D;
						font-family: 'Muli', sans-serif;
					}

					#viewstaffpostsdiv
					{
						width:98%; 
						background-color:#7CC476; 
						color:black; 
						border-radius:3px; 
						height:80vh; 
						overflow:scroll;
						margin-left: auto;
						margin-right: auto;
						text-shadow:none;
						text-align: center;
					}
					#adminstaffpoststitlediv
					{
						margin-top: -20px;
						text-shadow:none;
					}
				</style>
			</head>

			<div data-role="header" data-position="fixed" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white;">
				<a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller" class="ui-btn ui-shadow ui-corner-all ui-icon-back ui-btn-icon-notext ui-btn-a ui-btn-inline ui-nodisc-icon ui-alt-icon"></a>
				<h1>Admin Portal</h1>
			</div>


			<div data-role="content">

				<div id="adminstaffpoststitlediv">
	        		<p style="color:#7CC476; text-align:center; margin-left:auto; margin-right:auto">Staff Posts</p>
	        		<p style="color:#7CC476; text-shadow:none; text-align:center"><? echo $ConfMsg; ?></p>
	        	</div>


	            <div id="viewstaffpostsdiv">
	                    <!-- THIS FORM IS DYNAMICALLY CREATED TO SHOW ALL STAFF POSTS -->
	                    <?php
		                    foreach ($Allposts->result() as $line) 
		                    {
		                        	echo '<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_viewlecturerpostscontroller/deleteStaffPost" method="POST" style="text-align:center">
		                        			<p><b>Posted By</b></p>
		                        			<p>'.$line->postedby.'</p>
		                        			<p><b>Post</b></p>
		                        			<p>'.$line->post.'</p>
		                                    <p><b>Time Reported</b></p>
		                                    <p>'.$line->postdate.'</p>
		                                    <p><b>Date Reported</b></p>
		                                    <p>'.$line->posttime.'</p>
		                        			<input type="hidden" value="',$line->id,'" name="idPostToDelete" >
		                        			<input value="Delete" data-inline="true" data-mini="true" data-theme="b" type=submit>
		                        		</form> <br/>';
		                        	echo "<div style=\"width:80%; height: 5px; border-radius:2px; background-color: #005518; margin-left:auto; margin-right:auto;\"></div>";
		                    }
	                    ?>
	            </div>

			</div> <!--//content-->

		</body>

	</div> <!--//page-->

	<head>
		<meta http-equiv="pragma" content="no-cache">
	</head>
</html>