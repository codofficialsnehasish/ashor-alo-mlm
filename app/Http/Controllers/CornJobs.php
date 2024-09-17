<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User; 
use App\Models\TopUp; 
use App\Models\MonthlyReturn;
use App\Models\AccountTransaction;
use App\Models\TDSAccount;
use App\Models\RepurchaseAccount;
use App\Models\Account;
use App\Models\MLMSettings;

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

    // public function disburse_product_support(){
    //     $currentDay = Carbon::now()->day;
    //     $income_data = TopUp::where('is_completed',0)
    //                 ->orWhere('total_disbursed_amount','<',DB::raw('total_amount * 2'))
    //                 ->whereDate('start_date','!=',date('Y-m-d'))
    //                 ->whereDay('start_date',$currentDay)
    //                 ->get();
    //     foreach($income_data as $data){
    //         $percentage = MonthlyReturn::where('form_amount', '<=', $data->total_amount)
    //                           ->where('to_amount', '>=', $data->total_amount)
    //                           ->first();
    //         $top_up = TopUp::find($data->id);
    //         $top_up->month_count += 1;
    //         $top_up->total_disbursed_amount += ($percentage->percentage / 100) * $data->total_amount;
    //         if($top_up->total_disbursed_amount >= ($top_up->total_amount * 2) ){
    //             $top_up->is_completed = 1;
    //             $top_up->end_date = now();
    //         }
    //         $top_up->save();
    //         $user = User::find($data->user_id);
    //         $user->account_balance += ($percentage->percentage / 100) * $data->total_amount;
    //         $user->update();
    //     }
    // }

    public function disburse_roi(){ //ROI = Return of Invesment
        $this->process_direct_bonus();

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
            $user_per_day_roi = round(($data->installment_amount_per_month / $daysDifference),2);
            // $user_per_day_roi = $data->installment_amount_per_month / $daysDifference;
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

    public function forcely_disburse_roi() {
        $income_data = TopUp::where('is_completed', 0)
                    ->Where('total_installment_month', '>', 'month_count')
                    ->get();
    
        foreach($income_data as $data){
            // Initialize variables for iteration
            $startDate = Carbon::parse($data->start_date);
            $currentDate = Carbon::now()->subDay(); // Current date minus one day
    
            // Ensure we don't calculate for future dates
            if ($startDate->greaterThanOrEqualTo($currentDate)) {
                continue;
            }
    
            $totalDisbursed = 0;
    
            // Loop through each day between the start date and the current date minus 1
            for ($date = $startDate; $date->lessThanOrEqualTo($currentDate); $date->addDay()) {
                // Calculate the current month count based on the loop date
                $monthCount = $date->diffInMonths($startDate) + 1;
                $endDate = Carbon::parse($data->start_date)->addMonth($monthCount);
    
                // Calculate ROI per day
                $daysDifference = $endDate->diffInDays($startDate) + 1;
                $user_per_day_roi = round(($data->installment_amount_per_month / $daysDifference),2);
    
                // Update user account balance
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
        
                if($user->agent_id != null){
                    $this->levelBonusService->level_bonus($user->agent_id,$data->total_amount,$data->total_installment_month,$data->start_date);
                }
            }
    
        }
    }
    


    public function process_direct_bonus(){
        $today_join_users = TopUp::whereDate('created_at',date('Y-m-d'))->get();

        foreach($today_join_users as $join_data){
            $custo = User::find($join_data->user_id);
            if(User::where('user_id',$custo->agent_id)->exists()){
                $agent = User::where('user_id',$custo->agent_id)->first();
                if($agent->status == 1){
                    
                    //Direct Bonus
                    $mlm_settings = MLMSettings::first();
                    $user_bonus = ($join_data->total_amount * ($mlm_settings->agent_direct_bonus/100));
                    // $tds_amount = $user_bonus * ($mlm_settings->tds/100);
                    // $repurchase_amount = $user_bonus * ($mlm_settings->repurchase/100);
                    // $user_bonus -= $tds_amount+$repurchase_amount;
                    if(check_limit($agent->id)){
                        if(get_user_limit($agent->id) > ($agent->account_balance + $user_bonus) ){
                            $agent->account_balance += $user_bonus;
                            // Direct Bonus transaction
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $user_bonus,
                                'Direct Bonus',
                                1
                            );
                        }else{
                            $gap = get_user_limit($agent->id) - $agent->account_balance;
                            $agent->account_balance += $gap;
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $gap,
                                'Direct Bonus',
                                1
                            );
                            $user_bonus = abs($user_bonus - $gap); 
                            $agent->hold_balance += $user_bonus;
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $user_bonus,
                                'Direct Bonus on Hold',
                                1
                            );
                        }
                    }else{
                        $agent->hold_balance += $user_bonus;
                        $transactionAdded = $this->transaction->make_transaction(
                            $agent->id,
                            $user_bonus,
                            'Direct Bonus on Hold',
                            1
                        );
                    }
                    $agent->update();
        
                    
                    // $account = Account::first();
                    // $account->tds_balance += $tds_amount;
                    // $account->repurchase_balance += $repurchase_amount;
                    // $account->update();
                    // TDSAccount::create([
                    //     'user_id'=>$agent->id,
                    //     'amount'=>$tds_amount,
                    //     'which_for'=>'Deducting from Direct bonus',
                    //     'status'=>1
                    // ]);
                    // RepurchaseAccount::create([
                    //     'user_id'=>$agent->id,
                    //     'amount'=>$repurchase_amount,
                    //     'which_for'=>'Deducting from Direct bonus',
                    //     'status'=>1
                    // ]);
                }
            }
        }
    }

    
    public function forcely_process_direct_bonus(){
        $today_join_users = TopUp::all();

        foreach($today_join_users as $join_data){
            $custo = User::find($join_data->user_id);
            if(User::where('user_id',$custo->agent_id)->exists()){
                $agent = User::where('user_id',$custo->agent_id)->first();
                if($agent->status == 1){
                    
                    //Direct Bonus
                    $mlm_settings = MLMSettings::first();
                    $user_bonus = ($join_data->total_amount * ($mlm_settings->agent_direct_bonus/100));
                    // $tds_amount = $user_bonus * ($mlm_settings->tds/100);
                    // $repurchase_amount = $user_bonus * ($mlm_settings->repurchase/100);
                    // $user_bonus -= $tds_amount+$repurchase_amount;
                    if(check_limit($agent->id)){
                        if(get_user_limit($agent->id) > ($agent->account_balance + $user_bonus) ){
                            $agent->account_balance += $user_bonus;
                            // Direct Bonus transaction
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $user_bonus,
                                'Direct Bonus',
                                1
                            );
                        }else{
                            $gap = get_user_limit($agent->id) - $agent->account_balance;
                            $agent->account_balance += $gap;
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $gap,
                                'Direct Bonus',
                                1
                            );
                            $user_bonus = abs($user_bonus - $gap); 
                            $agent->hold_balance += $user_bonus;
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $user_bonus,
                                'Direct Bonus on Hold',
                                1
                            );
                        }
                    }else{
                        $agent->hold_balance += $user_bonus;
                        $transactionAdded = $this->transaction->make_transaction(
                            $agent->id,
                            $user_bonus,
                            'Direct Bonus on Hold',
                            1
                        );
                    }
                    $agent->update();
                }
            }
        }
    }
}
