<!-- adding header -->
@include("admin.dash.header")
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include("admin.dash.left_side_bar")
<!-- Left Sidebar End -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Reports</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a onclick="history.back()" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <form action="{{ route('report.generate-paid-unpaid-payment-report') }}" method="post"> --}}
                            <form action="{{ route('report.generate-product-delevery-report') }}" method="get">
                                {{-- @csrf --}}
                                <div class="row">
                                    <div class="mb-0 col-md-8">
                                        <label class="form-label">Search Using Order Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="{{ $start_date ?? ''}}" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="{{ $end_date ?? ''}}" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Choose Status</label>
                                        <select class="form-control" name="status">
                                            <option @if($status == '-1') selected @endif value="-1">All</option>
                                            <option @if($status == '1') selected @endif value="1">Delivered</option>
                                            <option @if($status == '0') selected @endif value="0">Undelivered</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- show data --> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">

                            <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row align-items-center">
                                    @if(request('start_date'))
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dt-buttons btn-group flex-wrap"> 
                                            <form action="{{ route('report.exportExcel') }}" method="get">
                                                <input type="hidden" name="query" value="{{ request('query') }}">
                                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                                <input type="hidden" name="status" value="{{ request('status') }}">
                                                <button type="submit" class="btn btn-secondary">Export Excel</button>
                                            </form>
                                            
                                            <form action="{{ route('report.exportPdf') }}" method="get">
                                                <input type="hidden" name="query" value="{{ request('query') }}">
                                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                                <input type="hidden" name="status" value="{{ request('status') }}">
                                                <button type="submit" class="btn btn-secondary">Export PDF</button>
                                            </form>                                            
                                        </div>
                                    </div>
                                    @endif
                                    {{-- <div class="col-sm-12 col-md-6">
                                        <div id="datatable-buttons_filter" class="dataTables_filter">
                                            <form action="" method="get">
                                                <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" name="query" aria-controls="datatable-buttons" minlength="3"></label>
                                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                                <input type="hidden" name="status" value="{{ request('status') }}">
                                                <input type="submit" value="Search">
                                            </form>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td class="text-wrap">Place Date</td>
                                                    <th class="text-wrap">Order ID</th>
                                                    <th class="text-wrap">User Name</th>
                                                    <th class="text-wrap">User ID</th>
                                                    <th class="text-wrap">Total Price</th>
                                                    <th class="text-wrap">Payment Method</th>
                                                    <th class="text-wrap">Payment Status</th>
                                                    <th class="text-wrap">Order Status</th>
                                                    <th class="text-wrap">Delivered At</th>
                                                    <th class="text-wrap">Created By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $order)
                                                <tr>
                                                    <td class="text-wrap">{{ format_datetime($order->created_at)  }}</td>
                                                    <td>#{{ $order->order_number  }}</td>
                                                    <td class="text-wrap">{{ $order->user->name ?? ''  }}</td>
                                                    <td>{{ get_user_id($order->buyer_id) }}</td>
                                                    <td>{{ $order->price_total }}</td>
                                                    <td>{{ $order->payment_method }}</td>
                                                    <td>{{ $order->payment_status }}</b></td>
                                                    <td>{{ $order->order_status }}</td>
                                                    <td>@if($order->status) {{ !empty($order->delivered_date) ? format_datetime($order->delivered_date) : format_datetime($order->updated_at) }} @endif</td>
                                                    <td class="text-wrap">{{ $order->placed_by }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">
                                            Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate">
                                            <!-- Laravel pagination links -->
                                            {{ $items->links('vendor.pagination.custom-pagination') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end show data -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include("admin.dash.footer")