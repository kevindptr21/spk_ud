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

	public function addPekerjaan(){
		$n_pekerjaan = $this->input->post('nama');
		if($n_pekerjaan != "" || $n_pekerjaan != null){
			$this->M_Pekerjaan->InsertPekerjaan(ucwords($n_pekerjaan));
			$this->session->set_flashdata('success',"Berhasil Menambahkan Pekerjaan");

		}else{
			$this->session->set_flashdata('errMsg',"Nama Pekerjaan Tidak Boleh Kosong!");
		}
		redirect('pekerjaan');
	}

	public function editPekerjaan(){
		
	}

	public function deletePekerjaan($params){
		$this->M_Pekerjaan->deletePekerjaanId($params);
		$this->session->set_flashdata('success',"Berhasil Menghapus Pekerjaan");
		redirect("pekerjaan");
	}
	
}
