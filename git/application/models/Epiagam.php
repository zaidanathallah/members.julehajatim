<?php
Class Epiagam extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets(){
        $sql = 'select a.id,name,hp,a.address from epiagam a ';

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function get($id){
        $sql = 'select a.id,name,hp,a.address,a.startx from epiagam a ';
        $sql.= 'where a.id="'.$id.'" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
}
