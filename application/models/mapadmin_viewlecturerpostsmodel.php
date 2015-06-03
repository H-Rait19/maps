<?php
class Mapadmin_viewlecturerpostsmodel extends CI_Model {

    function __construct()
    {
       parent::__construct();
       $this->load->database();
       
    }


    function deletePostFromDB($IDtoDelete)
    {

        $data = $this->db->where('id', $IDtoDelete); //find row to Delete using ID
        $this->db->delete('lecturerposts',$data); //Delete post from DB

        return "Deleted staff post!"; //return confirmation
    }


    function getAllPosts()
    {
        //get all staff posts
        $result = $this->db->get('lecturerposts');
            
        return $result; //return posts
    }

}




