<?php
class Mapadmin_reportedissuesmodel extends CI_Model {

    function __construct()
    {
       parent::__construct();
       $this->load->database();
       
    }


    function deleteReportFromDB($IDtoDelete)
    {

        $data = $this->db->where('id', $IDtoDelete); //find row to Delete using ID
        $this->db->delete('mapreportedissues',$data); //Delete report from DB

        return "Deleted reported issue!"; //return confirmation
    }


    function getAllReports()
    {
        //get all reported issues
        $result = $this->db->get('mapreportedissues');
            
        return $result; //return reports
    }

}




