<?php
class Mapadmin_model extends CI_Model {

    function __construct()
    {
       parent::__construct();
       $this->load->database(); //load DB
       
    }


    function getAllRooms(){
        //get all room information to initialise form
        $rooms = $this->db->get('maprooms');
            
        return $rooms; //return array of all rooms
    }

    function uploadImage($imageName, $idToUpdate)
    {
        //set img name and cuurent date to array then update in database where ID matches
        $date = date('Y-m-d'); //get current date
        $data = array('roomImageName' => $imageName, 'lastupdated' => $date);
        $this->db->where('id', $idToUpdate);
        $this->db->update('maprooms',$data);

        return "Image Successfully Uploaded!"; //return confirmation
    }

    function updateRoomData($ID, $RoomName, $RoomDetails, $RoomType, $RoomResources)
    {
        $date = date('Y-m-d'); //get current date
        $validationmessage; //initialise

        //check for empty fields
        if ($RoomName === "" || $RoomDetails === "" || $RoomType === "" || $RoomResources === "") {
            //return error msg
            return "Unable to update room details! No empty fields allowed!";
        }
        else
        {
            //set data to array then update database 
            $data = array('roomname' => $RoomName, 'roomdetails' => $RoomDetails, 'roomType' => $RoomType, 'roomResources' => $RoomResources, 'lastupdated' => $date);
                    $this->db->where('id', $ID); //find row to update using ID
                    $this->db->update('maprooms',$data); //update DB
            return "Room Details Successfully Updated!"; //return confirmation msg
        }

    }

    function getAllLecturerPosts($loginName)
    {
        //returns all live posts for staff member where loginID matches
        return $this->db->get_where('lecturerposts',array('postedby' => $loginName));
    }

    function deletePostDB($IDtoDelete)
    {
        $data = $this->db->where('id', $IDtoDelete); //find row to Delete using ID
        $this->db->delete('lecturerposts',$data); //Delete post from DB
        return "Post has been deleted!";
    }

    function insertPostDB($PostToInsert, $lecturerName)
    {
        //set defualt timezone
        date_default_timezone_set('GMT');
        //insert live post into database
        $this->db->insert('lecturerposts',array('postedby' => $lecturerName,'post' => $PostToInsert, 
                                                'postdate' => date('Y-m-d'), 'posttime' => date('H:i:s')));
        return "Posted to feed!";  //return confirmation
    }

    function getPostsDB()
    {
        //return all lecturer posts
        $match = $this->db->get('lecturerposts');
        return $match; //return array
    }

    function getAllLecturers(){
        //get all lecturer information to initialise form
        $result = $this->db->get('lecturerportal');
            
        return $result; //return array of all lecturers
    }

    function changePasswordDB($loggedin, $newPWConf)
    {
        $data = array('password' => sha1($newPWConf)); //replace old password with new and hash for security
                    $this->db->where('loginid', $loggedin); //find row to update using loginid
                    $this->db->update('lecturerportal',$data); //update DB
        return "Password Updated!"; //return confirmation
    }

    function changeEmailDB($loggedin, $newEmail)
    {
        $data = array('email' => $newEmail); //replace old email with new 
                    $this->db->where('loginid', $loggedin); //find row to update using loginid
                    $this->db->update('lecturerportal',$data); //update DB
        return "Email Updated!"; //return confirmation
    }

    function getLecturerName($loginID)
    {
        //returns all live posts for staff member where loginID matches
        $resultDB = $this->db->get_where('lecturerportal',array('loginid' => $loginID));
        $name;
        foreach ($resultDB->result() as $line) 
                        {
                            $name = $line->fullName;
                        }
        return $name;
    
    
    }
        

}