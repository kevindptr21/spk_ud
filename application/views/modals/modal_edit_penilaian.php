<div class="modal fade" id="editPenilaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="exampleModalCenterTitle">Ubah Data Penilaian</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php base_url(); ?>penilaian/changePenilaian" method="post">
                <div class="modal-body" id="formEdit">
                    <input type="hidden" id="idPenilaian" name="idPenilaian">
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Tanggal Penilaian</label>
                        <div class="col-sm">
                            <input 
                                type="text" 
                                class="form-control" 
                                id="tglPenilaian" 
                                readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Nama Karyawan</label>
                        <div class="col-sm">
                            <input 
                                type="text" 
                                readonly
                                name="nkPenilaian"
                                class="form-control" 
                                id="nkPenilaian"
                                required >
                        </div>
                    </div>
                    <?php foreach ($kriteria as $pk) {
                        echo '<div class="form-group row">
                            <label class="col-sm-5 col-form-label">'.$pk['nama_kriteria'].'</label>
                            <div class="col-sm">';
                            if($pk['jenis_kriteria'] == "Kualitatif"){
                                echo '<select name="nPenilaian[]" id="'.$pk['id_kriteria'].'" 
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
                                    id="'.$pk['id_kriteria'].'" 
                                    name="nPenilaian[]" 
                                    class="form-control" 
                                    pattern="[0-9]"
                                    required 
                                />';
                            }

                        echo '</div>
                        </div>';
                        
                    } ?>
                    </div>
                <div class="modal-footer">
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col">
                            <button type="submit" id="conf" class="btn btn-primary align-self-center">
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