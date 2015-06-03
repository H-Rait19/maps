<?php
class Login_controller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                
                $this->load->library('authenticationlibrary');
                $this->load->helper('url');
        }
 

        public function index()
        {
                //if session matches then grabs the members table array
                $loggedin = $this->authenticationlibrary->is_loggedin();

                //check if user logged in else return to login view
                if ($loggedin === false) 
                {
                    $this->load->model('mapadmin_model');
                    $lecturerIDs = $this->mapadmin_model->getAllLecturers(); //get all rooms from DB 
                    $this->load->view('map_loginview',array('errmsg' => '','state' => '','arrayLecIDs' => $lecturerIDs));

                }
                elseif ($loggedin == "admin.wmin") 
                {
                    $this->load->model('mapadmin_model');
                    $allRoomsFromDB = $this->mapadmin_model->getAllRooms();
                    $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 'ConfirmationMessage' => "", 'ErrorMessage' => ""));
                }
                else
                {
                    $this->load->model('mapadmin_model');
                    $loginName = $this->mapadmin_model->getLecturerName($loggedin);
                    $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => ""));
                }
                

        }



        public function authenticate()
        {
                //get login form post data
                $loginid = $this->input->post('loginid');
                $loginpassword = $this->input->post('password');

                //send to authentication library to check login and return true or false
                $data = $this->authenticationlibrary->login($loginid,$loginpassword);

                //if login attempt is not false and user logging in is ADMIN then load admin portal view
                if ($data !== false && $loginid == "admin.wmin") 
                {
                    $this->load->model('mapadmin_model');
                    $allRoomsFromDB = $this->mapadmin_model->getAllRooms(); //get list of all rooms
                    $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 'ConfirmationMessage' => "", 'ErrorMessage' => ""));
                }
                elseif ($data === false) 
                {
                    //else display error msg on login page
                    $this->load->database();
                    $lecturerIDs = $this->db->get('lecturerportal');
                    $this->load->view('map_loginview',array('errmsg' => 'Unable to login - please try again','state' => '','arrayLecIDs' => $lecturerIDs));
                }
                else
                {
                    //else the only other logged in user could be staff so load staff portal view
                    $this->load->model('mapadmin_model');
                    $loginName = $this->mapadmin_model->getLecturerName($loginid);
                    $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => ""));
                }


                
        }


        public function destroySession() //destroy session for logging out
        {
                $this->session->sess_destroy(); //destroy session
                $this->index(); //reload index function to return to login page       
        }
     

} 
?>
