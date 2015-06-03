<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cavendish Map Admin</title>
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	</head>

	<div style="background-color: #1D1D1D" data-role="page" class="adminmaproompage"> 
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

					#formdiv
					{
						text-shadow: none;
						color: black;
						background-color: #F16C4F;
						height: 0px;
					}

					#formholdingdiv
					{
						width: 98%;
						margin-left: auto;
						margin-right: auto;
						background-color:#F16C4F;
						border-radius: 10px;
						height: 86vh;
						overflow: scroll;
					}

					#image{
					display: block;
					width: auto;
					max-width: 95%;
					height: 100%;
					margin-left: auto;
					margin-right: auto;
					}
					#adminroominfotitlesdiv
					{
						margin-top: -20px;
						text-align: center;
					}
				</style>

				<script language="javascript" src="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/js/adminfetchrooms.js"></script>

			</head>

			<!-- OPTIONS PANEL -->
			<div data-role="panel" id="adminOptionsPanel" data-display="overlay" data-position="right" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9)">
			   <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_addremovelecturercontroller" data-icon="arrow-r" data-theme="a" data-role="button" rel="external">Edit Staff</a>
			   <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_viewlecturerpostscontroller" data-icon="arrow-r" data-theme="a" data-role="button" rel="external">Staff Posts</a>
			   <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_reportedissuescontroller" data-icon="arrow-r" data-theme="a" data-role="button" rel="external">Reported Issues</a>
			</div><!-- // live updates panel -->

			<div data-role="header" data-position="fixed" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white;">
				<a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/login_controller/destroySession" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-btn-inline">Logout</a>
				 	<h1>Admin Portal</h1>
				<a href="#adminOptionsPanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext ui-btn-a ui-btn-inline ui-nodisc-icon ui-alt-icon"></a>
			</div>


			<div  data-role="content">
				<div id="adminroominfotitlesdiv">
					<p style="text-shadow:none; color:#F16C4F; text-align:center">Edit Room Information</p>
					<?	// validation fields 
						echo "<span style=\"color:green; text-shadow:none\">".$ConfirmationMessage."</span>";
						echo "<span style=\"color:red; text-shadow:none\">".$ErrorMessage."</span>";
					?>
				</div>
				<div id="formholdingdiv">
					<!-- this form dynamically creates a list of rooms to select from to edit -->
					<form method="POST" data-ajax="false">
						<div style="width:98%; margin-left:auto; margin-right:auto">
							<select name="roomselection" data-theme="b" id="roomselection1" onchange="fetchrooms(this.value);">
								<?
			    					foreach ($roomArray->result() as $line) 
			    					{
			       						echo '<option value="'.$line->roomname.'" >'.$line->roomname.'</option>';
			    					}
								?>
							</select>
						</div>
					</form> 

					<!-- ajax form div which dynamically displays the editable room and upload image fields -->
			 		<div id="formdiv" style="width:100%">
					</div>

				</div> <!-- //formholdingdiv -->

			</div> <!--//content-->

		</body>

	</div> <!--//page-->

	<head>
		<meta http-equiv="pragma" content="no-cache">
	</head>
</html>