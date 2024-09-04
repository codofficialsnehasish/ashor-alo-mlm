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
                            <h6 class="page-title">Order</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('orders') }}">Order</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add new Order</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('orders') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <form class="custom-validation" action="{{ route('orders.process') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Add New Order
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control" placeholder="yyyy-mm-dd"
                                                data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true" name="date" autocomplete="off" value="{{ date('Y-m-d') }}">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Date and time</label>
                                        <div class="">
                                            <input class="form-control" type="datetime-local" value="{{date('Y-m-d H:i')}}" name="date" id="example-datetime-local-input">
                                        </div>
                                    </div> -->
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Choose Agents</label>
                                        <select class="form-control select2" name="agent" required>
                                            <option selected disabled value="">Select...</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}" @if(request()->segment(4) == $user->id) selected @endif>{{ $user->name }} - {{ $user->user_id }} - {{ $user->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Category</label>
                                        <select class="form-control select2" name="category" id="category" required>
                                            <option value selected disabled>Choose...</option>
                                            @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Product</label>
                                        <select class="select2 form-control select2-multiple" name="product[]" multiple="multiple" multiple data-placeholder="Choose ..." id="product_chooseable" required>
                                            {{-- @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="product_price" class="form-label">Price Subtotal</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="number" class="form-control" placeholder="" value="" id="product_price" aria-describedby="inputGroupPrepend" name="product_price" required>
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="mb-3">
                                        <label for="discounted_price" class="form-label">Discounted Price</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="number" class="form-control" placeholder="" value="" id="discounted_price" aria-describedby="inputGroupPrepend" name="discounted_price" onkeyup="calculateTotalPrice()">
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gst_price" class="form-label">GST Price</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="number" class="form-control" placeholder="" value="" id="gst_price" aria-describedby="inputGroupPrepend" name="gst_price" onkeyup="calculateTotalPrice()">
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shipping_price" class="form-label">Shipping Price</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="number" class="form-control" placeholder="" value="" id="shipping_price" aria-describedby="inputGroupPrepend" name="shipping_price" onkeyup="calculateTotalPrice()">
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="mb-3">
                                        <label for="security_deposite" class="form-label">Total Price</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="number" class="form-control" placeholder="" value="" id="total_price" aria-describedby="inputGroupPrepend" name="total_price" readonly>
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="security_deposite" class="form-label">Total Price</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                            <input type="number" class="form-control" placeholder="" value="" id="product_price" aria-describedby="inputGroupPrepend" name="total_price">
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="payment_method" class="form-label">Payment Method</label>
                                        <select class="form-select" id="payment_method" name="payment_method" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Online">Online</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a Payment Method.
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="payment_status" class="form-label">Payment Status</label>
                                        <select class="form-select" id="payment_status" name="payment_status" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Awaiting Payment">Awaiting Payment</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a Payment Option.
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1 by-5">
                                        Save & Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </form>
            </div>
            <!-- container-fluid -->
        </div>
    </div>
@section('script')
@include('admin.pagescript.orderscript')
@endsection
@include("admin/dash/footer")