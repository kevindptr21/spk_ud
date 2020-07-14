<?php
$nb = array(
    "C1" => ($kriteria[0]['nilai_bobot']/100),
    "C2" => ($kriteria[1]['nilai_bobot']/100),
    "C3" => ($kriteria[2]['nilai_bobot']/100),
    "C4" => ($kriteria[3]['nilai_bobot']/100),
    "C5" => ($kriteria[4]['nilai_bobot']/100),
    "C6" => ($kriteria[5]['nilai_bobot']/100),
    "C7" => ($kriteria[6]['nilai_bobot']/100),
);
?>
<h1>SMART</h1>
<h5>Normalisasi Bobot</h5>
<table border="1">
<tr>
    <td width="50">C1</td>
    <td width="50">C2</td>
    <td width="50">C3</td>
    <td width="50">C4</td>
    <td width="50">C5</td>
    <td width="50">C6</td>
    <td width="50">C7</td>
</tr>

<tr>
<?php
$no = 1;
foreach($kriteria as $kn){
    echo'<td>'.($kn['nilai_bobot']/100).'</td>';
}
?>
</tr>
</table><br>
<h5>1. Table Rating Kecocokan</h5>
<table border="1">
<tr>
    <td width="50">C1</td>
    <td width="50">C2</td>
    <td width="50">C3</td>
    <td width="50">C4</td>
    <td width="50">C5</td>
    <td width="50">C6</td>
    <td width="50">C7</td>
</tr>
<?php
$minMax = array(
    "C1" => array(
        "max" => array(),
        "min" => array(),
    ),
    "C2" => array(
        "max" => array(),
        "min" => array(),
    ),
    "C3" => array(
        "max" => array(),
        "min" => array(),
    ),
    "C4" => array(
        "max" => array(),
        "min" => array(),
    ),
    "C5" => array(
        "max" => array(),
        "min" => array(),
    ),
    "C6" => array(
        "max" => array(),
        "min" => array(),
    ),
    "C7" => array(
        "max" => array(),
        "min" => array(),
    ),

);
foreach($penilaian as $pn){
    array_push($minMax['C1']["max"],$pn['C1']);
    array_push($minMax['C2']["max"],$pn['C2']);
    array_push($minMax['C3']["max"],$pn['C3']);
    array_push($minMax['C4']["max"],$pn['C4']);
    array_push($minMax['C5']["max"],$pn['C5']);
    array_push($minMax['C6']["max"],$pn['C6']);
    array_push($minMax['C7']["max"],$pn['C7']);

    array_push($minMax['C1']["min"],$pn['C1']);
    array_push($minMax['C2']["min"],$pn['C2']);
    array_push($minMax['C3']["min"],$pn['C3']);
    array_push($minMax['C4']["min"],$pn['C4']);
    array_push($minMax['C5']["min"],$pn['C5']);
    array_push($minMax['C6']["min"],$pn['C6']);
    array_push($minMax['C7']["min"],$pn['C7']);

    echo'
    <tr>
        <td>'.$pn['C1'].'</td>
        <td>'.$pn['C2'].'</td>
        <td>'.$pn['C3'].'</td>
        <td>'.$pn['C4'].'</td>
        <td>'.$pn['C5'].'</td>
        <td>'.$pn['C6'].'</td>
        <td>'.$pn['C7'].'</td>

    </tr>
    ';
}
?>
</table><br>

<h5>2. Table Nilai Utility</h5>
<table border="1">
<tr>
    <td width="50">C1</td>
    <td width="50">C2</td>
    <td width="50">C3</td>
    <td width="50">C4</td>
    <td width="50">C5</td>
    <td width="50">C6</td>
    <td width="50">C7</td>
