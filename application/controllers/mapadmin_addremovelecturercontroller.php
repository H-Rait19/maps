<?php
class Mapadmin_addremovelecturercontroller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                //load preconfigured  helpers and libraries
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('authenticationlibrary');
                $this->load->library('email');
        }
 

        public function index()
        {
                //this library checks and authenticates login and logout requests
                $this->load->library('authenticationlibrary');
                //check if user is currently logged in and retrieve loginID
                $loggedin = $this->authenticationlibrary->is_loggedin();

                //if user not logged in, return to login screen 
                if ($loggedin === false) {
                    $this->load->database();
                    $lecturerIDs = $this->db->get('lecturerportal');
                    $this->load->view('map_loginview',array('errmsg' => '','state' => '','arrayLecIDs' => $lecturerIDs));
                }
                //else check if logged in user is ADMIN only then will the addremovelecturerview load
                elseif ($loggedin == "admin.wmin") 
                {
                    $this->load->model('mapadmin_addremovelecturermodel');
                    $allLecturersFromDB = $this->mapadmin_addremovelecturermodel->getAllLecturers(); //get list of all registered staff members
                    $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => "", 'ErrMsg' => ""));
                }
                //otherwise if not admin then the only other logged in user must be staff, therefore load lecturerportal
                else
                {
                    $this->load->model('mapadmin_model');
                    $loginName = $this->mapadmin_model->getLecturerName($loggedin);
                    $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => ""));
                }
        }


        public function deleteLecturer()
        {
            $this->load->model('mapadmin_addremovelecturermodel');
            //initiate method in model to delete selected staff member from database to unregister
            $Msg = $this->mapadmin_addremovelecturermodel->deleteLecturerDB($this->input->post('idLecturerToDelete'), $this->input->post('NametoDelete'));

            //reload view with updated list of staff members
            $allLecturersFromDB = $this->mapadmin_addremovelecturermodel->getAllLecturers();
            $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => $Msg, 'ErrMsg' => ""));
        }


        public function addLecturer()
        {
            $this->load->model('mapadmin_addremovelecturermodel');

            //grab all form post data
            $fullname = $this->input->post('fullName');
            $loginID = strtolower($this->input->post('loginID'));
            $password = $this->input->post('password');
            $confPassword = $this->input->post('confPassword');
            $email = $this->input->post('email');
            $allLecturersFromDB = $this->mapadmin_addremovelecturermodel->getAllLecturers();
            $match = false; //check if staff member already exists
            $Msg = ""; //confirmation msg

            //check for empty fields
            if ($fullname == "" || $loginID == "" || $password == "" || $confPassword == "" || $email == "") 
            {
                //if empty then load view with error message
                $allLecturersFromDB = $this->mapadmin_addremovelecturermodel->getAllLecturers();
                $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB,
                                                         'ConfMsg' => "", 'ErrMsg' => "No empty fields allowed!"));
            }
            else
            {
                //run through lecturer list to check if staff member already exists
                foreach ($allLecturersFromDB->result() as $line) 
                {
                    if($line->loginid == $loginID.".wmin" || $line->fullName == $fullname)
                    {
                        //if match is found then set TRUE
                        $match = true;
                    }
                }

                //check if admin is trying to be created in which case reload view with error message
                if ($loginID == "admin" || $fullname == "admin") 
                {
                    $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 
                                                            'ConfMsg' => "", 'ErrMsg' => "Cannot create new admin!"));
                }

                //if existing staff are found then return err msg
                elseif ($match == true) 
                {
                    $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 
                                                    'ConfMsg' => "", 'ErrMsg' => "Login ID or name already exists!"));
                }
                //check for valid email
                elseif (preg_match("/@/", $email) && preg_match("/.uk/", $email))
                {
                    //check if passwords match
                    if ($password == $confPassword) 
                    {
                        //register new staff member and return validation message
                        $Msg = $this->mapadmin_addremovelecturermodel->addLecturerDB($loginID, $fullname, $password, $email);

                        //create registration confirmation email to send to newely registered staff member
                        $this->email->from('admin@cavendishmap.wmin.ac.uk', 'Admin');
                        $this->email->to($email); 
                        $this->email->subject('Registered on Interactive Cavendish Map');
                        $this->email->message('You have successfully been registered on our Cavendish Interactive Map. 
                                                Here you can post live updates for everyone to see. Your login ID is '.$loginID.'.
                                                Your password is your surname which can be changed once you log in.
                                                https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/login_controller  |   Follow this link to log in.
                                                PLEASE DO NOT REPLY TO THIS EMAIL, UNMONITORED INBOX');   
                        $this->email->send();

                        //reload view with confirmation message and updated list of staff
                        $allLecturersFromDB = $this->mapadmin_addremovelecturermodel->getAllLecturers(); //refresh lecturer list
                        $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => $Msg, 'ErrMsg' => ""));
                    }
                    //else return error msg for unmatching passwords
                    else
                    {   
                        $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => "", 
                                                                                                        'ErrMsg' => "Passwords dont match!"));
                    }
                }
                //check for valid email
                elseif (preg_match("/@/", $email) && preg_match("/.com/", $email))
                {
                    //check if passwords match
                    if ($password == $confPassword) 
                    {
                        //register new staff member and return validation message
                        $Msg = $this->mapadmin_addremovelecturermodel->addLecturerDB($loginID, $fullname, $password, $email);

                        //create registration confirmation email to send to newely registered staff member
                        $this->email->from('admin@cavendishmap.wmin.ac.uk', 'Admin');
                        $this->email->to($email); 
                        $this->email->subject('Registered on Interactive Cavendish Map');
                        $this->email->message('You have successfully been registered on our Cavendish Interactive Map. 
                                                Here you can post live updates for everyone to see. Your login ID is '.$loginID.'.
                                                Your password is your surname which can be changed once you log in.
                                                https://w1377159.users.ecs.westminster.ac.uk/phpcw2/cimap/index.php/login_controller  |   Follow this link to log in.
                                                PLEASE DO NOT REPLY TO THIS EMAIL, UNMONITORED INBOX');  
                        $this->email->send();

                        //reload view with confirmation message and updated list of staff
                        $allLecturersFromDB = $this->mapadmin_addremovelecturermodel->getAllLecturers(); //refresh lecturer list
                        $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => $Msg, 'ErrMsg' => ""));
                    }
                    //else return error msg for unmatching passwords
                    else
                    {   
                        $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => "", 
                                                                                                        'ErrMsg' => "Passwords dont match!"));
                    }
                }
                //else return error msg for unmatching passwords
                else
                {   
                    $this->load->view('mapadmin_addremovelecturerview',array('AllLecturers' => $allLecturersFromDB, 'ConfMsg' => "", 
                                                                                                    'ErrMsg' => "Invalid email!"));
                }


            }
            
        } //addlecturer() END



} 
?>