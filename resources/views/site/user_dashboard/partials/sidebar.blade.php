        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/member-dashboard') }}">
                <div class="sidebar-brand-text mx-3">{{ app_name() }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/member-dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('register-member') }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Register Member</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profilekyc"
                    aria-expanded="true" aria-controls="profilekyc">
                    <i class="fas fa-user-cog"></i>
                    <span>Profile & KYC</span>
                    {!! check_kyc_status_for_menu(Auth::id()) !!}
                </a>
                <div id="profilekyc" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('member.update-profile',Auth::id()) }}">Update Profile</a>
                        <a class="collapse-item" href="{{ route('kyc.index') }}">KYC Details {!! check_kyc_status(Auth::id()) !!}</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeam"
                    aria-expanded="true" aria-controls="collapseTeam">
                    <i class="fas fa-users"></i>
                    <span>My Team</span>
                </a>
                <div id="collapseTeam" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/member-dashboard/direct') }}">Direct</a>
                        <a class="collapse-item" href="{{ url('/member-dashboard/left-side-members') }}">Left Team</a>
                        <a class="collapse-item" href="{{ url('/member-dashboard/right-side-members') }}">Right Team</a>
                        <a class="collapse-item" href="{{ url('/member-dashboard/all-members') }}">All Team</a>
                        <a class="collapse-item" href="{{ url('/member-dashboard/tree-view') }}">Tree View</a>
                        <a class="collapse-item" href="{{ url('/member-dashboard/level-view') }}">Level View</a>
                    </div>
                </div>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ url('/member-dashboard/member-requests') }}">
                    <i class="fas fa-hands-helping"></i>
                    <span>Member Requests</span>
                </a>
            </li> -->

            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ url('/member-dashboard/tree-view') }}">
                    <i class="fas fa-users"></i>
                    <span>Tree View</span>
                </a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Products & Orders</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('product') }}">Products</a>
                        <a class="collapse-item" href="{{ route('member.orders') }}">Orders</a>
                    </div>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#documents"
                    aria-expanded="true" aria-controls="documents">
                    <i class="fas fa-address-card"></i>
                    <span>My Documents</span>
                </a>
                <div id="documents" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('my-documents.welcome-letter') }}">Welcome Letter</a>
                        <a class="collapse-item" href="{{ route('my-documents.id-card') }}">ID Card</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payouts"
                    aria-expanded="true" aria-controls="payouts">
                    <i class="fas fa-wallet"></i>
                    <span>Payouts</span>
                </a>
                <div id="payouts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('payout.all') }}">Payouts</a>
                        <a class="collapse-item" href="{{ route('payout.history') }}">Payout History</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports"
                    aria-expanded="true" aria-controls="reports">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                </a>
                <div id="reports" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('userreport.top-report') }}">Topup Report</a>
                        <a class="collapse-item" href="{{ route('userreport.remuneration-report') }}">Remuneration Report</a>
                        <a class="collapse-item" href="{{ route('userreport.dilse-plan-report') }}">Dilse Plan Report</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#business-reports"
                    aria-expanded="true" aria-controls="business-reports">
                    <i class="fas fa-chart-line"></i>
                    <span>Business Report</span>
                </a>
                <div id="business-reports" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('business-report.level') }}">Level Wise Report</a>
                        <a class="collapse-item" href="{{ route('business-report.tree') }}">Tree Wise Report</a>
                    </div>
                </div>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('add.top-up-requests') }}">
                    <i class="fas fa-comments"></i>
                    <span>Top of Requests</span>
                </a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>