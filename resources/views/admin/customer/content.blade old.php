<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

    <!-- ========== Left Sidebar Start ========== -->
    @include("admin/dash/left_side_bar")
    <!-- Left Sidebar End -->

    <!-- <style>
        /*Now the CSS*/

        .tree ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            padding-left: 0px;
        }

        .tree li {
            float: left; text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
            
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*We will use ::before and ::after to draw the connectors*/

        .tree li::before, .tree li::after{
            content: '';
            position: absolute; top: 0; right: 50%;
            border-top: 1px solid #ccc;
            width: 50%; height: 20px;
        }
        .tree li::after{
            right: auto; left: 50%;
            border-left: 1px solid #ccc;
        }

        /*We need to remove left-right connectors from elements without 
        any siblings*/
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }

        /*Remove space from the top of single children*/
        .tree li:only-child{ padding-top: 0;}

        /*Remove left connector from first child and 
        right connector from last child*/
        .tree li:first-child::before, .tree li:last-child::after{
            border: 0 none;
        }
        /*Adding back the vertical connector to the last nodes*/
        .tree li:last-child::before{
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }
        .tree li:first-child::after{
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before{
            content: '';
            position: absolute; top: 0; left: 50%;
            border-left: 1px solid #ccc;
            width: 0; height: 20px;
        }

        .tree li a{
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;
            
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*Time for some hover effects*/
        /*We will apply the hover effect the the lineage of the element also*/
        .tree li a:hover, .tree li a:hover+ul li a {
            background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
        }
        /*Connector styles on hover*/
        .tree li a:hover+ul li::after, 
        .tree li a:hover+ul li::before, 
        .tree li a:hover+ul::before, 
        .tree li a:hover+ul ul::before{
            border-color:  #94a0b4;
        }
    </style>-->
    <style>
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>

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
                                <!-- <div class="pagination-container">
                                    <input type="text" name="" id="searchInput">
                                </div> -->
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-wrap">Reg Date</th>
                                            <th>Name</th>
                                            <!-- <th>Referral Code</th> -->
                                            <th>Position</th>
                                            <th>Level</th>
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
                                            <td class="text-wrap">{{$c->name}}</td>
                                            <!-- <td>{{$c->referral_code}}</td> -->
                                            <td>@if($c->is_left == 1) Left @else Right @endif</td>
                                            <td>{{ find_customer_level($c->user_id) }}</td>
                                            <td>{{$c->phone}}</td>
                                            <td>{{$c->decoded_password}}</td>
                                            <td class="text-wrap">{{$c->email}}</td>
                                            <td>{!! check_status($c->status) !!}</td>
                                            <td class="text-wrap">@if(!empty($c->agent_id)){{get_user_name('phone',$c->agent_id) }} @endif</td>
                                            <td class="text-wrap">
                                                <!-- <a class="btn btn-primary" href="{{url('/editcustomer')}}/{{$c->id}}" alt="edit"><i class="ti-check-box"></i></a> -->
                                                <a href="{{ route('switch-account',$c->id) }}"><img src="{{!empty($c->user_image) ? $c->user_image : asset('dashboard_assets/images/users/user-14.png')}}" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;border: 3px solid @if($c->status==1) green @else red @endif;" alt="Member" class="rounded-circle"></a>
                                                @if($c->status == 0)
                                                <a class="" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$c->id}}"><img src="{{ asset('dashboard_assets/images/activate.jpg') }}" height="50px" alt=""></a>
                                                @else
                                                <b class="text-success">Join with {{ $c->joining_amount }} in {{ get_join_green_date($c->join_amount_put_date) }}</b>
                                                @endif
                                                <!-- <a class="btn btn-info" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#fullscreenModal{{$c->id}}"><i class="fab fa-buffer"></i></a> -->
                                                <a class="btn btn-primary" href="{{ route('customer.edit',$c->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                                <a class="btn btn-danger" onclick="return confirm('***If you delete the customer, then the customer all data will be deleted***')" href="{{ route('customer.delete',$c->id)}}"><i class="ti-trash"></i></a>
                                            </td>
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
                                {{--<div class="pagination-container">
                                    <p>Showing {{ $customer->firstItem() }} to {{ $customer->lastItem() }} of {{ $customer->total() }} entries</p>
                                    @if ($customer->hasPages())
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            @if ($customer->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $customer->previousPageUrl() }}" rel="prev">Previous</a>
                                                </li>
                                            @endif
    
                                            @if ($customer->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $customer->nextPageUrl() }}" rel="next">Next</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                    @endif
                                </div>--}}

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