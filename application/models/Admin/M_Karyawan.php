<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Karyawan extends CI_Controller
{

    public function getListKaryawan()
    {
        $this->db->from('karyawan');
        return $this->db->get()->result('array');
    }
}
