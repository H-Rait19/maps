        //initialise variables
        var searchBarIsExtended = false;
        var isviewkeybuttonpressed = false;
        var currentrotation = 0;
        var zoomLevel = 1.0;
        var IDofRoomClicked;

        $(document).ready(function (){


                //animate search bar
                $( "#searchholdingdiv" ).click(function() {
                    if (searchBarIsExtended == false) {
                        $("#searchholdingdiv").css({ width: "200px", opacity: 1 });
                        $("#ajaxsearchresultsdiv").css({ height: "200px", opacity: 1 });
                        searchBarIsExtended = true;
                    }
                }); //end search animare func
                $( "#searchholdingdiv" ).mouseleave(function() {
                    if (searchBarIsExtended == true) {
                        $('#ajaxsearchresultsdiv').val("");
                        $("#searchholdingdiv").css({ width: "70px", opacity: 1 });
                        $("#ajaxsearchresultsdiv").css({ height: "0px", opacity: 0 });
                        searchBarIsExtended = false;
                    }
                });



                //rotate map anti-clockwise
                $('#rotatebutton1').click(function() {
                        currentrotation = currentrotation - 90;
                        //enable transitions
                        $('svg').css("-webkit-transition", "0.5s all");
                        $('svg').css("-moz-transition", "0.5s all");
                        $('svg').css("-os-transition", "0.5s all");
                        $('svg').css("-ms-transition", "0.5s all");
                        $('svg').css("transition", "0.5s all");
                                $('svg').css('-webkit-transform','rotate('+currentrotation+'deg)'); 
                                $('svg').css('-moz-transform','rotate('+currentrotation+'deg)');
                                $('svg').css('transform','rotate('+currentrotation+'deg)');
                });


                //rotate map clockwise
                $('#rotatebutton2').click(function() {
                        currentrotation = currentrotation + 90;
                        //enable transitions
                        $('svg').css("-webkit-transition", "0.5s all");
                        $('svg').css("-moz-transition", "0.5s all");
                        $('svg').css("-os-transition", "0.5s all");
                        $('svg').css("-ms-transition", "0.5s all");
                        $('svg').css("transition", "0.5s all");
                            $('svg').css('-webkit-transform','rotate('+currentrotation+'deg)'); 
                            $('svg').css('-moz-transform','rotate('+currentrotation+'deg)');
                            $('svg').css('transform','rotate('+currentrotation+'deg)');
                });

                //$box = jQuery('svg');

                //zoom in
                $('#zoomin').click(function() {
                    if (zoomLevel <= 2.0) {
                        //disable transitions for zoom since Firefox does not support it
                        $('svg').css("-webkit-transition", "none");
                        $('svg').css("-moz-transition", "none");
                        $('svg').css("-os-transition", "none");
                        $('svg').css("-ms-transition", "none");
                        $('svg').css("transition", "none");
                        $('svg').css({ 'zoom': zoomLevel += 0.2 });
                    } else {
                        alert("Zoom-in limit reached!");
                    }

                });


                //zoom out
                $('#zoomout').click(function() {
                    if (zoomLevel >= 0.4) {
                        //disable transitions for zoom since Firefox does not support it
                        $('svg').css("-webkit-transition", "none");
                        $('svg').css("-moz-transition", "none");
                        $('svg').css("-os-transition", "none");
                        $('svg').css("-ms-transition", "none");
                        $('svg').css("transition", "none");
                        $('svg').css({ 'zoom': zoomLevel -= 0.2 });
                    } else {
                        alert("Zoom-out limit reached!");
                    }
                });


                //zoom reset
                $('#resetZoomLevel').click(function() {
                    //reset fields
                    zoomLevel = 1.0;
                    currentrotation = 0;
                    //enable transitions
                    $('svg').css("-webkit-transition", "1s all");
                    $('svg').css("-moz-transition", "1s all");
                    $('svg').css("-os-transition", "1s all");
                    $('svg').css("-ms-transition", "1s all");
                    $('svg').css("transition", "1s all");
                        $('svg').css('-webkit-transform','rotate(0deg)'); 
                        $('svg').css('-moz-transform','rotate(0deg)');
                        $('svg').css('transform','rotate(0deg)');
                        $('svg').css({ 'zoom': zoomLevel});
                });


                //view key button pressed
                $('#viewkeybutton').click(function() {
                    if (isviewkeybuttonpressed == false) {
                        $("#showkeycoloursdiv").css("width", 10);
                        $("#showkeycoloursdiv").css({ height: "50%", opacity: 1 });
                        $("#showkeycoloursdiv").css({ width: "40%", opacity: 1 });
                        isviewkeybuttonpressed = true;
                        
                    } else {
                        $("#showkeycoloursdiv").css({ height: "10px", opacity: 0 });
                        $("#showkeycoloursdiv").css({ width: "0px", opacity: 0 });
                        isviewkeybuttonpressed = false;
                    }
                });

                /*  Once a user clicks a viewable room, this function takes the id of 
                 *  that room and inserts it into a form then submits to view that room
                 */
                $(".roomclass").click(function() {
                    IDofRoomClicked = $(this).attr('id');
                    $('#insertroomnameasvalue').val(IDofRoomClicked);
                    $('#viewroomform').submit();
                });
                $(".officeclass").click(function() {
                    IDofRoomClicked = $(this).attr('id');
                    $('#insertroomnameasvalue').val(IDofRoomClicked);
                    $('#viewroomform').submit();
                });
                $(".poiclass").click(function() {
                    IDofRoomClicked = $(this).attr('id');
                    $('#insertroomnameasvalue').val(IDofRoomClicked);
                    $('#viewroomform').submit();
                });
                $(".officeclass").click(function() {
                    IDofRoomClicked = $(this).attr('id');
                    $('#insertroomnameasvalue').val(IDofRoomClicked);
                    $('#viewroomform').submit();
                });
                $(".facilitiesclassclickable").click(function() {
                    IDofRoomClicked = $(this).attr('id');
                    $('#insertroomnameasvalue').val(IDofRoomClicked);
                    $('#viewroomform').submit();
                });

        });

