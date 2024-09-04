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
                                    <h6 class="page-title">Customer</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('customer.show') }}">Customer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Customer</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{ route('customer.show') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                                <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- register -->
                        <div class="account-pages">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New Customer</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{ route('customer.add') }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label" for="agentid">Sponsor Id</label>
                                                        <input type="text" class="form-control" name="agentid" id="agentid" placeholder="Agent Id" onkeyup="get_sponcor_name()">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="name">Sponsor Name</label>
                                                        <input type="text" class="form-control" id="sponsor_name" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input type="text" class="form-control" name="membername" id="name" placeholder="Enter name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="font-weight-bold" for="postion">Position</label>
                                                        <div class="input-group input-group-merge">
                                                            <select name="position" id="postion" class="form-select">
                                                                <option value="left">Left</option>
                                                                <option value="right">Right</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="form-label" for="input-email">Email address::</label>
                                                        <input id="input-email" name="email" class="form-control input-mask" data-inputmask="'alias': 'email'">
                                                        <span class="text-muted">_@_._</span>
                                                    </div>
                                                    <div class="mb-3 mt-3">
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
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Customer</button>
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

                @include("admin/dash/footer")