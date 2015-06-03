<?php
class Adminajax_model extends CI_Model {
    function __construct()
    {
        parent::__construct();      
        $this->load->database();
    }
    public function match($room)
    {
        //check DB for room matches
        $match = $this->db->get_where('maprooms',array('roomname' => $room));
        return $match; //return array of matches
    }
}
?>