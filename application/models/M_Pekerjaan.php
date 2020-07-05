<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pekerjaan extends CI_Model {

    public function getListPekerjaan()
    {
        $this->db->from('pekerjaan');
        return $this->db->get()->result_array();
    }
}
