<?php
Class Rphs extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('rph');
    }
    function index(){
        print_r($this->rph->get());
    }
    function gets(){
        echo json_encode($this->rph->get());
    }
}