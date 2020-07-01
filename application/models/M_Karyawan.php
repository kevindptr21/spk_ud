<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Karyawan extends CI_Controller
{

    public function getListKaryawan()
    {
        $this->db->from('karyawan t1');
        $this->db->join('pekerjaan t2','t2.id_pekerjaan = t1.id_pekerjaan');
        return $this->db->get()->result_array();
    }
}
