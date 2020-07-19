<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-penilaian-tab" data-toggle="tab" href="#nav-penilaian" role="tab" aria-controls="nav-penilaian" aria-selected="true">
            <img src="<?php echo base_url() ?>assets/icons/outline_grading_black_18dp.png" /> Form Penilaian
        </a>
        <a class="nav-item nav-link " id="nav-ST-tab" data-toggle="tab" href="#nav-ST" role="tab" aria-controls="nav-ST" aria-selected="false">
            <img src="<?php echo base_url() ?>assets/icons/outline_calculate_black_18dp.png" /> Perhitungan SMART-TOPSIS
        </a>
    </div>
</nav>
<div class="tab-content pt-4 container" id="nav-tabContent">

    <!-- INPUT NILAI -->
    <div class="tab-pane fade show active" id="nav-penilaian" role="tabpanel" aria-labelledby="nav-penilaian-tab">
        <div id="form-penilaian">
            <form id="frm" method="post" action="<?php base_url()?>penilaian/addPenilaian">
                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Tanggal Penilaian</label>
                    <div class="col-sm">
                        <select name="tgl_penilaian" id="tgl" class="form-control col-md-8">
                            <option><?= date('d-m-Y');?></option>
                            <?php
                            foreach($tgl as $date){
                                echo '<option value="'.$date['tgl_penilaian'].'">'.$date['tgl_penilaian'].'</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <input type="hidden" id="id" name="id">
                    <label class="col-sm-5 col-form-label">Nama Karyawan</label>
                    <div class="col-sm">
                        <input 
                            type="text" 
                            readonly
                            class="form-control" 
                            id="nama"
                            required
                        >
                    </div>
                    <a class="btn btn-dark col-sm-2 text-light" id="cari" data-toggle="modal" data-target="#cariKaryawan">
                        Cari
                    </a>
                </div>
                <?php foreach ($kriteria as $pk) {
                    echo '<div class="form-group row">
                        <label class="col-sm-5 col-form-label">'.$pk['nama_kriteria'].'</label>
                        <div class="col-sm">';
                        if($pk['jenis_kriteria'] == "Kualitatif"){
                            echo '<select name="n_penilaian[]" id="s'.substr($pk['id_kriteria'],1).'" 
                            class="form-control" style="width:9em;" required>
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
                                name="n_penilaian[]"';
                                if($pk['nama_kriteria'] == "Masa Kerja"){
                                    echo 'id="nk"';
                                }else if($pk['nama_kriteria'] == "Presensi"){
                                    echo 'id="nk2" max="310"';
                                }
                                echo 'class="form-control" 
                                pattern="[0-9]"
                                required 
                            />';
                        }

                    echo '</div>
                    </div>';
                    
                } ?>

                <div class="form-group row d-flex justify-content-center">
                    <div class="col-md-10 ml-auto">
                        <button type="submit" id="conf" class="btn btn-primary mr-5 btn-md align-self-center">
                            Tambah <i class="fas fa fa-plus-circle"></i>
                        </button>
                        <button type="reset" id="btl" class="btn btn-warning btn-md">
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
                        <h5>Tanggal : <?php echo date('d-m-Y')?></h5>
                    </div>
                </div>
                <div class="container pt-3">
                    <table class="table table-bordered tk" id="mydata">
                        <thead class="thead-dark">
                            <th style="width: 20px;">No</th>
                            <th>Nama Karyawan</th>
                            <th style="width: 100px;">Aksi</th>
                        </thead>
                        <tbody id="listPenilaian">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

    <!-- PERHITUNGAN -->
    <div class="tab-pane fade" id="nav-ST" role="tabpanel" aria-labelledby="nav-ST-tab">
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <label >Tanggal Penilaian</label>
            </div>
            <div class="p-2 bd-highlight">
                <select id="ST" class="form-control col-md-15">
                    <option selected>Pilih</option>
                    <?php foreach($tgl as $dateST){
                        echo '<option value="'.$dateST['tgl_penilaian'].'">'.$dateST['tgl_penilaian'].'</option>';
                    } ?>
                </select>
            </div>

            <div class="p-2 bd-highlight">
                <a href="<?php base_url()?>penilaian/printToPdf">
                    <button 
                        class="btn btn-primary btn-lg text-light">
                        <i class="fas fa fa-print"></i> Print
                    </button>
                </a>
            </div>
        </div>

        <div class='mt-3' id="spkST" style="height: 60vh;overflow-y:auto;">
           
        </div>


    </div>

</div>

<?php
$this->load->view('modals/modal_edit_penilaian'); 
?>