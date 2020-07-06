<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
            <img src="<? echo base_url() ?>assets/icons/outline_people_alt_black_18dp.png" /> Data Karyawan
        </a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
            <img src="<? echo base_url() ?>assets/icons/outline_person_add_black_18dp.png" /> Tambah Karyawan
        </a>
    </div>
</nav>
<div class="tab-content pt-5 container" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <table class="table table-striped tk" id="mydata">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Tanggal<br/>Diterima</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <? 
            $no = 1;
            foreach($karyawan as $k) {
                 
                echo '<tr>
                        <th scope="row">'.$no++.'</th>
                        <td>'.$k['nama_karyawan'].'</td>
                        <td style="width:30%;">'.$k['alamat'].'</td>
                        <td>'.$k['jenis_kelamin'].'</td>
                        <td>'.$k['nama_pekerjaan'].'</td>
                        <td>'.$k['tgl_awal_bekerja'].'</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#editKaryawan'.$k['id_karyawan'].'">
                                Ubah
                            </button>
                            <a class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#alertWarning'.$k['id_karyawan'].'">
                                Hapus
                            </a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <form method="post" action="<?php base_url()?>karyawan/addKaryawan">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-3">
                    <textarea name="alamat" cols="10" rows="5" class="form-control" required></textarea>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" value="Laki-Laki" checked required>
                            <label class="form-check-label" for="gridRadios1">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" value="Perempuan" required>
                            <label class="form-check-label" for="gridRadios2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Diterima</label>
                <div class="input-group mb-2 mr-sm-2 col-sm-3 date" data-provide="datepicker">
                    <input type="text" class="form-control" name="tgl" required>
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
                    <select class="custom-select my-1 mr-sm-2" name="pekerjaan" required>
                        <label></label>
                        <?php
                        foreach($pekerjaan as $p){
                            echo '
                            <option value="'.$p['id_pekerjaan'].'">'.$p['nama_pekerjaan'].'</option>';
                        }
                        ?>
                        
                    </select>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-10 ml-auto">
                    <button type="submit" class="btn btn-primary mr-5 btn-lg align-self-center">
                        Simpan <i class="fas fa fa-save"></i>
                    </button>
                    <button type="reset" class="btn btn-warning btn-lg">
                        Batal <i class="fas fa fa-window-close"></i>
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<? 
$this->load->view('modals/modal_edit_karyawan');
?>