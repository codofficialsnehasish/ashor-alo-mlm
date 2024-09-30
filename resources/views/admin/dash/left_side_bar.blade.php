<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <!-- <li class="menu-title">Main</li> -->
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('settings-contents') }}">Site Settings</a></li>
                        <li><a href="{{ route('mlm-settings') }}">MLM Settings</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Roles Permissions</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('roles') }}">Roles</a></li>
                                <li><a href="{{ route('permission') }}">Permission</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Master Data</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('monthly-return.index') }}">Monthly Return</a></li>
                                <li><a href="{{ route('lavel-master') }}">Level Bonus</a></li>
                                <li><a href="{{ route('remuneration-benefit.index') }}">Remuneration Benefit</a></li>
                                <li><a href="{{ route('award-reword.index') }}">Award Master</a></li>
                                <li><a href="{{ route('franchise-benefit.index') }}">Franchise Benefit</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('users.add') }}">Add Users</a></li>
                        <li><a href="{{ route('users') }}">All Users</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Agents</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('customer') }}">Add New Agent</a></li>
                        <li><a href="{{ route('customer.show') }}">All Agents</a></li>
                        <li><a href="{{ route('customer.tree-view') }}">Tree View</a></li>
                        <li><a href="{{ route('customer.user-of-leaders') }}">Users of Leader</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-id-card"></i>
                        <span>KYC</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('kyc.pendings') }}">Pending KYC</a></li>
                        <li><a href="{{ route('kyc.cancelled') }}">Cancelled KYC</a></li>
                        <li><a href="{{ route('kyc.completed') }}">Completed KYC</a></li>
                        <li><a href="{{ route('kyc.all') }}">All KYC</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow waves-effect">
                        <!-- <span class="badge rounded-pill bg-danger float-end" id="custo">2</span> -->
                        <i class="ti-shopping-cart-full"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('orders.add') }}">Add Order</a></li>
                        <li><a href="{{ route('orders') }}">All Orders</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="{{ route('top-up-requests') }}" class="waves-effect">
                        <i class="fas fa-code-branch"></i>
                        <span class="badge rounded-pill bg-danger float-end">2</span>
                        <span>Topup Requests</span>
                    </a>
                </li> -->

                <li>
                    <a href="{{ route('categories.index') }}" class="waves-effect">
                        <i class="mdi mdi-vector-combine"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('products') }}" class="waves-effect">
                        <i class="fas fa-cubes"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-chart-line"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('report.id-activation-report') }}">ID Activation Report</a></li>
                        <li><a href="{{ route('report.income-report') }}">Sell Report</a></li>
                        <li><a href="{{ route('report.tds-report') }}">TDS Report</a></li>
                        <li><a href="{{ route('report.repurchase-report') }}">Repurchase Report</a></li>
                        <!-- <li><a href="javascript:void(0)">Payment Report</a></li> -->
                        <li><a href="{{ route('report.direct-bonus-report') }}">Direct Bonus Report</a></li>
                        <li><a href="{{ route('report.level-bonus-report') }}">Level Bonus Report</a></li>
                        <li><a href="{{ route('report.investor-return-report') }}">Investor Return Report</a></li>
                        <li><a href="{{ route('report.product-return-report') }}">Product Return Report</a></li>
                        <li><a href="{{ route('report.payout-report') }}">Payout Report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.contact-us') }}" class="waves-effect">
                        <i class="fas fa-headset"></i>
                        <span>Contact Us</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-file-archive"></i>
                        <span>Legal Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('certificate.index') }}">Certificate</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('photo-gallary.index') }}" class="waves-effect">
                        <i class="fas fa-file-image"></i>
                        <span>Photo Gallery</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>