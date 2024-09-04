@include("admin/dash_cut/login_header")

<body class="account-pages">
    <!-- Begin page -->
    <div class="accountbg" style="background: url('{{ asset('dashboard_assets/images/login-wallpaper.jpg') }}');background-size: cover;background-position: center;"></div>
        <div class="wrapper-page account-page-full">
            <div class="card shadow-none">
                <div class="card-block">
                    <div class="account-box">
                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="/">
                                        <img src="{{get_logo()}}" height="120" alt="logo">
                                    </a>
                                </div>
                                <h4 class="font-size-18 mt-3 text-center">Welcome Back !</h4>
                                <p class="text-muted text-center">Sign in to continue to {{ app_name() }}.</p>
                                @if(Session::has("msg"))
                                    <div class="alert alert-danger alert-dismissible fade show mb-0 mt-3" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <strong>Oh snap!</strong> {{Session::get("msg")}}.
                                    </div>
                                @endif
                                <form class="mt-4" action="{{url('/checkuser')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" name="pass" class="form-control" id="userpassword" placeholder="Enter password">
                                    </div>

                                    <div class="mb-3 row">
                                        <!-- <div class="col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customControlInline">
                                                <label class="form-check-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-12 text-center">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" style="background: transparent linear-gradient(103deg, #E64C11 0%, #F7962D 100%) 0% 0% no-repeat padding-box;border:none !important;">
                                                Log In
                                            </button>
                                        </div>
                                    </div>

                                    <!-- <div class="mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    </div> -->

                                </form>

                                <div class="mt-2 text-center">
                                    <!-- <p>Don't have an account ? <a href="pages-register-2.html" class="fw-medium text-primary"> Signup now </a> </p> -->
                                    <p>{{ copyright() }}.<br> Crafted with <i class="mdi mdi-heart text-danger"></i> by Code of Dolphins</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include("admin/dash_cut/login_footer")