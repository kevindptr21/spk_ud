<div class="modal fade" id="cariKaryawan" tabindex="-1" role="dialog" aria-labelledby="cariKaryawan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Daftar Karyawan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-condensed" id="searchKaryawan" style="font-size: 14px;">
                    <thead class="thead-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Masa Kerja</th>
                            <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach($getKaryawan as $ck) {
                        $d1 = new DateTime($ck['tgl_awal_bekerja']);
                        $d2 = new DateTime(date("20-12-2019"));
                        $diff = $d1->diff($d2);
                        $months = $diff->format('%y') * 12 + $diff->format('%m');
                        $id = $ck['id_karyawan'];
                        $nama = $ck['nama_karyawan'];
                        echo '<tr>
                            <th>'.$no++.'</th>
                            <td>'.$ck['nama_karyawan'].'</td>
                            <td>'.$ck['jenis_kelamin'].'</td>
                            <td>'.$ck['nama_pekerjaan'].'</td>
                            <td id="mk">'.$months.' Bulan</th>
                            <td>
                                <button class="btn btn-primary text-light" data-dismiss="modal" 
                                onclick="getDataFromModal(`'.$id.'`,`'.$nama.'`,`'.$months.'`)">
                                    Pilih
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