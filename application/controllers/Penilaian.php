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
        $this->load->model('M_Penilaian');
    }

    public function index(){
        $data['tgl'] = $this->M_Penilaian->getTglPenilaian();
        $data['kriteria'] = $this->M_Kriteria->getListKriteria();
        $data['getKaryawan'] = $this->M_Karyawan->getListKaryawan();

        $this->load->view('template/header');
        $this->load->view('template/body');
        $this->load->view('pages/v_m_penilaian',$data);
		$this->load->view('template/footer');
    }

    public function testingInput(){
        $data = array(
            'id' => $this->input->post('id'),
            'tgl' => $this->input->post('tgl_penilaian'),
            'nilai' => $this->input->post('n_penilaian[]'),
        );
        $this->M_Penilaian->addPenilaian($data);
        redirect("penilaian");
    }

    public function getDataAjax($params){
        $data = $this->M_Penilaian->getListPenilaianTgl($params);
        $resJson = array();
        $no = 1;
        foreach($data as $d){
            $resJson[] = array(
                "no" => $no++,
                "nama" => $d['nama_karyawan'],
                "aksi" => '<a data-target="#editPenilaian'.$d['id_karyawan'].'" data-toggle="modal" 
                class="btn btn-warning btn-sm">
                    Ubah
                </a> 
                <a class="btn btn-danger btn-sm text-light" 
                onclick="swalConfirm(`penilaian`,`'.$d['id_penilaian'].'`,`'.$d['nama_karyawan'].'`);">
                    Hapus
                </a>'
            );
        }
        $response = array(
            "data" => $resJson,
        );
        echo json_encode($response);
    }

    public function smartTopsis($params){
        $data = array(
            "kriteria" => $this->M_Kriteria->getListKriteria(),
            "penilaian" => $this->M_Penilaian->getListPenilaianTgl($params),
        );
        echo json_encode($this->M_Penilaian->getSmartTopsis($data));
    }
}

?>