<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->
    <style>
        .label {
            display: inline-block;
            width: 120px; /* Adjust as needed */
            text-align: right;
            margin-right: 10px; /* Adjust as needed for spacing */
        }

        .value {
            display: inline-block;
            width: 120px; /* Adjust as needed */
            text-align: left;
            margin-left: 10px; /* Adjust as needed for spacing */
        }
    </style>

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
                                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{ route('orders.add') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td class="text-wrap">Date</td>
                                                    <th class="text-wrap">Order ID</th>
                                                    <th class="text-wrap">User Name</th>
                                                    <th class="text-wrap">User ID</th>
                                                    <th class="text-wrap">Product Category</th>
                                                    <th class="text-wrap">Total Price</th>
                                                    <th class="text-wrap">Payment Method</th>
                                                    <th class="text-wrap">Payment Status</th>
                                                    <th>Shipping Status</th>
                                                    <th>Created By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td class="text-wrap">{{ format_datetime($order->created_at)  }}</td>
                                                    <td>#{{ $order->order_number  }}</td>
                                                    <td class="text-wrap">{{ $order->user->name ?? ''  }}</td>
                                                    <td>{{ get_user_id($order->buyer_id) }}</td>
                                                    <!-- <td>
                                                        <span class="label">Subtotal Price :</span><span class="value">{{ $order->price_subtotal }}</span><br>
                                                        <span class="label">Gst Price :</span><span class="value">{{ $order->price_gst }}</span><br>
                                                        <span class="label">Shipping Price :</span><span class="value">{{ $order->price_shipping }}</span><br><hr>
                                                        <span class="label">Total:</span><span class="value">{{ $order->price_subtotal + $order->price_gst + $order->price_shipping }}</span><br>
                                                        <span class="label">Discount Price :</span><span class="value">{{ $order->discounted_price }}</span><br><hr>
                                                        <span class="label">Total Price :</span><span class="value">{{ $order->price_total }}</span><br>
                                                    </td> -->
                                                    <td>{{ get_product_category_name_by_order_id($order->id) }}</td>
                                                    <td>{{ $order->price_total }}</td>
                                                    <td>{{ $order->payment_method }}</td>
                                                    <td>
                                                        @if($order->payment_status == 'Awaiting Payment' || $order->payment_status ==  'Under Checking')
                                                        <div class="col-md-12">
                                                            <select class="form-select" id="{{$order->id}}" name="payment_status" required="" onchange="change_payment_status(this.id,this.value)">
                                                                <option @if($order->payment_status == 'Paid') selected @endif value="Paid">Paid</option>
                                                                <option @if($order->payment_status == 'Awaiting Payment') selected @endif value="Awaiting Payment">Awaiting Payment</option>
                                                                <option @if($order->payment_status == 'Under Checking') selected @endif value="Under Checking">Under Checking</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select a valid Option.
                                                            </div>
                                                        </div>
                                                        @else
                                                        <b class="btn btn-success">{{ $order->payment_status }}</b>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($order->status != 1)
                                                        <div class="col-md-12">
                                                            <select class="form-select" required="" onchange="change_order_status('{{$order->id}}',this.value)">
                                                                <option @if($order->order_status == 'Order Placed') selected @endif value="Order Placed">Order Placed</option>
                                                                <option @if($order->order_status == 'Order Procesing') selected @endif value="Order Procesing">Order Procesing</option>
                                                                <option @if($order->order_status == 'Order Shipped') selected @endif value="Order Shipped">Order Shipped</option>
                                                                <option @if($order->order_status == 'Order Completed') selected @endif value="Order Completed">Order Completed</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select a valid Option.
                                                            </div>
                                                        </div>
                                                        @else
                                                        <b class="btn btn-success">{{ $order->order_status }}</b>
                                                        @endif
                                                    </td>
                                                    <td class="text-wrap">{{ $order->placed_by }}</td>
                                                    <td>
                                                        @if($order->status == 1)
                                                        <a class="btn btn-info" href="{{ route('invoice',$order->id) }}" title="Download Invoice"><i class="fas fa-cloud-download-alt me-2" title=""></i>Download Invoice</a>
                                                        @endif
                                                        <a class="btn btn-success" href="{{ route('orders.order-details',$order->id) }}" alt="View Order" title="View Order"><i class="fas fa-eye" title="View Order"></i></a>
                                                        <!-- <a class="btn btn-primary" href="{{ route('orders.edit',$order->id)}}" alt="edit"><i class="ti-check-box"></i></a> -->
                                                        <a class="btn btn-danger" onclick="return confirm('Are You sure?')" href="{{ route('orders.delete',$order->id)}}"><i class="ti-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end show data -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                @section('script')
                @include('admin.pagescript.orderscript')
                @endsection

                @include("admin/dash/footer")