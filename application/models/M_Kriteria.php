<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kriteria extends CI_Model {

	public function getListKriteria(){
        $data = $this->db
        ->from('kriteria')
        ->get()->result_array();
        return $data;
    }

    private function resetData($params) {
        $resetData = $this->getListKriteria();
        if($params == "bobot"){
            foreach($resetData as $rd){
                $this->db
                ->set('nilai_bobot',0)
                ->where('id_kriteria',$rd['id_kriteria'])
                ->update('kriteria');
            }

        }else if($params == "increment"){

            if(count($this->getListKriteria()) == 0){
                return;
            }else{
                $no = 1;
                foreach($resetData as $d){
                    $this->db
                    ->set('id_kriteria','C'.$no++)
                    ->where('nama_kriteria',$d['nama_kriteria'])
                    ->update('kriteria');
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
        $result = $this->db
        ->select("nama_kriteria")
        ->from('kriteria')
        ->where('nama_kriteria',$params)
        ->or_where('nama_kriteria',strtoupper($params))
        ->or_where('nama_kriteria',strtolower($params))
        ->get()->result();
        return $result;
    }

    private function addColumnPenilaian(){
        $this->db->query("PRAGMA foreign_keys = 0");
        $this->db->query("CREATE TABLE temp_table AS SELECT * FROM penilaian");
        $this->db->query("DROP TABLE penilaian");
        $length = count($this->getListKriteria());
        if($length == 0){
            $this->db->query("
            CREATE TABLE penilaian (
            id_penilaian  INTEGER PRIMARY KEY AUTOINCREMENT,
            id_karyawan   VARCHAR (4) REFERENCES karyawan (id_karyawan),
            tgl_penilaian DATE )");

            $this->db->query("
            INSERT INTO penilaian (
            id_penilaian,
            id_karyawan,
            tgl_penilaian )
            SELECT id_penilaian,
            id_karyawan,
            tgl_penilaian FROM temp_table; ");

        }else{
            $qs1 = "
            CREATE TABLE penilaian (
            id_penilaian  INTEGER PRIMARY KEY AUTOINCREMENT,
            id_karyawan   VARCHAR (4) REFERENCES karyawan (id_karyawan),
            tgl_penilaian DATE,";
            
            for($i=1;$i <= $length;$i++){
                if($i < $length){
                    $data[$i] = "C$i    INTEGER (2), ";
                }else{
                    $data[$i] = "C$i    INTEGER (2));";
                }
                
            }

            $this->db->query($qs1.implode("",$data));
            $qsInsert1 = "
            INSERT INTO penilaian (
                id_penilaian,
                id_karyawan,
                tgl_penilaian,
            ";
            $qsInsert2 = "
            SELECT id_penilaian,
                    id_karyawan,
                    tgl_penilaian,
            ";
            $qsInsert3 = " FROM temp_table ;";

            $length2 = count($this->getListKriteria())-1;
            for($i=1;$i <= $length2;$i++){
                if($i < $length2){
                    $data2[$i] = "C$i, ";
                    $data3[$i] = "C$i, ";
                }else{
                    $data2[$i] = "C$i ) ";
                    $data3[$i] = "C$i ";
                }
                
            }

            $this->db->query($qsInsert1.implode("",$data2).$qsInsert2.implode("",$data3).$qsInsert3);
        }
        $this->db->query("DROP TABLE temp_table");
        $this->db->query("PRAGMA foreign_keys = 1");
    }

    public function insertKriteria($params){
        $kd = $this->createIncrement();
        $data = array (
            'id_kriteria' => $kd,
            'nama_kriteria' => ucwords($params['nama']),
            'nilai_bobot' => 0,
            'jenis_kriteria' => $params['jenis'],
            'id_user' => $this->session->userdata('user code')
        );

        $this->db->insert('kriteria',$data);
        $this->resetData('bobot');
        $this->addColumnPenilaian();
        
    }
    
    public function updateKriteria($data,$dataLength){
        for($i=0;$i<$dataLength;$i++){
            $this->db
            ->set('nama_kriteria',ucwords($data['nama'][$i]))
            ->set('nilai_bobot',$data['nilai'][$i])
            ->set('jenis_kriteria',$data['jenis'][$i])
            ->set('id_user',$this->session->userdata('user code'))
            ->where('id_kriteria',$data['id'][$i])
            ->update('kriteria');
        }
    }

    private function deleteColumnPenilaian(){
        $this->db->query("PRAGMA foreign_keys = 0");
        $this->db->query("CREATE TABLE temp_table AS SELECT * FROM penilaian");
        $this->db->query("DROP TABLE penilaian");
        $length = count($this->getListKriteria());
        if($length == 0){
            $this->db->query("
            CREATE TABLE penilaian (
            id_penilaian  INTEGER PRIMARY KEY AUTOINCREMENT,
            id_karyawan   VARCHAR (4) REFERENCES karyawan (id_karyawan),
            tgl_penilaian DATE )");

            $this->db->query("
            INSERT INTO penilaian (
            id_penilaian,
            id_karyawan,
            tgl_penilaian )
            SELECT id_penilaian,
            id_karyawan,
            tgl_penilaian FROM temp_table; ");

        }else{
            $qs1 = "
            CREATE TABLE penilaian (
            id_penilaian  INTEGER PRIMARY KEY AUTOINCREMENT,
            id_karyawan   VARCHAR (4) REFERENCES karyawan (id_karyawan),
            tgl_penilaian DATE,";
            
            for($i=1;$i<=$length;$i++){
                if($i < $length){
                    $data[$i] = "C$i    INTEGER (2),";
                }else{
                    $data[$i] = "C$i    INTEGER (2));";
                }
                
            }

            $this->db->query($qs1.implode("",$data));
            $qsInsert1 = "
            INSERT INTO penilaian (
                id_penilaian,
                id_karyawan,
                tgl_penilaian,
            ";
            $qsInsert2 = "
            SELECT id_penilaian,
                    id_karyawan,
                    tgl_penilaian,
            ";
            $qsInsert3 = " FROM temp_table ;";
            for($i=1;$i<=$length;$i++){
                if($i < $length){
                    $data2[$i] = "C$i,";
                    $data3[$i] = "C$i,";
                }else{
                    $data2[$i] = "C$i)";
                    $data3[$i] = "C$i";
                }
                
            }

            $this->db->query($qsInsert1.implode("",$data2).$qsInsert2.implode("",$data3).$qsInsert3);
        }
        $this->db->query("DROP TABLE temp_table");
        $this->db->query("PRAGMA foreign_keys = 1");

    }

    public function deleteKriteriaId($params){
        $this->db
        ->where('id_kriteria',$params)
        ->delete('kriteria');
        $this->resetData('bobot');
        $this->resetData('increment');
        $this->deleteColumnPenilaian();
        
    }
}
