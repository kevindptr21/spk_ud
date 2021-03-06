<div class="modal fade" id="addKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="exampleModalLabel">Tambah Kriteria Baru</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="<?php base_url()?>kriteria/addKriteria">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Kriteria</label>
                        <div class="col">
                            <input type="text" class="form-control" name="n_kriteria"
                            value="<?php echo $this->session->flashdata('nama') ?  $this->session->flashdata('nama') : '' ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="inlineFormCustomSelectPref">Jenis Kriteria</label>
                        <div class="col-sm-4">
                            <select class="custom-select my-1 mr-sm-2" name="j_kriteria">
                                <option selected value="0">Pilih</option>
                                <? 
                                foreach($jenis as $j) {
                                    echo '<option value="'.$j.'">'.$j.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="inlineFormCustomSelectPref">Tipe Kriteria</label>
                        <div class="col-sm-4">
                            <select class="custom-select my-1 mr-sm-2" name="t_kriteria">
                                <option selected value="0">Pilih</option>
                                <? 
                                foreach($tipe as $t) {
                                    echo '<option value="'.$t.'">'.$t.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

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