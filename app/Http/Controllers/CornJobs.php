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
use App\Models\Payout;
use App\Models\RemunerationBenefit;
use App\Models\SalaryBonus;


use App\Models\DummyCornTest;

use App\Services\LevelBonusService;
use App\Jobs\ProcessWeeklyLevelBonusJob;
use App\Jobs\ForcelyDisburseRoiJob;
use App\Jobs\DisburseRoiJob;
use App\Jobs\ForcelyGeneratePayoutJob;
use App\Jobs\GeneratePayoutJob;
use App\Jobs\ForcelyProcessWeeklyLevelBonusJob;

use App\Jobs\DummyJob;

class CornJobs extends Controller
{
    protected $transaction;
    protected $levelBonusService;
    public function __construct(AccountTransaction $transaction,LevelBonusService $levelBonusService){
        $this->transaction = $transaction;
        $this->levelBonusService = $levelBonusService;
    }

    /*public function disburse_roi(){ //ROI = Return of Invesment
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
            // $daysDifference = $endDate->diffInDays($startDate) + 1;
            $daysDifference = $endDate->diffInDays($startDate);
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


            // $this->levelBonusService->level_bonus($user->agent_id,$data->total_amount,$data->total_installment_month,$data->start_date,$daysDifference,1);
            // ProcessLevelBonus::dispatch($user->agent_id, $data->total_amount,$data->total_installment_month,$data->start_date);
        }

    }*/

    public function disburse_roi(){ //ROI = Return of Invesment
        $this->process_direct_bonus();

        $income_data = TopUp::where('is_completed',0)
                    ->Where('total_installment_month','>=','month_count')
                    ->whereDate('start_date','!=',date('Y-m-d'))
                    ->get();

        DisburseRoiJob::dispatch($income_data);
    } // tested 29-11-2024

    /*public function forcely_disburse_roi() {
        $income_data = TopUp::where('is_completed', 0)
                    ->Where('total_installment_month', '>', 'month_count')
                    ->get();
        // ini_set('max_execution_time', 600);
        // ini_set('memory_limit', '256M');
        // $income_data = TopUp::whereBetween('id', [1, 2])->get();

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
        
                $this->levelBonusService->level_bonus($user->agent_id,$data->total_amount,$data->total_installment_month,$data->start_date,$daysDifference, 1);
            }
    
        }
    }*/



    /*public function forcely_disburse_roi() {
        $income_data = TopUp::where('is_completed', 0)
                    ->Where('total_installment_month', '>', 'month_count')
                    ->get();

        ForcelyDisburseRoiJob::dispatch($income_data);
    }*/


    public function forcely_disburse_roi() {
        $startDate = Carbon::create(2024, 12, 19);
        $endDate = Carbon::create(2024, 12, 20);
        // $endDate = Carbon::now();
        $dates = [];
        // while ($startDate->lte($endDate)) {
        while ($startDate->lt($endDate)) {
            $dates[] = $startDate->toDateString(); // Add the current date to the array
            break;
            $startDate->addDay(); // Move to the next day
        }

        // return $dates;

        // Output the dates
        foreach ($dates as $date) {
            // echo $date . "<br>";
            $this->forcely_process_direct_bonus($date);

            $income_data = TopUp::where('is_completed',0)
                        ->Where('total_installment_month','>=','month_count')
                        // ->whereDate('start_date','!=',$date)
                        ->whereDate('start_date', '<', $date)
                        ->get();

            DisburseRoiJob::dispatch($income_data);
            // ForcelyDisburseRoiJob::dispatch($income_data,$date);
            
        }
    }
    


