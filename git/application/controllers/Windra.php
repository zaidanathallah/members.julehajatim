<?php
Class Windra extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('crud');
    }
    function index(){
        $region = $this->uri->segment(3);
        $data = array(
            'objs'=>$this->crud->gets('members',array('juleha_id','nickname','firstname','middlename','lastname','address','phone'),array('region'=>$region)),
            'region'=>$region
        );
        $this->load->view('windra/index',$data);
    }
}
