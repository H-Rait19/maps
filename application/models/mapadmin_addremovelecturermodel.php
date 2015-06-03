<?php
class Mapadmin_addremovelecturermodel extends CI_Model {

    function __construct()
    {
       parent::__construct();
       $this->load->database(); //load DB
       
    }


    function getAllLecturers(){
        //get all lecturer information to initialise form
        $result = $this->db->get('lecturerportal');
            
        return $result; //return array of all lecturers
    }

    function deleteLecturerDB($IDtoDelete, $NametoDeletePosts)
    {
        $data = $this->db->where('id', $IDtoDelete); //find row to Delete using ID
        $this->db->delete('lecturerportal',$data); //Delete lecturer from DB

        $data = $this->db->where('postedby', $NametoDeletePosts); //find post to Delete using name
        $this->db->delete('lecturerposts',$data); //Delete posts from DB

        return "Lecturer deleted! Any posts have also been deleted";
    }

    function addLecturerDB($loginID, $fullname, $password, $email)
    {
        //insert new staff member to be registered
        $this->db->insert('lecturerportal',array('loginid' => $loginID.".wmin", 
            'fullName' => $fullname, 'email' => $email, 'password' => sha1($password)));
        return "New lecturer successfully added!";  
    }

}