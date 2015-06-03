<?php
class Mapviewroom_model extends CI_Model {

    function __construct()
    {
       parent::__construct();
       $this->load->database();
       
    }


    function getRoomDetailsDB($room){

        //get all room details from database where room name matches
        $res = $this->db->get_where('maprooms',array('roomname' => $room));
        $row = $res->row_array();
            
        return $row; //return array of room details
    }

}