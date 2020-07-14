<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pekerjaan extends CI_Model {

    public function getListPekerjaan()
    {
        return $this->db
        ->from('pekerjaan')
        ->where('status',1)
        ->get()->result_array();
    }

    public function insertPekerjaan($params){
        $data = array(
            'id_pekerjaan' => null,
            'nama_pekerjaan' => $params,
            'status' => 1
        );
        $this->db->insert('pekerjaan',$data);

    }

    public function updatePekerjaan($params){
        $this->db
        ->set('nama_pekerjaan',$params['nama'])
        ->where('id_pekerjaan',$params['id'])
        ->update('pekerjaan');
    }

    public function deletePekerjaanId($params){
        $this->db
        ->from('pekerjaan')
        ->set('status',0)
        ->where('id_pekerjaan',$params)
        ->update('pekerjaan');
    }
}
