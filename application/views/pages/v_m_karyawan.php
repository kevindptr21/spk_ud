<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
            <img src="<? base_url() ?>assets/icons/outline_people_alt_black_18dp.png"/> Data Karyawan
        </a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
            <img src="<? base_url() ?>assets/icons/outline_person_add_black_18dp.png"/> Tambah Karyawan
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
                </tr>
            </thead>
            <? 
            $no = 1;
            foreach($karyawan as $k) {
                echo '
                <tbody>
                    <tr>
                        <th scope="row">'.$no++.'</th>
                        <td>'.$k['nama_karyawan'].'</td>
                        <td>'.$k['alamat'].'</td>
                        <td>'.$k['jenis_kelamin'].'</td>
                        <td>'.$k['nama_pekerjaan'].'</td>
                    </tr>
                </tbody>';
            }
            ?>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <form>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="inputEmail3">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-3">
                    <textarea name="alamat" cols="10" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Laki - Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Diterima</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="inputEmail3">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="inlineFormCustomSelectPref">Pekerjaan</label>
                <div class="col-sm-3">
                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                        <option selected>Pilih</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-10 ml-auto">
                    <button type="submit" class="btn btn-primary mr-5 btn-lg align-self-center">
                        Simpan <img src="<? base_url() ?>assets/icons/outline_save_black_18dp.png"/>
                    </button>
                    <button type="submit" class="btn btn-warning btn-lg">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>