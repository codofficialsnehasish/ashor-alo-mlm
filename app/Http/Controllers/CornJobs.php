<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User; 
use App\Models\TopUp; 
use App\Models\MonthlyReturn;
use App\Models\AccountTransaction;

use App\Services\LevelBonusService;
use App\Jobs\ProcessLevelBonus;

class CornJobs extends Controller
{
    protected $transaction;
    protected $levelBonusService;
    public function __construct(AccountTransaction $transaction,LevelBonusService $levelBonusService){
        $this->transaction = $transaction;
        $this->levelBonusService = $levelBonusService;
    }

    public function disburse_product_support(){
        $currentDay = Carbon::now()->day;
        $income_data = TopUp::where('is_completed',0)
                    ->orWhere('total_disbursed_amount','<',DB::raw('total_amount * 2'))
                    ->whereDate('start_date','!=',date('Y-m-d'))
                    ->whereDay('start_date',$currentDay)
                    ->get();
        foreach($income_data as $data){
            $percentage = MonthlyReturn::where('form_amount', '<=', $data->total_amount)
                              ->where('to_amount', '>=', $data->total_amount)
                              ->first();
            $top_up = TopUp::find($data->id);
            $top_up->month_count += 1;
            $top_up->total_disbursed_amount += ($percentage->percentage / 100) * $data->total_amount;
            if($top_up->total_disbursed_amount >= ($top_up->total_amount * 2) ){
                $top_up->is_completed = 1;
                $top_up->end_date = now();
            }
            $top_up->save();
            $user = User::find($data->user_id);
            $user->account_balance += ($percentage->percentage / 100) * $data->total_amount;
            $user->update();
        }
    }

    public function disburse_roi(){ //ROI = Return of Invesment
        $income_data = TopUp::where('is_completed',0)
                    ->Where('total_installment_month','>','month_count')
                    // ->whereDate('start_date','!=',date('Y-m-d'))
                    ->get();

        foreach($income_data as $data){
            if($data->month_count == 0){
                $startDate = Carbon::parse($data->start_date);
                $endDate = Carbon::parse($data->start_date)->addMonth($data->month_count+1);
            }else{
                $m = $data->month_count + 1;
                $startDate = Carbon::parse($data->start_date)->addMonth($m-1);
                $endDate = Carbon::parse($data->start_date)->addMonth($m);
            }
            $daysDifference = $endDate->diffInDays($startDate) + 1;
            // $user_per_day_roi = number_format($data->installment_amount_per_month / $daysDifference,2);
            $user_per_day_roi = $data->installment_amount_per_month / $daysDifference;
            $user = User::find($data->user_id);
            $user->account_balance += $user_per_day_roi;
            $user->update();
            $transactionAdded = $this->transaction->make_transaction(
                $data->user_id,
                $user_per_day_roi,
                'ROI Daily',
                1
            );

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


            $this->levelBonusService->level_bonus($user->agent_id,$data->total_amount,$data->total_installment_month,$data->start_date);
            // ProcessLevelBonus::dispatch($user->agent_id, $data->total_amount,$data->total_installment_month,$data->start_date);
        }

    }
    

}
