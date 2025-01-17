<!-- adding header -->
@include("admin.dash.header")
<!-- end header -->

{{-- <div class="main-content"> --}}

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
                </div>
            </div>

            <!-- show data --> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div style="overflow-y: auto; height: 500px;">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead style="position: sticky; top: 0; background-color: #b2e4bd; z-index: 1;">
                                    <tr>
                                        <th class="text-wrap">User</th>
                                        <th class="text-wrap">Payout Date</th>
                                        <th class="text-wrap">Direct Bonus</th>
                                        <th class="text-wrap">Level Bonus</th>
                                        <th class="text-wrap">Remunaration Bonus</th>
                                        <th class="text-wrap">ROI Bonus</th>
                                        <th class="text-wrap">Hold Amount Added</th>
                                        <th class="text-wrap">Hold Amount</th>
                                        <th class="text-wrap">Hold wallet Added</th>
                                        <th class="text-wrap">Hold wallet</th>
                                        <th class="text-wrap">Previous Unpaid amount</th>
                                        <th class="text-wrap">Total Payout</th>
                                        <th class="text-wrap">Paid Unpaid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 0;
                                        $currentUserId = null;
                                    @endphp
                                    @foreach($results as $result)
                                    @php
                                        $user = get_user_details($result->user_id);

                                        // Check if the user_id has changed or we've added 3 rows for the current user
                                        if ($currentUserId !== $result->user_id) {
                                            $counter = 0; // Reset the counter for a new user
                                            $currentUserId = $result->user_id; // Update the current user_id
                                        }

                                        $counter++; // Increment the counter
                                    @endphp
                                    <tr>
                                        <td class="text-wrap">{{ $user->name }} ({{ $user->user_id}})</td>
                                        <td class="text-wrap">{{ formated_date($result->start_date) }} - {{ formated_date($result->end_date) }}</td>
                                        <td class="text-wrap">{{ $result->direct_bonus_calculated }}</td>
                                        <td class="text-wrap">{{ $result->lavel_bonus_calculated }}</td>
                                        <td class="text-wrap">{{ $result->remuneration_bonus_calculated }}</td>
                                        <td class="text-wrap">{{ $result->roi_calculated }}</td>
                                        <td class="text-wrap">{{ $result->hold_amount_added }}</td>
                                        <td class="text-wrap">{{ $result->hold_amount }}</td>
                                        <td class="text-wrap">{{ $result->hold_wallet_added }}</td>
                                        <td class="text-wrap">{{ $result->hold_wallet }}</td>
                                        <td class="text-wrap">{{ $result->previous_unpaid_amount }}</td>
                                        <td class="text-wrap">{{ $result->total_payout }}</td>
                                        <td class="text-wrap">{{ $result->paid_unpaid == 1 ? '_Paid' : '_Unpaid' }}</td>
                                    </tr>
                                    @if ($counter == 3)
                                        <!-- Insert a row to display hold wallet and hold amount balances -->
                                        <tr>
                                            <td colspan="6" class="text-end"><strong>Hold Wallet Balance:</strong></td>
                                            <td class="text-wrap" colspan="3">{{ $user->hold_wallet }}</td>
                                            <td colspan="3" class="text-end"><strong>Hold Balance:</strong></td>
                                            <td class="text-wrap" colspan="3">{{ $user->hold_balance }}</td>
                                        </tr>
                                    @endif
                                    @endforeach
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