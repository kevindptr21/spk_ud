<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pekerjaan extends CI_Model {

    public function getListPekerjaan()
    {
        return $this->db
        ->from('pekerjaan')
        ->get()->result_array();
    }
}
