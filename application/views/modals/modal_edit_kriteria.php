<div class="modal fade" id="editKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="exampleModalCenterTitle">Ubah Data Kriteria</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php base_url(); ?>kriteria/changeKriteria" method="post">
                <div class="modal-body">
                    <? foreach($kriteria as $mk) { ?>
                    <div class="form-group row">
                        <div class="input-group col-sm-5">
                            <input type="hidden" name="id_kriteria[]" value="<?= $mk['id_kriteria'] ?>">
                            <input 
                                type="text"
                                id="<?= substr($mk['id_kriteria'],1)?>"
                                pattern="[A-z]{0,25}|[A-z]{0,25}([ ])[A-z]{0,25}" 
                                title="Tidah Boleh Menggunakan Angka" 
                                class="form-control" 
                                name="n_kriteria[]" 
                                value="<?= $mk['nama_kriteria'] ?>"
                            >

                        </div>
                        <div class="input-group col">
                            <input type="number"class="form-control" name="n_bobot[]" min="0" max="100"
                            value="<?= $mk['nilai_bobot'] ?>">
                            <div class="input-group-prepend input-sm">
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                        <div class="input-group col">
                            <select class="custom-select my-1 " name="j_kriteria[]">
                                <option selected value="0">Pilih</option>
                                <? 
                                foreach($jenis as $j) {
                                    if($mk['jenis_kriteria'] == $j) {
                                        echo '<option value="'.$j.'" selected>'.$j.'</option>';
                                    }else {
                                        echo '<option value="'.$j.'">'.$j.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group col">
                            <select class="custom-select my-1 " name="t_kriteria[]">
                                <option selected value="0">Pilih</option>
                                <? 
                                foreach($tipe as $t) {
                                    if($mk['tipe_kriteria'] == $t) {
                                        echo '<option value="'.$t.'" selected>'.$t.'</option>';
                                    }else {
                                        echo '<option value="'.$t.'">'.$t.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                    </div>
                    <? } ?>
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