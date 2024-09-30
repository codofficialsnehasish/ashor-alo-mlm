<!DOCTYPE html>
<html>
    <style>
        table, th, td {
        /* border:1px solid black; */
        }
    </style>
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
                                        <th style="background: #cccccc59;padding: 10px;">{{ $payout->direct_bonus + $payout->lavel_bonus + $payout->roi + $payout->hold_amount_added + $payout->remuneration_bonus }}
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
                            <h2 style="margin: 10px;font-size: 16px;">That amount will be credit on your bank account with in seven days </h2>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
    </center>
</html>