<!doctype html>
	<head>
		<!-- GOOGLE FONTS API http://www.google.com/fonts#UsePlace:use  16/05/2015-->
		<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Varela+Round::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
  <!-- GOOGLE FONTS API -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cavendish Campus</title>
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		

			<style type="text/css">
				html, body 
				{
					height: 98vh; 
					background-color: #1D1D1D;
					font-family: 'Varela Round', sans-serif;
				}
				#roomdetailsholderdiv 
				{
					height:86vh;
					width: 98%;
					background-color: #FAAE5C;
					overflow: scroll;
					text-align: center;
					margin-left: auto;
					margin-right: auto;
					text-shadow: none;
					color: black;
					border-radius: 10px;
				}
				#roominformationdiv 
				{
					width: 96%;
					margin-left: auto;
					margin-right: auto;
					text-shadow: none;
					color: #805705;
				}
				#image
				{
					display: block;
					width: auto;
					max-width: 95%;
					height: 100%;
					margin-left: auto;
					margin-right: auto;
					z-index: 1;
					cursor:pointer;
				}
				#imageholderdiv
				{
					-webkit-transition-duration: 0.5s;
					-moz-transition-duration: 0.5s;
					-o-transition-duration: 0.5s;
					transition-duration: 0.5s;
				}
			</style>

			<script type="text/javascript">

				var imageclicked = false;
				
				$(document).ready(function (){
					
					//expand imagecs
					$( "#image" ).click(function() {
						if (imageclicked == false) {
							$("#imageholderdiv").css({ height: "60%", opacity: 1 });
							imageclicked = true;
						} else {
							$("#imageholderdiv").css({ height: "30%", opacity: 1 });
							imageclicked = false;
							//minimize image
						}
					}); //end image expand



				});
			</script>
		</head>

	<div style="background-color: #1D1D1D" data-role="page" class="mapviewroompage">
		<body>

			<!-- facebook like buttons -->
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<!-- facebook -->

			<div data-role="header" data-position="fixed" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white;">
				<a href="#" data-rel="back" data-theme="b" data-transition="pop" class="ui-btn ui-shadow ui-corner-all ui-icon-back ui-btn-icon-notext ui-btn-a ui-btn-inline ui-nodisc-icon ui-alt-icon"></a>
				<h1>Room Details</h1>
			</div>


			<div  data-role="content">

				<div id="roomdetailsholderdiv" style="-webkit-transform: translate3d(0,0,0);">
			
					<div id="imageholderdiv" style="width:100%; height:30%; background-color:black; overflow:hidden">
						<img src="https://users.wmin.ac.uk/~w1377159/phpcw2/cimap/images/<? echo $roomimagename; ?>" alt="Room image" title="Click to zoom" id="image">
						<!-- Display room image from server -->
					</div>

					<!-- ROOM NAME TITLE -->
					<h2><?php echo $roomname; ?></h2>
					<!-- ROOM DETAILS DISPLAYED HERE -->
					<div id="roominformationdiv">
						
		    			<p style="text-align:center; color:black;"><b>Floor</b></p>
		    			<p style="text-align:center"> <? echo $roomfloor; ?> </p> 

		    			<p style="text-align:center; color:black;"><b>Type</b></p>
		    			<p style="text-align:center"><? echo $roomtype; ?></p> 
		 
		    			<p style="text-align:center; color:black;"><b>Details</b></p>
		    			<p style="text-align:center"><? echo $roomdetails; ?></p> 
		  				
		    			<p style="text-align:center; color:black;"><b>Additional information</b></p>
		    			<p style="text-align:center"><? echo $roomresources; ?></p> 
		  				
		    			<p style="text-align:center; color:black;"><b>Last updated</b></p>
		    			<p style="text-align:center"><? echo $lastupdated; ?></p> 
		    			
		  			
						<?php 
							//check which floor the room is on and load relevant form so user can navigate to that floor map
							if ($roomfloor === "-1") {
								echo "<a href=\"https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapmain\" data-role=\"button\" data-icon=\"carat-r\" data-theme=\"b\" data-ajax=\"false\" class=\"ui-nodisc-icon\">View Floor Map</a>";
							}
							if ($roomfloor === "Ground") {
								echo "<a href=\"https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapground_controller\" data-role=\"button\" data-icon=\"carat-r\" data-theme=\"b\" data-ajax=\"false\" class=\"ui-nodisc-icon\">View Floor Map</a>";
							}
							if ($roomfloor === "7") {
								echo "<a href=\"https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapseventh_controller\" data-role=\"button\" data-icon=\"carat-r\" data-theme=\"b\" data-ajax=\"false\" class=\"ui-nodisc-icon\">View Floor Map</a>";
							}
				        ?>
					</div>

					<div style="text-align:center;">
						<!-- twitter share button -->
						<a href="https://twitter.com/share" class="twitter-share-button" data-url=".." data-text="Im in " data-hashtags="<? echo $roomname; ?>">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<!--facebook share button-->
						<div class="fb-like" data-href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/welcomemap" data-layout="button_count" data-action="recommend" data-show-faces="false" data-share="true"></div>
					</div>

				</div> <!-- //room details div -->

			</div> <!--//content-->

		</body>

	</div> <!--//page-->

	<head>
		<meta http-equiv="pragma" content="no-cache">
	</head>
</html>