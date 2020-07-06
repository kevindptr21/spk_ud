<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kriteria extends CI_Model {

	public function getListKriteria(){
        $this->db->from('kriteria');
        $data = $this->db->get()->result_array();
        return $data;
    }

    private function resetData($params) {
        $resetData = $this->getListKriteria();
        if($params == "bobot"){
            foreach($resetData as $rd){
                $this->db->set('nilai_bobot',0);
                $this->db->where('id_kriteria',$rd['id_kriteria']);
                $this->db->update('kriteria');
            }

        }else if($params == "increment"){

            if(count($this->getListKriteria()) == 0){
                return;
            }else{
                $no = 1;
                foreach($resetData as $d){
                    $this->db->set('id_kriteria','C'.$no++);
                    $this->db->where('nama_kriteria',$d['nama_kriteria']);
                    $this->db->update('kriteria');
                }    
            }

        }else{
            return;
        }
    }

    private function createIncrement(){
        $str = "C";
        $incrmnt = count($this->getListKriteria());
        if($incrmnt == 0){
            $kd = $str."1";
        }else{
            $kd = $str.($incrmnt+1);
        }

        return $kd;
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
        $kd = $this->createIncrement();
        $data = array (
            'id_kriteria' => $kd,
            'nama_kriteria' => ucwords($a),
            'nilai_bobot' => 0,
            'jenis_kriteria' => $b,
            'id_user' => $this->session->userdata('user code')
        );

        $this->db->insert('kriteria',$data);
        $this->resetData('bobot'); 
        
    }
    
    public function updateKriteria($data,$dataLength){
        for($i=0;$i<$dataLength;$i++){
            $this->db->set('nama_kriteria',ucwords($data['nama'][$i]));
            $this->db->set('nilai_bobot',$data['nilai'][$i]);
            $this->db->set('jenis_kriteria',$data['jenis'][$i]);
            $this->db->set('id_user',$this->session->userdata('user code'));
            $this->db->where('id_kriteria',$data['id'][$i]);
            $this->db->update('kriteria');
        }
    }

    public function deleteKriteriaId($params){
        $this->db->where('id_kriteria',$params);
        $this->db->delete('kriteria');
        $this->resetData('bobot');
        $this->resetData('increment');
        
    }
}
