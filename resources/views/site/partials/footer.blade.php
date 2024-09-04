    
    <!--scroll bottom to top button start-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fas fa-hand-point-up"></span>
    </button>
    <!--scroll bottom to top button end-->

    <!-- toast message -->
    <script src="{{ asset('dashboard_assets/libs/toast/toastr.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/pages/toastr.init.js') }}"></script>
    <!-- toast message -->
    @include('admin.dash._massages')

    <!--build:js-->
    <script src="{{ asset('site_assets/js/vendors/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/popper.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/mixitup.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/headroom.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/wow.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/jquery.waypoints.min.js') }}"></script>
    <!--<script src="assets/js/vendors/countUp.min.js"></script>-->
    <script src="{{ asset('site_assets/js/vendors/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/vendors/validator.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/app.js') }}"></script>
    <!--endbuild-->

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard_assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard_assets/js/pages/sweet-alerts.init.js') }}"></script>
</body>

</html>