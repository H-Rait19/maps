<?php
    class Mapviewroomcontroller extends CI_Controller {
            public function __construct()
        {
                parent::__construct();
        }
 

        public function index()
        {   
                //get room name to view from post data
               	$room = $this->input->post('roomname');
                $this->load->model('mapviewroom_model');
               	$roomdetailsfromDB = $this->mapviewroom_model->getRoomDetailsDB($room); //retrieve details of that room

                //load view room page with all the room details
                $this->load->view('mapviewroom_view',array('roomname' => $roomdetailsfromDB['roomname'],'roomfloor' => $roomdetailsfromDB['roomfloor'],'roomdetails' => $roomdetailsfromDB['roomdetails'], 'roomdetails' => $roomdetailsfromDB['roomdetails'],
                     'roomtype' => $roomdetailsfromDB['roomType'], 'roomresources' => $roomdetailsfromDB['roomResources'], 'roomimagename' => $roomdetailsfromDB['roomImageName'], 'lastupdated' => $roomdetailsfromDB['lastupdated']));

        }

} 
?>