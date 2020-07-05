            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/svg-with-js/js/fontawesome-all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
                
        });
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
                $(this).attr('data-toggle','modal').attr('data-target','#addKriteria').modal('show');
                
            })
        </script>
    <?php } ?>
</body>

</html>