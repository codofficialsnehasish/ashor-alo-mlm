<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use App\Models\OrderProducts;
use App\Models\ProductSectorIncome;

class Product_income extends Controller
{
    public function provide_payment(){
        $currentDay = Carbon::now()->day;
        $income_data = ProductSectorIncome::where('is_completed',0)
                    ->where('month_count','<',20)
                    ->whereDay('confirm_date',$currentDay)
                    ->get();
        print_r($income_data);
        foreach($income_data as $data){
            $user = User::find($data->user_id);
            $user->account_balance = (10 / 100) * $data->total_amount;
            $user->update();
        }
    }
}