@include("site/partials/login-header")
    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form action="{{ url('/login-process') }}" class="sign-in-form" method="POST">
                        @csrf
                        <h2 class="title">Sign in</h2>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert mb-3" style="display: block;" id="warning_option">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span> 
                                <strong>Warning!</strong> {{ $error }}.
                            </div>
                            @endforeach
                        @endif
                        <div class="input-field">
                            <i class="fas fa-user" aria-hidden="true"></i>
                            <input type="text" placeholder="Phone Number" name="phone" id="username">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                            <input type="password" placeholder="Password" name="password" id="login_password">
                        </div>
                        <!-- <div class="">
                            <a href="" id="myBtn" onclick="forgot_password();" style="text-decoration: none;">Forgot Password</a>
                        </div> -->
                        <div class="rows">
                            <input type="submit" value="Login" class="btn solid" name="login" id="login">
                        </div>
                    </form>
                    <form id="signupform" method="POST" class="sign-up-form">
                        @csrf   
                        <h2 class="title">Sign up</h2>
                        <div class="show-error" id="error"></div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert mb-3" style="display: block;" id="warning_option">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span> 
                                <strong>Warning!</strong> {{ $error }}.
                            </div>
                            @endforeach
                        @endif
                        <div class="row">
                        <div class="input-field form-group">
                                <i class="fas fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Sponsor Id" name="agentid" id="agentid">
                            </div>

                            <div class="input-field form-group">
                                <i class="fas fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Sponsor Name" name="" id="agent_name" value="" readonly>
                            </div>
                    
                            <div class="input-field form-group">
                                <i class="fas fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Full Name" name="membername" id="membername" required="">
                            </div>

                            <div class="input-field form-group">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                <input type="email" placeholder="Email" name="email" id="email">
                            </div>

                            <div class="input-field form-group">
                                <i class="fas fa-phone" aria-hidden="true"></i>
                                <input type="number" placeholder="Phone No" name="mobile" id="mobile" value="" required="">
                            </div>

                            <div class="input-field form-group">
                                <i class="fas fa-lock" aria-hidden="true"></i>
                                <input type="password" placeholder="Password" name="password" id="password" required="">
                            </div>

                            <div class="input-field form-group">
                                <i class="fas fa-lock" aria-hidden="true"></i>
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" required="">
                            </div>

                            <center><button class="btn" type="submit" name="update_user" id="update_user">Sign up</button></center>
                        </div>
                    </form>
                </div>
            </div>
            <br><br><br>
            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <div class="logo_warp">
                        <img src="{{ asset('/site_data_images') }}/{{ get_logo() }}" class="image" alt="">
                        </div>

                        <h3>New here ?</h3>
                        <p>
                            Let's Join the Future of Financial Transactions.
                            Be a part of {{ app_name() }}.
                        </p>
                        <button class="btn transparent" id="sign-up-btn">
                        Sign up
                        </button>
                    </div>
                    <img src="{{ asset('site_assets/img/logg.png') }}" class="image" alt="">
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <div class="logo_warp">
                            <img src="{{ asset('/site_data_images') }}/{{ get_logo() }}" class="image" alt="">
                        </div>
                        <h3>One of us ?</h3>
                        <p>    
                            Welcome Back to {{ app_name() }}. Let's grow TOGETHER. 
                        </p>
                        <button class="btn transparent" id="sign-in-btn">
                        Sign in
                        </button>
                    </div>
                    <img src="{{ asset('site_assets/img/registerr.png') }}" class="image" alt="">
                </div>
            </div>
        </div>
        <script src="{{ asset('site_assets/js/app.js') }}"></script>
        <script>
            $(document).on("submit", "#signupform", function (event) {
                $("#error").html("");
                var form = $("#signupform");
                var serializedData = form.serializeArray();
                $.ajax({
                    url: "/process-signup",
                    type: "post",
                    data: serializedData,
                    dataType: "json",
                    success: function (response) { 
                        $.each(response , function(index, item) { 
                            console.log(index +':'+item);
                            var html='';
                            if(index == 'msg'){
                                form[0].reset();      
                                html += '<div class="alert-success mb-3" id="warning_option">';
                                html += '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">×</span>' 
                                html += '<strong>Success! </strong>'+ item +".";
                                html += '</div>';
                            }else{
                                html += '<div class="alert mb-3" id="warning_option">';
                                html += '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">×</span>' 
                                html += '<strong>Warning! </strong>'+ item +".";
                                html += '</div>';
                            }
                            $("#error").append(html);
                        });  
                    }
                });
                event.preventDefault();
            });

            $(document).ready(function() {
                $(".container").addClass("sign-up-mode");

                const urlParams = new URLSearchParams(window.location.search);
                const agentId = urlParams.get('agentid');

                $.ajax({
                    url: "/get-sponsor-name/"+agentId,
                    type: "GET",
                    data: {},
                    dataType: "json",
                    success: function (response) { 
                        // alert(response);
                        $("#agent_name").val("");
                        $("#agent_name").val(response);
                    }
                });
                
                // Set the value of the input field with name 'agentid'
                const agentIdInput = document.querySelector('input[name="agentid"]');
                if (agentIdInput) {
                    agentIdInput.value = agentId || ''; // Set the value, or empty string if agentId is null
                }
            });

            $(document).on("keyup", "#agentid", function (event) {
                $("#agent_name").val("");
                var sponcor_id = $("#agentid").val();
                // alert(sponcor_id);
                $.ajax({
                    url: "/get-sponsor-name/"+sponcor_id,
                    type: "GET",
                    data: {},
                    dataType: "json",
                    success: function (response) { 
                        // alert(response);
                        $("#agent_name").val(response);
                    }
                });
            });
        </script>
    </body>
</html>