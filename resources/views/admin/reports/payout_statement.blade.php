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
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a onclick="history.back()" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
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
                                        <td>{{ 0.00 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Product Return</td>
                                        <td>{{ $payout->roi }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Hold Amount Added</td>
                                        <td>{{ $payout->hold_amount_added }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right;">Gross Incentive</td>
                                        <td>{{ $payout->direct_bonus + $payout->lavel_bonus + $payout->roi + $payout->hold_amount_added }}</td>
                                    </tr>
                                    <tr><td colspan="3"></td></tr>
                                    <tr>
                                        <td colspan="2">Less Repurchase Wallet {{ $payout->repurchase_persentage }}%</td>
                                        <td>{{ $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Less TDS {{ $payout->tds_persentage }}%</td>
                                        <td>{{ $payout->direct_bonus_tds_deduction + $payout->lavel_bonus_tds_deduction }}</td>
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
                                        <td colspan="2" style="text-align: right;"><b>Net Payable Amount</b></td>
                                        <td><b>{{ $payout->total_payout }}</b></td>
                                    </tr>
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