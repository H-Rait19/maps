<?php
class Mapadmin_reportedissuescontroller extends CI_Controller {
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
                elseif ($loggedin == "admin.wmin") //if logged in user is ADMIN load continue to load reported issues view
                {
                    $this->load->model('mapadmin_reportedissuesmodel');
                    $allReportsFromDB = $this->mapadmin_reportedissuesmodel->getAllReports(); //get all reported issues
                    $this->load->view('mapadmin_viewreportedissuesview',array('Allreports' => $allReportsFromDB, 'ConfMsg' => ""));
                }
                else //else load lecturer portal view
                {
                    $this->load->model('mapadmin_model');
                    $loginName = $this->mapadmin_model->getLecturerName($loggedin);
                    $allPosts = $this->mapadmin_model->getAllLecturerPosts($loginName); //retrieve staff members previous live posts
                    $this->load->view('maplecturerportal_view',array('AllPosts' => $allPosts, 'loginName' => $loginName, 'PostConfMsg' => "", 'PostErrMsg' => ""));
                }
        }

        public function deleteReportedIssue() //delete from db function
        {
            //get ID from POST data
            $idToDelete = $this->input->post('idReportToDelete');
            $this->load->model('mapadmin_reportedissuesmodel');
            //send to model to delete reported issue from database
            $Msg = $this->mapadmin_reportedissuesmodel->deleteReportFromDB($idToDelete);

            //reload view with updated list of reports and confirmation message
            $allReportsFromDB = $this->mapadmin_reportedissuesmodel->getAllReports();
            $this->load->view('mapadmin_viewreportedissuesview',array('Allreports' => $allReportsFromDB, 'ConfMsg' => $Msg));
        }

} 
?>