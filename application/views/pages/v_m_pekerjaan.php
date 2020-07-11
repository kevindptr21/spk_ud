<nav class="pt-4 pl-2 bg-primary">
    <div class="nav nav-tabs tabs-text" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
            <img src="<? echo base_url() ?>assets/icons/outline_work_outline_black_18dp.png" /> Daftar Pekerjaan
        </a>
    </div>
</nav>
<div class="tab-content pt-5" id="nav-tabContent">
    <div class="tab-pane fade show active col-md-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPekerjaan">
            <i class="fas fa fa-plus-circle"></i> Tambah Pekerjaan
        </button>
        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <? 
            $no = 1;
            foreach($pekerjaan as $p) {
                echo '
                <tbody>
                    <tr>
                        <th scope="row">'.$no++.'</th>
                        <td>'.$p['nama_pekerjaan'].'</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" 
                                data-target="#editPekerjaan'.$p['id_pekerjaan'].'">
                                Ubah
                            </button>
                            <a class="btn btn-danger btn-sm text-light">
                                Hapus
                            </a>
                        </td>
                    </tr>
                </tbody>';
            }
            ?>
        </table>
    </div>
</div>
<?php $this->load->view('modals/modal_add_pekerjaan'); ?>