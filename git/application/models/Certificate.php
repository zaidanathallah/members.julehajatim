<?php
class Certificate extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets($member_id){
        $sql = "select id,certificatedate,subject from certificates ";
        $sql.= "where member_id = " . $member_id . ' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
}