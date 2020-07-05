function swalConfirm(table,id,name){
    var text = "";
    var methodName = "delete"+table.charAt(0).toUpperCase()+table.slice(1);
    switch(table){
        case "kriteria":
            text = "Setelah Menghapus Kriteria, Anda Diharuskan Untuk Mengatur Ulang Nilai Bobot Kriteria";
        break;
        case "pekerjaan":
            text = "Data Pekerjaan Ini Akan Dihapus dari List Pekerjaan";
        break;
        case "karyawan":
            text = "Data Karyawan Ini Akan Dihapus dari List Karyawan";
        break;
    }

    swal({
        title: "Yakin Menghapus " + name +" ?",
        text: text,
        icon: "warning",
        buttons: [
            'Batal',
            'Hapus'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            try {
                window.location.href = window.location.origin + window.location.pathname + 
                "/" + methodName + "/" +id;
            }catch (err) {
                console.log(err);
                swal({  
                    title: 'Error',
                    text: err,
                    icon: 'error'
                })
            }
        }
    })

}