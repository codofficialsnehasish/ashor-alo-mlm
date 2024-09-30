<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\TopUp;
use App\Models\AccountTransaction;
use Carbon\Carbon;
use App\Services\LevelBonusService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ForcelyDisburseRoiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $income_data;

    public function __construct($income_data)
    {
        $this->income_data = $income_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $levelBonusService = app(LevelBonusService::class);
        $transaction = app(AccountTransaction::class);

        foreach($this->income_data as $data){
            // Initialize variables for iteration
            // $startDate = Carbon::parse($data->start_date);
            $startDate = Carbon::parse($data->start_date)->addDay();
            $currentDate = Carbon::now()->subDay(); // Current date minus one day

            if ($startDate->greaterThanOrEqualTo($currentDate)) {
                continue;
            }

            $totalDisbursed = 0;

            for ($date = $startDate; $date->lessThanOrEqualTo($currentDate); $date->addDay()) {
                if($data->month_count == 0){
                    $startDate = Carbon::parse($data->start_date);
                    $endDate = Carbon::parse($data->start_date)->addMonth($data->month_count+1);
                } else {
                    $m = $data->month_count + 1;
                    $startDate = Carbon::parse($data->start_date)->addMonth($m-1);
                    $endDate = Carbon::parse($data->start_date)->addMonth($m);
                }

                $daysDifference = $endDate->diffInDays($startDate);
                $user_per_day_roi = round(($data->installment_amount_per_month / $daysDifference), 2);

                $user = User::find($data->user_id);
                if ($user) {
                    $user->account_balance += $user_per_day_roi;
                    $user->update();

                    // Log the transaction
                    $transaction->make_transaction(
                        $data->user_id,
                        $user_per_day_roi,
                        'ROI Daily',
                        1,
                        Carbon::parse($date)->format('Y-m-d H:i:s'),
                        Carbon::parse($date)->format('Y-m-d H:i:s')
                    );

                    $top_up = TopUp::find($data->id);
                    if ($top_up) {
                        $top_up->total_disbursed_amount += $user_per_day_roi;

                        if(($date->format('Y-m-d') != $data->start_date) && ($date->day == Carbon::parse($data->start_date)->day)) {
                            $top_up->month_count += 1;
                        }

                        if ($top_up->month_count == $top_up->total_installment_month) {
                            $top_up->is_completed = 1;
                            $top_up->end_date = now();
                        }

                        $top_up->save();
                    }

                    $levelBonusService->level_bonus($user->agent_id, $data->total_amount, $data->total_installment_month, $date, $daysDifference, 1);
                }
            }
        }
    }
}
