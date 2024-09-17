<?php 
    use Illuminate\Support\Str;
    use App\Models\Products;
    use App\Models\Carts;
    use Carbon\Carbon;
    use App\Models\Orders;
    use App\Models\User;
    use App\Models\OrderProducts;
    use App\Models\TopUp;


    if (!function_exists('get_user_details')){
        function get_user_details($id){
            $user = User::find($id);
            if($user){
                return $user;
            }else{
                return '';
            }
        }
    }


    if (!function_exists('get_name')){
        function get_name($id){
            $user = User::find($id);
            if($user){
                return $user->name;
            }else{
                return '';
            }
        }
    }

    if (!function_exists('get_name_by_user_id')){
        function get_name_by_user_id($user_id){
            $user = User::where('user_id',$user_id)->first();
            if($user){
                return $user->name;
            }else{
                return '';
            }
        }
    }

    if (!function_exists('get_user_id')){
        function get_user_id($id){
            $user = User::find($id);
            if($user){
                return $user->user_id;
            }else{
                return '';
            }
        }
    }

    if (!function_exists('get_id_using_user_id')){
        function get_id_using_user_id($user_id){
            $user = User::where('user_id',$user_id)->first();
            if($user){
                return $user->id;
            }else{
                return '';
            }
        }
    }
    
    if(!function_exists('is_kyc_exists')) {
        function is_kyc_exists($kyc){
            if(!empty($kyc)){
                return true;
            }else{
                return false;
            }
        }
    }

    if(!function_exists('check_kyc_status')){
        function check_kyc_status($user_id){
            $kyc = DB::table('kycs')->where('user_id',$user_id)->first();
            if($kyc){
                if($kyc->is_confirmed == 0){
                    $str = '<span class="badge badge-pill badge-warning ml-3">Pending</span>';
                }elseif($kyc->is_confirmed == 1){
                    $str = '<span class="badge badge-pill badge-success ml-3">Completed</span>';
                }else{
                    $str = '<span class="badge badge-pill badge-danger ml-3">Cancelled</span>';
                }
            }else{
                $str = '<span class="badge badge-pill badge-warning ml-3">Pending</span>';
            }
            return $str;
        }
    }

    if(!function_exists('check_kyc_status_for_menu')){
        function check_kyc_status_for_menu($user_id){
            $kyc = DB::table('kycs')->where('user_id',$user_id)->first();
            if($kyc){
                if($kyc->is_confirmed == 0){
                    $str = '<span class="badge badge-pill badge-warning ml-3"><i class="fas fas fa-clock"></i></span>';
                }elseif($kyc->is_confirmed == 1){
                    $str = '<span class="badge badge-pill badge-success ml-3"><i class="fas fa-check-circle"></i></span>';
                }else{
                    $str = '<span class="badge badge-pill badge-danger ml-3"><i class="fas fa-times-circle"></i></span>';
                }
            }else{
                $str = '<span class="badge badge-pill badge-warning ml-3"><i class="fas fas fa-clock"></i></span>';
            }
            return $str;
        }
    }

    if(!function_exists('check_kyc_submit_button')){
        function check_kyc_submit_button($user_id){
            $kyc = DB::table('kycs')->where('user_id',$user_id)->first();
            if($kyc){
                if($kyc->is_confirmed == 0 || $kyc->is_confirmed == 1){
                    return 'disabled';
                }else{
                    return '';
                }
            }
        }
    }

    if(!function_exists('check_identy_proof_status')){
        function check_identy_proof_status($kyc){
            if(is_kyc_exists($kyc)){
                if($kyc->identy_proof_status == 0){
                    $str = '<span class="text-warning" data-toggle="tooltip" data-placement="top" title="Pending"><i class="fas fas fa-clock"></i></span>';
                }elseif($kyc->identy_proof_status == 1){
                    $str = '<span class="text-success" data-toggle="tooltip" data-placement="top" title="Verified"><i class="fas fa-check-circle"></i></span>';
                }else{
                    $str = '<span class="text-danger" data-toggle="popover" data-content="' . htmlspecialchars($kyc->identy_proof_remarks, ENT_QUOTES, 'UTF-8') . '" title="Cancelled"><i class="fas fa-times-circle"></i> ' . htmlspecialchars($kyc->identy_proof_remarks, ENT_QUOTES, 'UTF-8') . '</span>';
                }
                return $str;
            }else{
                return '';
            }
        }
    }

    if(!function_exists('check_address_proof_status')){
        function check_address_proof_status($kyc){
            if(is_kyc_exists($kyc)){
                if($kyc->address_proof_status == 0){
                    $str = '<span class="text-warning" data-toggle="tooltip" data-placement="top" title="Pending"><i class="fas fas fa-clock"></i></span>';
                }elseif($kyc->address_proof_status == 1){
                    $str = '<span class="text-success" data-toggle="tooltip" data-placement="top" title="Verified"><i class="fas fa-check-circle"></i></span>';
                }else{
                    $str = '<span class="text-danger" data-toggle="popover" data-content="' . htmlspecialchars($kyc->address_proof_remarks, ENT_QUOTES, 'UTF-8') . '" title="Cancelled"><i class="fas fa-times-circle"></i> '. htmlspecialchars($kyc->address_proof_remarks, ENT_QUOTES, 'UTF-8') .'</span>';
                }
                return $str;
            }else{
                return '';
            }
        }
    }

    if(!function_exists('check_bank_proof_status')){
        function check_bank_proof_status($kyc){
            if(is_kyc_exists($kyc)){
                if($kyc->bank_ac_proof_status == 0){
                    $str = '<span class="text-warning" data-toggle="tooltip" data-placement="top" title="Pending"><i class="fas fas fa-clock"></i></span>';
                }elseif($kyc->bank_ac_proof_status == 1){
                    $str = '<span class="text-success" data-toggle="tooltip" data-placement="top" title="Verified"><i class="fas fa-check-circle"></i></span>';
                }else{
                    $str = '<span class="text-danger" data-toggle="popover" data-content="' . htmlspecialchars($kyc->bank_ac_proof_remarks, ENT_QUOTES, 'UTF-8') . '" title="Cancelled"><i class="fas fa-times-circle"></i> ' . htmlspecialchars($kyc->bank_ac_proof_remarks, ENT_QUOTES, 'UTF-8') . '</span>';
                }
                return $str;
            }else{
                return '';
            }
        }
    }

    if(!function_exists('check_pan_proof_status')){
        function check_pan_proof_status($kyc){
            if(is_kyc_exists($kyc)){
                if($kyc->pan_card_proof_status == 0){
                    $str = '<span class="text-warning" data-toggle="tooltip" data-placement="top" title="Pending"><i class="fas fas fa-clock"></i></span>';
                }elseif($kyc->pan_card_proof_status == 1){
                    $str = '<span class="text-success" data-toggle="tooltip" data-placement="top" title="Verified"><i class="fas fa-check-circle"></i></span>';
                }else{
                    $str = '<span class="text-danger" data-toggle="popover" data-content="' . htmlspecialchars($kyc->pan_card_proof_remarks, ENT_QUOTES, 'UTF-8') . '" title="Cancelled"><i class="fas fa-times-circle"></i> ' . htmlspecialchars($kyc->pan_card_proof_remarks, ENT_QUOTES, 'UTF-8') . '</span>';
                }
                return $str;
            }else{
                return '';
            }
        }
    }

    if(!function_exists('check_limit')){
        function check_limit($user_id){
            $user = User::find($user_id);
            if($user){
                $total_amount = TopUp::where('user_id',$user_id)->sum('total_amount');
                $up_to_amount = $total_amount * 10;
                if($up_to_amount == $user->account_balance){
                    return false;
                }elseif($up_to_amount > $user->account_balance){
                    return true;
                }else{
                    return false;
                }

            }
        }
    }

    if(!function_exists('get_user_limit')){
        function get_user_limit($user_id){
            $user = User::find($user_id);
            if($user){
                $total_amount = TopUp::where('user_id',$user_id)->sum('total_amount');
                $up_to_amount = $total_amount * 10;
                return $up_to_amount;
            }else{
                return 0;
            }
        }
    }