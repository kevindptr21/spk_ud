<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/jquery.mCustomScrollbar.min.css">
    <title>Halaman Utama</title>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <? $this->load->view('sidemenu/v_sidemenu')?>
        </nav>
        
        <div id="content">
            <div class="topbar container">
                <? $this->load->view('topbar/v_topbar') ?>    
            </div>

            <div class="main container">
                <?php
                if (isset($_GET['pages'])) {
                    $pages = $_GET['pages'];
                    switch ($pages) {
                        case 'home':
                            echo "Hello";
                        break;
                        case 'm_karyawan':
                            echo "Manajemen Karyawan";
                        break;
                        case 'm_pekerjaan':
                            echo "Manajemen Pekerjaan";
                        break;
                        case 'm_kriteria':
                            echo "Manajemen Kriteria";
                        break;
                        case 'penilaian':
                            echo "Penilaian Karyawan";
                        break;
                        default:
                            echo "Home";
                        break;
                    }
                } else {
                    echo "You Are Not Allowed To Access This!!!";
                }
                ?>
            </div>
        </div>
    </div>
    
    <script src="<?php base_url() ?>assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script lang="javascript">
        $(document).ready(function() {

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function() {
                // open or close navbar
                $('#sidebar').toggleClass('active');
                // close dropdowns
                $('.collapse.in').toggleClass('in');
                // and also adjust aria-expanded attributes we use for the open/closed arrows
                // in our CSS
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

        });
    </script>
</body>

</html>