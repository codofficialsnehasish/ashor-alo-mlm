<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\TopUp;
use App\Models\AccountTransaction;
use Carbon\Carbon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DisburseRoiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $income_data;
    // protected $date;
    /**
     * Create a new job instance.
     */
    public function __construct($income_data) //,$date
    {
        $this->income_data = $income_data;
        // $this->date = $date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $transaction = app(AccountTransaction::class);

        foreach($this->income_data as $data){
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
            // $user_per_day_roi = $data->installment_amount_per_month / $daysDifference;

            $user = User::find($data->user_id);
            if($user){
                $user->account_balance += $user_per_day_roi;
                $user->update();
            }
            
            $is_transacted = 0;
            if($data->is_personal_business != 1){
                if($data->is_provide_direct == 0 && $data->is_personal_business != 1 ){
                    if(!AccountTransaction::where('user_id',$data->user_id)->where('which_for','ROI Dailys')->whereDate('created_at',date('Y-m-d'))->where('topup_id',$data->id)->exists()){
                        $transaction->make_transaction(
                            $data->user_id,
                            $user_per_day_roi,
                            'ROI Dailys',
                            1,
                            null,
                            $data->id,
                        );
    
                        $is_transacted = 1;
                    }
                }else{
                    if(!AccountTransaction::where('user_id',$data->user_id)->where('which_for','ROI Daily')->whereDate('created_at',date('Y-m-d'))->where('topup_id',$data->id)->exists()){
                        $transaction->make_transaction(
                            $data->user_id,
                            $user_per_day_roi,
                            'ROI Daily',
                            1,
                            null,
                            $data->id,
                            // Carbon::parse($this->date)->format('Y-m-d H:i:s'),
                            // Carbon::parse($this->date)->format('Y-m-d H:i:s'),
                        );
                        $is_transacted = 1;
                    }
                }
            }

            if($is_transacted){
                $top_up = TopUp::find($data->id);
                if(Carbon::now()->day == Carbon::parse($data->start_date)->day){
                    $top_up->month_count += 1;
                }
                $top_up->total_disbursed_amount += $user_per_day_roi;
                if($top_up->month_count == $top_up->total_installment_month){
                    $top_up->is_completed = 1;
                    $top_up->end_date = now();
                }
                $top_up->save();
            }
        }
    }
}
