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
                                <div class="card-header bg-primary text-light d-flex align-items-center justify-content-between">
                                    Edit {{$customer->name}} ({{$customer->user_id}})
                                    <div class="float-end d-none d-md-block">
                                        <a href="{{ route('customer.reset',$customer->id) }}" onclick="return confirm('Are you sure to reset this profile ?')" class="btn btn-danger"><i class="fas fa-redo me-2"></i>Reset Profile</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="customer_id" value="{{$customer->id}}" id="">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" class="form-control" value="{{$customer->name}}" name="name" id="name" placeholder="Enter name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Father / Husband Name</label>
                                            <input type="text" class="form-control" value="{{ $customer->father_or_husband_name }}" name="father_or_husband_name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Date Of Birth (Ex DD/MM/YYYY)</label>
                                            <input type="date" class="form-control" value="{{ $customer->date_of_birth }}" name="date_of_birth">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value selected disabled>Choose...</option>
                                                <option @if($customer->gender == 'Male') selected @endif value="Male">Male</option>
                                                <option @if($customer->gender == 'Female') selected @endif value="Female">Female</option>
                                                <option @if($customer->gender == 'Others') selected @endif value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="marital-status">Marital Status</label>
                                            <select class="form-control" id="marital-status" name="marital_status">
                                                <option value selected disabled>Choose...</option>
                                                <option @if($customer->marital_status == 'Married') selected @endif value="Married">Married</option>
                                                <option @if($customer->marital_status == 'Unmarried') selected @endif value="Unmarried">Unmarried</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Mobile</label>
                                            <input type="number" class="form-control" value="{{ $customer->phone }}" name="phone" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Email</label>
                                            <input type="email" class="form-control" value="{{ $customer->email }}" name="email">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Qualification</label>
                                            <input type="text" class="form-control" value="{{ $customer->qualification }}" name="qualification">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Occupation/Job</label>
                                            <input type="text" class="form-control" value="{{ $customer->occupation }}" name="occupation">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Pincode</label>
                                            <input type="number" class="form-control" value="{{ $customer->pin_code }}" name="pin_code">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Shipping Address</label>
                                            <textarea class="form-control" name="shipping_address" rows="2">{{ $customer->shipping_address }}</textarea>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Address</label>
                                            <textarea class="form-control" rows="2" name="address">{{ $customer->address }}</textarea>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Country</label>
                                            <select class="form-control" id="country_id" name="country">
                                                <option value selected disabled>Choose...</option>
                                                @foreach($countries as $countrie)
                                                <option value="{{ $countrie->id }}" @if($customer->country == $countrie->id) selected @endif>{{ $countrie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">State</label>
                                            <select class="form-control" id="states_id" name="state">
                                                @if(!empty($customer->state))
                                                    @foreach($states as $state)
                                                    <option value="{{ $state->id }}" @if($customer->state == $state->id) selected @endif>{{ $state->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">City</label>
                                            <select class="form-control" id="citys_id" name="city">
                                                @if(!empty($customer->city))
                                                    @foreach($cities as $citie)
                                                    <option value="{{ $citie->id }}" @if($customer->city == $citie->id) selected @endif>{{ $citie->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-primary text-light">Edit Nominee</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Nominee Name</label>
                                            <input type="text" class="form-control" id="usr" value="{{ $customer->nominee_name }}" name="nominee_name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Relation</label>
                                            <select class="form-control" name="nominee_relation">
                                                <option value selected disabled>Choose...</option>
                                                <option @if($customer->nominee_relation == 'Brother') selected @endif value="Brother">Brother</option>
                                                <option @if($customer->nominee_relation == 'Brother In Law') selected @endif value="Brother In Law">Brother In Law</option>
                                                <option @if($customer->nominee_relation == 'Cousin') selected @endif value="Cousin">Cousin</option>
                                                <option @if($customer->nominee_relation == 'Daughter') selected @endif value="Daughter">Daughter</option>
                                                <option @if($customer->nominee_relation == 'Father') selected @endif value="Father">Father</option>
                                                <option @if($customer->nominee_relation == 'Granddaughter') selected @endif value="Granddaughter">Granddaughter</option>
                                                <option @if($customer->nominee_relation == 'Grandson') selected @endif value="Grandson">Grandson</option>
                                                <option @if($customer->nominee_relation == 'Husband') selected @endif value="Husband">Husband</option>
                                                <option @if($customer->nominee_relation == 'Mother') selected @endif value="Mother">Mother</option>
                                                <option @if($customer->nominee_relation == 'Nephew') selected @endif value="Nephew">Nephew</option>
                                                <option @if($customer->nominee_relation == 'Niece') selected @endif value="Niece">Niece</option>
                                                <option @if($customer->nominee_relation == 'Other') selected @endif value="Other">Other</option>
                                                <option @if($customer->nominee_relation == 'Parent In Law') selected @endif value="Parent In Law">Parent In Law</option>
                                                <option @if($customer->nominee_relation == 'Properitor') selected @endif value="Properitor">Properitor</option>
                                                <option @if($customer->nominee_relation == 'Sister') selected @endif value="Sister">Sister</option>
                                                <option @if($customer->nominee_relation == 'Sister In Law') selected @endif value="Sister In Law">Sister In Law</option>
                                                <option @if($customer->nominee_relation == 'Son') selected @endif value="Son">Son</option>
                                                <option @if($customer->nominee_relation == 'Wife') selected @endif value="Wife">Wife</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Date Of Birth (Ex DD/MM/YYYY)</label>
                                            <input type="date" class="form-control" id="usr" value="{{ $customer->nominee_dob }}" name="nominee_dob">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Address</label>
                                            <textarea class="form-control" rows="2" name="nominee_address">{{ $customer->nominee_address }}</textarea>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">State</label>
                                            <select class="form-control" name="nominee_state_id" id="nominee_states_id">
                                                <option value selected disabled>Choose...</option>
                                                @foreach($nominee_states as $state)
                                                <option value="{{ $state->id }}" @if($customer->nominee_state_id == $state->id) selected @endif>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">City</label>
                                            <select class="form-control" name="nominee_city_id" id="nominee_citys_id">
                                                @if(!empty($customer->nominee_city_id))
                                                    @foreach($nominee_cities as $cities)
                                                    <option value="{{ $cities->id }}" @if($customer->nominee_city_id == $cities->id) selected @endif>{{ $cities->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-primary text-light">Bank Details</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Account Name (As Per Bank)</label>
                                            <input type="text" class="form-control" value="{{ $customer->account_name }}" name="account_name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Bank Name</label>
                                            <input type="text" class="form-control" value="{{ $customer->bank_name }}" name="bank_name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Account Number</label>
                                            <input type="number" class="form-control" value="{{ $customer->account_number }}" name="account_number">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">Account Type</label>
                                            <select class="form-control" name="account_type">
                                                <option value="" selected>Choose...</option>
                                                <option value="Current" @if($customer->account_type == 'Current') selected @endif>Current</option>
                                                <option value="Saving" @if($customer->account_type == 'Saving') selected @endif>Saving</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">IFSC</label>
                                            <input type="text" class="form-control" value="{{ $customer->ifsc_code }}" name="ifsc_code">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">PAN</label>
                                            <input type="text" class="form-control" value="{{ $customer->pan_number }}" name="pan_number">
                                        </div>
                                        
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">UPI Name</label>
                                            <input type="text" class="form-control" value="{{ $customer->upi_name }}" name="upi_name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">UPI Type</label>
                                            <select class="form-control" name="upi_type">
                                                <option value="">Choose...</option>
                                                <option value="Phone Pay" @if($customer->upi_type == 'Phone Pay') selected @endif>Phone Pay</option>
                                                <option value="Google Pay" @if($customer->upi_type == 'Google Pay') selected @endif>Google Pay</option>
                                                <option value="Paytm" @if($customer->upi_type == 'Paytm') selected @endif>Paytm</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="usr">UPI Phone Number</label>
                                            <input type="number" class="form-control" value="{{ $customer->upi_number }}" name="upi_number">
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
                                        <label for="usr" class="form-label">Login Password</label>
                                        <input type="text" class="form-control" value="{{ $customer->decoded_password }}" name="password">
                                    </div>
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