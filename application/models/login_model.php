<?php
class Login_model extends CI_Model {
    function __construct()
    {
       parent::__construct();
       $this->load->database();
       $this->load->library('javascript');
    }

    
    function registerDB($loginid,$Rpwd)
    {    
            $hashpwd = sha1($Rpwd); //hash password for security purposes
            $this->load->database();
            //save into DB
            $this->db->insert('lecturerportal',array('loginid' => $loginid,'password' => $hashpwd));


            return "Registered!"; // no error message because all is ok        
    }


    function loginDB($loginid,$pwd)
    {    
        //get login details where matching
        $res = $this->db->get_where('lecturerportal',array('loginid' => $loginid,'password' => sha1($pwd)));

        if ($res->num_rows() != 1) 
        { // should be only ONE matching row otherwise return false and error message
            return false;
            echo "not working";
        }
        else //else on match is found so continue
        {
            $session_id = $this->session->userdata('session_id'); //get session id of current session
            $row = $res->row_array(); //convert to row array for DB return result
            $this->load->database();
            //save loginID and sessionID for verification purposes
            $this->db->insert('maplogins',array('sessionid' => $session_id,'loginid' => $loginid));
            return $row; //return database row array
        }

    }


    function is_loggedin()
    {
        $session_id = $this->session->userdata('session_id'); //get current session ID

        //check DB to see if current session matches the logged in session
        $res = $this->db->get_where('maplogins',array('sessionid' => $session_id)); 
        
        //if session matches
        if ($res->num_rows() == 1) 
        {
            $row = $res->row_array();
            return $row['loginid']; //return login ID
        }
        else 
        {
            return false; //else no matches so return FALSE
        }
    }




}
  