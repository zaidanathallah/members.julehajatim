<?php
class Location extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function save($name,$cp,$address,$district,$latitude,$longitude,$createuser){
        $sql = "insert into locations ";
        $sql.= "(name,cp,address,district,latitude,longitude,createuser)";
        $sql.= "values ";
        $sql.= "('".$name."','".$cp."','".$address."','".$district."',".$latitude.",".$longitude.",'".$createuser."')";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function gets(){
        $sql = 'select id,name,cp,address,district,latitude,longitude,createuser ';
        $sql.= 'from locations order by createdate desc ';
        $ci = & get_instance();
        $rows = $ci->db->query($sql);
        return $rows->result();
    }
    function clear(){
        $sql = 'delete ';
        $sql.= 'from locations ';
        $ci = & get_instance();
        $rows = $ci->db->query($sql);
        return $rows->result();
    }
    function delete($ids){
        $sql = 'delete ';
        $sql.= 'from locations ';
        $sql.= 'where id in ('.$ids.') ';
        $ci = & get_instance();
        $rows = $ci->db->query($sql);
        return $rows->result();
    }
}