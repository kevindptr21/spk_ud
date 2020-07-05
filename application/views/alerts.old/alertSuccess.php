<div class="modal fade" id="alertSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="bg-success d-flex justify-content-center">
                <h5 class="modal-title text-light" id="exampleModalLabel">Sukses</h5>
            </div>
            <div class="modal-body">
                <? echo "<h4>".$this->session->flashdata('msg')." <i class='fa fa-check' aria-hidden='true'></i></h4>"; ?>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-center">
                    <button data-dismiss="modal" class="btn btn-warning">
                        Tutup <i class="fas fa fa-window-close"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>