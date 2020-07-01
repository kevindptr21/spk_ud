            </div>
        </div>
    </div>
    
    <script src="<?php base_url() ?>assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="<?php base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php base_url() ?>assets/js/datatables.min.js"></script>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
        });
    </script>
</body>

</html>