<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('login') != true){
            redirect('auth');
        }
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('template/body');
		$this->load->view('pages/v_home');
		$this->load->view('template/footer');
	}
}
