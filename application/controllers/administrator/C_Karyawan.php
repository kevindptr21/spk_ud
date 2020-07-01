<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_karyawan');
		$this->load->library('session');
	}

	public function index(){
		$data['karyawan'] = $this->m_karyawan->getListKaryawan();
        $this->load->view('template/header');
		$this->load->view('pages/v_m_karyawan',$data);
		$this->load->view('template/footer');
	}
	
	public function pekerjaan(){
		$this->load->view('template/header');
		$this->load->view('pages/v_pekerjaan');
		$this->load->view('template/footer');
	}
}
