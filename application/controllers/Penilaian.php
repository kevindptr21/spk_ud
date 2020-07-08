<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    function __construct(){

        parent::__construct();
        if($this->session->userdata('login') == false){
            redirect('auth');
        }
        $this->load->model('M_Kriteria');
        $this->load->model('M_Karyawan');
        // $this->load->library('cart');
    }

    public function index(){
        $data['kriteria'] = $this->M_Kriteria->getListKriteria();
        $data['karyawan'] = $this->M_Karyawan->getListKaryawan();
        $this->load->view('template/header');
        $this->load->view('template/body');
		$this->load->view('pages/v_m_penilaian',$data);
		$this->load->view('template/footer');
    }

    public function testingInput(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'tgl' => $this->input->post('tgl_penilaian'),
            'nilai' => $this->input->post('n_penilaian[]'),
        );

        var_dump($data);
    }

}

?>