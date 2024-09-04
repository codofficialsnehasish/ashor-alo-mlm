<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;

    function make_transaction($user_id, $amount, $which_for, $status){
        $transaction = new AccountTransaction();
        $transaction->user_id = $user_id;
        $transaction->amount = $amount;
        $transaction->which_for = $which_for;
        $transaction->status = $status;
        return $transaction->save();
    }
}
