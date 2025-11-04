<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;


use App\Models\User; 
use App\Models\TopUp; 
use App\Models\MonthlyReturn;
use App\Models\AccountTransaction;
use App\Models\TDSAccount;
use App\Models\ServiceChargeAccount;
use App\Models\RepurchaseAccount;
use App\Models\Account;
use App\Models\MLMSettings;
use App\Models\Payout;
use App\Models\RemunerationBenefit;
use App\Models\SalaryBonus;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class GeneratePayoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactions;
    protected $lastSaturday;
    protected $current_day;
    /**
     * Create a new job instance.
     */
    public function __construct($transactions,$lastSaturday, $current_day)
    {
        $this->transactions = $transactions;
        $this->lastSaturday = $lastSaturday;
        $this->current_day = $current_day;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $transaction = app(AccountTransaction::class);

        foreach($this->transactions as $user_id){
            if(!Payout::where('user_id',$user_id)->whereDate('end_date',$this->current_day)->exists()){
                // Log::info("user_id ".$user_id.", end_date ".$this->current_day);
                $mlm_settings = MLMSettings::first();
                $total_deduction = $mlm_settings->tds + $mlm_settings->repurchase;

                $user = User::find($user_id);
                if($user){
                    //calculating the limit
                    $total_top_up_amount = TopUp::where('user_id',$user_id)->sum('total_amount');
                    $limit = $total_top_up_amount * 10;


                    //Personal Income DilSe Plan

                    // $dillse_personal_income = 0;
                    // $dilse_service_charge_deduction = 0;

                    /*$personal_incomes = TopUp::where('user_id',$user_id)->where('is_personal_business',1)->where('is_completed',0)->get();
                    if($personal_incomes->isNotEmpty()){
                        foreach($personal_incomes as $p_income){
                            $date = $p_income->start_date;

                            // $day = Carbon::parse($date)->format('d');
                            $day = Carbon::parse($date)->day;
                            $from = Carbon::parse($this->lastSaturday)->day;
                            $to = Carbon::parse($this->current_day)->day;
                            // Handle month wraparound (e.g., 29 → 1)

                            if ($from > $to) {
                                // Check if $day >= $from (e.g., 29,30,31) OR $day <= $to (e.g., 1,2,...)
                                $isInRange = ($day >= $from) || ($day <= $to);
                            } else {
                                // Normal case (e.g., 1 → 7)
                                $isInRange = ($day >= $from) && ($day <= $to);
                            }
                        
                            if ($isInRange) {
                                $dillse_personal_income = $p_income->installment_amount_per_month;
                                $p_income->month_count += 1;
                                $p_income->total_disbursed_amount += $dillse_personal_income;
                                $p_income->update();
                        
                                $dilse_service_charge_deduction = ($dillse_personal_income * 5) / 100;
                                // $dillse_personal_income -= $dilse_service_charge_deduction;
                            }
                        }
                    }*/

                    //end of personal income



                    $remuneration_salary = 0;

                    // Remuneration Benefits or Salary Income
                    // if ($this->current_day->day <= 7) {
                    if ($this->current_day->day <= 15) {
                        $total_left_business = calculate_left_business($user_id);
                        $total_right_business = calculate_right_business($user_id);

                        $achieved_target = RemunerationBenefit::where('target', '<=', $total_left_business)
                                            ->where('target', '<=', $total_right_business)
                                            ->where('visiblity',1)
                                            ->where('is_deleted',0)
                                            ->orderBy('target', 'DESC')
                                            ->first();

                        if($achieved_target){
                            if(SalaryBonus::where('user_id',$user_id)->exists()){
                                $salary = SalaryBonus::where('user_id',$user_id)->first();
                                if($achieved_target->id == $salary->remuneration_benefit_id && $salary->month_count <= $achieved_target->month_validity){
                                    $salary->month_count += 1;
                                    $salary->amount = $achieved_target->bonus;
                                    $remuneration_salary = $achieved_target->bonus;
                                    $salary->update();

                                    $transaction->make_transaction(
                                        $user_id,
                                        $achieved_target->bonus,
                                        'Salary Bonus',
                                        1
                                    );
                                }else{
                                    if($achieved_target->id != $salary->remuneration_benefit_id){
                                        $salary->remuneration_benefit_id = $achieved_target->id;
                                        $salary->month_count = 1;
                                        $salary->start_date = date('Y-m-d');
                                        $salary->amount = $achieved_target->bonus;
                                        $remuneration_salary = $achieved_target->bonus;
                                        $salary->update();
    
                                        $transaction->make_transaction(
                                            $user_id,
                                            $achieved_target->bonus,
                                            'Salary Bonus',
                                            1
                                        );
                                    }
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

                                $transaction->make_transaction(
                                    $user_id,
                                    $achieved_target->bonus,
                                    'Salary Bonus',
                                    1
                                );
                            }
                        }
                    }
    
                    // $total_payout = Payout::where('user_id',$user_id)->sum('total_payout');
                    $total_paid_payout = Payout::where('user_id',$user_id)->where('paid_unpaid','1')->sum('total_payout');
                    // $total_unpaid_payout = Payout::where('user_id',$user_id)->where('paid_unpaid','0')->sum('total_payout');
                    // $total_payout = Payout::where('user_id',$user_id)->sum('total_payout');
                    $total_payout_roi = Payout::where('user_id',$user_id)->sum('roi');
                    $total_payout_roi_tds = Payout::where('user_id',$user_id)->sum('roi_tds_deduction');

                    // $previous_unpaid_amount = Payout::where('user_id',$user_id)->where('paid_unpaid','0')->latest()->value('total_payout') ?? 0.00;
                    $lastPayout = Payout::where('user_id', $user_id)->latest()->first();

                    $previous_unpaid_amount = $lastPayout ? ($lastPayout->paid_unpaid == '0' ? $lastPayout->total_payout : 0.00) : 0.00;

                    $total_payout = $total_paid_payout + $previous_unpaid_amount;
                    $total_payout -= ($total_payout_roi - $total_payout_roi_tds);
        
                    $product_return = AccountTransaction::where(function ($query) {
                                                                $query->where('which_for', 'ROI Daily')
                                                                    ->orWhere('which_for', 'ROI Dailys');
                                                            })
                                                            ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($this->lastSaturday), format_date_for_db($this->current_day)])
                                                            ->where('user_id',$user_id)
                                                            ->sum('amount');

                    $dilse_return = AccountTransaction::where(function ($query) {
                                                                $query->where('which_for', 'DILSE Daily');
                                                            })
                                                            ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($this->lastSaturday), format_date_for_db($this->current_day)])
                                                            ->where('user_id',$user_id)
                                                            ->sum('amount');

                    $product_return_deduction = ($product_return * $mlm_settings->tds) / 100;
                    $total_product_return = $product_return - $product_return_deduction;

                    // repurchase deduction from investment
                    $product_return_repurchase_deduction =  ($total_product_return * $mlm_settings->repurchase ) / 100;
                    $total_product_return = $total_product_return - $product_return_repurchase_deduction;

                    $dilse_return_deduction = ($dilse_return * $mlm_settings->tds) / 100;
                    $total_dilse_return = $dilse_return - $dilse_return_deduction;
        
                    $direct_bonus = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                                                        ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($this->lastSaturday), format_date_for_db($this->current_day)])
                                                        ->where('user_id', $user_id)
                                                        ->sum('amount');
        
                    
                    $lavel_bonus = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                                                        ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($this->lastSaturday), format_date_for_db($this->current_day)])
                                                        ->where('user_id', $user_id)
                                                        ->sum('amount');
                    
                    $comission = $direct_bonus + $lavel_bonus + $remuneration_salary;
                    $deduction = ($comission * $total_deduction) / 100; // 15% of the deduction
                    $final_commission = $comission - $deduction;
    
                    $last_hold_amount = Payout::where('user_id', $user->id)->latest()->value('hold_amount') ?? 0;
                    $last_hold_wallet_amount = Payout::where('user_id', $user->id)->latest()->value('hold_wallet') ?? 0;
                    Log::info('last_hold_amount: ' . $last_hold_amount. ' last_hold_wallet_amount '.$last_hold_wallet_amount);
                    // $current_payout = $user->hold_balance + $final_commission + $user->hold_wallet;
                    // $current_payout = $user->hold_balance + $final_commission;
                    $current_payout = $last_hold_amount + $final_commission;

                    
                    
                    $payout = new Payout();
                    $payout->user_id = $user_id;
                    $payout->start_date = $this->lastSaturday;
                    $payout->end_date = $this->current_day;
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
                        // $payout->hold_amount_added = $user->hold_balance;
                        $payout->hold_amount_added = $last_hold_amount; 
                        $user->hold_balance = 0;
                    }else{
                        // after limit hold
                        // $payout->hold_amount = abs($limit - ($current_payout + $total_payout));
                        // $user->hold_balance += $payout->hold_amount;

                        if($limit <= $total_payout){
                            // $payout->hold_amount = $user->hold_balance + $final_commission;
                            $payout->hold_amount = $last_hold_amount + $final_commission;
                            $user->hold_balance += $final_commission;
                        }else{
                            $payout->hold_amount = abs($limit - ($current_payout + $total_payout));
                            $user->hold_balance = $payout->hold_amount;
                        }
                    }

                    $payout->remuneration_bonus = $remuneration_salary;
                    $payout->remuneration_bonus_tds_deduction = $remuneration_salary * ($mlm_settings->tds/100);
                    $payout->remuneration_bonus_repurchase_deduction = $remuneration_salary * ($mlm_settings->repurchase/100);
    
                    $payout->dilse_payout_amount = $dilse_return;   
                    $payout->dilse_service_charge_deduction = $dilse_return_deduction;

                    // $payout->dilse_payout_amount = 0.00;
                    // $payout->dilse_service_charge_deduction = 0.00;

                    $payout->roi = $product_return;
                    $payout->roi_tds_deduction = $product_return_deduction;
                    $payout->roi_repurchase_deduction = $product_return_repurchase_deduction;

                    $payout->previous_unpaid_amount = $previous_unpaid_amount;

                    // $payout->hold_wallet_added = $user->hold_wallet;
                    $payout->hold_wallet_added = $last_hold_wallet_amount;
                    
    
                    // $payout->total_payout = ($total_product_return + (($payout->hold_amount_added + $final_commission) - $payout->hold_amount)) ?? 0 ;
                    // $payout->total_payout = max(0, ($total_product_return + (($payout->hold_amount_added + $final_commission) - $payout->hold_amount))) ?? 0;
  
                    // $payout->total_payout = (($total_product_return + $previous_unpaid_amount) + (max(0, ( (($payout->hold_amount_added + $final_commission + $payout->hold_wallet_added) - $payout->hold_amount))))) ?? 0; //+ $previous_unpaid_amount
                    

                    $payout->total_payout = (($total_product_return + $previous_unpaid_amount + $payout->hold_wallet_added) + (max(0, ( (($payout->hold_amount_added + $final_commission) - $payout->hold_amount))))) ?? 0; //+ $previous_unpaid_amount
                    
                    // Log::info('User is: ' . $payout->user_id. ' Total payout '.$payout->total_payout. ' dilse_payout_amount '. $payout->dilse_payout_amount);
                    $payout->total_payout += $total_dilse_return;
                    // Log::info('User is: ' . $payout->user_id. ' after add dilse Total payout '.$payout->total_payout);

                    if($payout->total_payout < 500){
                        $user->hold_wallet = $payout->hold_wallet = $payout->total_payout;
                        $payout->total_payout = 0.00;
                    }else{
                        // $payout->hold_wallet_added = $user->hold_wallet;
                        $user->hold_wallet = 0.00;
                    }

                    $payout->save();

                    $user->repurchase_wallet = $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction;

                    $user->update();

                    $account = Account::first();
                    $account->tds_balance += $payout->direct_bonus_tds_deduction + $payout->lavel_bonus_tds_deduction + $payout->remuneration_bonus_tds_deduction;
                    $account->repurchase_balance += $payout->direct_bonus_repurchase_deduction + $payout->lavel_bonus_repurchase_deduction + $payout->remuneration_bonus_repurchase_deduction;
                    $account->service_charge_balance += ($payout->roi_tds_deduction + $payout->dilse_service_charge_deduction);
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

                    RepurchaseAccount::create([
                        'user_id'=>$user->id,
                        'amount'=>$payout->roi_repurchase_deduction,
                        'which_for'=>'Roi Repurchase',
                        'status'=>1
                    ]);

                    ServiceChargeAccount::create([
                        'user_id'=>$user->id,
                        'amount'=>$payout->roi_tds_deduction + $payout->dilse_service_charge_deduction,
                        'which_for'=>'Deducting from Payout',
                        'status'=>1
                    ]);
                }
            }
        }
    }
}
