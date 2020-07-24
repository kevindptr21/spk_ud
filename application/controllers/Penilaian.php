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
        $this->load->library('pdf');
    }

    public function index(){
        $data['tgl'] = $this->M_Penilaian->getTglPenilaian();
        $data['tglST'] = $this->M_Penilaian->getTglPenilaianST();
        $data['kriteria'] = $this->M_Kriteria->getListKriteria();
        $data['getKaryawan'] = $this->M_Karyawan->getListKaryawan();

        $this->load->view('template/header');
        $this->load->view('template/body');
        $this->load->view('pages/v_m_penilaian',$data);
		$this->load->view('template/footer');
    }

    public function addPenilaian(){
        $data = array(
            'id' => $this->input->post('id'),
            'tgl' => $this->input->post('tgl_penilaian'),
            'nilai' => $this->input->post('n_penilaian[]'),
        );
        $this->M_Penilaian->addPenilaian($data);
        $this->session->set_flashdata('success','Berhasil Menambahkan Penilaian');
        redirect("penilaian");
    }

    public function changePenilaian(){
        $data = array(
            'id_penilaian' => $this->input->post('idPenilaian'),
            'nilai' => $this->input->post('nPenilaian[]')
        );
        $this->M_Penilaian->updatePenilaian($data);
        $this->session->set_flashdata('success','Berhasil Menambahkan Penilaian');
        redirect("penilaian");
    }

    public function deletePenilaian($params){
        $this->M_Penilaian->deletePenilaianId($params);
        $this->session->set_flashdata('success','Berhasil Menghapus Penilaian');
        redirect('penilaian');
    }

    public function getDataAjax($params){
        $data = $this->M_Penilaian->getListPenilaianTgl($params);
        $resJson = array();
        $no = 1;
        foreach($data as $d){
            $resJson[] = array(
                "no" => $no++,
                "nama" => $d['nama_karyawan'],
                "aksi" => '<a data-target="#editPenilaian" data-toggle="modal" 
                class="btn btn-primary btn-sm text-light" onclick="getAjaxEditPenilaian('.$d['id_penilaian'].')">
                    Detail
                </a> 
                <a class="btn btn-danger btn-sm text-light" 
                onclick="swalConfirm(`penilaian`,`'.$d['id_penilaian'].'`,`'.$d['nama_karyawan'].'`);">
                    Hapus
                </a>',
                "idKaryawan" => $d['id_karyawan']
            );
        }
        $response = array(
            "data" => $resJson,
        );
        echo json_encode($response);
    }

    public function getDataAjaxEdit($params){
        $data = array(
            'kriteria' => $this->M_Kriteria->getListKriteria(),
            'nilai' => $this->M_Penilaian->getListPenilaianId($params),
        );
        echo json_encode($data);
    }

    public function smartTopsis($params){
        $data = array(
            "kriteria" => $this->M_Kriteria->getListKriteria(),
            "penilaian" => $this->M_Penilaian->getListPenilaianTgl($params),
        );
        echo json_encode($this->M_Penilaian->getSmartTopsis($data));
    }

    public function printToPdf($params){
        $data = array(
            "kriteria" => $this->M_Kriteria->getListKriteria(),
            "penilaian" => $this->M_Penilaian->getListPenilaianTgl($params),
        );

        $nilai = $this->M_Penilaian->getSmartTopsis($data);

        $pdf = new FPDF('l','mm','A4');
        $pdf->AddPage();
        $pdf->Image(base_url()."assets/images/logoUDPdf.png",5,-4,60);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',35);
        $pdf->Cell(0,10,"UD. Sumber Urip",0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,15,"Jalan H. Mawi Kp. Jati RT 004 RW 005 No. 9 Kecamatan Parung - Bogor, Jawa Barat 16330",0,1,'C');
        $pdf->Cell(0,0,"Telpon: 0251-8412-307, HP: 0822-1049-0544",0,1,'C'); 
        $pdf->SetDrawColor(0,0,0);
        $pdf->Line(10,55,288,55);
        $pdf->Line(10,55.3,288,55.3);
        $pdf->Ln(20);
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(0,10,'Laporan Hasil Penilaian Kinerja Karyawan',0,1,'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,10,'Periode : '.$params.'',0,1);
        $pdf->Cell(0,10,'Nilai Pekerjaan Karyawan',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(45,6,'Nama Karyawan',1,0);
        
        foreach ($nilai['kriteria'] as $row){
            $pdf->Cell(32,6,$row['nama_kriteria'],1,0);
        }

        $pdf->SetFont('Arial','',10);
        for ($i=0;$i<count($nilai['penilaian']);$i++){
            $pdf->Cell(0,6,'',0,1);
            $pdf->Cell(10,6,($i+1),1,0);
            $pdf->Cell(45,6,$nilai['penilaian'][$i]['nama_karyawan'],1,0);
            for ($j=0;$j<count($nilai['valPenilaian']);$j++){
                $pdf->Cell(32,6,$nilai['valPenilaian'][$j][$i],1,0);
            }
        }

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,10,'Nilai Akhir dan Perangkingan',0,1,'L');
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(45,6,'Nama Karyawan',1,0);
        $pdf->Cell(30,6,'Nilai Akhir',1,0);

        for($k=0;$k<count($nilai['pref']);$k++){
            $pdf->Cell(0,6,'',0,1);
            $pdf->Cell(10,6,($k+1),1,0);
            $pdf->Cell(45,6,$nilai['pref'][$k]['nama'],1,0);
            $pdf->Cell(30,6,$nilai['pref'][$k]['nilai'],1,0);
        }

        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,50,"Parung, ".date('d M Y'),0,0,"R");
        $pdf->Cell(-1,100,"(".ucwords($this->session->userdata('name')).")",0,0,"R");
        $pdf->Output("D","Penilaian Karyawan pertanggal ".$params.".pdf" ,"true");
        
    }
}

?>