<?php
Class Region extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets(){
        $sql = 'select * from regions ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getbyinitial($initial){
        $sql = 'select * from regions ';
        $sql.= 'where initial = "' . $initial . '" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }else{
            return false;
        }
    }
}