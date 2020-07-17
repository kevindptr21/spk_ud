<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Penilaian extends CI_Model {

    public function getTglPenilaian(){
        
        return $this->db
        ->select('tgl_penilaian, COUNT(*) as c')
        ->from('penilaian t1')
        ->join('karyawan t2','t2.id_karyawan = t1.id_karyawan')
        ->group_by('tgl_penilaian')
        ->having('c >= 1')
        ->order_by('c')
        ->not_like('tgl_penilaian',date('d-m-Y'))
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

    public function getSmartTopsis($data){
        $kriteria = $data['kriteria'];
        $penilaian = $data['penilaian'];

    // Normalisasi Bobot
        $nBobot = [];
        $min = [];
        $max = [];
        $nUtility = []; 
        $nSQRT = [];
        $maxYj = [];
        $minYj = [];
        $dPlus = [];
        $dMin = [];
        $Vi = array();
        
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
    
        // Counting R Matrix, Y Matrix, Find Max for Yj+ and Min for Yj-
            for($m=0;$m<count($nUtility[$i]);$m++){
                $rMatrix[$i][] = round(($nUtility[$i][$m]/$nSQRT[$i]),4);
                $yMatrix[$i][] = round(($rMatrix[$i][$m]*$nBobot[$i]),4);
            }
            $maxYj += array($i => max($yMatrix[$i]));
            $minYj += array($i => min($yMatrix[$i]));
    
        // Counting Distance For Positif Ideal and Negatif Ideal
            for($n=0;$n<count($yMatrix[$i]);$n++){
                $tempData[$i][] = round(pow(($maxYj[$i] - $yMatrix[$i][$n]),2),4);
                $tempData1[$i][] = round(pow(($yMatrix[$i][$n]- $minYj[$i]),2),4);
                
                $dYjMax[$n][] = $tempData[$i][$n];
                $dYjMin[$n][] = $tempData1[$i][$n];
            }
                
        }
        
        for($o=0;$o<count($dYjMax);$o++){
            $dPlus += array($o => round(sqrt(array_sum($dYjMax[$o])),4));
            $dMin += array($o => round(sqrt(array_sum($dYjMin[$o])),4));
            array_push($Vi,array(
                'v' => 'V'.($o+1),
                'nilai' => round(($dMin[$o]/($dMin[$o]+$dPlus[$o])),4),
                'nama' => $penilaian[$o]['nama_karyawan'],
                )
            );
        }
        
        // Sorting Vi
            $columns = array_column($Vi, 'nilai');
            array_multisort($columns, SORT_DESC, $Vi);
        // Export Result
            $dataJSON = array(
                'kriteria' => $kriteria,
                'nBobot' => $nBobot,
                'penilaian' => $penilaian,
                'valPenilaian' => $valPenilaian,
                'nUtility' => $nUtility,
                'rMatrix' => $rMatrix,
                'yMatrix' => $yMatrix,
                'idealPos' => $maxYj,
                'idealNeg' => $minYj,
                'dPos' => $dPlus,
                'dNeg' => $dMin,
                'pref' => $Vi,
            );
            
            return $dataJSON;
        }

    

}

?>