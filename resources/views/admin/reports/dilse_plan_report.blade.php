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
                    <!-- <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                            <a href="{{url('/add-game-timings')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                            <i class="fas fa-plus me-2"></i> Add New
                            </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-dilse-plan-report') }}" method="post">
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
            </div>
            <!-- show data -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">Name</th>
                                        <th>ID</th>
                                        <th class="text-wrap">Amount</th>
                                        <th class="text-wrap">Total Installment</th>
                                        <th class="text-wrap">Installment Amount per Month</th>
                                        <th class="text-wrap">Paid Installment</th>
                                        <th class="text-wrap">Paid Amount</th>
                                        <th class="text-wrap">Due Paid</th>
                                        <th class="text-wrap">Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $user = 0 @endphp
                                    @php $amount = 0 @endphp
                                    @foreach($items as $item)
                                    @php $user++ @endphp
                                    @php $amount += $item->total_amount @endphp
                                    <tr>
                                        <td class="text-wrap">{{ get_name($item->user_id) }}</td>
                                        <td>{{ get_user_id($item->user_id) }}</td>
                                        <td>{{ $item->total_amount }}</td>
                                        <td>{{ $item->total_installment_month }}</td>
                                        <td>{{ $item->installment_amount_per_month }}</td>
                                        <td>{{ $item->month_count }}</td>
                                        <td>{{ $item->total_disbursed_amount }}</td>
                                        <td>{{ abs($item->total_paying_amount - $item->total_disbursed_amount) }}</td>
                                        <td>{{ formated_date($item->start_date) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><b>Total User - {{ $user }}</b></td>
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
                </div>
            </div>
            <!-- end show data -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include("admin.dash.footer")