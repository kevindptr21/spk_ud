<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {


	function __construct(){
        parent::__construct();
		$this->load->model('M_Karyawan');
		$this->load->model('M_Pekerjaan');
		if($this->session->userdata('login') == false){
            redirect('auth');
        }
	}

	public function index(){
		$data['karyawan'] = $this->M_Karyawan->getListKaryawan();
		$data['pekerjaan'] = $this->M_Pekerjaan->getListPekerjaan();
		$this->load->view('template/header');
		$this->load->view('template/body');
		$this->load->view('pages/v_m_karyawan',$data);
		$this->load->view('template/footer');
	}

	private function validateNewWorker($data){
		

	}

	public function addKaryawan(){
		$data = array(
			"nama" => ucwords($this->input->post('nama')),
			"alamat" => $this->input->post('alamat'),
			"jk" => $this->input->post('jk'),
			"tgl" => $this->input->post('tgl'),
			"pekerjaan" => $this->input->post('pekerjaan')
		);

		$this->validateNewWorker($data);
	}
}
