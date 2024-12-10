<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class AccountTransaction extends Model
{
    use HasFactory;

    function make_transaction($user_id, $amount, $which_for, $status,$generated_against_id=null, $customCreatedAt = null, $customUpdatedAt = null){
        $transaction = new AccountTransaction();
        $transaction->user_id = $user_id;
        $transaction->amount = $amount;
        $transaction->which_for = $which_for;
        $transaction->status = $status;
        $transaction->generated_against_id = $generated_against_id;
        $transaction->created_at = $customCreatedAt ?? Carbon::now();
        $transaction->updated_at = $customUpdatedAt ?? Carbon::now();
        return $transaction->save();
    }
}
