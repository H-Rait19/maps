<?php
class Mapmain extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->library('javascript');
                $this->load->library('email');
        }
 

        public function index()
        {
               		$num = 1;
               		$this->load->model('map_model');
                    $floor = "-1";
                	$roomsfromDB = $this->map_model->getRoomNamesDB($floor); //send floor level to model to retrieve all room names from DB
                	$clgroom = new SplFixedArray(36); //create a new array

                    //retrieve all rooms for side panel which displays all rooms
                    $floorG = $this->map_model->getAllRoomsGround();
                    $floor7 = $this->map_model->getAllRoomsSeventh();

                    //loop through array to save room names
                	foreach ($roomsfromDB->result() as $line) 
                    {
                		$clgroom[$num] = $line->roomname;
                		$num = $num + 1;
           			}

                    //load map with rooms
                    $this->load->view('map_view',array('allLG' => $roomsfromDB, 'allG' => $floorG, 'all7' => $floor7, 'clgroom1' => $clgroom[1], 'clgroom2' => $clgroom[2], 'clgroom3' => $clgroom[3], 'clgroom4' => $clgroom[4], 'clgroom5' => $clgroom[5], 'clgroom6' => $clgroom[6], 'clgroom7' => $clgroom[7], 'clgroom8' => $clgroom[8], 'clgroom9' => $clgroom[9], 'clgroom10' => $clgroom[10],
                    									'clgroom11' => $clgroom[11], 'clgroom12' => $clgroom[12], 'clgroom13' => $clgroom[13], 'clgroom14' => $clgroom[14], 'clgroom15' => $clgroom[15], 'clgroom16' => $clgroom[16], 'clgroom17' => $clgroom[17], 'clgroom18' => $clgroom[18], 'clgroom19' => $clgroom[19], 'clgroom20' => $clgroom[20],
                    									'clgroom21' => $clgroom[21], 'clgroom22' => $clgroom[22], 'clgroom23' => $clgroom[23], 'clgroom24' => $clgroom[24], 'clgroom25' => $clgroom[25], 'clgroom26' => $clgroom[26], 'clgroom27' => $clgroom[27], 'clgroom28' => $clgroom[28], 'clgroom29' => $clgroom[29], 'clgroom30' => $clgroom[30],
                    									'clgroom31' => $clgroom[31], 'clgroom32' => $clgroom[32], 'clgroom33' => $clgroom[33], 'clgroom34' => $clgroom[34], 'clgroom35' => $clgroom[35], 'ajaxselectedroom' => ""));

        }

        public function lookup() //lookup func for AJAX search
        {
            //retrieve typed string
            $typed = $this->input->get('t');
            if ($typed == null || $typed == '') 
            {
                echo ''; // send back nothing if empty
                exit;
            }
            $this->load->model('wordviewajax_model');
            $wordlist['words'] = $this->wordviewajax_model->match($typed); //send to model to find matches then return any
            $this->load->view('wordviewajax_view',$wordlist); //load view with matches
        }

        public function reportIssue()
        {
            //retrieve POST details from report form
            $issueSubject = $this->input->post('issueSubject');
            $issueDetails = $this->input->post('issueDetails');
            $email = $this->input->post('userEmail');

            //send report to model to save into DB
            $this->load->model('map_model');
            $this->map_model->insertIssueDB($issueSubject, $issueDetails);

            //construct confirmation email for the user that has reported the issue
            $this->email->from('admin@cavendishmap.wmin.ac.uk', 'Admin');
            $this->email->to($email); 
            $this->email->subject('RE: '.$issueSubject.'.');
            $this->email->message('We have received your reported issue and will look into this as soon as possible. Your query was: '.$issueDetails.'. PLEASE DO NOT REPLY TO THIS EMAIL. UNMONITORED INBOX.');  
            $this->email->send();

            //reload map
            $this->index();

        }

} 
?>