</tr>
<?php
$data = array(
    0 => array(),
    1 => array(),
    2 => array(),
    3 => array(),
    4 => array(),
    5 => array(),
    6 => array()
);
$matriksX = array(
    0 => array(),
    1 => array(),
    2 => array(),
    3 => array(),
    4 => array(),
    5 => array(),
    6 => array()
);
foreach($penilaian as $pn){
    array_push($data[0],pow(($pn['C1']-min($minMax['C1']['min']))/(max($minMax['C1']['max'])-min($minMax['C1']['min'])),2));
    array_push($data[1],pow(($pn['C2']-min($minMax['C2']['min']))/(max($minMax['C2']['max'])-min($minMax['C2']['min'])),2));
    array_push($data[2],pow(($pn['C3']-min($minMax['C3']['min']))/(max($minMax['C3']['max'])-min($minMax['C3']['min'])),2));
    array_push($data[3],pow(($pn['C4']-min($minMax['C4']['min']))/(max($minMax['C4']['max'])-min($minMax['C4']['min'])),2));
    array_push($data[4],pow(($pn['C5']-min($minMax['C5']['min']))/(max($minMax['C5']['max'])-min($minMax['C5']['min'])),2));
    array_push($data[5],pow(($pn['C6']-min($minMax['C6']['min']))/(max($minMax['C6']['max'])-min($minMax['C6']['min'])),2));
    array_push($data[6],pow(($pn['C7']-min($minMax['C7']['min']))/(max($minMax['C7']['max'])-min($minMax['C7']['min'])),2));

    array_push($matriksX[0],($pn['C1']-min($minMax['C1']['min']))/(max($minMax['C1']['max'])-min($minMax['C1']['min'])));
    array_push($matriksX[1],($pn['C2']-min($minMax['C2']['min']))/(max($minMax['C2']['max'])-min($minMax['C2']['min'])));
    array_push($matriksX[2],($pn['C3']-min($minMax['C3']['min']))/(max($minMax['C3']['max'])-min($minMax['C3']['min'])));
    array_push($matriksX[3],($pn['C4']-min($minMax['C4']['min']))/(max($minMax['C4']['max'])-min($minMax['C4']['min'])));
    array_push($matriksX[4],($pn['C5']-min($minMax['C5']['min']))/(max($minMax['C5']['max'])-min($minMax['C5']['min'])));
    array_push($matriksX[5],($pn['C6']-min($minMax['C6']['min']))/(max($minMax['C6']['max'])-min($minMax['C6']['min'])));
    array_push($matriksX[6],($pn['C7']-min($minMax['C7']['min']))/(max($minMax['C7']['max'])-min($minMax['C7']['min'])));

    echo'
    <tr>
        <td>'.($pn['C1']-min($minMax['C1']['min']))/(max($minMax['C1']['max'])-min($minMax['C1']['min'])).'</td>
        <td>'.($pn['C2']-min($minMax['C2']['min']))/(max($minMax['C2']['max'])-min($minMax['C2']['min'])).'</td>
        <td>'.($pn['C3']-min($minMax['C3']['min']))/(max($minMax['C3']['max'])-min($minMax['C3']['min'])).'</td>
        <td>'.($pn['C4']-min($minMax['C4']['min']))/(max($minMax['C4']['max'])-min($minMax['C4']['min'])).'</td>
        <td>'.($pn['C5']-min($minMax['C5']['min']))/(max($minMax['C5']['max'])-min($minMax['C5']['min'])).'</td>
        <td>'.($pn['C6']-min($minMax['C6']['min']))/(max($minMax['C6']['max'])-min($minMax['C6']['min'])).'</td>
        <td>'.($pn['C7']-min($minMax['C7']['min']))/(max($minMax['C7']['max'])-min($minMax['C7']['min'])).'</td>

    </tr>
    ';
}
?>
</table><br>
<h1>TOPSIS</h1>
<h5>3. Normalisasi Matriks R</h5>
<table border="1">
<tr>
    <td width="50">C1</td>
    <td width="50">C2</td>
    <td width="50">C3</td>
    <td width="50">C4</td>
    <td width="50">C5</td>
    <td width="50">C6</td>
    <td width="50">C7</td>
</tr>
<?php
$nilaiAkar = array(
    0 => sqrt(array_sum($data[0])),
    1 => sqrt(array_sum($data[1])),
    2 => sqrt(array_sum($data[2])),
    3 => sqrt(array_sum($data[3])),
    4 => sqrt(array_sum($data[4])),
    5 => sqrt(array_sum($data[5])),
    6 => sqrt(array_sum($data[6])),
);
for($i=0;$i<count($penilaian);$i++){
    
    echo '
    <tr>
        <td>'.$data[0][$i].'</td>
        <td>'.$data[1][$i].'</td>
        <td>'.$data[2][$i].'</td>
        <td>'.$data[3][$i].'</td>
        <td>'.$data[4][$i].'</td>
        <td>'.$data[5][$i].'</td>
        <td>'.$data[6][$i].'</td>
    </tr>
    ';
}
?>
</table><br>
<table border="1">
<tr>
    <td width="50">C1</td>
    <td width="50">C2</td>
    <td width="50">C3</td>
    <td width="50">C4</td>
    <td width="50">C5</td>
    <td width="50">C6</td>
    <td width="50">C7</td>
