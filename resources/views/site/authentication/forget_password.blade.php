@include("site/partials/head") 
<body>

 
    <!--header section start-->
    @include("site/partials/header") 
    <!--header section end-->

    <div class="main">

        <!--login section start-->
        <section class="section section-lg section-header position-relative min-vh-100 flex-column d-flex justify-content-center" style="background: url('{{ asset('site_assets/img/slider-bg-1.svg') }}')no-repeat center bottom / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-content-left text-white">
                            <h1 class="display-2">Forget Password !</h1>
                            <p class="lead">
                                Keep your face always toward the sunshine - and shadows will fall behind you.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-3">
                                    <h3>Hi, {{ $user_name }}</h3>
                                    <p class="text-muted">Forget Your Password.</p>
                                </div>

                                <!--login form-->
                                <form class="login-signup-form" action="{{ url('/forget-password-process') }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="font-weight-bold">Password</label>
                                            </div>
                                            <!-- <div class="col-auto">
                                                <a href="{{ url('/password-reset') }}" class="form-text small text-muted">
                                                    Forgot password?
                                                </a>
                                            </div> -->
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <i class="ti-lock"></i>
                                            </div>
                                            <input type="password" class="form-control" name="password" placeholder="Enter your password">
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button class="btn btn-block btn-secondary mt-4 mb-3">Forget Password</button>

                                </form>
                            </div>
                            <!-- <div class="card-footer bg-soft text-center border-top px-md-5"><small>Not registered?</small>
                                <a href="{{ url('/sign-up') }}" class="small"> Create account</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--login section end-->


    </div>

    @include('site/partials/footer')