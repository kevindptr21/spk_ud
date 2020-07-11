<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Penilaian extends CI_Model {
    public function getListPenilaian(){
        return $this->db
        ->from('penilaian t1')
        ->join('karyawan t2','t2.id_karyawan = t1.id_karyawan')
        ->where('tgl_penilaian',date('d-m-Y'))
        ->get()->result_array();
    }

    public function getListPenilaianId($params){
        return $this->db
        ->from("penilaian t1")
        ->join("karyawan t2","t2.id_karyawan = t1.id_karyawan")
        ->where("id_penilaian",$params)
        ->where("tgl_penilaian",date("d-m-Y"))
        ->get()->result_array();
    }

    public function addPenilaian($data){
        $val = array();
        $no = 1;
        for($i=0;$i<count($data['nilai']);$i++){
            $val += [
                "id_penilaian" => 1,
                "id_karyawan" => $data['id'],
                "tgl_penilaian" => $data['tgl'],
                "C".$no++."" => $data['nilai'][$i],
            ];
        }
        $this->db->insert('penilaian',$val);
    }

}

?>