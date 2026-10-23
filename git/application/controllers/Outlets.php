<?php
class Outlets extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('outlet');
    }
    function index(){
        $data = array(
            'objs'=>$this->outlet->gets()
        );
        $this->load->view('outlets/index',$data);
    }
}