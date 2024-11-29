@section('style')
<style>
    table, th, td {
    /* border:1px solid black; */
    }
</style>
@endsection
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
                        <h1 class="h3 mb-0 text-gray-800">Payout Statement</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Statement</h6>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <a id="btn_print" type="button" value="print" class="btn btn-success mt-3 mb-3" onclick="">Print Statement</a>
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
                            <div id="printableArea" class="table-responsive" style="line-height:1.9;border: 6px solid #979696;padding:20px;border-radius: 15px;">
                                <center>
                                    <body>
                                        <table style="width: 800px;">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <img src="{{ get_logo() }}" style="width: 100px;">
                                                        <h1 style="margin: 0;font-size: 20px;">ASHOR ALO </h1>
                                                        <h2 style="margin: 0;font-size: 16px;">{{ optional(general_settings())->contact_address ?? '' }}</h2>
                                                        <p style="margin: 0;font-size: 14px;"><b>E-Mail :</b> {{ optional(general_settings())->contact_email ?? '' }} </p>
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
                                                                    <th style="background: #cccccc59;padding: 10px;">{{ $payout->direct_bonus + $payout->lavel_bonus + $payout->roi + $payout->hold_amount_added + $payout->remuneration_bonus + $payout->hold_wallet_added }}
                                                                </th>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
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
            @include('site.user_dashboard.partials.footer')