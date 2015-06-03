<?php
class Welcomemap extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                
        }
 

        public function index()
        {
               		//load homepage
                    $this->load->view('welcome_map_page');

        }

} 
?>
