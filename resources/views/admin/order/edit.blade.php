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
                        <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
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

        <form class="custom-validation" action="{{ route('orders.update') }}" method="post">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            Edit Order
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Choose Agents</label>
                                <select class="form-control select2" name="agent" required>
                                    <option selected disabled value="">Select...</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{$order->buyer_id == $user->id ? 'selected' : '' }}>{{ $user->name }} | {{ $user->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Price Subtotal</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    <input type="number" class="form-control" placeholder="" value="{{ $order->price_subtotal }}" id="product_price" aria-describedby="inputGroupPrepend" name="product_price" required onkeyup="calculateTotalPrice()">
                                    <div class="invalid-feedback">
                                        This field is required
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="discounted_price" class="form-label">Discounted Price</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    <input type="number" class="form-control" placeholder="" value="{{ $order->discounted_price }}" id="discounted_price" aria-describedby="inputGroupPrepend" name="discounted_price" onkeyup="calculateTotalPrice()">
                                    <div class="invalid-feedback">
                                        This field is required
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="gst_price" class="form-label">GST Price</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    <input type="number" class="form-control" placeholder="" value="{{ $order->price_gst }}" id="gst_price" aria-describedby="inputGroupPrepend" name="gst_price" onkeyup="calculateTotalPrice()">
                                    <div class="invalid-feedback">
                                        This field is required
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="shipping_price" class="form-label">Shipping Price</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    <input type="number" class="form-control" placeholder="" value="{{ $order->price_shipping }}" id="shipping_price" aria-describedby="inputGroupPrepend" name="shipping_price" onkeyup="calculateTotalPrice()">
                                    <div class="invalid-feedback">
                                        This field is required
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="security_deposite" class="form-label">Total Price</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                    <input type="number" class="form-control" placeholder="" value="{{ $order->price_total }}" id="total_price" aria-describedby="inputGroupPrepend" name="total_price" readonly>
                                    <div class="invalid-feedback">
                                        This field is required
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Online" {{ $order->payment_method == 'Online' ? 'selected' : '' }}>Online</option>
                                    <option value="Cash" {{ $order->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a Payment Method.
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-select" id="payment_status" name="payment_status" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="Awaiting Payment" {{ $order->payment_status == 'Awaiting Payment' ? 'selected' : '' }}>Awaiting Payment</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a Awaiting Payment.
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
<script>
    function calculateTotalPrice() {
        var product_price = parseInt(document.getElementById('product_price').value) || 0;
        var discounted_price = parseInt(document.getElementById('discounted_price').value) || 0;
        var gst_price = parseInt(document.getElementById('gst_price').value) || 0;
        var shipping_price = parseInt(document.getElementById('shipping_price').value) || 0;

        var calculate_total = product_price + gst_price + shipping_price;
        var totalPrice = calculate_total - discounted_price;

        document.getElementById('total_price').value = totalPrice;
    }
    calculateTotalPrice();
</script>

@include("admin/dash/footer")