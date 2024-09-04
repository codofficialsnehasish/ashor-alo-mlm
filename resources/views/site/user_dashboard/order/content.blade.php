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
                        <h1 class="h3 mb-0 text-gray-800">All Orders</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of All Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Total Price</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Shipping Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number  }}</td>
                                            <!-- <td>
                                                <span class="label">Subtotal Price :</span><span class="value">{{ $order->price_subtotal }}</span><br>
                                                <span class="label">Gst Price :</span><span class="value">{{ $order->price_gst }}</span><br>
                                                <span class="label">Shipping Price :</span><span class="value">{{ $order->price_shipping }}</span><br><hr>
                                                <span class="label">Total:</span><span class="value">{{ $order->price_subtotal + $order->price_gst + $order->price_shipping }}</span><br>
                                                <span class="label">Discount Price :</span><span class="value">{{ $order->discounted_price }}</span><br><hr>
                                                <span class="label">Total Price :</span><span class="value">{{ $order->price_total }}</span><br>
                                            </td> -->
                                            <td>{{ $order->price_total }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                @if($order->payment_status == 'Awaiting Payment' || $order->payment_status ==  'Under Checking')
                                                <b class="text-danger">{{ $order->payment_status }}</b>
                                                @else
                                                <b class="btn btn-success">{{ $order->payment_status }}</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->status != 1)
                                                <b class="">{{ $order->order_status }}</b>
                                                @else
                                                <b class="btn btn-success">{{ $order->order_status }}</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->status == 1)
                                                <a class="btn btn-info" href="{{ route('invoice',$order->id) }}" title="Download Invoice"><i class="fas fa-cloud-download-alt me-2" title=""></i>Download Invoice</a>
                                                @endif
                                                <a class="btn btn-success" href="javascript:void(0)" alt="View Order" title="View Order"><i class="fas fa-eye" title="View Order"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')