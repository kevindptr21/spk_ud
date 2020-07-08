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
                    <? 
                    $no = 1;
                    foreach($karyawan as $k) {
                        $d1 = new DateTime($k['tgl_awal_bekerja']);
                        $d2 = new DateTime(date("d-m-Y"));
                        $diff = $d1->diff($d2);
                        $months = $diff->format('%y') * 12 + $diff->format('%m');
                        echo '<tr>
                            <th>'.$no++.'</th>
                            <td>'.$k['nama_karyawan'].'</td>
                            <td>'.$k['jenis_kelamin'].'</td>
                            <td>'.$k['nama_pekerjaan'].'</td>
                            <td id="mk">'.$months.' Bulan</th>
                            <td>
                                <a>Yuk Dipilih Yuk</a>
                            </td>
                        </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>