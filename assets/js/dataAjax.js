function getAjaxPenilaian(id){
    $.ajax({
        url: window.location.origin + window.location.pathname + 
        "/getDataAjax/"+id,
        type: "GET",
        cache: false,
        dataType: "JSON",
    }).done(function(data){
        var len = data.data.length;
        var btnInputed = `<td>
            <button class="btn btn-sm btn-success">Done <i class="fas fa fa-check-circle"></i></button>
        </td>`;
        for(var i=0;i<len;i++){
            if($("#pilihKaryawan"+data.data[i].idKaryawan) != data.data[i].idKaryawan){
                $("#pilihKaryawan"+data.data[i].idKaryawan).replaceWith(btnInputed);
            }
            
        }
    });

    document.getElementById("tglInputNilai").innerHTML = "Tanggal : "+$("#tgl").val();

    $("#mydata").DataTable({
        scrollY: 250,
        ajax: {
            url: window.location.origin + window.location.pathname + 
            "/getDataAjax/"+$("#tgl").val(),
            type: "POST",
        },
        columns:[
            {data : 'no'},
            {data : 'nama'},
            {data : 'aksi'}
        ],
        bFilter: true,
        info: true,
        destroy: true,
    });
    
}

function getAjaxEditPenilaian(id){
    $.ajax({
        url: window.location.origin + window.location.pathname + 
        "/getDataAjaxEdit/" + id,
        type: "GET",
        cache: false,
        dataType: "JSON",
    }).done(function(data){
        var kriteria = data.kriteria;
        var penilaian = data.nilai;
        $("#nkPenilaian").val(penilaian[0]['nama_karyawan']);
        $("#tglPenilaian").val(penilaian[0]['tgl_penilaian']);
        $("#idPenilaian").val(penilaian[0]['id_penilaian']);
        for(var i=0;i<kriteria.length;i++){
            var id = kriteria[i].id_kriteria
            $(`#${id}`).val(penilaian[0][id]) 
        }
        
    })
}

function getAjaxST(tgl){
    document.getElementById('spkST').innerHTML = null;
    $.ajax({
        url: window.location.origin + window.location.pathname + "/smartTopsis/" + tgl,
        type: "GET",
        cache: false,
        dataType: "JSON",
    }).done(function(dataJSON){
        var p = dataJSON.penilaian;
        var vP = dataJSON.valPenilaian;
        var kriteria = dataJSON.kriteria;
        var len = dataJSON.penilaian.length;
        var idealPos = dataJSON.idealPos;
        var idealNeg = dataJSON.idealNeg;
        var dPos = dataJSON.dPos;
        var dNeg = dataJSON.dNeg;
        var pref = dataJSON.pref;

        var countingSteps = [
            { data : dataJSON.nUtility, tb : "Nilai Utility"},
            { data : dataJSON.rMatrix, tb : "Nilai Matriks R"},
            { data : dataJSON.yMatrix, tb : "Nilai Matriks Ternormalisasi Terbobot Y"}
        ];
        
        getResPenilaian(p,kriteria,vP,"Nilai Karyawan");
        for(var i=0;i<countingSteps.length;i++){
            countingPerSteps(
                countingSteps[i].data,
                kriteria,
                len,
                countingSteps[i].tb
            );
        }
        idealSolution(idealPos,idealNeg,kriteria,"Solusi Ideal");
        distanceIdealSolution(dPos,dNeg,len,"Jarak Solusi Ideal");
        preferentionData(pref,len,"Nilai Preferensi dan Perangkingan");

    });
}

