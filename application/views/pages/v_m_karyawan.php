<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-karyawan-tab" data-toggle="tab" href="#nav-karyawan" 
        role="tab" aria-controls="nav-karyawan" aria-selected="true">
            <img src="<? echo base_url() ?>assets/icons/outline_people_alt_black_18dp.png" /> Data Karyawan
        </a>
        <a class="nav-item nav-link" id="nav-tambahKaryawan-tab" data-toggle="tab" href="#nav-tambahKaryawan" 
        role="tab" aria-controls="nav-tambahKaryawan" aria-selected="false">
            <img src="<? echo base_url() ?>assets/icons/outline_person_add_black_18dp.png" /> Tambah Karyawan
        </a>
    </div>
</nav>

<div class="tab-content pt-4 container" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-karyawan" role="tabpanel" aria-labelledby="nav-karyawan-tab">
        <table class="table table-striped tk" id="karyawan">
            <thead class="thead-dark">
                <th scope="col">No</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Pekerjaan</th>
                <th scope="col">Tanggal<br/>Diterima</th>
                <th scope="col">Aksi</th>
            </thead>
            <tbody>
            <?
            $no = 1;
            foreach($karyawan as $k) {
                 if($k['jenis_kelamin'] == "L"){
                    $jnsKelamin = "Laki-Laki";
                 }else {
                    $jnsKelamin = "Perempuan";
                 }
                echo '<tr>
                        <th scope="row">'.$no++.'</th>
                        <td>'.$k['nama_karyawan'].'</td>
                        <td style="width:30%;">'.$k['alamat'].'</td>
                        <td>'.$jnsKelamin.'</td>
                        <td>'.$k['nama_pekerjaan'].'</td>
                        <td>'.$k['tgl_awal_bekerja'].'</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#editKaryawan'.$k['id_karyawan'].'">
                                Ubah <i class="fas fa fa-edit"></i>
                            </button>
                            <a class="btn btn-danger btn-sm text-light" 
                            onclick="swalConfirm(`karyawan`,`'.$k['id_karyawan'].'`,`'.$k['nama_karyawan'].'`);">
                                Hapus <i class="fas fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>';
                }
            ?>
            </tbody>
        </table>
    </div>

    <div class="tab-pane fade" id="nav-tambahKaryawan" role="tabpanel" aria-labelledby="nav-tambahKaryawan-tab">
        <form method="post" action="<?php base_url()?>karyawan/addKaryawan" id="krywn">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-3">
                    <input 
                        type="text"
                        id="krywn_nama" 
                        class="form-control" 
                        name="nama"/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-3">
                    <textarea 
                        name="alamat"
                        id="krywn_alamat" 
                        cols="10" 
                        rows="5" 
                        class="form-control"></textarea>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio"
                                id="krywn_jk" 
                                name="jk" 
                                value="L" 
                                checked >
                            <label class="form-check-label" for="gridRadios1">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio"
                                id="krywn_jk" 
                                name="jk" 
                                value="P" >
                            <label class="form-check-label" for="gridRadios2">Perempuan</label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Diterima</label>
                <div class="input-group mb-2 mr-sm-2 col-sm-3 date" data-provide="datepicker">
                    <input 
                        type="text" 
                        class="form-control" 
                        id="krywn_tgl"  
                        name="tgl" >
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-calendar input-prefix" tabindex=0></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="inlineFormCustomSelectPref">Pekerjaan</label>
                <div class="col-sm-3">
                    <select 
                        id="krywn_pekerjaan"
                        class="custom-select my-1 mr-sm-2" 
                        name="pekerjaan" >
                        <?php
                        foreach($pekerjaan as $p){
                            echo '<option value="'.$p['id_pekerjaan'].'">
                            '.$p['nama_pekerjaan'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-10 ml-auto">
                    <button type="submit" class="btn btn-primary mr-5 btn-md align-self-center">
                        Simpan <i class="fas fa fa-save"></i>
                    </button>
                    <button type="reset" class="btn btn-warning btn-md">
                        Batal <i class="fas fa fa-window-close"></i>
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<?php $this->load->view('modals/modal_edit_karyawan'); ?> 