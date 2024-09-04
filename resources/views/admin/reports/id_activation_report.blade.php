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
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-id-activation-report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-6">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-4">
                                        <label class="form-label">Choose Agents</label>
                                        <select class="form-control select2" name="activated_by">
                                            <option selected disabled value="">Select...</option>
                                            @foreach($admins as $user)
                                            <option value="{{ $user->name.'('.get_role($user->id).')' }}">{{ $user->name }} - {{ get_role($user->id) }}</option>
                                            @endforeach
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
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">Name</th>
                                        <th>ID</th>
                                        <th class="text-wrap">Amount</th>
                                        <th class="text-wrap">Date</th>
                                        <th class="text-wrap">Activated By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->joining_amount }}</td>
                                        <td>{{ format_datetime($user->join_amount_put_date) }}</td>
                                        <td>{{ $user->join_by }}</td>
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
    @include("admin.dash.footer")