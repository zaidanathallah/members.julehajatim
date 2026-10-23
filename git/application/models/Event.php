<?php
Class Event extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets($params){
        $ci = & get_instance();
        $sql = 'select id,subject,address,eventdate,description from eventkajians ';
        $sql.= 'where region = "' . $params['region'] . '" ';
        $sql.= 'order by createdate desc ';
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
    function save($params){
        $keys = array();$vals = array();
        $ci = & get_instance();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = 'insert into eventkajians ';
        $sql.= 'subject,address,eventdate,eventtime,description  values ';
        $sql.= '('.$params['subject'].','.$params['address'].','.$params['eventdate'].','.$params['eventtime'].','.$params['description'].') ';
        $que = $ci->db->query($sql);
        return array('id'=>$ci->db->insert_id);
    }
    function saveparticipant($params){
        $ci = & get_instance();
        $sql = 'insert into eventkajianparticipants ';
        $sql.= '(kajian_id,juleha_id) ';
        $sql.= 'values ';
        $sql.= '('.$params['kajian_id'].',"'.$params['juleha_id'].'")';
        $que = $ci->db->query($sql);
        return array('id'=>$ci->db->insert_id);
    }
    function update($params){
        $arrs = array();
        $ci = & get_instance();
        foreach($params as $key=>$val){
            array_push($arrs,$key . '=' . $val);
        }
        $sql = 'update eventkajians ';
        $sql.= 'set ' . implode(',',$arrs);
        $sql.= 'where id = ' . $params['id'];
        $que = $ci->db->query($sql);
        return array('sql'=>$sql);
    }
    function getparticipants($params){
        $ci = & get_instance();
        $sql = 'select id,kajian_id,juleha_id from eventkajianparticipants ';
        $sql.= 'where kajian_id= ' . $params['kajian_id'] . ' ';
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
    function deleteparticipant($params){
        $ci = & get_instance();
        $sql = 'delete from eventkajianparticipants ';
        $sql.= 'where kajian_id= ' . $params['kajian_id'] . ' ';
        $sql.= 'and juleha_id= "' . $params['juleha_id'] . '" ';
        $que = $ci->db->query($sql);
        return array(
            'res'=>$sql
        );
    }
}