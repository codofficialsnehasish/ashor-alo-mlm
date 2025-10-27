<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Maintenance | {{ app_name() }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{description()}}" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ get_icon() }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dashboard_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dashboard_assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>

        <section class="my-5">
            <div class="container-alt container">
                <div class="row justify-content-center">
                    <div class="col-10 text-center">
                        <div class="home-wrapper mt-5">
                            <div class="mb-4">
                                <img src="{{ asset('site_assets/img/logo-color.png') }}" alt="logo" height="70px" />
                            </div>

                            <div class="maintenance-img">
                                <img src="{{ asset('dashboard_assets/images/maintenance.png') }}" alt="" class="img-fluid mx-auto d-block">
                            </div>
                            <h3 class="mt-4">Site is Under Maintenance</h3>
                            <p>Please check back in sometime.</p>

                            <div class="row">
                                <div class="text-center col-md-4">
                                    <div class="card mt-4 maintenance-box">
                                        <div class="card-body">
                                            <i class="mdi mdi-airplane-takeoff h2"></i>
                                            <h6 class="text-uppercase mt-3">Why is the Site Down?</h6>
                                            <p class="text-muted mt-3">The site is currently undergoing scheduled maintenance. This downtime allows us to implement important updates, improve system performance, and enhance the overall user experience. Rest assured, our team is working diligently to complete the maintenance as quickly as possible.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center col-md-4">
                                    <div class="card mt-4 maintenance-box">
                                        <div class="card-body">
                                            <i class="mdi mdi-clock-alert h2"></i>
                                            <h6 class="text-uppercase mt-3">
                                                What is the Downtime?</h6>
                                            <p class="text-muted mt-3">We expect the maintenance to last for approximately 30 Minutes. During this time, the website will be temporarily unavailable. We apologize for any inconvenience this may cause and appreciate your patience.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center col-md-4">
                                    <div class="card mt-4 maintenance-box">
                                        <div class="card-body">
                                            <i class="mdi mdi-email h2"></i>
                                            <h6 class="text-uppercase mt-3">Do you need Support?</h6>
                                            <p class="text-muted mt-3">If you have any urgent concerns or need support during this time, please feel free to reach out to our support team at:
                                                <a href="mailto:ashoralo12@gmail.com" class="text-decoration-underline">ashoralo12@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        

        <!-- JAVASCRIPT -->
        <script src="{{ asset('dashboard_assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/node-waves/waves.min.js') }}"></script>


        <script src="{{ asset('dashboard_assets/js/app.js') }}"></script>

    </body>
</html>
