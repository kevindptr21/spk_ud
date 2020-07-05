<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kriteria extends CI_Model {

	public function getListKriteria(){
        $this->db->from('kriteria');
        $data = $this->db->get()->result_array();
        return $data;
    }
    
    public function getKriteriaName($params){
        $this->db->select("nama_kriteria");
        $this->db->from('kriteria');
        $this->db->where('nama_kriteria',$params);
        $this->db->or_where('nama_kriteria',strtoupper($params));
        $this->db->or_where('nama_kriteria',strtolower($params));
        $result = $this->db->get()->result();
        return $result;
    }

    public function insertKriteria($a,$b){
        $str = "C";
        $incrmnt = count($this->getListKriteria());
        if($incrmnt == 0){
            $kd = $str."01";
        }else if($incrmnt > 0 && $incrmnt < 9) {
            $kd = $str."0".($incrmnt+1);
        }else{
            $kd = $str.($incrmnt+1);
        }

        $data = array (
            'id_kriteria' => $kd,
            'nama_kriteria' => ucwords($a),
            'nilai_bobot' => 0,
            'jenis_kriteria' => $b,
            'id_user' => $this->session->userdata('user code')
        );
        $this->db->insert('kriteria',$data);
        $resetData = $this->getListKriteria();
        foreach($resetData as $rd){
            $this->db->set('nilai_bobot',0);
            $this->db->where('id_kriteria',$rd['id_kriteria']);
            $this->db->update('kriteria');
        }
    }

    public function deleteKriteriaId($params){
        $this->db->where('id_kriteria',$params);
        $this->db->delete('kriteria');
        $resetData = $this->getListKriteria();
        foreach($resetData as $rd){
            $this->db->set('nilai_bobot',0);
            $this->db->where('id_kriteria',$rd['id_kriteria']);
            $this->db->update('kriteria');
        }
    }

    
}
