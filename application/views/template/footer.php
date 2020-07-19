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
    <script src="<?php base_url() ?>assets/js/formValidation.js"></script>
    
    <script lang="javascript">
        $(document).ready(function() {
            $('#karyawan').DataTable({
                scrollY: 340,
            });
            $('#searchKaryawan').DataTable();
        });
        
        function dateChange() {
            var tgl = document.getElementById("tglInput").value;
            var res = tgl.replace("/","-").replace("/","-");
            document.getElementById('tglInput').value = res;
        };
        
        function getDataFromModal(a,b,c){
            document.getElementById('id').value = a;
            document.getElementById('nama').value = b;
            document.getElementById('nk').value = c;
        }
    </script>

    <?php if($_SERVER["REQUEST_URI"] === "/penilaian"){ ?>
    <script lang="javascript">
        var tgl = $("#tgl").val();
        getAjaxPenilaian(tgl);
        $("#tgl").bind('change',function(e){
            e.preventDefault();
            getAjaxPenilaian($(this).val());
        });
        $("#ST").bind('change', function(e) {
            showLoading();
            getAjaxST($(this).val());
        });
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