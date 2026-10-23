<?php
Class Events extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('event');
    }
    function gets(){
        $region = $this->uri->segment(3);
        $objs = $this->event->gets(array("region"=>"SDA"));
        echo json_encode($objs['res']);
    }
    function saveparticipant(){
        $kajian_id = $this->uri->segment(3);
        $juleha_id = $this->uri->segment(4);
        $this->event->saveparticipant(array('kajian_id'=>$kajian_id,'juleha_id'=>$juleha_id));
    }
    function getparticipants(){
        $kajian_id = $this->uri->segment(3);
        echo json_encode($this->event->getparticipants(array('kajian_id'=>$kajian_id)));
    }
    function deleteparticipant(){
        echo json_encode($this->event->deleteparticipant(array('kajian_id'=>$this->uri->segment(3),'juleha_id'=>$this->uri->segment(4))));
    }
}