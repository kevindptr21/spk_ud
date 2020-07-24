<div class="modal fade" id="cariKaryawan" aria-labelledby="cariKaryawan">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Daftar Karyawan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <table class="table table-bordered table-sm" id="searchKaryawan" style="font-size: 10pt;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Masa Kerja</th>
                            <th scope="col">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    function get_month_diff($start, $end = FALSE){
                        $end OR $end = time();

                        $start = new DateTime("$start");
                        $end   = new DateTime("$end");
                        $diff  = $start->diff($end);

                        return $diff->format('%y') * 12 + $diff->format('%m');
                    }

                    foreach($getKaryawan as $ck) {
                        $months = get_month_diff($ck['tgl_awal_bekerja'],date('d-m-Y'));
                        $id = $ck['id_karyawan'];
                        $nama = $ck['nama_karyawan'];
                        echo '<tr>
                            <th>'.$no++.'</th>
                            <td>'.$ck['nama_karyawan'].'</td>
                            <td>'.$ck['jenis_kelamin'].'</td>
                            <td>'.$ck['nama_pekerjaan'].'</td>
                            <td id="mk">'.$months.' Bulan</th>
                            <td id="pilihKaryawan'.$id.'">
                                <button class="btn btn-primary btn-sm text-light" data-dismiss="modal" 
                                onclick="getDataFromModal(`'.$id.'`,`'.$nama.'`,`'.$months.'`)">
                                    Pilih <i class="fas fa fa-square"></i>
                                </button>
                            </td>
                        </tr>
                        ';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>