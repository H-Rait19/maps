<?php
class Map_model extends CI_Model {

    function __construct()
    {
       parent::__construct();
       $this->load->database();
       
    }


    function getRoomNamesDB($floor){

        $rooms = $this->db->get_where('maprooms',array('roomfloor' => $floor)); //get all room details from db where floor matches
        return $rooms; //return array
    }

    function insertIssueDB($issueSubject, $issueDetails)
    {
        //insert reported issue into database with time and date
        $this->db->insert('mapreportedissues',array('issueSubject' => $issueSubject,'issueDetails' => $issueDetails, 'timeReported' => date('H:i:s'), 'dateReported' => date('Y-m-d')));
    }


    //these are used to retireve all the rooms for the map side panel
    function getAllRoomsLowerGround(){

        $rooms = $this->db->get_where('maprooms',array('roomfloor' => "-1")); //get all room details from db where floor matches
        return $rooms; //return array
    }
    function getAllRoomsGround(){

        $rooms = $this->db->get_where('maprooms',array('roomfloor' => "Ground")); //get all room details from db where floor matches
        return $rooms; //return array
    }
    function getAllRoomsSeventh(){

        $rooms = $this->db->get_where('maprooms',array('roomfloor' => "7")); //get all room details from db where floor matches
        return $rooms; //return array
    }

    function getAllStaffNames(){

        $staff = $this->db->get('lecturerportal'); //get all room details from db where floor matches
        return $staff; //return array
    }

}




