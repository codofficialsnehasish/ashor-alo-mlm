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
                        <h1 class="h3 mb-0 text-gray-800">Payout Details</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('payout.payout-statement',$payout->id) }}" class="btn btn-info">View Statement</a></h6>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block" style="float: inline-end;">
                                        <div class="dropdown">
                                            <a onclick="history.back()" class="btn btn-primary" aria-expanded="false">
                                                <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Items</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">Direct Bonus</td>
                                            <td>{{ $payout->direct_bonus }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Level Bonus</td>
                                            <td>{{ $payout->lavel_bonus }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Remuneration Bonus</td>
                                            <td>{{ $payout->remuneration_bonus }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Product Return</td>
                                            <td>{{ $payout->roi }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Previous Hold Amount</td>
                                            <td>{{ $payout->hold_amount_added }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Hold Wallet Added</td>
                                            <td>{{ $payout->hold_wallet_added }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: right;">Gross Incentive</td>
                                            <td>{{ $payout->direct_bonus + $payout->lavel_bonus + $payout->roi + $payout->hold_amount_added + $payout->remuneration_bonus }}</td>
                                        </tr>
                                        <tr><td colspan="3"></td></tr>
                                        <tr>
                                            <td colspan="2">Less Repurchase Wallet {{ $payout->repurchase_persentage }}%</td>
                                            <td>{{ $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Less TDS {{ $payout->tds_persentage }}%</td>
                                            <td>{{ $payout->direct_bonus_tds_deduction + $payout->lavel_bonus_tds_deduction + $payout->remuneration_bonus_tds_deduction }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Less Service Charge {{ $payout->service_charge_persentage }}%</td>
                                            <td>{{ $payout->roi_tds_deduction }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Hold Amount</td>
                                            <td>{{ $payout->hold_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Hold Wallet</td>
                                            <td>{{ $payout->hold_wallet }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: right;"><b>Net Payable Amount</b></td>
                                            <td><b>{{ $payout->total_payout }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('site.user_dashboard.partials.footer')