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
    
    <script lang="javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
            $('#karyawan').DataTable();
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
        $("#ajax").on('click', function(e){
            e.preventDefault();
            $("#cari").hide();
            $("#sbmt").html("Simpan <i class='fas fa fa-save'></i>")
            .removeClass('btn btn-primary mr-5 btn-md align-self-center')
            .addClass('btn btn-success mr-5 btn-md align-self-center');
            $("#frm").attr('action','<?php base_url()?>penilaian/changePenilaian');
            
            $.ajax({
                url: "<?php base_url()?>penilaian/editAjax/"+$(this).attr('data-value'),
                type: "GET",
                cache: false,
                dataType: "json",
            })
            .done(function(res) {
                console.log(res);
                // var lgth = <?= count($kriteria); ?>;
                // $("#nama").val(res[0].nama_karyawan);
                // for(var i=1; i<=lgth; i++){
                //     $(`#s${i} option[value=${res[0].C,i}]`).attr('selected', 'selected');
                //     $('#nk').val(res[0].C7);
                //     $('#nk2').val(res[0].C2);
                // }    
            });

            $("#btl").on('click',function(){
                window.location.replace('<?php base_url();?>penilaian');
            });
        });
    </script>
    <?php } ?>

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

    const showLoading = function() {
    swal({
        icon: '<?php base_url()?>assets/images/Loading-.gif',
        button:false,
        closeOnEsc:false,
        closeOnClickOutside: false,
        timer: 2000,
        onOpen: () => {
            swal.showLoading();
        }
    })
    };

    document.getElementById("conf")
    .addEventListener('click', (event) => {
        showLoading();
        $("#addKriteria").hide();
    });
    </script>
</body>

</html>