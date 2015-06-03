<?php
class Wordviewajax_model extends CI_Model {
    private $wordlist;
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->select('roomname, roomfloor, roomType, roomResources, roomdetails');
        $this->db->from('maprooms');
        $this->wordlist = $this->db->get(); //save room names and relevant floors to global variable
    }



    public function match($partword)
    {
        $matching_words = array(); //create array


        //make uppercase 
        $partword = strtoupper($partword);

        //run thorugh each db result for matches from the user AJAX search
        foreach ($this->wordlist->result() as $row) 
        {

            if (preg_match("/$partword/",strtoupper($row->roomname)) || preg_match("/$partword/",strtoupper($row->roomfloor)) || preg_match("/$partword/",strtoupper($row->roomType)) || preg_match("/$partword/",strtoupper($row->roomdetails)) || preg_match("/$partword/",strtoupper($row->roomResources))) 
            {
                $matching_words[] = $row->roomname; //if matches are found then insert into array list
            }

        }

    return $matching_words; //return matches

    }

    function getAllLecturerPosts($loginName)
    {
        //returns all live posts for staff member where loginID matches
        return $this->db->get_where('lecturerposts',array('postedby' => $loginName));
    }

    
    public function matchposts($name, $word)
    {
        $matching_posts = array(); //create array
        //make uppercase 
        $word = strtoupper($word);
        $this->load->database();
        $results = $this->db->get_where('lecturerposts',
                    array('postedby' => $name)); //get relevent fields from DB to search
        //run thorugh each db result for matches from the user LIVE POST AJAX search
        foreach ($results->result() as $row) 
        {
            if (preg_match("/$word/",strtoupper($row->post)) || 
                preg_match("/$word/",strtoupper($row->postdate)) || 
                preg_match("/$word/",strtoupper($row->posttime))) 
            {
                $matching_posts[] = $row; //if matches are found then insert into array list
            }
        }
    return $matching_posts; //return matches
    }
    
}
?>