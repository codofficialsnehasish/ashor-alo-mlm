<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\TopUp;
use App\Services\LevelBonusService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWeeklyLevelBonusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactions;
    protected $levelBonusService;

    /**
     * Create a new job instance.
     *
     * @param $transactions
     * @param LevelBonusService $levelBonusService
     */
    public function __construct($transactions)
    {
        $this->transactions = $transactions;
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

            foreach($income_data as $data){
                $user = User::find($data->user_id);
                $weeklyPayment = ($data->installment_amount_per_month / get_days_in_this_month()) * $value;
                $weeklyPayment = round($weeklyPayment, 2);

                // Output the weekly payment
                // echo "<br>".$weeklyPayment."<br>";
                $this->levelBonusService->weekly_level_bonus($user->agent_id,$weeklyPayment,1);
            }
        }
    }
}
