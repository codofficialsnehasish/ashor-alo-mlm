<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\TopUp;
use App\Services\LevelBonusService;
use Illuminate\Bus\Queueable;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ForcelyProcessWeeklyLevelBonusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactions;
    protected $levelBonusService;
    protected $start_date;
    protected $end_date;

    /**
     * Create a new job instance.
     *
     * @param $transactions
     * @param LevelBonusService $levelBonusService
     */
    public function __construct($transactions) //
    {
        $this->transactions = $transactions;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->levelBonusService = app(LevelBonusService::class); // Using Laravel's service container to resolve the service
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->transactions as $key => $value) {

            $income_data = TopUp::where('user_id',$key)->get();
            \Log::info("message ".$key);

            foreach($income_data as $data){
                // $days = get_day_for_level($data->start_date,$data->end_date,$this->start_date, $this->end_date);
                $lastSaturday = Carbon::createFromFormat('Y-m-d', $this->start_date);
                $today = Carbon::createFromFormat('Y-m-d', $this->end_date);

                // Top-up start and end dates
                $topUpStartDate = Carbon::createFromFormat('Y-m-d', $data->start_date);
                // $topUpEndDate = Carbon::createFromFormat('Y-m-d', $tend_date);
                $topUpEndDate = $data->end_date ? Carbon::createFromFormat('Y-m-d H:i:s', $data->end_date) : null;

                // Calculate day difference based on the conditions
                if ($topUpStartDate->greaterThan($lastSaturday)) {
                    // Case 1: Top-up starts after last Saturday
                    $start = $topUpStartDate;
                    $end = $today;
                } elseif ($topUpEndDate && $topUpEndDate->lessThan($today)) {
                    // Case 2: Top-up ends before today and topUpEndDate is not null
                    $start = $lastSaturday;
                    $end = $topUpEndDate;
                } else {
                    // Case 3: Overlap between last Saturday and today
                    $start = $lastSaturday;
                    $end = $topUpEndDate ? $topUpEndDate : $today; // Use today if topUpEndDate is null
                }

                // Calculate day difference
                $days = $start->diffInDays($end) + 1;







                $user = User::find($data->user_id);
                // $weeklyPayment = ($data->installment_amount_per_month / get_days_in_this_month()) * $value;
                // $weeklyPayment = ($data->total_amount / get_days_in_this_month()) * $value;
                $weeklyPayment = ($data->total_amount / get_days_in_this_month()) * $days;
                $weeklyPayment = round($weeklyPayment, 2);

                // Output the weekly payment
                // echo "<br>".$weeklyPayment."<br>";
                if($user){
                    $this->levelBonusService->forcefully_weekly_level_bonus($user->agent_id,$weeklyPayment,1,$this->end_date,$user->id); //
                }
            }
        }
    }
}
