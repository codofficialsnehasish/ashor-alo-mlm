<?php
namespace App\Services;

use App\Models\User;
use App\Models\Lavel_masters;
use App\Models\AccountTransaction;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LevelBonusService
{
    protected $transaction;

    public function __construct(AccountTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function level_bonus($user_id, $amount, $total_month, $start_date, $daydiff, $user_level) {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '256M');

        $user = User::where('user_id', $user_id)->first();
        if($user_id == null) { return; }
        if (empty($user)) {
            return;
        }

        // $highest_level = Lavel_masters::latest()->first();
        // if($user->lavel > $highest_level->level_number){
        //     return;
        // }

        // if($user->status != 1){ return; }
        if($user->status == 1){
            // $startDate = Carbon::parse($start_date);
            // $endDate = $startDate->copy()->addMonths($total_month);
            // $totalDays = $startDate->diffInDays($endDate);

            $user_lavel_persentage = Lavel_masters::where('level_number', $user_level)->value('lavel_persentage');
            $user_lavel_persentage = number_format($user_lavel_persentage, 1);
            $total_bonus = $amount * ($user_lavel_persentage/100);
            
            // $bonus = ($bonus * (1-(5/100)));
            // $bonus = $total_bonus / $totalDays;
            $bonus = round(($total_bonus / $daydiff),2);
            // echo $bonus; die;

            if(check_limit($user->id)){
                if(get_user_limit($user->id) > ($user->account_balance + $bonus) ){
                    $user->account_balance += $bonus;
                    // Level Bonus transaction
                    $transactionAdded = $this->transaction->make_transaction(
                        $user->id,
                        $bonus,
                        'Level Bonus',
                        1
                    );
                }else{
                    $gap = get_user_limit($user->id) - $user->account_balance;
                    $user->account_balance += $gap;
                    $transactionAdded = $this->transaction->make_transaction(
                        $user->id,
                        $gap,
                        'Level Bonus',
                        1
                    );
                    $bonus = abs($bonus - $gap); 
                    $user->hold_balance += $bonus;
                    $transactionAdded = $this->transaction->make_transaction(
                        $user->id,
                        $bonus,
                        'Level Bonus on Hold',
                        1
                    );
                }
            }else{
                $user->hold_balance += $bonus;
                $transactionAdded = $this->transaction->make_transaction(
                    $user->id,
                    $bonus,
                    'Level Bonus on Hold',
                    1
                );
            }
            $user->update();
        }

        $this->level_bonus($user->agent_id, $amount, $total_month, $start_date , $daydiff, $user_level += 1);

    } 

    public function weekly_level_bonus($user_id, $amount, $user_level){
        $user = User::where('user_id', $user_id)->first();
        if($user_id == null) { return; }
        if (empty($user)) {
            return;
        }

        // $highest_level = Lavel_masters::latest()->first();
        // if($user->lavel > $highest_level->level_number){
        //     return;
        // }

        if($user->status != 1){ return; }

        if($user->status == 1){

            $user_lavel_persentage = Lavel_masters::where('level_number', $user->lavel)->value('lavel_persentage');
            $user_lavel_persentage = number_format($user_lavel_persentage, 1);
            $bonus = $amount * ($user_lavel_persentage/100);

            if(check_limit($user->id)){
                if(get_user_limit($user->id) > ($user->account_balance + $bonus) ){
                    $user->account_balance += $bonus;
                    // Level Bonus transaction
                    $transactionAdded = $this->transaction->make_transaction(
                        $user->id,
                        $bonus,
                        'Level Bonus',
                        1
                    );
                }else{
                    $gap = get_user_limit($user->id) - $user->account_balance;
                    $user->account_balance += $gap;
                    $transactionAdded = $this->transaction->make_transaction(
                        $user->id,
                        $gap,
                        'Level Bonus',
                        1
                    );
                    $bonus = abs($bonus - $gap); 
                    $user->hold_balance += $bonus;
                    $transactionAdded = $this->transaction->make_transaction(
                        $user->id,
                        $bonus,
                        'Level Bonus on Hold',
                        1
                    );
                }
            }else{
                $user->hold_balance += $bonus;
                $transactionAdded = $this->transaction->make_transaction(
                    $user->id,
                    $bonus,
                    'Level Bonus on Hold',
                    1
                );
            }
            $user->update();
        }

        $this->weekly_level_bonus($user->agent_id, $amount, $user_level += 1);
    }
    
}