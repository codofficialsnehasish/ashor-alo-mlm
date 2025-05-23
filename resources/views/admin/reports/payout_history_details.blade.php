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
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a onclick="history.back()" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
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
                            {{-- {{ $items }} --}}
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Issue Date</th>
                                        <th>Amount</th>
                                        <th>Paid Date</th>
                                        <th>Mode</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payouts as $payout)
                                        <tr>
                                            {{-- <td>{{ $total - $loop->iteration + 1 }}</td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ formated_date($payout->end_date,'-') }}</td>
                                            <td>{{ $payout->total_payout }}</td>
                                            <td>{{ !empty($payout->paid_date) ? formated_date($payout->paid_date,'-') : '' }}</td>
                                            <td>{{ $payout->paid_mode }}</td>
                                            <td>{!! paid_unpaid($payout->id,$payout->user_id) !!}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Amount - {{ $amount }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot> --}}
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