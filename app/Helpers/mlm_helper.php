<?php 
    use Illuminate\Support\Str;
    use App\Models\Products;
    use App\Models\Carts;
    use Carbon\Carbon;
    use App\Models\Orders;
    use App\Models\User;
    use App\Models\OrderProducts;
    use App\Models\TopUp;
    use App\Models\MLMSettings;
    use App\Models\AccountTransaction;
    use App\Models\RemunerationBenefit;
    use App\Models\SalaryBonus;


    // generate password
    if(!function_exists('generate_random_password')){
        function generate_random_password($length = 8) {
            // $lowercase = 'abcdefghijklmnopqrstuvwxyz';
            // $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            // $numbers = '0123456789';
            // $specialCharacters = '!@#$%^&*()';
            $password = '';
            // $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
            // $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
            // $password .= $numbers[rand(0, strlen($numbers) - 1)];
            // $password .= $specialCharacters[rand(0, strlen($specialCharacters) - 1)];

            // $password = '';
            // $password .= $specialCharacters[rand(0, strlen($specialCharacters) - 1)];
            
            // Fill the rest of the password length with random numbers
            // for ($i = 1; $i < $length; $i++) {
            //     $password .= $numbers[rand(0, strlen($numbers) - 1)];
            // }

            // $allCharacters = $lowercase . $uppercase . $numbers . $specialCharacters;
            // for ($i = 4; $i < $length; $i++) {
            //     $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
            // }
            // $password = str_shuffle($password);
            for ($i = 0; $i < $length; $i++) {
                $password .= rand(0, 9);
            }
            return $password;
        }
    }

    // Generate Agent ID
    if(!function_exists('generate_agent_id')){
        function generate_agent_id($length = 8) {
            $agent_id = '';
            for ($i = 0; $i < $length; $i++) {
                $agent_id .= rand(1, 9);
            }
            return $agent_id;
        }
    }


    if(!function_exists('calculate_total_month')){
        function calculate_total_month($total_amount, $category){
            $percentage = DB::table('monthly_returns')->where('form_amount', '<=', $total_amount)
            ->where('to_amount', '>=', $total_amount)
            ->where('category',$category)
            ->first();

            if(!empty($percentage->percentage)){
                $per_month_installment_amount = $total_amount * ($percentage->percentage / 100);
                $total_month = ($total_amount * ($percentage->return_persentage/100)) / $per_month_installment_amount;
                return $total_month;
            }

        }
    }

    if(!function_exists('calculate_ROI')){ //Return of Invesment
        function calculate_ROI($total_amount, $category){
            $percentage = DB::table('monthly_returns')->where('form_amount', '<=', $total_amount)
            ->where('to_amount', '>=', $total_amount)
            ->where('category',$category)
            ->first();
            $data_array = [];
            if(!empty($percentage->percentage)){
                $per_month_installment_amount = $total_amount * ($percentage->percentage / 100);
                $total_month = ($total_amount * ($percentage->return_persentage/100)) / $per_month_installment_amount;
                $data_array['total_installment_month'] = $total_month;
                $data_array['installment_amount_per_month'] = $per_month_installment_amount;
                $data_array['total_paying_amount'] = $total_amount * ($percentage->return_persentage/100);
                $data_array['return_percentage'] = $percentage->return_persentage;
                $data_array['percentage'] = $percentage->percentage;
                return $data_array;
            }else{
                return array();
            }
        }
    }

    if(!function_exists('calculate_installment_amount')){
        function calculate_installment_amount($total_amount){
            $percentage = DB::table('monthly_returns')->where('form_amount', '<=', $total_amount)
            ->where('to_amount', '>=', $total_amount)
            ->first();

            if(!empty($percentage->percentage)){
                $per_month_installment_amount = $total_amount * ($percentage->percentage / 100);
                return $per_month_installment_amount;
            }

        }
    }



    if(!function_exists('calculate_total_commission')){
        function calculate_total_commission($type, $user_id){
            $mlm_settings = MLMSettings::first();
            $total_deduction = $mlm_settings->tds + $mlm_settings->repurchase;

            $direct_bonus = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                                                ->where('user_id', $user_id)
                                                ->sum('amount');

            $lavel_bonus = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                                                ->where('user_id', $user_id)
                                                ->sum('amount');

            $comission = $direct_bonus + $lavel_bonus;
            $deduction = ($comission * $total_deduction) / 100; // 15% of the commission
            $final_commission = $comission - $deduction;
    
            // $total_top_up_amount = TopUp::where('user_id',$user_id)->sum('total_amount');
            $product_return = AccountTransaction::where('which_for','ROI Daily')->where('user_id',$user_id)->sum('amount');
            $product_return_deduction = ($product_return * $mlm_settings->tds) / 100;
            $product_return = $product_return - $product_return_deduction;
            
            if($final_commission >= ($total_top_up_amount * 10)){
                if($type == 'comission'){
                    return ($total_top_up_amount * 10) + $product_return;
                }elseif($type == 'hold'){
                    return round($final_commission - ($total_top_up_amount * 10),2);
                }
            }else{
                if($type == 'comission'){
                    return round(($final_commission + $product_return),2);
                }
                if($type == 'hold'){
                    return 0.00;
                }
            }
        }
    }

    if(!function_exists('get_member_rank')){
        function get_member_rank($user_id){
            $salary = SalaryBonus::leftJoin('remuneration_benefits','remuneration_benefits.id','salary_bonus.remuneration_benefit_id')
                                    ->where('user_id',$user_id)
                                    ->first();
            if($salary){
                return $salary->rank;
            }else{
                return '';
            }
        }
    }

