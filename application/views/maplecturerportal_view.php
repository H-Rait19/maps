<?php
 header("Access-Control-Allow-Origin: *"); ?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lecturer Portal</title>
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	</head>

	<div style="background-color: #1D1D1D" data-role="page" class="lecturerportalpage"> 
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

					#viewpostsdiv
					{
						width:98%; 
						background-color:#75FFA3; 
						color:black; 
						border-radius:3px; 
						height:60vh; 
						overflow:scroll;
						margin-left: auto;
						margin-right: auto;
						text-shadow:none;
						text-align: center;
					}
					#newpostdiv
					{
						width: 98%;
						margin-left: auto;
						margin-right: auto;
					}
					#postitlesdiv
					{
						margin-top: -20px;
					}

				</style>
			</head>

			<div data-role="header" data-position="fixed" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white;">
				<a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/login_controller/destroySession" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-btn-inline">Logout</a>
			 	<h1>Lecturer Portal</h1>
			</div>


			<div data-role="content">

				<div id="postitlesdiv">
					<p style="color:white; text-align:center; margin-left:auto; margin-right:auto">Live Feed Posts | Welcome <? echo $loginName; ?></p>
					<p style="color:#75FFA3; text-shadow:none; text-align:center"><? echo $PostConfMsg; ?></p>
					<p style="color:red; text-shadow:none; text-align:center"><? echo $PostErrMsg; ?></p>
				</div>


			    <div id="viewpostsdiv">
			            <!-- answers loaded into this div using foreach and POST data -->
			            <?php
			            foreach ($AllPosts->result() as $line) 
			            {
			                	echo '<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller/deletePost" method="POST" data-ajax="false">
			                			<br/> Date and Time Posted: ',$line->postdate,' ',$line->posttime,' <br/>
			                			Post: ',$line->post,'<br/>
			                			<input type="hidden" value="',$line->id,'" name="idPostToDelete" >
			                			<input value="Delete Post" data-inline="true" data-mini="true" type=submit>
			                		</form> <br/>';
			                	echo "<div style=\"width:80%; height: 5px; border-radius:2px; background-color: #005518; margin-left:auto; margin-right:auto;\"></div>";
			            }
			            ?>
			    </div>


			    <div id="newpostdiv">
			    <!-- Form allows user to post to the live feed -->
			    	<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller/insertPost" 
			    																							data-ajax="false" method="POST">
			            <input type="hidden" value="<?php echo $loginName; ?>" name="postedBy">
			            <input type="text" name="postToInsert" placeholder="Enter Post Here...">
			            <input value="Post to Feed" type=submit data-theme="a" data-icon="plus">
			    	</form>

			    	<a href="#resetPasswordPopup" data-rel="popup" data-role="button" data-theme="b" data-icon="info" data-position-to="window" data-transition="pop">Reset Password</a>
			    	<a href="#resetEmailPopup" data-rel="popup" data-role="button" data-theme="b" data-icon="info" data-position-to="window" data-transition="pop">Reset Email</a>

			    </div>
			    
			   	<!-- this pop up form allows user to reset password-->
			    <div data-role="popup" id="resetPasswordPopup" style="background-color:#1D1D1D; color:white; width: 98%; margin-left:auto; margin-right:auto">
			    	<p style="text-align:center; color:#75FFA3; text-shadow:none "><b>Reset Password</b></p>
			    	<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller/changePassword" data-ajax="false" method="POST" style="padding:20px;">
			            <input type="password" name="oldPassword" placeholder="Old Password" data-theme="b"/>
			            <input type="password" name="newPassword" placeholder="New Password" data-theme="b"/>
			            <input type="password" name="newPasswordConf" placeholder="Confirm Password" data-theme="b"/>
			            <input value="Reset" type=submit data-icon="plus" data-theme="a"/>
			    	</form>
			    </div>

			    <!-- this pop up form allows user to reset email-->
			    <div data-role="popup" id="resetEmailPopup" style="background-color:#1D1D1D; color:white; width: 98%; margin-left:auto; margin-right:auto">
			    	<p style="text-align:center; color:#75FFA3; text-shadow:none "><b>Reset Email</b></p>
			    	<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller/changeEmail" data-ajax="false" method="POST" style="padding:20px;">
			            <input type="email" name="oldemail" placeholder="Old email" data-theme="b"/>
			            <input type="email" name="newemail" placeholder="New email" data-theme="b"/>
			            <input value="Reset" type=submit data-icon="plus" data-theme="a"/>
			    	</form>
			    </div>


			</div> <!--//content-->

		</body>

	</div> <!--//page-->

</html>