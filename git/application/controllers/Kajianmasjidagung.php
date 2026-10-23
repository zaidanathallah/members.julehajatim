<?php
Class Kajianmasjidagung extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('member');
        $this->load->model('epiagam');
        $this->load->model('portofolio');
        $this->load->model('certificate');
        $this->load->model('training');
        $this->load->helper('inflector');
        $this->load->library('julehalibs');
        $this->load->model('region');
    }
        function epiagam(){
        $juleha_id = $this->uri->segment(3);
        //$obj = $this->member->get($juleha_id);
        $peserta = $this->epiagam->get($juleha_id);
        //print_r($peserta);
        $data = array(
            'juleha_id'=>$juleha_id,
            'peserta_id'=>$this->uri->segment(3),
            'next_id'=>$this->uri->segment(3)+1,
            'prev_id'=>$this->uri->segment(3)-1,
            //'obj'=>$obj['res'],
            'peserta'=>$peserta['res'][0]
         );
        $this->load->view('kajianmasjidagung2025/epiagam',$data);
    }
    function pesertakajian(){
        $objs = $this->epiagam->gets();
        $data = array(
            'objs'=>$objs['res']
        );
        $this->load->view('kajianmasjidagung2025/tablepeserta',$data);
    }
}