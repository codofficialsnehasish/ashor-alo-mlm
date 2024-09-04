@include("site/partials/head") 
<body>
    <!--header section start-->
    @include("site/partials/header") 
    <!--header section end-->

    <div class="main">

        <!--sign up section start-->
        <section class="section section-lg section-header position-relative min-vh-100 flex-column d-flex justify-content-center" style="background: url('{{ asset('site_assets/img/slider-bg-1.svg') }}')no-repeat center bottom / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-content-left text-white">
                            <h1 class="display-2">Create Your Account</h1>
                            <p class="lead">
                                Keep your face always toward the sunshine - and shadows will fall behind you.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h3>Create Account</h3>
                                    <p class="text-muted">Sign in to your account to continue.</p>
                                </div>
                                <!--sign up form-->
                                <form class="login-signup-form" id="signupform" method="post">
                                    @csrf
                                    <div class="show-error" id="error"></div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="agentid">Sponsor Id</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-user"></i></div>
                                            <input type="text" class="form-control" id="agentid" name="agentid" value="" placeholder="Enter Sponsor Id">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="sponsor_name">Sponsor Name</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-user"></i></div>
                                            <input type="text" class="form-control" placeholder="Sponsor Name" name="sponsor_name" id="sponsor_name" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="membername">Your Name</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-user"></i></div>
                                            <input type="text" name="membername" id="membername" class="form-control" placeholder="Enter your name" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="membername">Position</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-user"></i></div>
                                            <!-- <input type="text" name="membername" id="membername" class="form-control" placeholder="Enter your name" required=""> -->
                                            <select name="position" id="" class="form-control">
                                                <option value="left">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="email">Email Address</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-email"></i></div>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="name@address.com">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="mobile">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-user"></i></div>
                                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Enter your phone number" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-lock"></i></div>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="password_confirmation">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon"><i class="ti-lock"></i></div>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-Enter your password" required="">
                                        </div>
                                    </div>

                                    <div class="my-4">
                                        <div class="form-check square-check">
                                            <input class="form-check-input" type="checkbox" value="" id="check-terms" required>
                                            <label class="form-check-label" for="check-terms">
                                                I agree to the <a href="{{ route('site-terms-and-conditions') }}" target="_blank"><b>Terms and Conditions</b></a>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button class="btn btn-block btn-secondary border-radius mt-4 mb-3" type="submit">
                                        Sign up
                                    </button>
                                </form>
                            </div>
                            <div class="card-footer bg-soft text-center border-top px-md-5"><small>Already registered?</small>
                                <a href="{{ url('/login') }}" class="small"> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--sign up section end-->

    </div>
    <script>
        $(document).on("submit", "#signupform", function (event) {
            var form = $("#signupform");
            var serializedData = form.serializeArray();
            $.ajax({
                url: "{{ url('/process-signup') }}",
                type: "post",
                data: serializedData,
                dataType: "json",
                success: function (response) { 
                    $.each(response , function(index, item) { 
                        var html='';
                        if(index == 'msg'){
                            form[0].reset();
                            showToast('success', 'Success', item);
                            window.location.href = "{{ url('/member-dashboard') }}";
                        }else{
                            showToast('error', 'Warning!', item);
                        }
                    });  
                }
            });
            event.preventDefault();
        });

        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const sponsorID = urlParams.get('sponsorid');
            $.ajax({
                url: "{{ url('/get-sponsor-name') }}/"+sponsorID,
                type: "GET",
                data: {},
                dataType: "json",
                success: function (response) {
                    $("#sponsor_name").val("");
                    $("#sponsor_name").val(response);
                }
            });
            const agentIdInput = document.querySelector('input[name="agentid"]');
            if (agentIdInput) {
                agentIdInput.value = sponsorID || '';
            }
        });

        $(document).on("keyup", "#agentid", function (event) {
            $("#sponsor_name").val("");
            var sponcor_id = $("#agentid").val();
            $.ajax({
                url: "{{ url('/get-sponsor-name') }}/"+sponcor_id,
                type: "GET",
                data: {},
                dataType: "json",
                success: function (response) { 
                    $("#sponsor_name").val(response);
                }
            });
        });
    </script>
    @include('site/partials/footer')