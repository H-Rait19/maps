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
        <title>Interactive Maps</title>
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
        </style>
    </head>

    <div style="background-color: #1D1D1D" data-role="page" class="mapwelcomepage">
        <body>
            <div data-role="header" data-position="fixed" data-theme="b" style="background: linear-gradient(180deg, #4A8FD3, #0F65B9); color: white;">
                <h1>Interactive Maps</h1>
            </div>
            <div  data-role="content">
                <div style="margin-left:auto; margin-right:auto; width:70%; padding-left:20px; padding-top:10px; padding-right:20px; border-radius:10px; background-color:#FAAE5C; margin-top:10px;">
                    <h3 style="text-align:center; color: black; text-shadow:none">Floors</h3>
                        <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapmain" data-role="button" data-icon="carat-r" data-theme="b" data-ajax="false" class="ui-nodisc-icon">Lower Ground Floor</a>
                        <br/>
                        <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapground_controller" data-role="button" data-icon="carat-r" data-theme="b" data-ajax="false" class="ui-nodisc-icon">Ground Floor</a>
                        <br/>
                        <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapseventh_controller" data-role="button" data-icon="carat-r" data-theme="b" data-ajax="false" class="ui-nodisc-icon">Seventh Floor</a>
                        <br/>
                </div>

                <div style="margin-left:auto; margin-right:auto; width:60%; padding-left:10px; padding-right:10px; padding-top:10px; border-radius:10px; background-color:#5583ff; margin-top:30px;">
                    <h3 style="text-align:center; color: black; text-shadow:none">Admin/Staff Access</h3>
                    <a href="https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/mapadmin_controller" data-role="button" data-icon="lock" data-theme="b" data-ajax="false" class="ui-nodisc-icon">Admin/Staff Login</a>
                    <br/>
                </div>
                
            </div> <!-- //content -->
        </body>

    </div> <!-- page -->


</html>