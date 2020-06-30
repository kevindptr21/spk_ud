<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_auth');
	}

	public function index()
	{
		$this->load->view('v_halamanutama');
	}

	public function authentication() {
		$uname = $this->input->post('uname');
		$pass = md5($this->input->post('pass'));
		$validating = $this->m_auth->isLogin($uname,$pass);
		
		if($validating !== null){
			echo "<script type='text/javascript'>
			alert('Login Berhasil');
			</script>";
		}
	}
}
