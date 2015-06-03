<!doctype html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin - Add/Remove Lecturers</title>
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </head>

    <div style="background-color: #1D1D1D" data-role="page" class="adminlectureraddremovepage"> 
        <body>
            <!-- another head is called here for the CSS to correctly display -->
            <head>
                <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'/>
                <style type="text/css">
                    html, body 
                    {
                        height: 92vh; 
                        background-color: #1D1D1D;
                        font-family: 'Muli', sans-serif;
                    }
                    #viewlecturersdiv
                    {
                		width:98%; 
                		background-color:#7CC476; 
                		color:black; 
                		border-radius:3px; 
                		height:70vh; 
                		overflow:scroll;
                		margin-left: auto;
                		margin-right: auto;
                		text-shadow:none;
                        text-align: center;
                	}
                	#adminlectitlediv
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

                <!-- titles -->
            	<div id="adminlectitlediv">
                    <p style="color:#7CC476; text-align:center; margin-left:auto; margin-right:auto">Edit Lecturers</p>
                    <p style="color:#7CC476; text-shadow:none; text-align:center"><? echo $ConfMsg; ?></p>
                    <p style="color:red; text-shadow:none; text-align:center"><? echo $ErrMsg; ?></p>
                </div>


                <div id="viewlecturersdiv">
                    <!-- lecturers dynamically loaded into this div using foreach and POST data -->
                    <?php
                        foreach ($AllLecturers->result() as $line) 
                        {
                        	if($line->loginid != "admin.wmin") //make sure ADMIN is not added to the form
                        	{
                            	echo '<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_addremovelecturercontroller/deleteLecturer" method="POST" style="text-align:center" data-ajax="false">
                            			<p><b>Login ID</b></p>
                            			<p>'.$line->loginid.'</p>
                            			<p><b>Name</b></p>
                            			<p>'.$line->fullName.'</p>
                                        <p><b>Email</b></p>
                                        <p>'.$line->email.'</p>
                            			<input type="hidden" value="',$line->id,'" name="idLecturerToDelete" >
                            			<input type="hidden" value="',$line->fullName,'" name="NametoDelete" >
                            			<input value="Delete Lecturer" data-inline="true" data-mini="true" data-theme="b" type=submit>
                            		</form> <br/>';
                                echo "<div style=\"width:80%; height: 5px; border-radius:2px; background-color: #005518; margin-left:auto; margin-right:auto;\"></div>";
                            }
                        }
                    ?>
                </div>

    			<a href="#popupBasic" data-rel="popup" data-role="button" data-theme="b" data-position-to="window" data-transition="flow">Add New Lecturer</a>

                <!-- this is the pop up form to register a new staff member -->
                <div data-role="popup" id="popupBasic" style="background-color:#1D1D1D; color:white">
                    <!-- Form allows user to post to the live feed -->
                	<p style="text-align:center; color:#7CC476; text-shadow:none "><b>New Lecturer</b></p>
                	<form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_addremovelecturercontroller/addLecturer" 
                                                                                                    data-ajax="false" method="POST" style="padding:20px;">
                        <input type="text" name="fullName" placeholder="Full Name" data-theme="b" required/>
                        <input type="text" name="loginID" placeholder="Login ID" data-theme="b" required/>
                        <input type="password" name="password" placeholder="Password" data-theme="b" required/>
                        <input type="password" name="confPassword" placeholder="Confirm Password" data-theme="b" required/>
                        <input type="text" name="email" placeholder="Email" data-theme="b" required/>
                        <input value="Add" type=submit data-icon="plus" data-theme="a"/>
                	</form>
                </div>


            </div> <!--//content-->

        </body>

    </div> <!--//page-->

    <head>
        <meta http-equiv="pragma" content="no-cache">
    </head>
</html>