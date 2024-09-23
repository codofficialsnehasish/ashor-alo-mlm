<?php
namespace App\Jobs;

use App\Models\TopUp;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTopUpROI implements ShouldQueue
{
    protected $topUp;

    public function __construct(TopUp $topUp)
    {
        $this->topUp = $topUp;
    }

    public function handle()
    {
        $data = $this->topUp;

        $startDate = Carbon::parse($data->start_date);
        $currentDate = Carbon::now()->subDay(); // Current date minus one day

        // Ensure we don't calculate for future dates
        // if ($startDate->greaterThanOrEqualTo($currentDate)) {
        //     continue;
        // }

        // $totalDisbursed = 0;

        // // Loop through each day between the start date and the current date minus 1
        for ($date = $startDate; $date->lessThanOrEqualTo($currentDate); $date->addDay()) {
            // Calculate the current month count based on the loop date
            if($data->month_count == 0){
                $startDate = Carbon::parse($data->start_date);
                $endDate = Carbon::parse($data->start_date)->addMonth($data->month_count+1);
            }else{
                $m = $data->month_count + 1;
                $startDate = Carbon::parse($data->start_date)->addMonth($m-1);
                $endDate = Carbon::parse($data->start_date)->addMonth($m);
            }
            // $daysDifference = $endDate->diffInDays($startDate) + 1;
            $daysDifference = $endDate->diffInDays($startDate);

            $user_per_day_roi = round(($data->installment_amount_per_month / $daysDifference),2);

            $user = User::find($data->user_id);
            $user->account_balance += $user_per_day_roi;
            $user->update();

            // Log the transaction
            $this->transaction->make_transaction(
                $data->user_id,
                $user_per_day_roi,
                'ROI Daily',
                1
            );

            // $totalDisbursed += $user_per_day_roi;
            // Update top-up data after processing all days
            $top_up = TopUp::find($data->id);
            $top_up->total_disbursed_amount += $user_per_day_roi;
            
            // Update month count if it's the start date of the next month
            if(($date->format('Y-m-d') !=$data->start_date) && ($date->day == Carbon::parse($data->start_date)->day)){
                $top_up->month_count += 1;
            }         
    
            // Mark as completed if all installments are disbursed
            if ($top_up->month_count == $top_up->total_installment_month) {
                $top_up->is_completed = 1;
                $top_up->end_date = now();
            }
    
            $top_up->save();
    
            $this->levelBonusService->level_bonus($user->agent_id,$data->total_amount,$data->total_installment_month,$data->start_date, 1);
        }
    }
}
