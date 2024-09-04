@include('site.user_dashboard.partials.head')

    <style>
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
            /* font-size: 11px; */
            font-size: 20px;
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
    </style> 

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('site.user_dashboard.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('site.user_dashboard.partials.top_bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Level View</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Level View of Member {{ Auth::user()->name }}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body d-flex justify-content-center">
                                    <!-- <div class="tree">
                                        <ul>
                                            <li>
                                                {{--<a href="#">{{Auth::user()->name}}</a>
                                                @php
                                                    $cusomers = get_customer_by_agent_id(Auth::user()->phone);
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
                                                @endif--}}

                                                <a href="#">{{Auth::user()->name}}</a>
                                                @php $customerTree = get_customer_tree(Auth::user()->phone) @endphp
                                                
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
                                                            <div class="{{get_active_class(Auth::user()->status)}}">
                                                                <span>{{ is_active(Auth::user()->status) }}</span>
                                                            </div>
                                                            <div class="member-image">
                                                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Member">
                                                            </div>
                                                            <div class="member-footer">
                                                                <div class="name"><span>{{ Auth::user()->name }}</span></div>
                                                                <div class="downline"><span>{{ Auth::user()->joining_amount }}</span></div>
                                                                <div class="downline"><span>{{ get_join_green_date(Auth::user()->join_amount_put_date) }}</span></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @php $customerTree = get_customer_tree(Auth::user()->phone) @endphp
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')