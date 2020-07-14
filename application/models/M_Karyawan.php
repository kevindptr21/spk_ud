<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Karyawan extends CI_Model {

    public function getListKaryawan()
    {
        return $this->db
        ->from('karyawan t1')
        ->join('pekerjaan t2','t2.id_pekerjaan = t1.id_pekerjaan')
        // ->order_by('tgl_awal_bekerja')
        ->where('t1.status',1)
        ->get()->result_array();
    }

    private function createIncrement(){
        $str = "K";
        $incrmnt = count($this->getListKaryawan());
        if($incrmnt == 0){
            $kd = $str."001";
        }else if($incrmnt < 10){
            $kd = $str."00".($incrmnt+1);
        }else if($incrmnt >= 10 && $incrmnt < 100){
            $kd = $str."0".($incrmnt+1);
        }else{
            $kd = $str.($incrmnt+1);
        }
        return $kd;
    }

    public function insertKaryawan($params){
        $data = array(
            "id_karyawan" => $this->createIncrement(),
            "nama_karyawan" => $params['nama'],
            "alamat" => $params['alamat'],
            "jenis_kelamin" => $params['jk'],
            "tgl_awal_bekerja" => $params['tgl'],
            "status" => 1,
            "id_user" => $this->session->userdata('user code'),
            "id_pekerjaan" => $params['pekerjaan']
        );
        $this->db->insert('karyawan',$data);
    }

    public function updateKaryawan($params){
        $this->db
        ->set('nama_karyawan',$params['nama'])
        ->set('alamat',$params['alamat'])
        ->set('jenis_kelamin',$params['jk'])
        ->set('tgl_awal_bekerja',$params['tgl'])
        ->set('id_pekerjaan',$params['pekerjaan'])
        ->where('id_karyawan',$params['id'])
        ->update('karyawan');
    }

    public function deleteKaryawanId($params){
        $this->db
        ->set('status',0)
        ->where('id_karyawan',$params)
        ->update('karyawan');
    }
}
?>