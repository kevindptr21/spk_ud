            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/svg-with-js/js/fontawesome-all.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
            $('#searchKaryawan').DataTable();
        });
        // var errMsg = '<small class="text-danger">Hanya Huruf Alphabet. (a-z)</small>';
        // for(var i=1; i<length;i++){
        //     var inputN = document.getElementById(`${i}`);
        //     inputN.oninvalid = function(){
        //         document.getElementById("errMsg").innerHTML = errMsg;
        //     }
            
        // }

        // var inputN = document.getElementById('namaKr1');
        
        // inputN.oninvalid = function(e){
        //     console.log(e.target.value);
        // }
    </script>

    <?php if(!empty($this->session->flashdata('success'))) { ?>
        <script lang="javascript">
            $(document).ready(function () {
                swal("Success!", "<?php echo $this->session->flashdata('success')?>","success");
            })
        </script>
        
    <?php } else if(!empty($this->session->flashdata('errMsg'))){ ?>
        <script lang="javascript">
            $(document).ready(function () {
                swal("Kesalahan!", "<?php echo $this->session->flashdata('errMsg')?>","error");
            });
        </script>

    <?php } else if(!empty($this->session->flashdata('errAddKriteria'))){ ?>
        <script lang="javascript">
            $(document).ready(function () {
                swal("Kesalahan!", "<?php echo $this->session->flashdata('errAddKriteria')?>","error");
                $("#openAddKriteria").trigger('click');
            });
        </script>

    <?php } else if(!empty($this->session->flashdata('errEditKriteria'))){ ?>
        <script lang="javascript">
            $(document).ready(function () {
                swal("Kesalahan!", "<?php echo $this->session->flashdata('errEditKriteria')?>","error");
                $("#openEditKriteria").trigger('click');
            });
        </script>
    <?php } ?>

</body>

</html>