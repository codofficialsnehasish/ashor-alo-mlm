@include('site.user_dashboard.partials.head')

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>                      
                        <h6 class="h6 mb-0 text-gray-800">
                            <strong>Left Reference Link:</strong> 
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="{{ url('/member-register') }}?sponsorid={{ Auth::user()->user_id }}&position=left" data-a2a-title="Get Business Opportunity on ASHOR ALO. Join today using below link" style="line-height: 32px;">
                            <a class="a2a_dd" href="https://www.addtoany.com/share'#url={{ url('/member-register') }}?sponsorid={{ Auth::user()->user_id }}&position=left&amp;title={{ urlencode('Get Business Opportunity on ASHOR ALO. Join today using below link') }}"><span class="a2a_svg a2a_s__default a2a_s_a2a" style="background-color: rgb(1, 102, 255);"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g fill="#FFF"><path d="M14 7h4v18h-4z"></path><path d="M7 14h18v4H7z"></path></g></svg></span><span class="a2a_label a2a_localize" data-a2a-localize="inner,Share">Share</span></a>
                            <a class="a2a_button_copy_link" target="_blank" rel="nofollow noopener" href="/#copy_link"><span class="a2a_svg a2a_s__default a2a_s_link" style="background-color: rgb(136, 137, 144);"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#fff" d="M7.591 21.177q0-.54.377-.917l2.804-2.804a1.24 1.24 0 0 1 .913-.378q.565 0 .97.43-.038.041-.255.25-.215.21-.29.29a3 3 0 0 0-.2.256 1.1 1.1 0 0 0-.177.344 1.4 1.4 0 0 0-.046.37q0 .54.377.918a1.25 1.25 0 0 0 .918.377q.19.001.373-.047.189-.056.345-.175.135-.09.256-.2.15-.14.29-.29c.14-.142.223-.23.25-.254q.445.42.445.984 0 .539-.377.916l-2.778 2.79a1.24 1.24 0 0 1-.917.364q-.54-.001-.917-.35l-1.982-1.97a1.22 1.22 0 0 1-.378-.9zm9.477-9.504q0-.54.377-.917l2.777-2.79a1.24 1.24 0 0 1 .913-.378q.525-.001.917.364l1.984 1.968q.38.378.38.903 0 .54-.38.917l-2.802 2.804a1.24 1.24 0 0 1-.916.364q-.565 0-.97-.418.038-.04.255-.25a8 8 0 0 0 .29-.29q.108-.12.2-.255.121-.156.176-.344.048-.181.047-.37 0-.538-.377-.914a1.25 1.25 0 0 0-.917-.377q-.205 0-.37.046-.172.046-.346.175a4 4 0 0 0-.256.2q-.08.076-.29.29l-.25.258q-.441-.417-.442-.983zM5.003 21.177q0 1.617 1.146 2.736l1.982 1.968c.745.75 1.658 1.12 2.736 1.12q1.63 0 2.75-1.143l2.777-2.79c.75-.747 1.12-1.66 1.12-2.737q.002-1.66-1.183-2.818l1.186-1.185q1.16 1.185 2.805 1.186 1.617 0 2.75-1.13l2.803-2.81q1.127-1.132 1.128-2.748 0-1.62-1.146-2.738L23.875 6.12Q22.758 4.999 21.139 5q-1.63 0-2.75 1.146l-2.777 2.79c-.75.747-1.12 1.66-1.12 2.737q-.002 1.658 1.183 2.817l-1.186 1.186q-1.16-1.186-2.805-1.186-1.617 0-2.75 1.132L6.13 18.426Q5 19.559 5 21.176z"></path></svg></span><span class="a2a_label">Copy Link</span></a>
                            <div style="clear: both;"></div></div>
                            <script async="" src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                        </h6>

                        <h6 class="h6 mb-0 text-gray-800">
                            <strong>Right Reference Link:</strong> 
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="{{ url('/member-register') }}?sponsorid={{ Auth::user()->user_id }}&position=right" data-a2a-title="Get Business Opportunity on ASHOR ALO. Join today using below link" style="line-height: 32px;">
                                <a class="a2a_dd" href="https://www.addtoany.com/share'#url={{ url('/member-register') }}?sponsorid={{ Auth::user()->user_id }}&position=right&amp;title={{ urlencode('Get Business Opportunity on ASHOR ALO. Join today using below link') }}"><span class="a2a_svg a2a_s__default a2a_s_a2a" style="background-color: rgb(1, 102, 255);"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g fill="#FFF"><path d="M14 7h4v18h-4z"></path><path d="M7 14h18v4H7z"></path></g></svg></span><span class="a2a_label a2a_localize" data-a2a-localize="inner,Share">Share</span></a>
                                <a class="a2a_button_copy_link" target="_blank" rel="nofollow noopener" href="/#copy_link"><span class="a2a_svg a2a_s__default a2a_s_link" style="background-color: rgb(136, 137, 144);"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#fff" d="M7.591 21.177q0-.54.377-.917l2.804-2.804a1.24 1.24 0 0 1 .913-.378q.565 0 .97.43-.038.041-.255.25-.215.21-.29.29a3 3 0 0 0-.2.256 1.1 1.1 0 0 0-.177.344 1.4 1.4 0 0 0-.046.37q0 .54.377.918a1.25 1.25 0 0 0 .918.377q.19.001.373-.047.189-.056.345-.175.135-.09.256-.2.15-.14.29-.29c.14-.142.223-.23.25-.254q.445.42.445.984 0 .539-.377.916l-2.778 2.79a1.24 1.24 0 0 1-.917.364q-.54-.001-.917-.35l-1.982-1.97a1.22 1.22 0 0 1-.378-.9zm9.477-9.504q0-.54.377-.917l2.777-2.79a1.24 1.24 0 0 1 .913-.378q.525-.001.917.364l1.984 1.968q.38.378.38.903 0 .54-.38.917l-2.802 2.804a1.24 1.24 0 0 1-.916.364q-.565 0-.97-.418.038-.04.255-.25a8 8 0 0 0 .29-.29q.108-.12.2-.255.121-.156.176-.344.048-.181.047-.37 0-.538-.377-.914a1.25 1.25 0 0 0-.917-.377q-.205 0-.37.046-.172.046-.346.175a4 4 0 0 0-.256.2q-.08.076-.29.29l-.25.258q-.441-.417-.442-.983zM5.003 21.177q0 1.617 1.146 2.736l1.982 1.968c.745.75 1.658 1.12 2.736 1.12q1.63 0 2.75-1.143l2.777-2.79c.75-.747 1.12-1.66 1.12-2.737q.002-1.66-1.183-2.818l1.186-1.185q1.16 1.185 2.805 1.186 1.617 0 2.75-1.13l2.803-2.81q1.127-1.132 1.128-2.748 0-1.62-1.146-2.738L23.875 6.12Q22.758 4.999 21.139 5q-1.63 0-2.75 1.146l-2.777 2.79c-.75.747-1.12 1.66-1.12 2.737q-.002 1.658 1.183 2.817l-1.186 1.186q-1.16-1.186-2.805-1.186-1.617 0-2.75 1.132L6.13 18.426Q5 19.559 5 21.176z"></path></svg></span><span class="a2a_label">Copy Link</span></a>
                                <div style="clear: both;"></div>
                            </div>
                            <script async="" src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                        </h6>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $total_income ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Commission</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $total_commission ?? 0.00 }}</div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mt-1">
                                                Hold Amount : ₹{{ $hold_amount ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Direct Bonus</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $direct_bonus ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Level Bonus</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $level_bonus ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Product Support</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $product_return ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Remuneration Benefits</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $remuneration_benefits ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Repurchase Wallet</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $repurchase_bonus ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Direct Team Member</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $direct_team_member ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Left Team Member</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="left-team-member-show">{{ $left_team_member ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Right Team Member</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="right-team-member-show">{{ $right_team_member ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                All Team Member</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="all-team-member-show">{{ $tree_team_member ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Level Team Member</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="level-team-member-show">{{ $level_team_member ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Team Member -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Active Team Member
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 team-count">{{ $total_active_team_member ?? 0.00 }}</div>
                                                </div>
                                                <div class="col">
                                                    @if(!empty($total_team_member) && ($total_team_member != 0 && $total_active_team_member != 0) )
                                                    @php $percentage = ($total_active_team_member / $total_team_member) * 100 @endphp
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    @else
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Rank</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="rank-show">{{ $rank ?? '' }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-poll fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Top Up Amount</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ {{ $total_topup_amount ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Left Business</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="left-business-show">₹ {{ $total_left_business ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Right Business</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="right-business-show">₹ {{ $total_right_business ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Current Week Business</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="current-week-business-show">₹ {{ $current_week_business ?? 0.00 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Last Payment</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ @if(!empty($last_payment) && $last_payment->paid_unpaid == 0) {{ $last_payment->total_payout }} @else 0.00 @endif</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
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

            @section('script')
            <script>
                $(document).ready(function() {
                    $.ajax({
                        url: "{{ route('member-dashboard.get-left-team-member') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#left-team-member-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#left-team-member-show').text(response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-right-team-member') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#right-team-member-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#right-team-member-show').text(response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-tree-team-member') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#all-team-member-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#all-team-member-show').text(response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-level-team-member') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#level-team-member-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#level-team-member-show').text(response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-total-left-business') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#left-business-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#left-business-show').text('₹ '+response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-total-right-business') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#right-business-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#right-business-show').text('₹ '+response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-rank') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#rank-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#rank-show').text(response);
                        }
                    });

                    $.ajax({
                        url: "{{ route('member-dashboard.get-current-week-business') }}",
                        type: 'POST',
                        data:{_token:"{{ csrf_token() }}"},
                        beforeSend: function() {
                            $('#current-week-business-show').text('Calculating...');
                        },
                        success: function(response) {
                            $('#current-week-business-show').text('₹ '+response);
                        }
                    });

                    function updateTeamProgress() {
                        let totalTeamMembers = 0;
                        let totalActiveMembers = 0;

                        // Show "Calculating..." before fetching data
                        $('.team-count').text('Calculating...');
                        $('.progress-bar').css('width', '0%').attr('aria-valuenow', '0');

                        // Fetch total team members
                        $.ajax({
                            url: "{{ route('member-dashboard.get-total-team-member') }}",
                            type: 'POST',
                            data: { _token: "{{ csrf_token() }}" },
                            success: function(response) {
                                totalTeamMembers = parseFloat(response) || 0;
                                checkAndUpdateProgress();
                            }
                        });

                        // Fetch total active team members
                        $.ajax({
                            url: "{{ route('member-dashboard.get-total-active-team-member') }}",
                            type: 'POST',
                            data: { _token: "{{ csrf_token() }}" },
                            success: function(response) {
                                totalActiveMembers = parseFloat(response) || 0;
                                checkAndUpdateProgress();
                            }
                        });

                        function checkAndUpdateProgress() {
                            if (totalTeamMembers !== 0) {
                                let percentage = (totalActiveMembers / totalTeamMembers) * 100;
                                $('.team-count').text(totalActiveMembers.toFixed(2));
                                $('.progress-bar').css('width', percentage + '%').attr('aria-valuenow', percentage);
                            } else {
                                $('.team-count').text('0.00');
                                $('.progress-bar').css('width', '0%').attr('aria-valuenow', '0');
                            }
                        }
                    }

                    // Call the function on page load or when needed
                    updateTeamProgress();


                });
            </script>
            @endsection

            @include('site.user_dashboard.partials.footer')