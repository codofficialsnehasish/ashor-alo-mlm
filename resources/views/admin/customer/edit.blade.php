<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include("admin/dash/left_side_bar")
<!-- Left Sidebar End -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Customer</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Customer</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{route('customer.show')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="account-pages">
                <div class="container">
                    <form class="custom-validation" action="{{ route('customer.update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header bg-primary text-light">Edit Customer</div>
                                <div class="card-body">
                                    <input type="hidden" name="customer_id" value="{{$customer->id}}" id="">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" value="{{$customer->name}}" name="name" id="name" placeholder="Enter name" required>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label" for="input-email">Email address::</label>
                                        <input id="input-email" value="{{$customer->email}}" name="email" class="form-control input-mask" data-inputmask="'alias': 'email'">
                                        <span class="text-muted">_@_._</span>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label" for="phone">Phone No.</label>
                                        <div>
                                            <input data-parsley-type="number" value="{{$customer->phone}}" type="text" name="phone" id="phone" class="form-control" required placeholder="Enter phone number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header bg-primary text-light">Publish</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="customRadioInline1" name="status" class="form-check-input" value="1" {{ check_uncheck($customer->status,1) }}>
                                            <label class="form-check-label" for="customRadioInline1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="customRadioInline2" name="status" class="form-check-input" value="0" {{ check_uncheck($customer->status,0) }}>
                                            <label class="form-check-label" for="customRadioInline2">Inactive</label>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Update Customer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            
            
            <!-- end register -->
            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script>
        function copyValue() {
            if(document.getElementById('check1').checked){
                let text1 = document.getElementById('phone').value;        
                document.getElementById('gpay').value = text1;
            }
            else{
                document.getElementById('gpay').value = "";
            }    
            if(document.getElementById('check2').checked){
                let text1 = document.getElementById('phone').value;        
                document.getElementById('paytm').value = text1;
            }
            else{
                document.getElementById('paytm').value = "";
            } 
            if(document.getElementById('check3').checked){
                let text1 = document.getElementById('phone').value;        
                document.getElementById('phone_pay').value = text1;
            }
            else{
                document.getElementById('phone_pay').value = "";
            } 
        }
    </script>

    @include("admin/dash/footer")