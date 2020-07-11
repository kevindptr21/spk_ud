<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Karyawan extends CI_Model {

    public function getListKaryawan()
    {
        return $this->db
        ->from('karyawan t1')
        ->join('pekerjaan t2','t2.id_pekerjaan = t1.id_pekerjaan')
        ->order_by('tgl_awal_bekerja','ASC')
        ->get()->result_array();
    }
}
?>