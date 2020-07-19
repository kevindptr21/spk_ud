<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct(){

        parent::__construct();
		if($this->session->userdata('login') == false){
			redirect('auth');
        }
		$this->load->model('M_Karyawan');
		$this->load->model('M_Pekerjaan');
	}

	public function index(){
		$data['karyawan'] = $this->M_Karyawan->getListKaryawan();
		$data['pekerjaan'] = $this->M_Pekerjaan->getListPekerjaan();
		$this->load->view('template/header');
		$this->load->view('template/body');
		$this->load->view('pages/v_m_karyawan',$data);
		$this->load->view('template/footer');
	}

	public function addKaryawan(){
		$data = array(
			"nama" => ucwords($this->input->post('nama')),
			"alamat" => $this->input->post('alamat'),
			"jk" => $this->input->post('jk'),
			"tgl" => $this->input->post('tgl'),
			"pekerjaan" => $this->input->post('pekerjaan')
		);
		
		$this->M_Karyawan->insertKaryawan($data);
		$this->session->set_flashdata('success',"Berhasil Menambahkan Karyawan");
		redirect("karyawan");
	}

	public function changeKaryawan(){
		$data = array(
			"id" => $this->input->post('id'),
			"nama" => ucwords($this->input->post('nama')),
			"alamat" => $this->input->post('alamat'),
			"jk" => $this->input->post('jk'),
			"tgl" => $this->input->post('tgl'),
			"pekerjaan" => $this->input->post('pekerjaan')
		);
		
		$this->M_Karyawan->updateKaryawan($data);
		$this->session->set_flashdata('success',"Berhasil Mengubah Karyawan");
		redirect("karyawan");
	}

	public function deleteKaryawan($params){
		$this->M_Karyawan->deleteKaryawanId($params);
		$this->session->set_flashdata('success',"Berhasil Menghapus Karyawan");
		redirect('karyawan');
	}
}
?>