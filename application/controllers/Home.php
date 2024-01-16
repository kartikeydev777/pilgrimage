<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model('HomeModel');
    }

	public function index(){
        $data['events']=$this->HomeModel->home();
    //    print_r($data);
		$this->load->view('home',$data);
	}
    
}