</tr>
<?php
$matriksR = array(
    0 => array(),
    1 => array(),
    2 => array(),
    3 => array(),
    4 => array(),
    5 => array(),
    6 => array()
);

for($i=0;$i<count($penilaian);$i++){
    array_push($matriksR[0],($matriksX[0][$i]/$nilaiAkar[0]));
    array_push($matriksR[1],($matriksX[1][$i]/$nilaiAkar[1]));
    array_push($matriksR[2],($matriksX[2][$i]/$nilaiAkar[2]));
    array_push($matriksR[3],($matriksX[3][$i]/$nilaiAkar[3]));
    array_push($matriksR[4],($matriksX[4][$i]/$nilaiAkar[4]));
    array_push($matriksR[5],($matriksX[5][$i]/$nilaiAkar[5]));
    array_push($matriksR[6],($matriksX[6][$i]/$nilaiAkar[6]));
    
    echo '
    <tr>
        <td>'.($matriksX[0][$i]/$nilaiAkar[0]).'</td>
        <td>'.($matriksX[1][$i]/$nilaiAkar[1]).'</td>
        <td>'.($matriksX[2][$i]/$nilaiAkar[2]).'</td>
        <td>'.($matriksX[3][$i]/$nilaiAkar[3]).'</td>
        <td>'.($matriksX[4][$i]/$nilaiAkar[4]).'</td>
        <td>'.($matriksX[5][$i]/$nilaiAkar[5]).'</td>
        <td>'.($matriksX[6][$i]/$nilaiAkar[6]).'</td>
    </tr>
    ';
}
?>
</table><br>
<h5>4. Normalisasi Matriks R Terbobot Y</h5>
<table border="1">
<tr>
    <td width="50">C1</td>
    <td width="50">C2</td>
    <td width="50">C3</td>
    <td width="50">C4</td>
    <td width="50">C5</td>
    <td width="50">C6</td>
    <td width="50">C7</td>
</tr>
<?php
$matriksY = array(
    0 => array(),
    1 => array(),
    2 => array(),
    3 => array(),
    4 => array(),
    5 => array(),
    6 => array()
);
$no = 1;
for($j=0;$j<count($penilaian);$j++){
    
    array_push($matriksY[0],($matriksR[0][$j]*$nb['C1']));
    array_push($matriksY[1],($matriksR[1][$j]*$nb['C2']));
    array_push($matriksY[2],($matriksR[2][$j]*$nb['C3']));
    array_push($matriksY[3],($matriksR[3][$j]*$nb['C4']));
    array_push($matriksY[4],($matriksR[4][$j]*$nb['C5']));
    array_push($matriksY[5],($matriksR[5][$j]*$nb['C6']));
    array_push($matriksY[6],($matriksR[6][$j]*$nb['C7']));
    
    echo '
    <tr>
        <td>'.($matriksR[0][$j]*$nb['C1']).'</td>
        <td>'.($matriksR[1][$j]*$nb['C2']).'</td>
        <td>'.($matriksR[2][$j]*$nb['C3']).'</td>
        <td>'.($matriksR[3][$j]*$nb['C4']).'</td>
        <td>'.($matriksR[4][$j]*$nb['C5']).'</td>
        <td>'.($matriksR[5][$j]*$nb['C6']).'</td>
        <td>'.($matriksR[6][$j]*$nb['C7']).'</td>
    </tr>
    ';
}

?>
</table><br>
<h5>Solusi Ideal Positif A+</h5>
<table border="1">
<tr>
    <td width="50">Kriteria</td>
    <td width="50">A+</td>
    <td width="50">Max (Yij)</td>
    <td width="50">A-</td>
    <td width="50">Min (Yij)</td>
</tr>
<?php
for($i=0;$i<count($kriteria);$i++){
    echo '
    <tr>
        <td>'.$kriteria[$i]['nama_kriteria'].'</td>
        <td>Y1+</td>
        <td>'.max($matriksY[$i]).'</td>
        <td>Y1-</td>
        <td>'.min($matriksY[$i]).'</td>
    </tr>
    ';
}
?>
</table><br>
<h5>Jarak Solusi Ideal +</h5>
<table>
    
</table>