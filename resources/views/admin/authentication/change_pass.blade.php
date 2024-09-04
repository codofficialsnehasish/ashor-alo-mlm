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
                                    <h6 class="page-title">Change Password</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <!-- <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Profile</a></li> -->
                                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Change Password</div>
                                            <div class="card-body">
                                                @if(Session::has("msg"))
                                                <div class="alert alert-danger alert-dismissible fade show mb-3 mt-3">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    <strong>Oh snap!</strong> {{Session::get("msg")}}
                                                </div>
                                                @endif
                                                <form class="custom-validation" action="{{url('/changep')}}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label" for="cp">Current Password</label>
                                                        <input type="text" class="form-control" name="cp" id="cp" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="np">New Password</label>
                                                        <input type="text" class="form-control" name="np" id="np" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="conpass">Confirm Password</label>
                                                        <input type="text" class="form-control" name="conpass" id="conpass" required>
                                                    </div>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Change</button>
                                                            <!-- <button type="reset" class="btn btn-secondary waves-effect">Cancel</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- end register -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("admin/dash/footer")