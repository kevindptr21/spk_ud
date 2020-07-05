<? if(substr($_SERVER["REQUEST_URI"],1) == "kriteria") {
    foreach($kriteria as $kr){ ?>

<div class="modal fade" id="alertWarning<? echo $kr['id_kriteria'];?>" tabindex="-1" role="dialog" 
aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="bg-danger d-flex justify-content-center">
        <h5 class="modal-title text-light" id="exampleModalLabel">Warning <i class="fas fa fa-exclamation-triangle"></i></h5>
      </div>
      <div class="modal-body">
        Yakin Ingin Menghapus
        <? echo $kr['nama_kriteria'] ?> ?
      </div>
    </div>
  </div>
</div>

<?
  }
} else if (substr($_SERVER["REQUEST_URI"],1) == "karyawan" )  {
  foreach($karyawan as $k) { ?>

<div class="modal fade" id="alertWarning<? echo $k['id_karyawan']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="bg-danger d-flex justify-content-center">
        <h5 class="modal-title text-light" id="exampleModalLabel">Warning <i class="fas fa fa-exclamation-triangle"></i></h5>
      </div>
      <div class="modal-body">
        Yakin Ingin Menghapus
        <? echo $k['nama_karyawan'] ?> ?
      </div>
    </div>
  </div>
</div>

<? }
} else if (substr($_SERVER["REQUEST_URI"],1) == "pekerjaan" )  {
  foreach($pekerjaan as $p) { ?>

  <? 
  }
}
  ?>