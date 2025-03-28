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
                        <h6 class="page-title">Business Report</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Business Report</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Level Wise</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.business-report.generate_date_wise_level_report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-5">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-3">
                                        <label class="form-label">Choose Agents</label>
                                        <select class="form-control select2" name="user_id">
                                            <option selected disabled value="">Select...</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->user_id }}">{{ $user->name }} ( {{ $user->user_id }} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Choose Position</label>
                                        <select class="form-control" name="position">
                                            <option selected disabled value="">Select...</option>
                                            <option value="Left">Left</option>
                                            <option value="Right">Right</option>
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
            <div class="card">
                <div class="card-body text-center">
                    <h3><strong>{{ $title }}</strong></h3>
                    <a href="{{ $pdf_link }}" class="btn btn-primary"><i class="fas fa-file-pdf me-2"></i> Expoet To PDF</a>
                    <a href="{{ $excel_link }}" class="btn btn-primary"><i class="fas fa-file-excel me-2"></i> Expoet To Excel</a>
                </div>
            </div>
            @php $total_amount = 0 @endphp
            @php $total_user_count = 0 @endphp
            @if(!empty($groupedBusiness))
            @foreach ($groupedBusiness as $level => $business)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Level {{ $level }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap datatable-buttons" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-wrap">Sl. No.</th>
                                    <th class="text-wrap">Name</th>
                                    <th class="text-wrap">Position</th>
                                    <th class="text-wrap">Phone</th>
                                    <th class="text-wrap">Sponsor Id</th>
                                    <th class="text-wrap">Date</th>
                                    <th class="text-wrap">Amount</th>
                                    <th class="text-wrap">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $amount = 0 @endphp
                                @if(!empty($business))
                                @foreach($business as $item)
                                @php 
                                    $amount += $item['total_business']->total_amount ;
                                    $total_amount += $item['total_business']->total_amount;
                                    $total_user_count += 1;
                                @endphp
                                <tr>
                                    <td class="text-wrap">{{ $loop->iteration }}</td>
                                    <td class="text-wrap">{{ $item['name'] }} ({{ $item['user_id'] }}) </td>
                                    <td class="text-wrap">{{ $item['position'] }}</td>
                                    <td class="text-wrap">{{ $item['phone'] }}</td>
                                    <td class="text-wrap">{{ $item['sponsor_id'] }}</td>
                                    <td class="text-wrap">{{ formated_date($item['total_business']->start_date,'-') }}</td>
                                    <td class="text-wrap">{{ $item['total_business']->total_amount }}</td>
                                    <td class="text-wrap">{{ get_products_by_order_id($item['total_business']->order_id) }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Amount - {{ $amount }}</b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            <div class="card">
                <div class="card-body text-center">
                    <b>Total Member : <strong>@php echo $total_user_count; @endphp</strong></b> | 
                    <b>Total Amount : <strong>@php echo $total_amount; @endphp</strong></b>
                </div>
            </div>
            <!-- end show data -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include("admin.dash.footer")