<?php
Class Praktek extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('crud');
    }
    function save($params){
        return  $this->crud->create('prakteks',$params);
    }
    function gets($params){
        return $this->crud->gets(
            'prakteks',
            array('id','juleha_id'),
            array('rph_id'=>$params['rph_id'],'praktekdate'=>$params['praktekdate'])
        );
    }
    function delete($params){
        return $this->crud->delete('prakteks',$params);
    }
}