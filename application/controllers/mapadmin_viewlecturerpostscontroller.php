<?php
class Mapadmin_viewlecturerpostscontroller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
        }
 

        public function index()
        {
                $this->load->library('authenticationlibrary');

                //if session matches then grabs the members login ID
                $loggedin = $this->authenticationlibrary->is_loggedin();

                //if login attempt is false
                if ($loggedin === false) {
                    $this->load->database();
                    $lecturerIDs = $this->db->get('lecturerportal');
                    $this->load->view('map_loginview',array('errmsg' => '','state' => '','arrayLecIDs' => $lecturerIDs));

                }
                elseif ($loggedin == "admin.wmin") //if logged in user is ADMIN load continue to load staff posts view
                {
                    $this->load->model('mapadmin_viewlecturerpostsmodel');
                    $allPostsFromDB = $this->mapadmin_viewlecturerpostsmodel->getAllPosts(); //get all staff posts
                    $this->load->view('mapadmin_viewlecturerpostsview',array('Allposts' => $allPostsFromDB, 'ConfMsg' => ""));
                }
                else //else load lecturer portal view
                {
                    $this->load->model('mapadmin_model');
                    $loginName = $this->mapadmin_model->getLecturerName($loggedin);
                    $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => ""));
                }
        }

        public function deleteStaffPost() //delete from db function
        {
            //get ID from POST data
            $idToDelete = $this->input->post('idPostToDelete');
            $this->load->model('mapadmin_viewlecturerpostsmodel');
            //send to model to delete staff post from database
            $Msg = $this->mapadmin_viewlecturerpostsmodel->deletePostFromDB($idToDelete);

            //reload view with updated list of staff posts and confirmation message
            $allPostsFromDB = $this->mapadmin_viewlecturerpostsmodel->getAllPosts();
            $this->load->view('mapadmin_viewlecturerpostsview',array('Allposts' => $allPostsFromDB, 'ConfMsg' => $Msg));
        }

} 
?>