<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	function __construct(){
        parent::__construct();
        
        if($this->session->userdata('login') == false){
            redirect('auth');
        }
        $this->load->model('M_Kriteria');
	}

	public function index(){
        $data['tipe'] = array('Benefit','Cost');
        $data['jenis'] = array('Kuantitatif','Kualitatif');
		$data['kriteria'] = $this->M_Kriteria->getListKriteria();
        $this->load->view('template/header');
        $this->load->view('template/body');
		$this->load->view('pages/v_m_kriteria',$data);
		$this->load->view('template/footer');
    }

    public function getKriteria(){
        echo json_encode($this->M_Kriteria->getListKriteria());
    }
    
    private function validation($params,$data) {
        if($params == "add"){
            $val = $this->M_Kriteria->getKriteriaName($data['nama']);
            if($val == null || count($val) == 0){
                if($data['jenis'] != "0" && $data['tipe'] != "0"){
                    $this->M_Kriteria->insertKriteria($data);
                    $this->session->set_flashdata('success','Kriteria Berhasil Ditambahkan');
    
                }else if($data['jenis'] == "0" && $data['tipe'] != "0") {
                    $this->session->set_flashdata('errAddKriteria','Harus Memilih Jenis Kriteria!');
                    $this->session->set_flashdata('nama',$data['nama']);
    
                }else if($data['jenis'] != "0" && $data['tipe'] == "0") {
                    $this->session->set_flashdata('errAddKriteria','Harus Memilih Tipe Kriteria!');
                    $this->session->set_flashdata('nama',$data['nama']);
                }else {
                    $this->session->set_flashdata('errAddKriteria','Harus Memilih Jenis dan Tipe Kriteria!');
                    $this->session->set_flashdata('nama',$data['nama']);
                }

            }else{
                $this->session->set_flashdata('errAddKriteria','Kriteria '.$data['nama']." Telah Tersedia");
            }


        } else if($params == "change"){
            $bobotValue = 0;
            $complete = 0;

            for($i=0;$i<count($data['nilai']);$i++){

                if(($data['jenis'][$i] == "0") && ($data['nama'][$i] != "") && ($data['tipe'][$i] == "0")){
                    $this->session->set_flashdata('errEditKriteria',"Harus Memilih Jenis dan Tipe Kriteria!");
                    $complete = $complete - 1;
                }else if(($data['jenis'][$i] != "0") && ($data['nama'][$i] == "") && ($data['tipe'][$i] != "0")){
                    $this->session->set_flashdata('errEditKriteria',"Nama Kriteria Tidak Boleh Kosong!");
                    $complete = $complete - 1;
                }else if(($data['jenis'][$i] == "0") && ($data['nama'][$i] == "") && ($data['tipe'][$i] == "0")){
                    $this->session->set_flashdata('errEditKriteria',"Nama, Jenis dan Tipe Kriteria Harus Terisi!");
                    $complete = $complete - 1;
                }else if(($data['jenis'][$i] == "0") && ($data['nama'][$i] != "") && ($data['tipe'][$i] != "0")){
                    $this->session->set_flashdata('errEditKriteria',"Harus Memilih Jenis Kriteria!");
                    $complete = $complete - 1;
                }else if(($data['jenis'][$i] != "0") && ($data['nama'][$i] != "") && ($data['tipe'][$i] == "0")){
                    $this->session->set_flashdata('errEditKriteria',"Harus Memilih Tipe Kriteria!");
                    $complete = $complete - 1;
                }else{
                    $bobotValue = $bobotValue + $data['nilai'][$i];
                    $complete = $complete + 1;
                }

            };

            if($complete == count($data['nilai'])){
                if($bobotValue > 100){
                    $this->session->set_flashdata('errEditKriteria',"Jumlah Nilai Bobot > 100%");
                }else if($bobotValue < 100) {
                    $this->session->set_flashdata('errEditKriteria',"Jumlah Nilai Bobot < 100%");
                }else {
                    $this->M_Kriteria->updateKriteria($data,count($data['nilai']));
                    $this->session->set_flashdata('success',"Berhasil Mengubah Kriteria");
                }
            }
        } else {
            $this->M_Kriteria->deleteKriteriaId($data);
            $this->session->set_flashdata('success','Kriteria Berhasil Dihapus');
        }

        redirect('kriteria');
    }

    public function addKriteria(){
        $data = array(
            'nama' => ucwords($this->input->post('n_kriteria')),
            'jenis' => $this->input->post('j_kriteria'),
            'tipe' => $this->input->post('t_kriteria'),
        );
        if($data['nama'] != "" || $data['nama'] != null){
            $this->validation('add',$data);
        }else {
            $this->session->set_flashdata('errMsg','Nama Tidak Boleh Kosong!');
            $this->session->set_flashdata('nama',$data['nama']);
            redirect('kriteria');
        }
    }

    public function changeKriteria(){
        $data = array(
            'id' => $this->input->post('id_kriteria[]'),
            'nama' => $this->input->post('n_kriteria[]'),
            'nilai' => $this->input->post('n_bobot[]'),
            'jenis' => $this->input->post('j_kriteria[]'),
            'tipe' => $this->input->post('t_kriteria[]'),
        );

        $this->validation('change',$data);   
    }

    public function deleteKriteria($params){
        $this->validation('delete',$params);
    }
}
