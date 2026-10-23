<?php
Class Rph extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('crud');
    }
    function get(){
        return $this->crud->gets('rphs',array('id','name','region_id'),array());
    }
}