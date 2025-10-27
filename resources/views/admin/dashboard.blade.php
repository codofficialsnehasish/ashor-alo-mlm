<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin/dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Dashboard</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Welcome to {{ app_name() }} Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('customer.show') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/14.1.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Total Member</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $customer_count }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('customer.show') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/25.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Active Member</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $active_count }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/24.png') }}" alt="">
                                                </div>
                                                <h6 class="font-size-16 text-uppercase text-white-50">Today Business</h6>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $todays_business }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/26.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Total Business</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $total_business }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/27.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Total Payment</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $total_payment }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/28.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Last Week Payment</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $last_week_payment }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/29.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Hold Amount</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $hold_amount }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/31.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">TDS</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $tds }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/31.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Repurchase Wallet</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $repurchase_wallet }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0);">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/32.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Service Charge</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $service_charge }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('kyc.pendings') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/23.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Pending KYC</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $pending_kyc }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('admin.contact-us') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/23.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Customer Contacts</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $contac_us }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="javascript:void(0)">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/31.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50"><!--Current Week Business--> Current Fortnight Business</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;" id="current-week-business">{{ $current_week_business }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- End Page-content -->

                @section('script')
                <script>
                    $.ajax({
                        url: "{{ route('dashboard.admin-get-current-week-business') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#current-week-business').text('Calculating...');
                        },
                        success: function(response) {
                            $('#current-week-business').text('₹ '+response);
                        }
                    });
                </script>
                @endsection
                
                @include("admin/dash/footer")