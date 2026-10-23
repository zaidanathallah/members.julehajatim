<?php
class Main extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('location');
    }
    function index(){
        $myarr = [
            ["name"=>"loc1","address"=>"addr1"],
            ["name"=>"loc2","address"=>"addr2"],
            ["name"=>"loc3","address"=>"addr3"],
            ["name"=>"loc4","address"=>"addr4"],
            ["name"=>"loc5","address"=>"addr5"],
            ["name"=>"loc6","address"=>"addr6"],
        ];
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        echo json_encode($myarr);
    }
    function save(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        $params = $_POST;
        $this->location->save($params['name'],$params['cp'],$params['address'],$params['district'],$params['latitude'],$params['longitude'],$params['createuser']);
        echo json_encode($params);
    }
    function gets(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        $result = $this->location->gets();
        echo json_encode($this->location->gets());
    }
    function clear(){
        $this->location->clear();
    }
}