<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#daftarKriteria" role="tab" aria-controls="nav-home" aria-selected="true">
            <img src="<? echo base_url() ?>assets/icons/outline_ballot_black_18dp.png" /> Daftar Kriteria
        </a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#ubahKriteria" role="tab" 
        aria-controls="nav-profile" aria-selected="false">
            <img src="<? echo base_url() ?>assets/icons/outline_post_add_black_18dp.png" /> Ubah Daftar Kriteria
        </a>
    </div>
</nav>
<div class="tab-content pt-4" id="nav-tabContent">
    <div class="tab-pane fade container mt-4 show active" id="daftarKriteria" role="tabpanel" aria-labelledby="nav-home-tab">
        <!-- Table -->
        <div class="float-left mr-5" style="width: 65%;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kriteria</th>
                        <th scope="col">Nilai Bobot (%)</th>
                        <th scope="col">Jenis Kriteria</th>
                        <th scope="col">Tipe Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <? 
                    if($kriteria == null) {
                        echo '<tr>
                        <td colspan="5" align="center">Belum Ada Kriteria Yang Ditambahkan</td>
                        </tr>';
                    }else {
                        $no_ = 1;
                        foreach($kriteria as $kr) {
                            echo '<tr>
                            <td>'.$no_++.'</td>
                            <td>'.$kr['nama_kriteria'].'</td>
                            <td align="center">'.$kr['nilai_bobot'].'</td>
                            <td>'.$kr['jenis_kriteria'].'</td>
                            <td>'.$kr['tipe_kriteria'].'</td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card" style="width: 30%;">
            <div class="card-header">
                <div class="d-flex justify-content-center">
                    <h4>Keterangan</h4>
                </div>
            </div>
            <div class="container pt-3">
                Jenis Kriteria:
                <ul>
                    <li>Kuantitatif Dinyatakan Dalam Bentuk Angka.</li>
                    <li>Kualitatif Dinyatakan Dalam Bentuk Kata.</li>
                </ul>
                Tipe Kriteria:
                <ul>
                    <li>Benefit (Jika Nilai Terbesar adalah Nilai Terbaik).</li>
                    <li>Cost (Jika Nilai Terkecil adalah Nilai Terbaik).</li>
                </ul>
            </div>
        </div>
        
    </div>

    <div class="tab-pane fade col-md-7" id="ubahKriteria" role="tabpanel" aria-labelledby="nav-profile-tab">
        <button type="button" id="openAddKriteria" class="btn btn-success" data-toggle="modal" data-target="#addKriteria">
            <i class="fas fa fa-plus-circle"></i> Tambah Kriteria
        </button>
        <button type="button" id="openEditKriteria" class="btn btn-warning" 
        <?php echo count($kriteria) != 0 ? "" : "disabled" ?> data-toggle="modal" data-target="#editKriteria">
            <i class="fas fa fa-edit"></i> Ubah Kriteria
        </button>
        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kriteria</th>
                    <th scope="col">Nilai Bobot (%)</th>
                    <th scope="col">Jenis Kriteria</th>
                    <th scope="col">Tipe Kriteria</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <? 
                if($kriteria == null) {
                    echo '<tr>
                    <td colspan="5" align="center">Belum Ada Kriteria Yang Ditambahkan</td>
                    </tr>';
                }else {
                    $no__ = 1;
                    foreach($kriteria as $kr) {
                        echo '<tr>
                            <td>'.$no__++.'</td>
                            <td>'.$kr['nama_kriteria'].'</td>
                            <td align="center">'.$kr['nilai_bobot'].'</td>
                            <td>'.$kr['jenis_kriteria'].'</td>
                            <td>'.$kr['tipe_kriteria'].'</td>
                            <td>
                                <a class="btn btn-danger text-light"
                                onclick="swalConfirm(`kriteria`,`'.$kr['id_kriteria'].'`,`'.$kr['nama_kriteria'].'`);">
                                    <i class="fas fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php 
$this->load->view('modals/modal_add_kriteria');
$this->load->view('modals/modal_edit_kriteria');
?>