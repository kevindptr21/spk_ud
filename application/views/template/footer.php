            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/svg-with-js/js/fontawesome-all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/loader.js"></script>
    <script src="<?php base_url() ?>assets/js/dataAjax.js"></script>
    <script src="<?php base_url() ?>assets/js/jquery-validate.min.js"></script>

    <?php if($_SERVER["REQUEST_URI"] === "/karyawan"){ ?>
    <script lang="javascript">
        $(document).ready(function() {
            $('#karyawan').DataTable({
                scrollY: 340,
                info: false,
            });
            $("#krywn").validate({
                submitHandler: function(form){
                  form.submit();
                  showLoading();
                },
                rules: {
                    nama : {
                        required: true,
                    },
                    alamat : {
                        required: true,
                    },
                    tgl : {
                        required: true,
                    }
                },
                messages : {
                    nama : {
                        required: "Tidak Boleh Kosong!",
                    },
                    alamat : {
                        required: "Tidak Boleh Kosong!",
                    },
                    tgl : {
                        required: "",
                    }
                },
            });
            $("#edtKrywn").validate({
                submitHandler: function(form){
                  form.submit();
                  showLoading();
                },
                rules: {
                    nama : {
                        required: true,
                    },
                    alamat : {
                        required: true,
                    },
                    tgl : {
                        required: true,
                    }
                },
                messages : {
                    nama : {
                        required: "Tidak Boleh Kosong!",
                    },
                    alamat : {
                        required: "Tidak Boleh Kosong!",
                    },
                    tgl : {
                        required: "",
                    }
                },
            });
        });
    </script>
    <?php } else if ($_SERVER["REQUEST_URI"] === "/penilaian"){ ?>
    <script lang="javascript">
        $('#searchKaryawan').DataTable();
        var tgl = $("#tgl").val();
        getAjaxPenilaian(tgl);
        $("#tgl").bind('change',function(e){
            e.preventDefault();
            getAjaxPenilaian($(this).val());
        });
        
        $("#ST").bind('change', function(e) {
            if($("#ST").val() == "Pilih"){
                $("#printToPdf").attr('disabled',true);
                document.getElementById('spkST').innerHTML = "<h5>Silahkan Pilih Tanggal Penilaian</h5>";
            }else{
                $("#printToPdf").removeAttr('disabled');
                showLoading();
                getAjaxST($(this).val());
            }
        });

        function printToPdf(){
            window.location.href = "<?php base_url()?>penilaian/printToPdf/"+$("#ST").val();
        }

        function getDataFromModal(a,b,c){
            document.getElementById('id').value = a;
            document.getElementById('nama').value = b;
            document.getElementById('nk').value = c;
        }
    </script>
    <?php } ?>

    <!-- Alert -->
    <script lang="javascript">    
    <?php if(!empty($this->session->flashdata('success'))) { ?>
        swal("Success!", "<?php echo $this->session->flashdata('success');?>","success");
        
    <?php } else if(!empty($this->session->flashdata('errMsg'))){ ?>
        swal("Kesalahan!", "<?php echo $this->session->flashdata('errMsg');?>","error");

    <?php } else if(!empty($this->session->flashdata('errAddKriteria'))){ ?>
        swal("Kesalahan!", "<?php echo $this->session->flashdata('errAddKriteria');?>","error");
        $("#openAddKriteria").trigger('click');

    <?php } else if(!empty($this->session->flashdata('errEditKriteria'))){ ?>
        swal("Kesalahan!", "<?php echo $this->session->flashdata('errEditKriteria');?>","error");
        $("#openEditKriteria").trigger('click');

    <?php } else { } ?>
    </script>

    <!-- Loading -->
    <script lang="javascript">
        document.getElementById("conf")
        .addEventListener('click', (event) => {
            showLoading();
            $("#addKriteria").hide();
        });

    </script>
</body>

</html>