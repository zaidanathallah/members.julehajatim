<?php
class Templates extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $data = array(
            'title'=>'Keanggotaan Juleha'
        );
        $this->load->view('templates/index',$data);
    }
}