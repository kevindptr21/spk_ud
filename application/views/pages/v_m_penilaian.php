<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-penilaian-tab" data-toggle="tab" href="#nav-penilaian" role="tab" aria-controls="nav-penilaian" aria-selected="true">
            <img src="<? echo base_url() ?>assets/icons/outline_grading_black_18dp.png" /> Form Penilaian
        </a>
        <a class="nav-item nav-link" id="nav-ST-tab" data-toggle="tab" href="#nav-ST" role="tab" aria-controls="nav-ST" aria-selected="false">
            <img src="<? echo base_url() ?>assets/icons/outline_calculate_black_18dp.png" /> Perhitungan SMART-TOPSIS
        </a>
    </div>
</nav>
<div class="tab-content pt-5 container" id="nav-tabContent">

    <!-- INPUT NILAI -->
    <div class="tab-pane fade show active" id="nav-penilaian" role="tabpanel" aria-labelledby="nav-penilaian-tab">
        
        <div id="form-penilaian">
            <form method="post" action="<? base_url()?>penilaian/testingInput">
                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Tanggal Penilaian</label>
                    <div class="col-sm">
                        <input 
                            style="width:7em;"
                            type="text" 
                            disable 
                            class="form-control" 
                            name="tgl_penilaian" 
                            value="<?= date('d/m/Y') ?>"
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Nama Karyawan</label>
                    <div class="col-sm">
                        <input 
                            type="text" 
                            disabled
                            class="form-control" 
                            name="nama" 
                            required
                        >
                    </div>
                    <a class="btn btn-primary col-sm-2 text-light" data-toggle="modal" data-target="#cariKaryawan">
                        Cari
                    </a>
                </div>
                <? foreach ($kriteria as $pk) {
                    echo '<div class="form-group row">
                        <label class="col-sm-5 col-form-label">'.$pk['nama_kriteria'].'</label>
                        <div class="col-sm">';
                        if($pk['jenis_kriteria'] == "Kualitatif"){
                            echo '
                            <select name="n_penilaian[]" class="form-control" style="width:9em;">
                                <option value="0">Pilih</option>
                                <option value="5">Sangat Baik</option>
                                <option value="4">Baik</option>
                                <option value="3">Cukup</option>
                                <option value="2">Kurang</option>
                                <option value="1">Sangat Kurang</option>
                            </select>
                            ';
                        }else {
                            echo '
                            <input
                                style="width:5em;"
                                type="number" 
                                min="0" 
                                name="n_penilaian[]" 
                                class="form-control" 
                                value="0" 
                                pattern="[0-9]{3}" />';
                        }

                    echo '</div>
                    </div>';
                    
                } ?>

                <div class="form-group row d-flex justify-content-center">
                    <div class="col-md-10 ml-auto">
                        <button type="submit" class="btn btn-primary mr-5 btn-md align-self-center">
                            Tambah <i class="fas fa fa-plus-circle"></i>
                        </button>
                        <button type="reset" class="btn btn-warning btn-md">
                            Batal <i class="fas fa fa-window-close"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div id="inputed-data">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <h4>List Karyawan Terinput</h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h5>Tanggal : <?= date('d/m/Y')?></h5>
                    </div>
                </div>
                <div class="container pt-3">
                    <table class="table table-bordered tk" id="mydata">
                        <thead class="thead-dark">
                            <th style="width: 20px;">No</th>
                            <th>Nama Karyawan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <? if($this->cart->contents() == null) { ?>
                                <!-- <tr>
                                    <td colspan="3" align="center">Belum Ada Karyawan Terinput</td>
                                </tr> -->
                            <? } else { 
                                $noCart = 1;
                                foreach($this->cart->contents() as $cc){ ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $cc['nama_karyawan']; ?></td>
                                        <td>A | B | C</td>
                                    </tr>

                                <? } 
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

    <!-- PERHITUNGAN -->
    <div class="tab-pane fade" id="nav-ST" role="tabpanel" aria-labelledby="nav-ST-tab">
        <h1>PERHITUNGAN SMART-TOPSIS</h1>
    </div>

</div>
<?
$this->load->view('modals/modal_cari_karyawan');
?>