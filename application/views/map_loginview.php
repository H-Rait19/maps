<!DOCTYPE html>  
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
        <title>Login</title>
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </head>


    <div data-role="page" style="background-color: #1D1D1D"> 
        <body>
            <!-- another header goes here for AJAX functionality to successfully work as well as CSS styling -->
            <head>
                <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'/>
                <style type="text/css">
                    html, body 
                    {
                        height: 98vh; 
                        background-color: #1D1D1D;
                        font-family: 'Varela Round', sans-serif;
                    }
                </style>
            </head>


    	    <div data-role="header" data-position="fixed" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white;">
                <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/welcomemap" class="ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext ui-btn-a ui-btn-inline ui-nodisc-icon ui-alt-icon" data-transition="pop" data-ajax="false"></a>
                <h1>Login</h1>
            </div>
        
            <div data-role="content"> 

                <h1 style="text-align:center; color:white; text-shadow:none">Log In</h1>
                <p style="text-align:center; color:red; text-shadow:none;"> <?php echo $errmsg; ?> </p>

                <div style="width:300px; height:300px; border-radius:10px; background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white; margin-left:auto; margin-right:auto; text-shadow:none; padding-top:20px">
                    <!-- login div -->
                    <div style="width:200px; margin-left:auto; margin-right:auto;" > 

    				    <form action="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/login_controller/authenticate" method="POST" data-ajax="false">
                            <label for="loginid" class="select">Select ID</label>
                            <select name="loginid" id="loginid1" data-theme="b">
                                <?
                                    foreach ($arrayLecIDs->result() as $line) 
                                    {
                                        echo '<option value="'.$line->loginid.'" >'.$line->loginid.'</option>';
                                    }
                                ?>
                            </select>
                            Password: <input type=password name="password" data-theme="b">
                            <input value="Submit" type=submit data-icon="gear" data-theme="b">
                        </form>
                        
                    </div> <!-- //login div -->
                </div>

            </div> <!-- //content DIV -->
        </body>
    </div> <!-- //page -->

    <head>
        <meta http-equiv="pragma" content="no-cache">
    </head>
</html>       
