@include('site.user_dashboard.partials.head')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('site.user_dashboard.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('site.user_dashboard.partials.top_bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
                    </div>

                    <!-- <form action="{{ route('member.process-update-profile') }}" method="post" enctype="multipart/form-data">-->
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{!empty($user->user_image) ? asset($user->user_image) : asset('dashboard_assets/images/users/user-13.jpg')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 220px;height: 220px;object-fit: contain;">
                                        </div>
                                        <form action="{{ route('member.process-update-profile') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <div class="custom-file" style="margin-top: 20px;">
                                            <input type="file" class="custom-file-input" id="customFile" name="user_image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home2" role="tab">
                                                    <span class="d-none d-md-block">Edit Profile</span><span class="d-block d-md-none"><i class="fas fa-user-edit"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile2" role="tab">
                                                    <span class="d-none d-md-block">Edit Nominee</span><span class="d-block d-md-none"><i class="fas fa-user-injured"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages2" role="tab">
                                                    <span class="d-none d-md-block">Bank Details</span><span class="d-block d-md-none"><i class="fas fa-school"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#settings2" role="tab">
                                                    <span class="d-none d-md-block">Login Password</span><span class="d-block d-md-none"><i class="fas fa-eye-slash"></i></span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active p-3" id="home2" role="tabpanel">
                                                <form id="update-profile-details" method="post">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Name</label>
                                                            <input type="text" class="form-control" value="{{ $user->name }}" name="name" required {{ is_disabled($user->name) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Father / Husband Name</label>
                                                            <input type="text" class="form-control" value="{{ $user->father_or_husband_name }}" name="father_or_husband_name" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Date Of Birth (Ex DD/MM/YYYY)</label>
                                                            <input type="date" class="form-control" value="{{ $user->date_of_birth }}" name="date_of_birth">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="gender">Gender</label>
                                                            <select class="form-control" id="gender" name="gender" required>
                                                                <option value selected disabled>Choose...</option>
                                                                <option @if($user->gender == 'Male') selected @endif value="Male">Male</option>
                                                                <option @if($user->gender == 'Female') selected @endif value="Female">Female</option>
                                                                <option @if($user->gender == 'Others') selected @endif value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="marital-status">Marital Status</label>
                                                            <select class="form-control" id="marital-status" name="marital_status">
                                                                <option value selected disabled>Choose...</option>
                                                                <option @if($user->marital_status == 'Married') selected @endif value="Married">Married</option>
                                                                <option @if($user->marital_status == 'Unmarried') selected @endif value="Unmarried">Unmarried</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Mobile</label>
                                                            <input type="number" class="form-control" value="{{ $user->phone }}" name="phone" required {{ is_disabled($user->phone) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Email</label>
                                                            <input type="email" class="form-control" value="{{ $user->email }}" name="email" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Qualification</label>
                                                            <input type="text" class="form-control" value="{{ $user->qualification }}" name="qualification">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Occupation/Job</label>
                                                            <input type="text" class="form-control" value="{{ $user->occupation }}" name="occupation">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Pincode</label>
                                                            <input type="number" class="form-control" value="{{ $user->pin_code }}" name="pin_code" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Shipping Address</label>
                                                            <textarea class="form-control" name="shipping_address" rows="2">{{ $user->shipping_address }}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Address</label>
                                                            <textarea class="form-control" rows="2" name="address">{{ $user->address }}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Country</label>
                                                            <select class="form-control" id="country_id" name="country">
                                                                <option value selected disabled>Choose...</option>
                                                                @foreach($countries as $countrie)
                                                                <option value="{{ $countrie->id }}" @if($user->country == $countrie->id) selected @endif>{{ $countrie->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">State</label>
                                                            <select class="form-control" id="states_id" name="state">
                                                                @if(!empty($user->state))
                                                                    @foreach($states as $state)
                                                                    <option value="{{ $state->id }}" @if($user->state == $state->id) selected @endif>{{ $state->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">City</label>
                                                            <select class="form-control" id="citys_id" name="city">
                                                                @if(!empty($user->city))
                                                                    @foreach($cities as $citie)
                                                                    <option value="{{ $citie->id }}" @if($user->city == $citie->id) selected @endif>{{ $citie->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane p-3" id="profile2" role="tabpanel">
                                                <form id="update-nominee-details" method="post">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Nominee Name</label>
                                                            <input type="text" class="form-control" id="usr" value="{{ $user->nominee_name }}" name="nominee_name" required {{ is_disabled($user->nominee_name) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Relation</label>
                                                            <select class="form-control" name="nominee_relation" required {{ is_disabled($user->nominee_relation) }}>
                                                                <option value selected disabled>Choose...</option>
                                                                <option @if($user->nominee_relation == 'Brother') selected @endif value="Brother">Brother</option>
                                                                <option @if($user->nominee_relation == 'Brother In Law') selected @endif value="Brother In Law">Brother In Law</option>
                                                                <option @if($user->nominee_relation == 'Cousin') selected @endif value="Cousin">Cousin</option>
                                                                <option @if($user->nominee_relation == 'Daughter') selected @endif value="Daughter">Daughter</option>
                                                                <option @if($user->nominee_relation == 'Father') selected @endif value="Father">Father</option>
                                                                <option @if($user->nominee_relation == 'Granddaughter') selected @endif value="Granddaughter">Granddaughter</option>
                                                                <option @if($user->nominee_relation == 'Grandson') selected @endif value="Grandson">Grandson</option>
                                                                <option @if($user->nominee_relation == 'Husband') selected @endif value="Husband">Husband</option>
                                                                <option @if($user->nominee_relation == 'Mother') selected @endif value="Mother">Mother</option>
                                                                <option @if($user->nominee_relation == 'Nephew') selected @endif value="Nephew">Nephew</option>
                                                                <option @if($user->nominee_relation == 'Niece') selected @endif value="Niece">Niece</option>
                                                                <option @if($user->nominee_relation == 'Other') selected @endif value="Other">Other</option>
                                                                <option @if($user->nominee_relation == 'Parent In Law') selected @endif value="Parent In Law">Parent In Law</option>
                                                                <option @if($user->nominee_relation == 'Properitor') selected @endif value="Properitor">Properitor</option>
                                                                <option @if($user->nominee_relation == 'Sister') selected @endif value="Sister">Sister</option>
                                                                <option @if($user->nominee_relation == 'Sister In Law') selected @endif value="Sister In Law">Sister In Law</option>
                                                                <option @if($user->nominee_relation == 'Son') selected @endif value="Son">Son</option>
                                                                <option @if($user->nominee_relation == 'Wife') selected @endif value="Wife">Wife</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Date Of Birth (Ex DD/MM/YYYY)</label>
                                                            <input type="date" class="form-control" id="usr" value="{{ $user->nominee_dob }}" name="nominee_dob" required {{ is_disabled($user->nominee_dob) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Address</label>
                                                            <textarea class="form-control" rows="2" name="nominee_address" required {{ is_disabled($user->nominee_address) }}>{{ $user->nominee_address }}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">State</label>
                                                            <select class="form-control" name="nominee_state_id" id="nominee_states_id" required {{ is_disabled($user->nominee_state_id) }}>
                                                                <option value selected disabled>Choose...</option>
                                                                @foreach($nominee_states as $state)
                                                                <option value="{{ $state->id }}" @if($user->nominee_state_id == $state->id) selected @endif>{{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">City</label>
                                                            <select class="form-control" name="nominee_city_id" id="nominee_citys_id" required {{ is_disabled($user->nominee_city_id) }}>
                                                                @if(!empty($user->nominee_city_id))
                                                                    @foreach($nominee_cities as $cities)
                                                                    <option value="{{ $cities->id }}" @if($user->nominee_city_id == $cities->id) selected @endif>{{ $cities->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        <b class="text-danger">Note : Once You update details then You can not change . For Any Further change contact to company Email Id</b>
                                                    </p>
                                                    @if(empty($user->nominee_name))
                                                    <div class="d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="tab-pane p-3" id="messages2" role="tabpanel">
                                                <form id="update-bank-details" method="post">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Account Name (As Per Bank)</label>
                                                            <input type="text" class="form-control" value="{{ $user->account_name }}" name="account_name" required {{ is_disabled($user->account_name) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Bank Name</label>
                                                            <input type="text" class="form-control" value="{{ $user->bank_name }}" name="bank_name" required {{ is_disabled($user->bank_name) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Account Number</label>
                                                            <input type="number" class="form-control" value="{{ $user->account_number }}" name="account_number" required {{ is_disabled($user->account_number) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">Account Type</label>
                                                            <select class="form-control" name="account_type" required {{ is_disabled($user->account_type) }}>
                                                                <option value selected disabled>Choose...</option>
                                                                <option value="Current" @if($user->account_type == 'Current') selected @endif>Current</option>
                                                                <option value="Saving" @if($user->account_type == 'Saving') selected @endif>Saving</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">IFSC</label>
                                                            <input type="text" class="form-control" value="{{ $user->ifsc_code }}" name="ifsc_code" required {{ is_disabled($user->ifsc_code) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">PAN</label>
                                                            <input type="text" class="form-control" value="{{ $user->pan_number }}" name="pan_number" required {{ is_disabled($user->pan_number) }}>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">UPI Type</label>
                                                            <select class="form-control" name="upi_type" required {{ is_disabled($user->upi_type) }}>
                                                                <option value selected disabled>Choose...</option>
                                                                <option value="Phone Pay" @if($user->upi_type == 'Phone Pay') selected @endif>Phone Pay</option>
                                                                <option value="Google Pay" @if($user->upi_type == 'Google Pay') selected @endif>Google Pay</option>
                                                                <option value="Paytm" @if($user->upi_type == 'Paytm') selected @endif>Paytm</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="usr">UPI Phone Number</label>
                                                            <input type="number" class="form-control" value="{{ $user->upi_number }}" name="upi_number" required {{ is_disabled($user->upi_number) }}>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        <b class="text-danger">Note : Once You update Bank & PAN details then You can not change . For Any Further change contact to company Email Id</b>
                                                    </p>
                                                    @if(empty($user->account_number))
                                                    <div class="d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="tab-pane p-3" id="settings2" role="tabpanel">
                                                <form id="chnage-password" method="post">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <div class="form-group">
                                                        <label for="usr">Old Password:</label>
                                                        <input type="password" class="form-control" name="old_password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">New Password:</label>
                                                        <input type="password" class="form-control" name="new_password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd">Confirm Password:</label>
                                                        <input type="password" class="form-control" name="confirm_password" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @section('script')
            <script>
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
                $('.nav-link').on('click', function(event) {
                    event.preventDefault();

                    // Remove active class from all tab links and tab panes
                    $('.nav-link').removeClass('active');
                    $('.tab-pane').removeClass('active show');

                    // Add active class to the clicked tab link and corresponding tab pane
                    $(this).addClass('active');
                    $($(this).attr('href')).addClass('active show');
                });

                $("#country_id").on('change', function(){ 
                    $("#states_id").html('');
                    const countryid= $(this).val();
                    $.ajax({
                        url : "{{ route('get-state-list') }}",
                        data:{country_id : countryid, _token:"{{ csrf_token() }}"},
                        method:'post',
                        dataType:'json',
                        beforeSend: function(){
                            $('#states_id').addClass('eventbtn'); 
                        },
                        success:function(response) {
                            $("#states_id").append('<option value="">Select State</option>');
                            $.each(response , function(index, item) { 
                                $("#states_id").append('<option value="'+item.id+'">'+item.name+'</option>');
                            });
                            $('.spinner-border').hide();
                        }
                    });
                });

                $("#states_id").on('change', function(){ 
                    $("#citys_id").html('');
                    const stateid= $(this).val();
                    $.ajax({
                        url : "{{ route('get-city-list') }}",
                        data:{state_id : stateid, _token:"{{ csrf_token() }}" },
                        method:'post',
                        dataType:'json',
                        beforeSend: function(){
                            $('#citys_id').html('<option value="">Loading...</option>'); 
                            },
                        success:function(response) {
                            $("#citys_id").html('');
                            $("#citys_id").append('<option value="">Select City</option>');
                            $.each(response , function(index, item) {
                                $("#citys_id").append('<option value="'+item.id+'">'+item.name+'</option>');
                            });
                        }
                    });
                });

                $("#nominee_states_id").on('change', function(){ 
                    $("#nominee_citys_id").html('');
                    const stateid= $(this).val();
                    $.ajax({
                        url : "{{ route('get-city-list') }}",
                        data:{state_id : stateid, _token:"{{ csrf_token() }}" },
                        method:'post',
                        dataType:'json',
                        beforeSend: function(){
                            $('#nominee_citys_id').html('<option value="">Loading...</option>'); 
                            },
                        success:function(response) {
                            $("#nominee_citys_id").html('');
                            $("#nominee_citys_id").append('<option value="">Select City</option>');
                            $.each(response , function(index, item) {
                                $("#nominee_citys_id").append('<option value="'+item.id+'">'+item.name+'</option>');
                            });
                        }
                    });
                });


                $('#chnage-password').on('submit', function(event){
                    event.preventDefault();
                    var form = $("#chnage-password");
                    var serializedData = form.serializeArray();
                    $.ajax({
                        url: "{{ route('member.process-change-password') }}",
                        type: "POST",
                        data: serializedData,
                        success:function(response){
                            if(response.status == 1){
                                showToast('success', 'Success', response.massage);
                                $('#chnage-password')[0].reset();
                            }else{
                                showToast('error', 'Error', response.massage);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '';
                                $.each(errors, function(key, messages) {
                                    showToast('error', 'Error', messages);
                                });
                            } else {
                                showToast('error', 'Error', 'An unexpected error occurred.');
                            }
                        }
                    });
                });

                
                $('#update-bank-details').on('submit', function(event){
                    event.preventDefault();
                    var form = $("#update-bank-details");
                    var serializedData = form.serializeArray();
                    $.ajax({
                        url: "{{ route('member.update-bank-details') }}",
                        type: "POST",
                        data: serializedData,
                        success:function(response){
                            if(response.status == 1){
                                showToast('success', 'Success', response.massage);
                                // $('#update-bank-details')[0].reset();
                                form.find('input, select').prop('disabled', true);
                
                                // Hide the submit button
                                form.find('button[type="submit"]').hide();
                            }else{
                                showToast('error', 'Error', response.massage);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '';
                                $.each(errors, function(key, messages) {
                                    showToast('error', 'Error', messages);
                                });
                            } else {
                                showToast('error', 'Error', 'An unexpected error occurred.');
                            }
                        }
                    });
                });


                $('#update-nominee-details').on('submit', function(event){
                    event.preventDefault();
                    var form = $("#update-nominee-details");
                    var serializedData = form.serializeArray();
                    $.ajax({
                        url: "{{ route('member.update-nominee-details') }}",
                        type: "POST",
                        data: serializedData,
                        success:function(response){
                            if(response.status == 1){
                                showToast('success', 'Success', response.massage);
                                // $('#update-bank-details')[0].reset();
                                form.find('input, select, textarea').prop('disabled', true);
                
                                // Hide the submit button
                                form.find('button[type="submit"]').hide();
                            }else{
                                showToast('error', 'Error', response.massage);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '';
                                $.each(errors, function(key, messages) {
                                    showToast('error', 'Error', messages);
                                });
                            } else {
                                showToast('error', 'Error', 'An unexpected error occurred.');
                            }
                        }
                    });
                });


                $('#update-profile-details').on('submit', function(event){
                    event.preventDefault();
                    var form = $("#update-profile-details");
                    var serializedData = form.serializeArray();
                    $.ajax({
                        url: "{{ route('member.update-profile-details') }}",
                        type: "POST",
                        data: serializedData,
                        success:function(response){
                            if(response.status == 1){
                                showToast('success', 'Success', response.massage);
                                // $('#update-bank-details')[0].reset();
                                // form.find('input, select, textarea').prop('disabled', true);
                
                                // Hide the submit button
                                form.find('button[type="submit"]').hide();
                            }else{
                                showToast('error', 'Error', response.massage);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '';
                                $.each(errors, function(key, messages) {
                                    showToast('error', 'Error', messages);
                                });
                            } else {
                                showToast('error', 'Error', 'An unexpected error occurred.');
                            }
                        }
                    });
                });
            </script>
            @endsection
            
            @include('site.user_dashboard.partials.footer')