    public function process_direct_bonus(){
        $today_join_users = TopUp::whereDate('created_at',date('Y-m-d'))->where('is_provide_direct',1)->get();

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

                    $transactionAdded = $this->transaction->make_transaction(
                        $agent->id,
                        $user_bonus,
                        'Direct Bonus',
                        1,
                        $custo->id
                    );

                    // if(check_limit($agent->id)){
                    //     if(get_user_limit($agent->id) > ($agent->account_balance + $user_bonus) ){
                    //         $agent->account_balance += $user_bonus;
                    //         // Direct Bonus transaction
                    //         $transactionAdded = $this->transaction->make_transaction(
                    //             $agent->id,
                    //             $user_bonus,
                    //             'Direct Bonus',
                    //             1
                    //         );
                    //     }else{
                    //         $gap = get_user_limit($agent->id) - $agent->account_balance;
                    //         $agent->account_balance += $gap;
                    //         $transactionAdded = $this->transaction->make_transaction(
                    //             $agent->id,
                    //             $gap,
                    //             'Direct Bonus',
                    //             1
                    //         );
                    //         $user_bonus = abs($user_bonus - $gap); 
                    //         $agent->hold_balance += $user_bonus;
                    //         $transactionAdded = $this->transaction->make_transaction(
                    //             $agent->id,
                    //             $user_bonus,
                    //             'Direct Bonus on Hold',
                    //             1
                    //         );
                    //     }
                    // }else{
                    //     $agent->hold_balance += $user_bonus;
                    //     $transactionAdded = $this->transaction->make_transaction(
                    //         $agent->id,
                    //         $user_bonus,
                    //         'Direct Bonus on Hold',
                    //         1
                    //     );
                    // }

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

    
    public function forcely_process_direct_bonus($date){
        // $today_join_users = TopUp::all();
        $today_join_users = TopUp::whereDate('created_at',$date)->where('is_provide_direct',1)->get();

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


                    $transactionAdded = $this->transaction->make_transaction(
                        $agent->id,
                        $user_bonus,
                        'Direct Bonus',
                        1,
                        $custo->id,
                        // Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                        // Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    );



                    // if(check_limit($agent->id)){
                    //     if(get_user_limit($agent->id) > ($agent->account_balance + $user_bonus) ){
                    //         $agent->account_balance += $user_bonus;
                    //         // Direct Bonus transaction
                    //         $transactionAdded = $this->transaction->make_transaction(
                    //             $agent->id,
                    //             $user_bonus,
                    //             'Direct Bonus',
                    //             1,
                    //             Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //             Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //         );
                    //     }else{
                    //         $gap = get_user_limit($agent->id) - $agent->account_balance;
                    //         $agent->account_balance += $gap;
                    //         $transactionAdded = $this->transaction->make_transaction(
                    //             $agent->id,
                    //             $gap,
                    //             'Direct Bonus',
                    //             1,
                    //             Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //             Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //         );
                    //         $user_bonus = abs($user_bonus - $gap); 
                    //         $agent->hold_balance += $user_bonus;
                    //         $transactionAdded = $this->transaction->make_transaction(
                    //             $agent->id,
                    //             $user_bonus,
                    //             'Direct Bonus on Hold',
                    //             1,
                    //             Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //             Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //         );
                    //     }
                    // }else{
                    //     $agent->hold_balance += $user_bonus;
                    //     $transactionAdded = $this->transaction->make_transaction(
                    //         $agent->id,
                    //         $user_bonus,
                    //         'Direct Bonus on Hold',
                    //         1,
                    //         Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //         Carbon::parse($join_data->start_date)->format('Y-m-d H:i:s'),
                    //     );
                    // }


                    $agent->update();
                }
            }
        }
    }




    /*public function level_bonus_in_saturday_to_friday(){
        $today = Carbon::now();
        $lastSaturday = $today->isSaturday() ? $today : $today->previous(Carbon::SATURDAY); // Get last Saturday's date
        $current_day = Carbon::now();

        // $acc_transactions = AccountTransaction::whereBetween(DB::raw('DATE(created_at)'),[format_date_for_db($lastSaturday), format_date_for_db($current_day)])
        //                                         ->where('which_for', 'ROI Daily')
        //                                         ->distinct() // Ensure distinct user_id
        //                                         ->pluck('user_id');

        $acc_transactions = AccountTransaction::whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                                                ->where('which_for', 'ROI Daily')
                                                ->select('user_id', DB::raw('DATE(created_at) as payment_date'))
                                                ->distinct()
                                                ->get()
                                                ->groupBy('user_id')
                                                ->map(function ($transactions) {
                                                    return $transactions->pluck('payment_date')->unique()->count();
                                                });


        foreach ($acc_transactions as $key => $value) {

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
    }*/

    public function level_bonus_in_saturday_to_friday() {
        // if (Carbon::now()->isFriday()) {
                $today = Carbon::now();
                $lastSaturday = $today->isSaturday() ? $today : $today->previous(Carbon::SATURDAY); // Get last Saturday's date
                $current_day = Carbon::now();
            
                // Process in chunks and dispatch each chunk to a queue job
                $acc_transactions = AccountTransaction::whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                    ->where('which_for', 'ROI Daily')
                    ->select('user_id', DB::raw('DATE(created_at) as payment_date'))
                    ->distinct()
                    ->get()
                    ->groupBy('user_id')
                    ->map(function ($transactions) {
                        return $transactions->pluck('payment_date')->unique()->count();
                    });

                ProcessWeeklyLevelBonusJob::dispatch($acc_transactions);
        // }else{
        //     return 'today in not friday';
        // }
    }  // tested 29-11-2024

    public function forcely_level_bonus_in_saturday_to_friday() {
        $start_date = '2024-11-16';
        $lastFriday = '2024-11-22';
        $acc_transactions = AccountTransaction::whereBetween(DB::raw('DATE(created_at)'), [$start_date, $lastFriday])
            ->where('which_for', 'ROI Daily')
            ->select('user_id', DB::raw('DATE(created_at) as payment_date'))
            ->distinct()
            ->get()
            ->groupBy('user_id')
            ->map(function ($transactions) {
                return $transactions->pluck('payment_date')->unique()->count();
            });
        // return $acc_transactions; die;

        ForcelyProcessWeeklyLevelBonusJob::dispatch($acc_transactions, $lastFriday);
    }   
    
    public function generate_payout_in_saturday_to_friday() {
        // if (Carbon::now()->isFriday()) {
            $today = Carbon::now();
            $lastSaturday = $today->isSaturday() ? $today : $today->previous(Carbon::SATURDAY); // Get last Saturday's date
            $current_day = Carbon::now();

            // $mlm_settings = MLMSettings::first();
            // $total_deduction = $mlm_settings->tds + $mlm_settings->repurchase;
        
            $transactions = AccountTransaction::whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
            ->groupBy('user_id')
            ->pluck('user_id');

            /*foreach($transactions as $user_id){
                $user = User::find($user_id);
                if($user){
                    $total_top_up_amount = TopUp::where('user_id',$user_id)->sum('total_amount');
                    // if($total_top_up_amount > 0){
                        $limit = $total_top_up_amount * 10;

                        $remuneration_salary = 0;
                        // Remuneration Benefits or Salary Income
                        if ($current_day->day <= 7) {
                            $total_left_business = calculate_left_business($user_id);
                            $total_right_business = calculate_right_business($user_id);

                            $achieved_target = RemunerationBenefit::where('target', '<=', $total_left_business)
                                                ->where('target', '<=', $total_right_business)
                                                ->orderBy('target', 'DESC')
                                                ->first();

                            if($achieved_target){
                                if(SalaryBonus::where('user_id',$user_id)->exists()){
                                    $salary = SalaryBonus::where('user_id',$user_id)->first();
                                    if($achieved_target->id == $salary->remuneration_benefit_id && $salary->month_count <= $achieved_target->month_validity){
                                        $salary->month_count += 1;
                                        $remuneration_salary = $achieved_target->bonus;
                                        $salary->update();
                                    }
                                }else{
                                    $salary = new SalaryBonus();
                                    $salary->user_id = $user_id;
                                    $salary->remuneration_benefit_id = $achieved_target->id;
                                    $salary->start_date = date('Y-m-d');
                                    $salary->amount = $achieved_target->bonus;
                                    $salary->month_count = 1;
                                    $salary->save();
                                    $remuneration_salary = $achieved_target->bonus;
                                }
                            }
                        }
        
                        $total_payout = Payout::where('user_id',$user_id)->sum('total_payout');
            
                        $product_return = AccountTransaction::where('which_for','ROI Daily')
                                                                ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                                                                ->where('user_id',$user_id)
                                                                ->sum('amount');

                        $product_return_deduction = ($product_return * $mlm_settings->tds) / 100;
                        $total_product_return = $product_return - $product_return_deduction;
            
                        $direct_bonus = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                                                            ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                                                            ->where('user_id', $user_id)
                                                            ->sum('amount');
            
                        
                        $lavel_bonus = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                                                            ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                                                            ->where('user_id', $user_id)
                                                            ->sum('amount');
                        
                        $comission = $direct_bonus + $lavel_bonus + $remuneration_salary;
                        $deduction = ($comission * $total_deduction) / 100; // 15% of the deduction
                        $final_commission = $comission - $deduction;
        
                        $current_payout = $user->hold_balance + $final_commission;

                        
                        
                        $payout = new Payout();
                        $payout->user_id = $user_id;
                        $payout->start_date = $lastSaturday;
                        $payout->end_date = $current_day;
                        $payout->tds_persentage = $mlm_settings->tds;
                        $payout->repurchase_persentage = $mlm_settings->repurchase;
                        $payout->service_charge_persentage = $mlm_settings->tds;

                        $payout->direct_bonus = $direct_bonus;
                        $payout->direct_bonus_tds_deduction = $direct_bonus * ($mlm_settings->tds/100);
                        $payout->direct_bonus_repurchase_deduction = $direct_bonus * ($mlm_settings->repurchase/100);

                        $payout->lavel_bonus = $lavel_bonus;
                        $payout->lavel_bonus_tds_deduction = $lavel_bonus * ($mlm_settings->tds/100);
                        $payout->lavel_bonus_repurchase_deduction = $lavel_bonus * ($mlm_settings->repurchase/100);

                        // Checking for hold amount
                        if(($limit - ($current_payout + $total_payout)) >= 0){
                            // if($user->id == 4){
                            //     echo $user->hold_balance; die;
                            // }
                            // then pay the hold amount
                            $payout->hold_amount_added = $user->hold_balance;
                            $user->hold_balance = 0;
                        }else{
                            // after limit hold
                            $payout->hold_amount = abs($limit - ($current_payout + $total_payout));
                            $user->hold_balance += $payout->hold_amount;
                        }

                        $payout->remuneration_bonus = $remuneration_salary;
                        $payout->remuneration_bonus_tds_deduction = $remuneration_salary * ($mlm_settings->tds/100);
                        $payout->remuneration_bonus_repurchase_deduction = $remuneration_salary * ($mlm_settings->repurchase/100);
        
                        $payout->roi = $product_return;
                        $payout->roi_tds_deduction = $product_return_deduction;
        
                        // $payout->total_payout = ($total_product_return + (($payout->hold_amount_added + $final_commission) - $payout->hold_amount)) ?? 0 ;
                        $payout->total_payout = max(0, ($total_product_return + (($payout->hold_amount_added + $final_commission) - $payout->hold_amount))) ?? 0;

                        $payout->save();

                        $user->repurchase_wallet = $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction;

                        $user->update();

                        $account = Account::first();
                        $account->tds_balance += $payout->direct_bonus_tds_deduction + $payout->lavel_bonus_tds_deduction + $payout->remuneration_bonus_tds_deduction;
                        $account->repurchase_balance += $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction;
                        $account->update();

                        TDSAccount::create([
                            'user_id'=>$user->id,
                            'amount'=>$payout->direct_bonus_tds_deduction + $payout->lavel_bonus_tds_deduction + $payout->remuneration_bonus_tds_deduction,
                            'which_for'=>'Deducting from Payout',
                            'status'=>1
                        ]);
                        RepurchaseAccount::create([
                            'user_id'=>$user->id,
                            'amount'=>$payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction,
                            'which_for'=>'Deducting from Payout',
                            'status'=>1
                        ]);
                    // }
                }
            }*/

            GeneratePayoutJob::dispatch($transactions, $lastSaturday, $current_day);
        // }else{
        //     return 'today in not friday';
        // }
    } // tested 29-11-2024

    public function forcely_generate_payout() {
        $start_date = '2024-11-16';
        $lastFriday = '2024-11-22';
        $transactions = AccountTransaction::whereBetween(DB::raw('DATE(created_at)'), [$start_date, $lastFriday])
                                            ->groupBy('user_id')
                                            ->pluck('user_id');

        ForcelyGeneratePayoutJob::dispatch($transactions, $start_date, $lastFriday);
    }








    public function hold_wallet_replace_for_one_time(){
        // Query 1
        // SELECT user_id,SUM(hold_wallet) as total_hold, COUNT(*) AS row_count FROM `payouts` GROUP BY user_id;

        // Query 2
        // SELECT user_id, SUM(hold_wallet) AS total_hold, COUNT(*) AS row_count FROM payouts GROUP BY user_id HAVING total_hold > 0 AND row_count > 1;

        $results = Payout::selectRaw('user_id, SUM(hold_wallet) as total_hold, COUNT(*) as row_count')
                        ->groupBy('user_id')
                        ->havingRaw('total_hold > 0')
                        ->havingRaw('row_count > 1')
                        ->get();
        // return $results;
        foreach($results as $result){
            $user = User::find($result->user_id);
            $user->hold_wallet = $result->total_hold;
            $user->update();
        }

        echo 'success';
    }
    

    public function dummy_corn_test(){
        // DummyJob::dispatch();
    }
}
