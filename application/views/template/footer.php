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
            $('.invalid-feedback').show();
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
        $(document).ready(function () {
            var tgl = $("#tgl").val();
            getAjax(tgl);
            $("#tgl").on('change',function(e){
                e.preventDefault();
                getAjax($(this).val());
            });
        });

        $("#ST").on('change', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php base_url()?>penilaian/SmartTopsis",
                type: "GET",
                cache: false,
                dataType: "json",
            }).done(function (data){
                console.log(data);
            })
        })

        function getAjax (id){
            $.ajax({
            url: "<?php base_url()?>penilaian/getDataAjax/"+id,
            type: "GET",
            cache: false,
            dataType: "json",
            }).done(function(data){
                var no=1;
                var dataTables = "";
                if(data.length != 0){
                    $.each(data, function(key, value){
                        dataTables += `
                        <tr>
                            <td>${no++}</td>
                            <td>${value['nama_karyawan']}</td>
                            <td>Ubah</td>
                        </tr>` ;
                    })
                }else {
                    dataTables +=`
                    <tr>
                        <td colspan=3 align="center">No data available in table</td>
                    </tr>` ;
                }
                document.getElementById('lstPenilaian').innerHTML = dataTables;

            });
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
    <?php if($_SERVER["REQUEST_URI"] === "/kriteria"){ ?>
    <script lang="javascript">
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
    <?php } ?>
</body>

</html>