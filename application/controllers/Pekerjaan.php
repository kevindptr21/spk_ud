<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_Pekerjaan');
		if($this->session->userdata('login') == false){
            redirect('auth');
        }
	}

	public function index(){
        $data['pekerjaan'] = $this->M_Pekerjaan->getListPekerjaan();
		$this->load->view('template/header');
		$this->load->view('template/body');
		$this->load->view('pages/v_m_pekerjaan',$data);
		$this->load->view('template/footer');
	}
	
}
