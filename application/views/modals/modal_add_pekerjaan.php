<div class="modal fade" id="addPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="exampleModalLabel">Tambah Pekerjaan Baru</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php base_url();?>pekerjaan/addPekerjaan" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Pekerjaan</label>
                        <div class="col">
                            <input 
                                type="text" 
                                name="nama" 
                                class="form-control" >
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