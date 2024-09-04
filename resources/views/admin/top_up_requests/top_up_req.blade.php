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
                                    <h6 class="page-title">Topup Requests</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Topup Requests</li>
                                    </ol>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_result')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Referar Name</th>
                                                        <th>Referance Name</th>
                                                        <th>Amount</th>
                                                        <th>Coments</th>
                                                        <!-- <th>Mode</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($top_up_requests as $d)
                                                    <tr>
                                                        <th>{{ format_datetime($d->created_at) }}</th>
                                                        <td>{{ get_user_name('id',$d->user_id) }}</td>
                                                        <td>{{$d->ref_user_name}}</td>
                                                        <td>{{$d->topup_money}}</td>
                                                        <td>{{$d->comments}}</td>
                                                        <!-- <td>@if($d->which_for == "add_fund")Add Fund in Wallet @else Withdraw Fund @endif</td> -->
                                                        <!-- <td>{{$d->mode}}</td> -->
                                                        <td>
                                                            <a class="btn btn-outline-success" href="{{url('/approve_add_fund')}}/{{$d->id}}" alt="edit">Approve <i class="ti-check-box"></i></a>
                                                            <a class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" href="{{url('/cancel_add_fund')}}/{{$d->id}}">Cancel<i class="ti-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="exampleModalScrollable{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Approve Withdrawal Request</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{url('/withdraw-fund')}}" method="post">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id" value="{{$d->id}}">
                                                                        <div class="md-3" style="display: flex;flex-direction: column;">
                                                                            <label for="customer" class="form-label">Choose Withdrawal Mode</label>
                                                                            <select class="form-select select2" id="customer" name="mode" required>
                                                                                <option selected disabled value="">Choose ....</option>
                                                                                <option value="Phone Pay">Phone Pay</option>
                                                                                <option value="Google Pay">Google Pay</option>
                                                                                <option value="Paytm">Paytm</option>
                                                                                <option value="Bank Account">Bank Account</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success">Approve <i class="ti-check-box"></i></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("admin.dash.footer")