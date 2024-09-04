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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('customer.get-user-of-leaders') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-0 col-md-8">
                                            <label class="form-label">Search Using Date</label>
                                            <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                <input type="text" class="form-control" name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                                <input type="text" class="form-control" name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="mb-0 col-md-2">
                                            <label class="form-label">User ID</label>
                                            <div>
                                                <input type="number" class="form-control" required name="user_id" placeholder="User ID" value=""/>
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
                                            <th class="text-wrap">Reg Date</th>
                                            <th>Name</th>
                                            <th>ID</th>
                                            <!-- <th>Referral Code</th> -->
                                            <!-- <th>Level</th> -->
                                            <th>Position</th>
                                            <!-- <th>Password</th> -->
                                            <!-- <th>Email</th> -->
                                            <th class="text-wrap">Sponsor Name</th>
                                            <th class="text-wrap">Sponsor ID</th>
                                            <th>Status</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer as $c)
                                        <tr>
                                            <td class="text-wrap">{!! format_datetime($c->created_at) !!}</td>
                                            <td class="text-wrap">{{$c->name}}</td>
                                            <!-- <td>{{$c->referral_code}}</td> -->
                                            <td>{{$c->user_id}}</td>
                                            <!-- <td>{{-- find_customer_level($c->user_id) --}} {{ $c->lavel}}</td> -->
                                            <!-- <td>{{$c->decoded_password}}</td> -->
                                            <td>@if($c->is_left == 1) Left @else Right @endif</td>
                                            <!-- <td class="text-wrap">{{$c->email}}</td> -->
                                            <td class="text-wrap">@if(!empty($c->agent_id)){{get_user_name('user_id',$c->agent_id) }} @endif</td>
                                            <td class="text-wrap">@if(!empty($c->agent_id)){{ $c->agent_id }} @endif</td>
                                            <td>{!! check_status($c->status) !!}</td>
                                            
                                        </tr>


                                        {{--<div id="fullscreenModal{{$c->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Show Level</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body table-responsive" style="display:flex;justify-content:center;">
                                                                        <!-- <div class="tree">
                                                                            <ul>
                                                                                <li>
                                                                                    <a href="#">{{$c->name}}</a>
                                                                                    @php
                                                                                        $cusomers = get_customer_by_agent_id($c->phone);
                                                                                    @endphp
                                                                                    @if(!empty($cusomers[0]))
                                                                                    <ul>
                                                                                        @foreach($cusomers as $cusomer)
                                                                                        <li>
                                                                                            <a href="#">{{$cusomer->name}}</a>
                                                                                            @php
                                                                                                $cuso = get_customer_by_agent_id($cusomer->phone);
                                                                                            @endphp
                                                                                            @if(!empty($cuso[0]))
                                                                                            <ul>
                                                                                                @foreach($cuso as $cu)
                                                                                                <li>
                                                                                                    <a href="#">{{$cu->name}}</a>
                                                                                                </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                            @endif
                                                                                        </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                    @else
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a href="#">No one Avaliable</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    @endif
                                                                                </li>
                                                                            </ul>
                                                                        </div> -->
                                                                        <!--  <div class="tree">
                                                                            <ul>
                                                                                <li>
                                                                                    <a href="#">{{ $c->name }}</a>
                                                                                    @php $customerTree = get_customer_tree($c->phone) @endphp
                                                                                    
                                                                                    {!! render_customer_tree($customerTree) !!}
                                                                                </li>
                                                                            </ul>
                                                                        </div> -->

                                                                        <div class="genealogy-body genealogy-scroll">
                                                                            <div class="genealogy-tree">
                                                                                <ul>
                                                                                    <li>
                                                                                        <a href="javascript:void(0);">
                                                                                            <div class="member-view-box">
                                                                                                <div class="{{get_active_class($c->status)}}">
                                                                                                    <span>{{ is_active($c->status) }}</span>
                                                                                                </div>
                                                                                                <div class="member-image">
                                                                                                    <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Member">
                                                                                                </div>
                                                                                                <div class="member-footer">
                                                                                                    <div class="name"><span>{{ $c->name }}</span></div>
                                                                                                    <div class="downline"><span>{{ $c->joining_amount }}</span></div>
                                                                                                    <div class="downline"><span>{{ get_join_green_date($c->join_amount_put_date) }}</span></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                        @php $customerTree = get_customer_tree($c->phone) @endphp
                                                                                        {!! render_customer_tree($customerTree) !!}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{--<div id="fullscreenModal{{$c->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Show Level</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body table-responsive" style="display:flex;justify-content:center;">
                                                                        <div class="tree">
                                                                            <ul>
                                                                                @foreach ($rootUsers as $user)
                                                                                <li>
                                                                                    <a href="#">{{ $user->name }}</a>
                                                                                    @if ($user->children->count() > 0)
                                                                                        <ul>
                                                                                            @foreach ($user->children as $child)
                                                                                                @include('admin.customer.tree-node', ['user' => $child])
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    @endif
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>--}}

                                        <div class="modal fade" id="staticBackdrop{{$c->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Make ID Green with Amount</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('customer.make-id-green') }}" method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $c->id }}">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="name">Joining Amount</label>
                                                                <input type="number" class="form-control" name="join_amount" id="name" placeholder="Enter amount" required="" step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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