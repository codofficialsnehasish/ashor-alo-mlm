            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright &copy; Your Website 2021</span> -->
                        {{ copyright() }}. Crafted with <i class="fas fa-heart text-danger"></i> by <a href="https://codeofdolphins.com/"><b>Code of Dolphins</b></a>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('site.user_dashboard.partials.logout_modal')
    <!-- End of Logout Modal-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('site_assets/user_dashboard_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('site_assets/user_dashboard_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('site_assets/user_dashboard_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('site_assets/user_dashboard_assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('site_assets/user_dashboard_assets/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- <script src="{{ asset('site_assets/user_dashboard_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('site_assets/user_dashboard_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> -->
    
    <!-- Page level custom scripts -->
    <script src="{{ asset('site_assets/user_dashboard_assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('site_assets/user_dashboard_assets/js/demo/chart-pie-demo.js') }}"></script>

    <!-- <script src="{{ asset('site_assets/user_dashboard_assets/js/demo/datatables-demo.js') }}"></script> -->
    
    

    <!-- Required datatable js -->
    <script src="{{ asset('dashboard_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('dashboard_assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('dashboard_assets/js/pages/datatables.init.js') }}"></script> 



    <!-- Click Lavel Show -->

    <!-- toast message -->
    <script src="{{ asset('dashboard_assets/libs/toast/toastr.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/pages/toastr.init.js') }}"></script>
    <!-- toast message -->
    @include('site.user_dashboard.partials._massages')
    @include('site.pagescript.e_commerce_script')

    <script>
        // $(function () {
        //     $('.genealogy-tree ul').hide();
        //     $('.genealogy-tree>ul').show();
        //     $('.genealogy-tree ul.active').show();
        //     $('.genealogy-tree li').on('click', function (e) {
        //         var children = $(this).find('> ul');
        //         if (children.is(":visible")) children.hide('fast').removeClass('active');
        //         else children.show('fast').addClass('active');
        //         e.stopPropagation();
        //     });
        // });

        $('#inputfile').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blash').attr('src', e.target.result).css('display', 'block');
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            $('[data-toggle="popover"]').popover({
                html: true,
                trigger: 'hover'
            });
        });
    </script>
    @yield('script')

    <!-- Click Lavel Show -->
</body>

</html>