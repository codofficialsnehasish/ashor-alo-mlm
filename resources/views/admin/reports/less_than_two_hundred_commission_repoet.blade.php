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
            {{--<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-level-bonus-report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-10">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>--}}

            <!-- show data --> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">Name</th>
                                        <th class="text-wrap">ID</th>
                                        <th class="text-wrap">Total Hold Wallet Amount</th>
                                        <th class="text-wrap">Total Hold Amount</th>
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
                                    @php $hold_amount = 0 @endphp
                                    @foreach($items as $item)
                                    @php $amount += $item->hold_wallet @endphp
                                    @php $hold_amount += $item->hold_amount @endphp
                                    @php $user = get_user_details($item->user_id) @endphp
                                    <tr>
                                        <td class="text-wrap">{{ get_name($item->user_id) }}</td>
                                        <td class="text-wrap">{{ get_user_id($item->user_id) }}</td>
                                        <td class="text-wrap">{{ $item->hold_wallet }}</td>
                                        <td class="text-wrap">{{ $item->hold_amount }}</td>
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
                                        <td class="text-wrap"><b>Total Amount - {{ $amount }}</b></td>
                                        <td class="text-wrap"><b>Total Amount - {{ $hold_amount }}</b></td>
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
                </div>
            </div>
            <!-- end show data -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include("admin.dash.footer")