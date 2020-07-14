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
		$filename = base_url().'assets/data.csv';
		// The nested array to hold all the arrays
		$the_big_array = []; 
		// Open the file for reading
		if (($h = fopen("{$filename}", "r")) !== FALSE) 
		{
		// Each line in the file is converted into an individual array that we call $data
		// The items of the array are comma separated
		while (($data = fgetcsv($h, 1000, ";")) !== FALSE) 
		{
			// Each individual array is being pushed into the nested array
			$data = str_replace("/","-",$data);
			$the_big_array[] = $data;
			// $the_big_array[] = str_replace('L',"Laki-Laki",$data);
		}

		// Close the file
		fclose($h);
		}

		// Display the code in a readable format
		// echo "<pre>";

		// var_dump($the_big_array);
		$karyawan = $this->M_Karyawan->getListKaryawan();
		$str = "K";
		$incrmnt = count($karyawan);
		if($incrmnt == 0){
			$kd = $str."001";
		}else if($incrmnt < 10){
			$kd = $str."00".($incrmnt+1);
		}else if($incrmnt >= 10 && $incrmnt < 100){
			$kd = $str."0".($incrmnt+1);
		}else{
			$kd = $str.($incrmnt+1);
		}
		for($i=0;$i<count($the_big_array);$i++){
			$this->db
			->set("id_karyawan" ,$kd)
			->set("nama_karyawan" ,$the_big_array[$i][0])
			->set("alamat",$the_big_array[$i][2])
			->set("jenis_kelamin",$the_big_array[$i][1])
			->set("tgl_awal_bekerja",$the_big_array[$i][6])
			->set("status",1)
			->set("id_user",$this->session->userdata('user code'))
			->set("id_pekerjaan",$the_big_array[$i][5])
			->get_compiled_insert('karyawan');
			
		}
		// $data = array(
		// 	"nama" => ucwords($this->input->post('nama')),
		// 	"alamat" => $this->input->post('alamat'),
		// 	"jk" => $this->input->post('jk'),
		// 	"tgl" => $this->input->post('tgl'),
		// 	"pekerjaan" => $this->input->post('pekerjaan')
		// );
		
		// $this->M_Karyawan->insertKaryawan($data);
		// $this->session->set_flashdata('success',"Berhasil Menambahkan Karyawan");
		// redirect("karyawan");
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