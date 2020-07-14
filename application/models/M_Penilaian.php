<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Penilaian extends CI_Model {

    function __construct(){

        parent::__construct();
        $this->load->model('M_Karyawan');
        $this->load->model('M_Kriteria');
    }

    public function getTglPenilaian(){
        return $this->db
        ->select('tgl_penilaian, COUNT(*) as c')
        ->from('penilaian t1')
        ->join('karyawan t2','t2.id_karyawan = t1.id_karyawan')
        ->group_by('tgl_penilaian')
        ->having('c > 1')
        ->order_by('c')
        ->get()->result_array();
    }

    public function getListPenilaianTgl($params){
        return $this->db
        ->from("penilaian t1")
        ->join("karyawan t2","t2.id_karyawan = t1.id_karyawan")
        ->where("tgl_penilaian",$params)
        ->get()->result_array();
    }

    public function addPenilaian($data){
        $val = array();
        $no = 1;
        for($i=0;$i<count($data['nilai']);$i++){
            $val += [
                "id_penilaian" => null,
                "id_karyawan" => $data['id'],
                "tgl_penilaian" => $data['tgl'],
                "id_user" => $this->session->userdata('user code'),
                "C".$no++."" => $data['nilai'][$i],
            ];
        }
        $this->db->insert('penilaian',$val);
    }

    private function SPK(){

        $kriteria = $this->M_Kriteria->getListKriteria();
        $penilaian = $this->getListPenilaianTgl('20-12-2019');

        // Normalisasi Bobot
            $nBobot = [];

        $valPenilaian = [];
        $min = [];
        $max = [];
        $nUtility = [];
        $pow = []; 
        $nSQRT = [];
        $rMatrix = [];
        $yMatrix = [];
        $maxYij = [];
        $minYij = [];

        
        for($i=0;$i<count($kriteria);$i++){
            $nBobot += array($i => ($kriteria[$i]['nilai_bobot']/100));

        // SMART Method    
            // Getting Data and Find Min Max Value
                for($j=0;$j<count($penilaian);$j++){
                    $valPenilaian[$i][] = $penilaian[$j]['C'.($i+1)];
                }
                $min += array($i => min($valPenilaian[$i]));
                $max += array($i => max($valPenilaian[$i]));
            
            // Counting Utility Value
                for($k=0;$k<count($valPenilaian[$i]);$k++){
                    if($kriteria[$i]['tipe_kriteria'] == "Benefit"){
                        $nUtility[$i][] = round(($valPenilaian[$i][$k] - $min[$i]) / ($max[$i]-$min[$i]),4) ;
                    }else{
                        $nUtility[$i][] = round(($max[$i] - $valPenilaian[$i][$k]) / ($max[$i]-$min[$i]),4) ;
                    }
                }

        // TOPSIS Method
            // Getting Division for Each Criteria
                for($l=0;$l<count($nUtility[$i]);$l++){
                    $pow[$i][] = round(pow($nUtility[$i][$l],2),4);
                }
                $nSQRT += array($i => round(sqrt(array_sum($pow[$i])),4));

            // Counting R Matrix, Y Matrix, Find Max for Yij+ and Min for Yij-
                for($m=0;$m<count($nUtility[$i]);$m++){
                    $rMatrix[$i][] = round(($nUtility[$i][$m]/$nSQRT[$i]),4);
                    $yMatrix[$i][] = round(($rMatrix[$i][$m]*$nBobot[$i]),4);
                }
                $maxYij += array($i => max($yMatrix[$i]));
                $minYij += array($i => min($yMatrix[$i]));

            // Counting Distance For Positif Ideal and Negatif Ideal


        }
                $data = [
                    'nBobot' => $nBobot
                ];
        
        return $minYij;
    }

    public function SMART_TOPSIS(){
        return $this->SPK();
    }

    

}

?>