<?php
class Adminajax_controller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->library('javascript');
        }


        public function lookup() //lookup func for AJAX search
        {
            $typed = $this->input->get('t');
            if ($typed == null || $typed == '') 
            {
                echo ''; // send back nothing if we got nothing
                exit;
            }
            $this->load->model('adminajax_model');
            $room = $this->adminajax_model->match($typed);
            $this->load->view('adminajax_view',array('selectedroom' => $room));
        }

} 
?>