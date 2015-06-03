<?php
class Mapajax_controller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->library('javascript');
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
            //send to AJAX model to find matches in database then return any matches
            $wordlist['words'] = $this->wordviewajax_model->match($typed);

            //load view with matches
            $this->load->view('wordviewajax_view',$wordlist);
        }

        
        //lookupName func to retrieve all posts which match staff name
        public function lookupName() 
        {
            //retrieve staff name
            $name = $this->input->get('t');
            if ($name == null || $name == '') 
            {
                echo ''; // send back nothing if empty
                exit;
            }
            $this->load->model('wordviewajax_model');
            //send to AJAX model to find matches in database then return any matches
            $postlist = $this->wordviewajax_model->getAllLecturerPosts($name);

            //load view with matches
            $this->load->view('mapseventhlivepostsajax_view',
                                array('posts' => $postlist, 'isSearchResult' => ""));
        }

        //lookup func for AJAX live posts panel which returns the live post search results
        public function lookupKeywordMatch() 
        {
            $isSearchResult = "yes"; //identifier for view to check 
            //retrieve staff name and typed word
            $name = $this->input->get('t');
            $word = $this->input->get('c');
            if ($word == null || $word == '') 
            {
                echo ''; // send back nothing if empty
                exit;
            }
            $this->load->model('wordviewajax_model');
            //send to AJAX model to find live post matches in database then return any matches
            $postlist = $this->wordviewajax_model->matchposts($name, $word);

            //load view with matches
            $this->load->view('mapseventhlivepostsajax_view',array(
                                'posts' => $postlist, 'isSearchResult' => $isSearchResult));
        }


} 
?>