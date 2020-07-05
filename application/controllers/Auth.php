<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_Auth');
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('login');
		$this->load->view('template/footer');	
	}

	public function authentication() {
		$uname = $this->input->post('uname');
		$pass = md5($this->input->post('pass'));
		$data = $this->M_Auth->isLogin($uname,$pass);
		if($data != null){
			$sessData = array (
				'login' => true,
				'name' => $data[0]['nama_user'],
				'user code' => $data[0]['id_user'],
			);
			$this->session->set_userdata($sessData);
			$this->session->set_flashdata('success','Selamat Datang '.$data[0]['nama_user']);
			redirect("home");

		}else {
			$this->session->set_flashdata('errMsg','Username dan Password Tidak Cocok.');
			redirect('auth');
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}

}
