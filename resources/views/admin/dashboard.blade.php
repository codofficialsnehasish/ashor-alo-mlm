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
                                                <h5 class="font-size-16 text-uppercase text-white-50">Total Agents</h5>
                                                <h5 class="fw-medium font-size-24" style="color:white;">
                                                    {{ $customer_count }}
                                                    <!-- <span class="badge rounded-pill bg-success"><?= $active_customer_count; ?></span>
                                                    <span class="badge rounded-pill bg-danger"><?= $inactive_customer_count; ?></span> -->
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('products') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/22.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Total Products</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $products_count }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('orders') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/09.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Today's Orders</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $todays_orders }}</h4>
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
                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- End Page-content -->

                
                @include("admin/dash/footer")