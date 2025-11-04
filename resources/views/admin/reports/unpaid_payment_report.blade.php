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
                            <form action="{{ route('report.generate-paid-unpaid-payment-report') }}" method="get">
                                {{-- @csrf --}}
                                <div class="row">
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Search Using</label>
                                        <select class="form-control" name="search_using">
                                            <option @if($search_using == 'payout_date') selected @endif value="payout_date">Payout Date</option>
                                            <option @if($search_using == 'paid_date') selected @endif value="paid_date">Paid Date</option>
                                        </select>
                                    </div>
                                    <div class="mb-0 col-md-4">
                                        <label class="form-label">Search Using Payout Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Payout Start Date" value="{{ $start_date ?? ''}}" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="Payout End Date" value="{{ $end_date ?? ''}}" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Choose Status</label>
                                        <select class="form-control" name="status">
                                            <option @if($status == 'all') selected @endif value="all">All</option>
                                            <option @if($status == 'paid') selected @endif value="paid">Paid</option>
                                            <option @if($status == 'unpaid') selected @endif value="unpaid">Unpaid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit" name="button" value="excel_download">Download Excel</button>
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
                            {{-- <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">Name</th>
                                        <th class="text-wrap">ID</th>
                                        <th class="text-wrap">Total Payout Amount</th>
                                        <th class="text-wrap">Payout Date</th>
                                        <th class="text-wrap">Account Name (As Per Bank)</th>
                                        <th class="text-wrap">Bank Name</th>
                                        <th class="text-wrap">Account Number</th>
                                        <th class="text-wrap">IFSC</th>
                                        <th class="text-wrap">Account Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $amount = 0 @endphp
                                    @foreach($items as $item)
                                    @php $amount += $item->total_payout @endphp
                                    @php $user = get_user_details($item->user_id) @endphp
                                    <tr>
                                        <td class="text-wrap">{{ get_name($item->user_id) }}</td>
                                        <td class="text-wrap">{{ get_user_id($item->user_id) }}</td>
                                        <td class="text-wrap">{{ $item->total_payout }}</td>
                                        <td class="text-wrap">{{ $item->start_date }} - {{ $item->end_date }}</td>
                                        <td class="text-wrap">{{ $user->account_name }}</td>
                                        <td class="text-wrap">{{ $user->bank_name }}</td>
                                        <td class="text-wrap">{{ $user->account_number }}</td>
                                        <td class="text-wrap">{{ $user->ifsc_code }}</td>
                                        <td class="text-wrap">{{ $user->account_type }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Amount - {{ $amount }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table> --}}

                            <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                {{-- <div class="row align-items-center">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dt-buttons btn-group flex-wrap"> 
                                            <form action="{{ route('customer.exportExcel') }}" method="get">
                                                <input type="hidden" name="query" value="{{ request('query') }}">
                                                <button type="submit" class="btn btn-secondary">Export Excel</button>
                                            </form>
                                            <form action="{{ route('customer.exportPdf') }}" method="get">
                                                <input type="hidden" name="query" value="{{ request('query') }}">
                                                <button type="submit" class="btn btn-secondary">Export PDF</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="datatable-buttons_filter" class="dataTables_filter">
                                            <form action="{{ route('customer.show') }}" method="get">
                                                <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" name="query" aria-controls="datatable-buttons" minlength="3"></label>
                                                <input type="submit" value="Search">
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-wrap">Name</th>
                                                    <th class="text-wrap">ID</th>
                                                    <th class="text-wrap">Total Payout Amount</th>
                                                    <th class="text-wrap">Payout Date</th>
                                                    <th class="text-wrap">Paid Date</th>
                                                    <th class="text-wrap">Account Name (As Per Bank)</th>
                                                    <th class="text-wrap">Bank Name</th>
                                                    <th class="text-wrap">Account Number</th>
                                                    <th class="text-wrap">IFSC</th>
                                                    <th class="text-wrap">Account Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $amount = 0 @endphp
                                                @foreach($items as $item)
                                                @php $amount += $item->total_payout @endphp
                                                @php $user = get_user_details($item->user_id) @endphp
                                                <tr>
                                                    <td class="text-wrap">{{ get_name($item->user_id) }}</td>
                                                    <td class="text-wrap">{{ get_user_id($item->user_id) }}</td>
                                                    <td class="text-wrap">{{ $item->total_payout }}</td>
                                                    <td class="text-wrap">{{ $item->start_date }} - {{ $item->end_date }}</td>
                                                    <td class="text-wrap">{{ $item->paid_date }}</td>
                                                    <td class="text-wrap">{{ $user->account_name }}</td>
                                                    <td class="text-wrap">{{ $user->bank_name }}</td>
                                                    <td class="text-wrap">{{ $user->account_number }}</td>
                                                    <td class="text-wrap">{{ $user->ifsc_code }}</td>
                                                    <td class="text-wrap">{{ $user->account_type }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><b>Total Amount - {{ $amount }}</b></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
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