function getResPenilaian(penilaian,kriteria,valPenilaian,tableName){
    var html = `<p class='font-weight-bold'> ${tableName} </p>
    <table class='table table-striped tk'>`;
    html += `<thead class="thead-dark">
        <th scope="col">No</th>
        <th scope="col">Nama Karyawan</th>`;
    for(var i=0;i<kriteria.length;i++){
        html += `<th>${kriteria[i].id_kriteria}</th>`;
    }
    html += `</thead>
    <tbody>`;
    var no = 1;
    for(var j = 0; j<penilaian.length;j++){
        html += `<tr>
        <td>${no++}</td>
        <td>${penilaian[j].nama_karyawan}</td> `;
        for(var k=0;k<valPenilaian.length;k++){
            html += `<td>${valPenilaian[k][j]}</td>`;
        }
        html += `</tr>`;
    }
    document.getElementById('spkST').innerHTML += (html + "</tbody></table>");
}

function countingPerSteps(data,kriteria,length,tableName){
    var html = `<p class='font-weight-bold'> ${tableName} </p><table class='table table-striped tk pt-2'>`;
    html += `<thead class="thead-dark">
        <th scope="col">No</th>
        <th scope="col">Alternatif</th>`;
    for(var i=0;i<kriteria.length;i++){
        html += `<th>${kriteria[i].id_kriteria}</th>`;
    }
    html += `</thead>
    <tbody>`;
    var no = 1;
    for(var j = 0; j<length;j++){
        html += `<tr>
        <td>${no++}</td>
        <td>A${j+1}</td> `;
        for(var k=0;k<data.length;k++){
            html += `<td>${data[k][j]}</td>`;
        }
        html += `</tr>`;
    }
    document.getElementById('spkST').innerHTML += (html + "</tbody></table>");
}

function idealSolution(idealPos,idealNeg,kriteria,tablName){
    var html = `<p class='font-weight-bold'> ${tablName} </p>
    <table class='table table-striped tk pt-2'>`;
    html += `
    <thead class="thead-dark">
        <th scope="col">Nama Kriteria</th>
        <th scope="col">Positif (A+)</th>
        <th scope="col">MAX (Yij)</th>
        <th scope="col">Negatif (A-)</th>
        <th scope="col">MIN (Yij)</th>
        </thead>
    <tbody>`;
    for(var i=0;i<kriteria.length;i++){
        html += `<tr>
        <td>${kriteria[i].nama_kriteria}</td>
        <td>Y${i+1}+</td>
        <td>${idealPos[i]}</td>
        <td>Y${i+1}-</td>
        <td>${idealNeg[i]}</td>
        </tr>`;
    }
    document.getElementById('spkST').innerHTML += (html + "</tbody></table>");
}

function distanceIdealSolution(dPos,dNeg,length,tableName){
    var html = `<div class="float-left" style="width:30%;">
    <p class='font-weight-bold'> ${tableName} </p>
    <table class='table table-striped tk'>`;
    html += `
    <thead class="thead-dark">
        <th scope="col">Alternatif</th>
        <th scope="col">Positif (D+)</th>
        <th scope="col">Negatif (D-)</th>
        </thead>
    <tbody>`;
    for(var i=0;i<length;i++){
        html += `<tr>
        <td>A${i+1}</td>
        <td>${dPos[i]}</td>
        <td>${dNeg[i]}</td>
        </tr>`;
    }
    document.getElementById('spkST').innerHTML += (html + "</tbody></table></div>");
}

function preferentionData(pref,length,tableName){
    var html = `<div class="float-left ml-5" style="width:65%;">
    <p class='font-weight-bold'> ${tableName} </p>
    <table class='table table-striped tk'>`;
    html += `
    <thead class="thead-dark">
        <th scope="col">Ranking</th>
        <th scope="col">Preferensi</th>
        <th scope="col">Nama Karyawan</th>
        <th scope="col">Nilai</th>
        </thead>
    <tbody>`;
    for(var i=0;i<length;i++){
        html += `<tr>
        <td>${i+1}</td>
        <td>${pref[i].v}</td>
        <td>${pref[i].nama}</td>
        <td>${pref[i].nilai}</td>
        </tr>`;
    }
    document.getElementById('spkST').innerHTML += (html + "</tbody></table></div>");
}