<?php
class Mapseventh_controller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                //$this->index();
                //$this->load->library('javascript');
        }
 

        public function index()
        {
               		$num = 1;
               		$this->load->model('map_model');
                    $floor = "7";
                	$roomsfromDB = $this->map_model->getRoomNamesDB($floor); //get room names from model
                	$seventhrooms = new SplFixedArray(27); //array to hold all room name]

                    //loop through array 
                	foreach ($roomsfromDB->result() as $line) 
                    {
                		$seventhrooms[$num] = $line->roomname; //save into array
                		$num = $num + 1; //count through array
           			}
                    $allStaff = $this->map_model->getAllStaffNames();
                    //display map with room names
                    $this->load->view('mapseventh_view',array('seventhroom' => $seventhrooms, 'allStaff' => $allStaff));

        }



} 
?>