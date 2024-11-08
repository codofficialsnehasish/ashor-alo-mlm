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
                        {{-- <div class="card-body table-responsive">
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
                                        <td colspan="2">Hold Wallet Added</td>
                                        <td>{{ $payout->hold_wallet_added }}</td>
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
                                        <td colspan="2">Hold Wallet</td>
                                        <td>{{ $payout->hold_wallet }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right;"><b>Net Payable Amount</b></td>
                                        <td><b>{{ $payout->total_payout }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <a id="btn_print" type="button" value="print" class="btn btn-success mt-3 mb-3" onclick="">Print Statement</a>
                                </div>
                            </div>
                            <div id="printableArea" class="table-responsive" style="line-height:1.9;border: 6px solid #979696;padding:20px;border-radius: 15px;">
                                <center>
                                    <body>
                                        <table style="width: 800px;">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <img src="{{ get_logo() }}" style="width: 100px;">
                                                        <h1 style="margin: 0;font-size: 20px;">ASHOR ALO </h1>
                                                        <h2 style="margin: 0;font-size: 16px;">Thacker House, 35, Chittaranjan Avenue, 4th Floor, Kolkata 700012, West Bengal</h2>
                                                        <p style="margin: 0;font-size: 14px;"><b>E-Mail :</b> ashoralo12@gmail.com </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table style="width: 800px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center">
                                                                        <h2 style="margin: 10px;font-size: 16px;">STATEMENT DATED ON {{ $payout->end_date }} </h2>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table style="width: 800px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h2 style="margin: 0;font-size: 16px;margin-bottom: 5px;"><b>Name:</b> {{ get_name($payout->user_id) }}</h2>
                                                                        <h2 style="margin: 0;font-size: 16px;"> <b>ID:</b> {{ get_user_id($payout->user_id) }} </h2>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table style="width: 800px;border: 1px solid #000;padding: 10px;margin-top: 20px;">
                                                            <tbody>
                                                                <tr style="text-align: left;">
                                                                    <th style="width: 630px;background: #cccccc59;padding: 10px;">Benifit Details</th>
                                                                    <th style="background: #cccccc59;padding: 10px;width: 170px;">Amount </th>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;"> Direct Bonus</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->direct_bonus }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Level Bonus</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->lavel_bonus }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Remuneration Bonus</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->remuneration_bonus }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Product Return</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->roi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Previous Hold Amount</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->hold_amount_added }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Previous Hold Wallet Amount</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->hold_wallet_added }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr></tr>
                                                <tr>
                                                    <td>
                                                        <table style="width: 800px;border: 1px solid #000;padding: 10px;">
                                                            <tbody>
                                                                <tr style="text-align: left;">
                                                                    <th style="width: 630px;background: #cccccc59;padding: 10px;">Gross incentive</th>
                                                                    <th style="background: #cccccc59;padding: 10px;">{{ $payout->direct_bonus + $payout->lavel_bonus + $payout->roi + $payout->hold_amount_added + $payout->remuneration_bonus }}</th>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Less Repurchase Wallet {{ $payout->repurchase_persentage }}% </td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Less TDS {{ $payout->tds_persentage }}% </td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->direct_bonus_tds_deduction + $payout->lavel_bonus_tds_deduction + $payout->remuneration_bonus_tds_deduction }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Less Service charge {{ $payout->service_charge_persentage }}%</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->roi_tds_deduction }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Hold Amount</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->hold_amount }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 630px;padding: 10px;">Hold Wallet Amount</td>
                                                                    <td style="padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->hold_wallet }}</td>
                                                                </tr>
                                                                <tr style="text-align: left;">
                                                                    <th style="width: 630px;background: #cccccc59;padding: 10px;">Previous Unpaid Amount</th>
                                                                    <th style="background: #cccccc59;padding: 10px;">{{ $payout->previous_unpaid_amount }}</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table style="width: 800px;border: 1px solid #000;padding: 10px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-weight: bold;width: 630px;">Net Payable Amount</td>
                                                                    <td style="font-weight: bold;padding: 10px;width: 170px;border-left: 1px solid #ccc;">{{ $payout->total_payout }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <h2 style="margin: 10px;font-size: 16px;">The amount will be credited to your bank account within seven days</h2>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </body>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end show data -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @section('script')
    <script>
        $(document).ready(function() {
            $('#btn_print').click(function() {
                var printContents = $('#printableArea').html();
                var originalContents = $('body').html();

                $('body').html(printContents);
                window.print();
                $('body').html(originalContents);
            });
        });
    </script>
    @endsection

    @include("admin.dash.footer")