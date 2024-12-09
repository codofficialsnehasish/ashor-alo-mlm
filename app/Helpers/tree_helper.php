<?php 
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    use App\Models\User;
    use App\Models\Orders;
    use App\Models\TopUp;
    use Illuminate\Support\Facades\DB;
    // first version
    // if (!function_exists('render_customer_tree')) {
    //     function render_customer_tree($customers) {
    //         if (empty($customers[0])) {
    //             return '<ul><li><a href="#">No one Available</a></li></ul>';
    //         }

    //         $html = '<ul>';
    //         foreach ($customers as $customer) {
    //             $html .= '<li>';
    //             $html .= '<a href="#">' . $customer->name . '</a>';
    //             if (!empty($customer->sub_customers)) {
    //                 $html .= render_customer_tree($customer->sub_customers);
    //             }
    //             $html .= '</li>';
    //         }
    //         $html .= '</ul>';
    //         return $html;
    //     }
    // }


    if (!function_exists('get_customer_by_agent_id')) {
        function get_customer_by_agent_id($agent_id){
            $customer = DB::table('users')->where('agent_id', $agent_id)->get();
            return $customer;
        }
    }

    if (!function_exists('get_customer_tree')) {
        function get_customer_tree($user_id) {
            $customers = get_customer_by_agent_id($user_id);
            foreach ($customers as $customer) {
                $customer->sub_customers = get_customer_tree($customer->user_id);
            }
            return $customers;
        }
    }

    

    if (!function_exists('get_active_class')){
        function get_active_class($val){
            if($val == 1){
                return "member-header-active";
            }else{
                return "member-header-inactive";
            }
        }
    }

    if (!function_exists('is_active')){
        function is_active($val){
            if($val == 1){
                return "Active";
            }else{
                return "Inactive";
            }
        }
    }
    //second version
    if (!function_exists('render_customer_tree')) {
        function render_customer_tree($customers) {
            // print_r($customers);
            if (empty($customers)) {
                return;
            }

            $html = '<ul>';
            foreach ($customers as $customer) {
                // print_r($customer);
                $html .= '<li>';
                $html .= '<a href="javascript:void(0);">';
                $html .= '<div class="member-view-box">';
                $html .= '<div class="'.get_active_class($customer->status).'">';
                $html .= '<span>'.is_active($customer->status).'</span>';
                $html .= '</div>';
                $html .= '<div class="member-image">';
                $html .= '<img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Member">';
                $html .= '</div>';
                $html .= '<div class="member-footer">';
                $html .= '<div class="name"><span>' . $customer->name . '</span></div>';
                $html .= '<div class="downline"><span>' . $customer->joining_amount . '</span></div>';
                $html .= '<div class="downline"><span>' . get_join_green_date($customer->join_amount_put_date) . '</span></div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</a>';
                if (!empty($customer->sub_customers)) {
                    $html .= render_customer_tree($customer->sub_customers);
                }
                $html .= '</li>';
            // break;
            }
            $html .= '</ul>';
            return $html;
        }
    }


    if (!function_exists('build_customer_array')) {
        function build_customer_array($customers, &$levels, $level = 1) {
            if (empty($customers)) {
                return;
            }
    
            foreach ($customers as $customer) {
                $customerData = [
                    'id' => $customer->id,
                    'reg_date' => formated_date($customer->created_at),
                    'user_id' => $customer->user_id,
                    'name' => $customer->name,
                    'phone' => $customer->phone,
                    'agent_id' => $customer->agent_id,
                    'position' => $customer->is_left == 1 ? 'Left' : 'Right',
                    'status' => check_status($customer->status),
                ];
    
                $levels['lavel' . $level][] = $customerData;
    
                if (!empty($customer->sub_customers)) {
                    build_customer_array($customer->sub_customers, $levels, $level + 1);
                }
            }
        }
    }


    if (!function_exists('get_customer_level')) {
        function get_customer_level($customers, $level = 0, &$cache = []) {
            $maxLevel = $level;
            foreach ($customers as $customer) {
                if (!empty($customer->sub_customers)) {
                    $customerId = $customer->id;
                    if (isset($cache[$customerId])) {
                        $subCustomerLevel = $cache[$customerId];
                    } else {
                        $subCustomerLevel = get_customer_level($customer->sub_customers, $level + 1, $cache);
                        $cache[$customerId] = $subCustomerLevel;
                    }
                    $maxLevel = max($maxLevel, $subCustomerLevel);
                }
            }
            return $maxLevel;
        }
    }
    
    if (!function_exists('find_customer_level')) {
        function find_customer_level($user_id) {
            $customers = get_customer_tree($user_id); 
            $cache = [];
            return get_customer_level($customers, 0, $cache);
        }
    }
    
    
    if(!function_exists('get_total_level_team_member')){
        function get_total_level_team_member($user_id){
            $customerTree = get_customer_tree($user_id); 
            $levels = [];
            $level_data = build_customer_array($customerTree, $levels);

            $total_customers = 0;
            foreach ($levels as $customers) {
                $total_customers += count($customers);
            }
            return $total_customers;
        }
    }



    // third version
    // if (!function_exists('render_customer_tree')) {
    //     function render_customer_tree($customers) {
    //         if ($customers->isEmpty()) {
    //             return;
    //         }
    
    //         $html = '<ul>';
    
    //         $leftCustomers = $customers->filter(function($customer) {
    //             return $customer->is_left == 1;
    //         });
    
    //         $rightCustomers = $customers->filter(function($customer) {
    //             return $customer->is_right == 1;
    //         });
    
    //         // Render left customers or add a blank <li>
    //         if (!$leftCustomers->isEmpty()) {
    //             foreach ($leftCustomers as $customer) {
    //                 $html .= render_customer_html($customer);
    //             }
    //         } else {
    //             $html .= '<li>';
    //             $html .= '<a href="javascript:void(0);">';
    //             $html .= '<div class="member-view-box" style="background: #a7a2a257 !important;">';
    //             $html .= '        <div class="member-header" style="background: #a7a2a257 !important;">';
    //             $html .= '            <span>No User Avaliable</span>';
    //             $html .= '        </div>';
    //             $html .= '        <div class="member-image" style="background: #a7a2a257 !important;">';
    //             $html .= '            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Member" style="background: #a7a2a257 !important;">';
    //             $html .= '        </div>';
    //             $html .= '        <div class="member-footer">';
    //             $html .= '            <div class="name"><span></span></div>';
    //             $html .= '            <div class="downline"><span></span></div>';
    //             $html .= '        </div>';
    //             $html .= '    </div>';
    //             $html .= '</a>';
    //             $html .= '</li>';
    //         }
    
    //         // Render right customers or add a blank <li>
    //         if (!$rightCustomers->isEmpty()) {
    //             foreach ($rightCustomers as $customer) {
    //                 $html .= render_customer_html($customer);
    //             }
    //         } else {
    //             $html .= '<li></li>';
    //         }
    
    //         $html .= '</ul>';
    //         return $html;
    //     }
    // }
    
    // if (!function_exists('render_customer_html')) {
    //     function render_customer_html($customer) {
    //         $html = '<li>';
    //         $html .= '<a href="javascript:void(0);">';
    //         $html .= '<div class="member-view-box">';
    //         $html .= '<div class="' . get_active_class($customer->status) . '">';
    //         $html .= '<span>' . is_active($customer->status) . '</span>';
    //         $html .= '</div>';
    //         $html .= '<div class="member-image">';
    //         $html .= '<img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Member">';
    //         $html .= '</div>';
    //         $html .= '<div class="member-footer">';
    //         $html .= '<div class="name"><span>' . $customer->name . '</span></div>';
    //         $html .= '<div class="downline"><span>' . $customer->joining_amount . '</span></div>';
    //         $html .= '<div class="downline"><span>' . get_join_green_date($customer->join_amount_put_date) . '</span></div>';
    //         $html .= '</div>';
    //         $html .= '</div>';
    //         $html .= '</a>';
    //         if (!empty($customer->sub_customers)) {
    //             $html .= render_customer_tree(collect($customer->sub_customers));
    //         }
    //         $html .= '</li>';
    //         return $html;
    //     }
    // }
    

    if (!function_exists('register_left')) {
        function register_left($user_id){ 
            $customers = getLeftSideMembers($user_id);
            $count = 0;
            foreach($customers as $c){
                if($c->status == 0){
                    $count++;
                }
            }
            return $count;
        }
    }

    if (!function_exists('register_right')) {
        function register_right($user_id){
            $customers = getRightSideMembers($user_id);
            $count = 0;
            foreach($customers as $c){
                if($c->status == 0){
                    $count++;
                }
            }
            return $count;
        }
    }

    if (!function_exists('activated_right')) {
        function activated_right($user_id){
            $customers = getRightSideMembers($user_id);
            $count = 0;
            foreach($customers as $c){
                if($c->status == 1){
                    $count++;
                }
            }
            return $count;
        }
    }

    if (!function_exists('activated_left')) {
        function activated_left($user_id){
            $customers = getLeftSideMembers($user_id);
            $count = 0;
            foreach($customers as $c){
                if($c->status == 1){
                    $count++;
                }
            }
            return $count;
        }
    }

    if (!function_exists('total_left')) {
        function total_left($user_id){
            return count(getLeftSideMembers($user_id)); 
        }
    }

    if (!function_exists('total_right')) {
        function total_right($user_id){
            return count(getRightSideMembers($user_id));
        }
    }
    
    if (!function_exists('total_user')) {
        function total_user($user_id){
            return (count(getLeftSideMembers($user_id)) + count(getRightSideMembers($user_id))); 
        }
    }

    if(!function_exists('getLeftSideMembers')){
        function getLeftSideMembers($user_id) {
            $user = User::where('parent_id',$user_id)->where('is_left',1)->first();
            if(!empty($user)){
                $user_id = $user->id;
                $all_customers = [$user];
                $fetch_customers = function($user_id) use (&$all_customers, &$fetch_customers) {
                    $left_customers = User::where('parent_id', $user_id)
                                        ->get();
                    foreach ($left_customers as $left_customer) {
                        $all_customers[] = $left_customer;
                        $fetch_customers($left_customer->id);
                    }
                };
                $fetch_customers($user_id);
                // return count($all_customers);
                return $all_customers;
            }else{
                return array();
            }
        }
    }
    
    

    if(!function_exists('getRightSideMembers')){
        function getRightSideMembers($user_id) {
            $user = User::where('parent_id',$user_id)->where('is_right',1)->first();
            if(!empty($user)){
                $user_id = $user->id;
                $all_customers = [$user];
                $fetch_customers = function($user_id) use (&$all_customers, &$fetch_customers) {
                    $left_customers = User::where('parent_id', $user_id)
                                          ->get();
                    if(!empty($left_customers)){
                        foreach ($left_customers as $left_customer) {
                            $all_customers[] = $left_customer;
                            $fetch_customers($left_customer->id);
                        }
                    }
                };
                $fetch_customers($user_id);
                // return count($all_customers);
                return $all_customers;
            }else{
                return array();
            }
        }
    }
    


    if(!function_exists('calculate_left_business')){
        function calculate_left_business($user_id){
            $left_side_members = getLeftSideMembers($user_id);
        
            if (empty($left_side_members)) {
                return 0;
            }
            
            $buyer_ids = array_column($left_side_members, 'id');
            
            // $total_business = Orders::whereIn('buyer_id', $buyer_ids)
            //                     ->sum('price_total');

            $total_business = TopUp::whereIn('user_id', $buyer_ids)->where('is_provide_direct',1)
            ->sum('total_amount');
            
            return $total_business;
        }
    }

    if(!function_exists('calculate_curr_left_business')){
        function calculate_curr_left_business($user_id){
            $left_side_members = getLeftSideMembers($user_id);
        
            if (empty($left_side_members)) {
                return 0;
            }
            
            $buyer_ids = array_column($left_side_members, 'id');
            $today = Carbon::now()->startOfDay();
            $last_saturday = Carbon::now()->previous(Carbon::SATURDAY)->startOfDay();
            
            $total_business = Orders::whereIn('buyer_id', $buyer_ids)
                                ->whereBetween('created_at', [$last_saturday, $today])
                                ->sum('price_total');
            
            return $total_business;
        }
    }

    if(!function_exists('calculate_right_business')){
        function calculate_right_business($user_id){
            $right_side_members = getRightSideMembers($user_id);
    
            if (empty($right_side_members)) {
                return 0;
            }
            
            $buyer_ids = array_column($right_side_members, 'id');
            
            // $total_business = Orders::whereIn('buyer_id', $buyer_ids)
            //                         ->sum('price_total');

            $total_business = TopUp::whereIn('user_id', $buyer_ids)->where('is_provide_direct',1)
                                    ->sum('total_amount');
            
            return $total_business;
        }
    }

    if(!function_exists('calculate_right_current_week_business')){
        function calculate_right_current_week_business($user_id){

            $today = Carbon::now();
            $lastSaturday = $today->isSaturday() ? $today : $today->previous(Carbon::SATURDAY); // Get last Saturday's date
            $current_day = Carbon::now();

            $right_side_members = getRightSideMembers($user_id);
    
            if (empty($right_side_members)) {
                return 0;
            }
            
            $buyer_ids = array_column($right_side_members, 'id');
            
            // $total_business = Orders::whereIn('buyer_id', $buyer_ids)
            //                         ->sum('price_total');

            $total_business = TopUp::whereIn('user_id', $buyer_ids)
                        ->where('is_provide_direct', 1)
                        ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                        ->sum('total_amount');
            
            return $total_business;
        }
    }

    if(!function_exists('calculate_left_current_week_business')){
        function calculate_left_current_week_business($user_id){

            $today = Carbon::now();
            $lastSaturday = $today->isSaturday() ? $today : $today->previous(Carbon::SATURDAY); // Get last Saturday's date
            $current_day = Carbon::now();
            
            $left_side_members = getLeftSideMembers($user_id);
        
            if (empty($left_side_members)) {
                return 0;
            }
            
            $buyer_ids = array_column($left_side_members, 'id');
            // return $buyer_ids;

            $total_business = TopUp::whereIn('user_id', $buyer_ids)
                        ->where('is_provide_direct', 1)
                        ->whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])
                        ->sum('total_amount');
            
            return $total_business;
        }
    }


    if(!function_exists('calculate_curr_right_business')){
        function calculate_curr_right_business($user_id){
            $right_side_members = getRightSideMembers($user_id);
        
            if (empty($right_side_members)) {
                return 0;
            }
            
            $buyer_ids = array_column($right_side_members, 'id');
            $today = Carbon::now()->startOfDay();
            $last_saturday = Carbon::now()->previous(Carbon::SATURDAY)->startOfDay();
            
            $total_business = Orders::whereIn('buyer_id', $buyer_ids)
                                ->whereBetween('created_at', [$last_saturday, $today])
                                ->sum('price_total');

            
            return $total_business;
        }
    }