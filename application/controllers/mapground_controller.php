<?php
class Mapground_controller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->library('javascript');
        }
 

        public function index()
        {
               		$num = 1;
               		$this->load->model('map_model');
                    $floor = "Ground";
                	$roomsfromDB = $this->map_model->getRoomNamesDB($floor); //get room names from model
                	$cgroom = new SplFixedArray(27); //array to hold all room names

                    //retrieve all rooms for side panel which displays all rooms
                    $floorLG = $this->map_model->getAllRoomsLowerGround();
                    $floor7 = $this->map_model->getAllRoomsSeventh();

                    //loop through array 
                	foreach ($roomsfromDB->result() as $line) 
                    {
                		$cgroom[$num] = $line->roomname; //save each room name into array
                		$num = $num + 1; //count through array
           			}

                    //display map with room names
                    $this->load->view('mapground_view',array('allLG' => $roomsfromDB, 'allG' => $roomsfromDB, 'all7' => $floor7,'cg03' => $cgroom[1], 'cg02' => $cgroom[2], 'cg01' => $cgroom[3], 'cg05' => $cgroom[4], 'cg06' => $cgroom[5], 'fstregistry' => $cgroom[6], 'cafeneo' => $cgroom[7], 'studentunion' => $cgroom[8], 'marylebonebooks' => $cgroom[9], 'cg50' => $cgroom[10],
                    				'cg49' => $cgroom[11], 'cg27' => $cgroom[12], 'cg25' => $cgroom[13], 'cg26' => $cgroom[14], 'cg10' => $cgroom[15], 'smokeradio' => $cgroom[16], 'sushop' => $cgroom[17], 'cg24' => $cgroom[18], 'ng100' => $cgroom[19], 'ng107' => $cgroom[20],
                    				'ng101' => $cgroom[21], 'ng102' => $cgroom[22], 'ng106' => $cgroom[23], 'ng105' => $cgroom[24], 'ng103' => $cgroom[25], 'ng104' => $cgroom[26]));

        }



} 
?>