<!-- adding header -->
@include('admin/dash/header')
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include('admin/dash/left_side_bar')
<!-- Left Sidebar End -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h6 class="page-title">Order</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                @php $invoice_url = url('invoice',$order->order_number) @endphp
                                <!-- <a href="javascript:void(0)" onclick="javascript:popupCenter({url: '{{$invoice_url}}', title: 'Invoise', w: 1000, h: 600});" class="btn btn-info  dropdown-toggle" aria-expanded="false">
                                    <i class="mdi mdi-cloud-download me-2"></i> Download Invoice
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('orders') }}" class="btn btn-primary  dropdown-toggle"
                                    aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Order Details</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Status</label>
                                        <div class="col-sm-4">
                                        @if($order->status == 1)
                                            <label class="btn btn-success btn-sm waves-effect">Completed</label>
                                        @else
                                            <label class="btn btn-secondary btn-sm waves-effect">{{ ucfirst($order->order_status) }}</label>
                                            <!-- <a href="#" class="btn btn-primary" data-bs-placement="top"  title="Edit this Item" data-bs-toggle="modal" data-bs-target="#updateStatusModal_<?= $order->id; ?>"><i class="fa fa-edit option-icon"></i>Update order Status</a> -->
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Order Number</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->order_number }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Payment Method</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">
                                                {{ ucfirst($order->payment_method) }}
                                            </strong>
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Currency</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->price_currency }}</strong>
                                        </div>
                                    </div> -->
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Payment Status</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ ucfirst($order->payment_status) }}</strong>
                                            @if($order->payment_status == 'pending')
                                            <!-- <a href="#" class="btn btn-primary" data-bs-placement="top"  title="Edit this Item" data-bs-toggle="modal" data-bs-target="#updatePaymentStatusModal_<?= $order->id; ?>"><i class="fa fa-edit option-icon"></i>Update Payment Status</a> -->
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Payment Date</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->payment_date ? format_datetime($order->payment_date) : '' }}</strong>
                                        </div>
                                    </div> -->
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">User Name</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $buyer_details->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Phone Number</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $buyer_details->phone }}</strong>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $buyer_details->email }}</strong>
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->formatted_address }}</strong>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Landmark</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->landmark }}</strong>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Order Items</div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <!-- <th>Product Id</th> -->
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Gst</th>
                                        <th>Total</th>
                                        <!-- <th class="max-width-120">Options</th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $subtotal = 0; @endphp
                                    @php $gst = 0; @endphp
                                    @php $shipping = 0; @endphp
                                    @foreach ($order_items as $item)
                                    <tr>
                                        <!-- <td>{{ $item->product_id }}</td> -->
                                        <td>{{ $item->product_title }}</td>
                                        <td>{{ $item->product_unit_price }}</td>
                                        <td>{{ $item->product_quantity }}</td>
                                        <td>{{ $item->product_gst }}</td>
                                        @php $subtotal += ($item->product_unit_price * $item->product_quantity) @endphp
                                        <td>{{ $item->product_total_price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-lg-4 float-end">
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">Subtotal</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ $subtotal }}</strong></div>
                                </div>
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">GST</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ $gst }}</strong></div>
                                </div>
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">Total</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ ($subtotal + $gst + $shipping) - $order->coupon_discount }}</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page-content -->

@include('admin/dash/footer')
