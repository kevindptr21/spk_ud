<select name="tgl_penilaian" id="ST" class="form-control col-sm-2">
    <option selected>Pilih</option>
    <option value="<?= date('d-m-Y'); ?>"><?= date('d-m-Y'); ?></option?>
    <?php
    foreach($tgl as $dateST){
        echo '<option value="'.$dateST['tgl_penilaian'].'">'.$dateST['tgl_penilaian'].'</option>';
    }
    ?>
</select>