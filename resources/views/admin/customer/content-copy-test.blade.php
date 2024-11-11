<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

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
                            <h6 class="page-title">Agent</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Agents</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('customer') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row align-items-center">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-wrap">Reg Date</th>
                                                        <th class="text-wrap">Active Date</th>
                                                        <th>Name</th>
                                                        <!-- <th>Referral Code</th> -->
                                                        <th>Position</th>
                                                        {{-- <th>Level</th> --}}
                                                        <th>Mobile</th>
                                                        <th>Password</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th class="text-wrap">Agent Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customer as $c)
                                                    <tr>
                                                        <td class="text-wrap">{!! format_datetime($c->created_at) !!}</td>
                                                        <td class="text-wrap">{!! $c->join_amount_put_date ? format_datetime($c->join_amount_put_date) : '' !!}</td>
                                                        <td class="text-wrap">{{$c->name}} ( {{$c->user_id}} )</td>
                                                        <!-- <td>{{$c->referral_code}}</td> -->
                                                        <td>@if($c->is_left == 1) Left @else Right @endif</td>
                                                        {{-- <td>find_customer_level($c->user_id) {{ $c->lavel}}</td> --}}
                                                        <td>{{$c->phone}}</td>
                                                        <td>{{$c->decoded_password}}</td>
                                                        <td class="text-wrap">{{$c->email}}</td>
                                                        <td>
                                                            @if($c->block == 0)
                                                            {!! check_status($c->status) !!}
                                                            @else
                                                                <span class="badge bg-danger text-light" style="font-size:15px;">Blocked</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-wrap">@if(!empty($c->agent_id)){{get_user_name('user_id',$c->agent_id) }} ( {{ $c->agent_id }} ) @endif</td>
                                                        <td class="text-wrap">
                                                            <!-- <a class="btn btn-primary" href="{{url('/editcustomer')}}/{{$c->id}}" alt="edit"><i class="ti-check-box"></i></a> -->
                                                            <a href="{{ route('switch-account',$c->id) }}"><img src="{{!empty($c->user_image) ? asset($c->user_image) : asset('dashboard_assets/images/users/user-14.png')}}" style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover;border: 3px solid @if($c->status==1) green @else red @endif;" alt="Member" class="rounded-circle"></a>
                                                            @if($c->status == 0)
                                                            <!-- <a class="" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$c->id}}"><img src="{{ asset('dashboard_assets/images/activate.jpg') }}" height="50px" alt=""></a> -->
                                                            <a href="{{ route('orders.add',$c->id) }}"><img src="{{ asset('dashboard_assets/images/activate.jpg') }}" height="40px" alt=""></a>
                                                            @else
                                                            <!-- <b class="text-success">Join with {{-- $c->joining_amount --}} in {{-- get_join_green_date($c->join_amount_put_date) --}}</b> -->
                                                            @endif
                                                            @if($c->block == 0)
                                                            <a href="{{ route('customer.block',$c->id) }}"><img src="{{ asset('dashboard_assets/images/block.png') }}" height="40px" alt=""></a>
                                                            @else
                                                            <a href="{{ route('customer.block',$c->id) }}"><img src="{{ asset('dashboard_assets/images/unblock.png') }}" height="40px" alt=""></a>
                                                            @endif
                                                            <!-- <a class="btn btn-info" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#fullscreenModal{{$c->id}}"><i class="fab fa-buffer"></i></a> -->
                                                            <a class="btn btn-primary" href="{{ route('customer.edit',$c->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                                            <a class="btn btn-danger" onclick="return confirm('***If you delete the customer, then the customer all data will be deleted***')" href="{{ route('customer.delete',$c->id)}}"><i class="ti-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">
                                                Showing {{ $customer->firstItem() }} to {{ $customer->lastItem() }} of {{ $customer->total() }} entries
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate">
                                                <!-- Laravel pagination links -->
                                                {{ $customer->links('vendor.pagination.custom-pagination') }}
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

        <script>
            function openTab(tabName) {
                // Hide all tab content
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.remove('active');
                });
                // Show the selected tab content
                document.getElementById(tabName).classList.add('active');

                // Highlight the selected tab
                document.querySelectorAll('.network-tab').forEach(tab => {
                    tab.classList.remove('active');
                });
                document.querySelector(`.network-tab[data-target="${tabName}"]`).classList.add('active');
            }
        </script>

        <script>
        function openInNewWindow(event) {
            event.preventDefault(); // Prevent the default anchor behavior
            const url = event.currentTarget.href;
            const windowFeatures = "toolbar=no, menubar=no, width=800, height=600";
            window.open(url, "_blank", windowFeatures);
        }
        </script>
        
        @include("admin/dash/footer")