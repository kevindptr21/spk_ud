<? foreach($karyawan as $ke){ ?>
<div class="modal fade" id="editKaryawan<? echo $ke['id_karyawan']; ?>" tabindex="-1" role="dialog" 
aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="exampleModalLabel">Ubah Data Karyawan</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Karyawan</label>
                        <div class="col">
                            <input type="text" class="form-control" name="nakar" value="<? echo $ke['nama_karyawan']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col">
                            <textarea name="alamat" cols="30" rows="5" class="form-control">
                                <?php echo $ke['alamat']; ?>
                            </textarea>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" value="Laki-Laki"
                                    <? if($ke['jenis_kelamin'] == "Laki-Laki"){ echo "checked";} ?>
                                    >
                                    <label class="form-check-label" for="gridRadios1">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" value="perempuan"
                                    <? if($ke['jenis_kelamin'] == "Perempuan"){ echo "checked";} ?>
                                    >
                                    <label class="form-check-label" for="gridRadios2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Diterima</label>
                        <div class="input-group mb-2 mr-sm-2 col date" data-provide="datepicker">
                            <input type="text" class="form-control" name="tgl" value="<? echo $ke['tgl_awal_bekerja'] ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar input-prefix" tabindex=0></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="inlineFormCustomSelectPref">Pekerjaan</label>
                        <div class="col">
                            <select class="custom-select my-1 mr-sm-2" name="pekerjaan" required>
                                <?php
                                foreach($pekerjaan as $p){
                                    if($ke['id_pekerjaan'] == $p['id_pekerjaan']){
                                        echo '<option value="'.$p['id_pekerjaan'].'" selected>
                                        '.$p['nama_pekerjaan'].'
                                        </option>';
                                    }else{
                                        echo '<option value="'.$p['id_pekerjaan'].'">
                                        '.$p['nama_pekerjaan'].'
                                        </option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col">
                            <button type="submit" class="btn btn-primary align-self-center">
                                Simpan <i class="fas fa fa-save"></i>
                            </button>
                            <button data-dismiss="modal" class="btn btn-warning">
                                Batal <i class="fas fa fa-window-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<? } ?>