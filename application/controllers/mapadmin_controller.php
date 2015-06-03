<?php
class Mapadmin_controller extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                //load helpers and preconfigured libraries
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('authenticationlibrary');
                $this->load->library('javascript');
        }
 

        public function index()
        {
                $this->load->library('authenticationlibrary');

                //if session matches then grab logged in user loginID
                $loggedin = $this->authenticationlibrary->is_loggedin();


                if ($loggedin === false) 
                {
                    //if not logged in, load login view
                    $this->load->model('mapadmin_model');
                    $lecturerIDs = $this->mapadmin_model->getAllLecturers(); //get all rooms from DB 
                    $this->load->view('map_loginview',array('errmsg' => '','state' => '','arrayLecIDs' => $lecturerIDs));

                }
                //else if logged in user is admin then load admin portal view
                elseif ($loggedin == "admin.wmin") 
                {
                    $this->load->model('mapadmin_model');
                    $allRoomsFromDB = $this->mapadmin_model->getAllRooms(); //get all rooms from DB 
                    $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 'ConfirmationMessage' => "", 'ErrorMessage' => ""));
                }

                //else logged in user can only be staff member so load lecturer portal view
                else
                {
                    $this->load->model('mapadmin_model');
                    $loginName = $this->mapadmin_model->getLecturerName($loggedin);
                    $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => ""));
                }
               	

        }

        public function updateImage()
        {
            
            //set up codeigniter image upload config
            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'jpg|jpeg';
            $config['overwrite'] = 'TRUE';
            $this->load->library('upload',$config); //set configurations

            //if cant upload then return error message to user
            if (!$this->upload->do_upload('userfile')) 
            {
                //get error message from upload error list then load view to display error message
                $error = array('error' => $this->upload->display_errors());
                $this->load->model('mapadmin_model');
                $allRoomsFromDB = $this->mapadmin_model->getAllRooms();
                $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 'ErrorMessage' => "Not uploaded! Image has to be JPG or JPEG", 'ConfirmationMessage' => ""));
            } 
            //else upload has been successful 
            else 
            {
                $file_data = $this->upload->data(); //upload data
                $data = array('upload_data' => $this->upload->data()); //get upload information
                $this->load->model('mapadmin_model');
                //save image name to database by retrieving file name from upload data
                $ValidationMsg = $this->mapadmin_model->uploadImage($data['upload_data']['file_name'], $this->input->post('roomidforimage'));
                //retrieve all rooms
                $allRoomsFromDB = $this->mapadmin_model->getAllRooms();
                //load view with confirmation message and updated list of rooms
                $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 'ConfirmationMessage' => $ValidationMsg, 'ErrorMessage' => ""));

            } 
        }

        public function updateRoom()
        {

            //get all POST data from update form
            $ID = $this->input->post('roomid');
            $Rname = $this->input->post('roomname');
            $Rdetails = $this->input->post('roomdetails');
            $Rtype = $this->input->post('roomtype');
            $Rresources = $this->input->post('roomresources');

            $this->load->model('mapadmin_model');
            //send data to model function to upload to database
            $ValidationMsg = $this->mapadmin_model->updateRoomData($ID, $Rname, $Rdetails, $Rtype, $Rresources);

            //reload view with validation message
            $this->load->model('mapadmin_model');
            $allRoomsFromDB = $this->mapadmin_model->getAllRooms();

            //check validation message content to see if update was successfull
            if ($ValidationMsg === "Room Details Successfully Updated!") 
            {
                //if SUCCESSFUL reload view with confirmation message
                $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 
                    'ConfirmationMessage' => $ValidationMsg, 'ErrorMessage' => ""));
            }
            //else reload view with error message
            else
            {
                $this->load->view('mapadmin_view',array('roomArray' => $allRoomsFromDB, 
                    'ConfirmationMessage' => "", 'ErrorMessage' => $ValidationMsg));
            }
            

        }


        public function deletePost()
        {
            $this->load->model('mapadmin_model');
            // send POST form data to model function to delete live post from database
            $Msg = $this->mapadmin_model->deletePostDB($this->input->post('idPostToDelete'));

            //retrieve loginID of logged in user
            $loggedin = $this->authenticationlibrary->is_loggedin();
            $loginName = $this->mapadmin_model->getLecturerName($loggedin);
            $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
            $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => $Msg, 'PostErrMsg' => ""));

        }


        public function insertPost()
        {
            $loggedin = $this->authenticationlibrary->is_loggedin(); //get lecturer loginID
            $this->load->model('mapadmin_model');

            //check if post is empty in which case return to view with error message
            if ($this->input->post('postToInsert') == "") 
            {
                $allPosts = $this->mapadmin_model->getAllLecturerPosts($this->input->post('postedBy')); //retrieve staff members previous live posts
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $this->input->post('postedBy'), 'PostConfMsg' => $Msg, 'PostErrMsg' => "Error! Post empty, Unable to post"));
            }
            //else pass to model function to save to database
            else
            {
                $Msg = $this->mapadmin_model->insertPostDB($this->input->post('postToInsert'), $this->input->post('postedBy'));
                $allPosts = $this->mapadmin_model->getAllLecturerPosts($this->input->post('postedBy'));//get updated list of live posts
                //reload view with confirmation message and updated list of live posts
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $this->input->post('postedBy'), 'PostConfMsg' => $Msg, 'PostErrMsg' => ""));
            }
        }


        public function changePassword()
        {
            //get password form data
            $oldPW = $this->input->post('oldPassword');
            $newPW = $this->input->post('newPassword');
            $newPWConf = $this->input->post('newPasswordConf');

            $oldpwFromDB = ""; //initialise

            $loggedin = $this->authenticationlibrary->is_loggedin(); //get logged in loginID
            $this->load->model('mapadmin_model');

            $loginName = $this->mapadmin_model->getLecturerName($loggedin);
            //get all posts for when reloading lecturerportal view
            $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); 
                    
            
            $allLecturersFromDB = $this->mapadmin_model->getAllLecturers(); //get all lecturer details
            //get current password of current user
            foreach ($allLecturersFromDB->result() as $line) 
            {
                //loop to find matching login id to retrieve old password
                if($line->loginid == $loggedin)
                {
                    $oldpwFromDB = $line->password; //save old password to var
                }
            }

            //check if hashed posted old pw matches old password from DB
            if ($oldPW == "" || $newPW == "" || $newPWConf == "") 
            {
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 
                                        'PostConfMsg' => "", 'PostErrMsg' => "Empty fields not allowed!"));
            }
            elseif (sha1($oldPW) != $oldpwFromDB)
            {
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 
                                                            'PostConfMsg' => "", 'PostErrMsg' => "Old password does not match with the system!"));
            }
            else
            {
                //if new password matches confirmation password
                if ($newPW == $newPWConf) 
                {
                    //send to model to update user password in database
                    $Msg = $this->mapadmin_model->changePasswordDB($loggedin, $newPWConf);
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 
                                                                                    'PostConfMsg' => $Msg, 'PostErrMsg' => ""));
                }
                else
                {
                    //else new passwords dont match so reload view with error message
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 
                                                            'PostConfMsg' => "", 'PostErrMsg' => "New passwords dont match!"));
                }
            }
        }



        public function changeEmail()
        {
            //get email form data
            $oldEmail = $this->input->post('oldemail');
            $newEmail = $this->input->post('newemail');

            $oldemailFromDB;

            $loggedin = $this->authenticationlibrary->is_loggedin(); //get logged in loginID
            $this->load->model('mapadmin_model');

            $loginName = $this->mapadmin_model->getLecturerName($loggedin);
            $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //get all posts for when reloading lecturerportal view
                    
            
            $allLecturersFromDB = $this->mapadmin_model->getAllLecturers(); //get all lecturer details

            //get current email of user
            foreach ($allLecturersFromDB->result() as $line) 
            {
                //loop to find matching login id to retrieve old email
                if($line->loginid == $loggedin)
                {
                    $oldemailFromDB = $line->email; //save old email 
                }
            }

            //check if entered email matches old email from DB
            if ($newEmail == "") 
            {
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => "Empty fields not allowed!"));
            }
            elseif ($oldemailFromDB != $oldEmail)
            {
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => "Old email does not match with the system!"));
            }
            
            elseif (preg_match("/@/", $newEmail) && preg_match("/.uk/", $newEmail))
            {
                //send to model to update user email in database
                $Msg = $this->mapadmin_model->changeEmailDB($loggedin, $newEmail);
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => $Msg, 'PostErrMsg' => ""));
            }
            elseif (preg_match("/@/", $newEmail) && preg_match("/.com/", $newEmail))
            {
                //send to model to update user email in database
                $Msg = $this->mapadmin_model->changeEmailDB($loggedin, $newEmail);
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => $Msg, 'PostErrMsg' => ""));
            }
            else
            {
                $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => "Invalid new email!"));   

            }

        }



} 
?>