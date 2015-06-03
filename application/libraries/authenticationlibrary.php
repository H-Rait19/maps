<?php
class Authenticationlibrary {
 
    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('login_model');
    }


    public function login($user,$pwd)
        {

            //validate fields to check for empties
            if($user == '' || $pwd == '') 
            {
                return false;
            }
            
            //send to model to log in then return 
            return $this->ci->login_model->loginDB($user,$pwd);     
        }


    public function is_loggedin()
        {
            //retrieve loggin details from model to check if user is logged in
            return $this->ci->login_model->is_loggedin();
        }





}
?>