<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {


	function __construct(){
        parent::__construct();
		$this->load->model('M_Karyawan');
		if($this->session->userdata('login') == false){
            redirect('auth');
        }
	}

	public function index(){
		$data['karyawan'] = $this->M_Karyawan->getListKaryawan();
		$this->load->view('template/header');
		$this->load->view('template/body');
		$this->load->view('pages/v_m_karyawan',$data);
		$this->load->view('template/footer');
	}
}
