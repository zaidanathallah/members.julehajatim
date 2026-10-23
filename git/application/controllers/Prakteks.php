<?php
Class Prakteks extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('praktek');
    }
    function save(){
        $params = array(
            'rph_id'=>$this->uri->segment(3),
            'juleha_id'=>$this->uri->segment(4),
            'praktekdate'=>$this->uri->segment(5)
        );
        echo json_encode(array('res'=>$this->praktek->save($params)));
    }
    function gets(){
        $rph_id = $this->uri->segment(3);
        $praktekdate = $this->uri->segment(4);
        echo json_encode($this->praktek->gets(array('rph_id'=>$rph_id,'praktekdate'=>$praktekdate)));
    }
    function delete(){
        $rph_id = $this->uri->segment(3);
        $juleha_id = $this->uri->segment(4);
        $praktekdate = $this->uri->segment(5);
        echo json_encode($this->praktek->delete(array('rph_id'=>$rph_id,'juleha_id'=>$juleha_id,'praktekdate'=>$praktekdate)));
    }
}