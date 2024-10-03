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
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                        </div>
                        <div class="card-body">
                            <form class="custom-validation row" id="signupform">
                                @csrf
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="agentid">Sponsor Id</label>
                                    <input type="text" class="form-control" name="agentid" id="agentid" placeholder="Agent Id" onkeyup="get_sponcor_name()">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Sponsor Name</label>
                                    <input type="text" class="form-control" id="sponsor_name" readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="membername" id="name" placeholder="Enter name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="font-weight-bold form-label" for="postion">Position</label>
                                    <div class="input-group input-group-merge">
                                        <select name="position" id="postion" class="form-control form-select">
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0 col-md-6">
                                    <label class="form-label" for="input-email">Email address::</label>
                                    <input id="input-email" name="email" class="form-control input-mask" data-inputmask="'alias': 'email'">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone No.</label>
                                    <div>
                                        <input data-parsley-type="number" type="text" name="mobile" id="phone" class="form-control" required placeholder="Enter phone number">
                                    </div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label" for="pass">Password</label>
                                    <div>
                                        <input type="password" name="password" id="pass" class="form-control" required placeholder="Enter Password">
                                    </div>
                                </div> -->
                                <div class="mb-0 mt-3">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Member</button>
                                        <!-- <button type="reset" class="btn btn-secondary waves-effect">Cancel</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @section('script')
            <script>
                function get_sponcor_name(){
                    $("#sponsor_name").val("");
                    var sponcor_id = $("#agentid").val();
                    // alert(sponcor_id);
                    $.ajax({
                        url: "{{ url('/get-sponsor-name') }}/"+sponcor_id,
                        type: "GET",
                        data: {},
                        dataType: "json",
                        success: function (response) { 
                            // alert(response);
                            $("#sponsor_name").val(response);
                        }
                    });
                }
            </script>

            <script>
                $(document).on("submit", "#signupform", function (event) {
                    var form = $("#signupform");
                    var serializedData = form.serializeArray();
                    $.ajax({
                        url: "{{ route('process-signup') }}",
                        type: "post",
                        data: serializedData,
                        dataType: "json",
                        success: function (response) { 
                            $.each(response , function(index, item) { 
                                var html='';
                                if(index == 'msg'){
                                    form[0].reset();   
                                    Swal.fire({
                                        title: item.title,
                                        text: item.text,
                                        icon: "success",
                                        showCancelButton: !0,
                                        confirmButtonColor: "#556ee6",
                                        cancelButtonColor: "#f46a6a"
                                    });
                                    showToast('success', 'Success', item.title);
                                    // window.location.href = "{{ url('/member-dashboard') }}";
                                }else{
                                    showToast('error', 'Warning!', item);
                                }
                            });  
                        }
                    });
                    event.preventDefault();
                });
            </script>

            @endsection


            @include('site.user_dashboard.partials.footer')
