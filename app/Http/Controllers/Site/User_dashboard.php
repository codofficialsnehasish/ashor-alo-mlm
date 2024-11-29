<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Orders;
use App\Models\MLMSettings;
use App\Models\TopUp; 
use App\Models\AccountTransaction;
use App\Models\LocationCountries;
use App\Models\LocationStates;
use App\Models\LocationCities;
use App\Models\RepurchaseAccount;

class User_dashboard extends Controller
{
    public function __construct(){
        $this->view_path='site.user_dashboard.';
    }

    private function get_all_customers($phone) {
        $all_customers = [];
        $fetch_customers = function($phone) use (&$all_customers, &$fetch_customers) {
            $customers = User::where('agent_id', $phone)->get();
            foreach ($customers as $customer) {
                $all_customers[] = $customer;
                $fetch_customers($customer->phone);
            }
        };
        $fetch_customers($phone);

        $filteredCustomers = array_filter($all_customers, function($customer) {
            return $customer['status'] == 1;
        });

        $resp = [
            'customer_count' => count($all_customers),
            'active_count' => count($filteredCustomers)
        ];
        return $resp;
    }
    

    public function member_dashboard(){
        $data['title'] = 'Dashboard';
        $data['total_income'] = $this->get_total_income();
        $data['total_commission'] = $this->calculate_total_commission('comission');
        $data['hold_amount'] = $this->calculate_total_commission('hold');
        $data['total_purchase'] = Orders::where('buyer_id',Auth::id())->sum('price_total');
        $data_customer = $this->get_all_customers(Auth::user()->user_id);
        $data['total_team_member'] = total_left(Auth::id()) + total_right(Auth::id());
        $data['total_active_team_member'] = activated_right(Auth::user()->id) + activated_left(Auth::user()->id);
        $data['direct_bonus'] = $this->calculate_direct_bonus();
        $data['level_bonus'] = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])->where('user_id',Auth::id())->sum('amount');
        $data['product_return'] = AccountTransaction::where('which_for','ROI Daily')->where('user_id',Auth::id())->sum('amount');
        $data['direct_team_member'] = User::where('agent_id',Auth::user()->user_id)->count();
        $data['left_team_member'] = total_left(Auth::id());
        $data['right_team_member'] = total_right(Auth::id());
        $data['tree_team_member'] = total_left(Auth::id()) + total_right(Auth::id());
        $data['level_team_member'] = get_total_level_team_member(Auth::user()->user_id);
        $data['total_topup_amount'] = TopUp::where('user_id',Auth::id())->sum('total_amount');
        $data['total_left_business'] = calculate_left_business(Auth::id());
        $data['total_right_business'] = calculate_right_business(Auth::id());
        $data['rank'] = get_member_rank(Auth::id());
        $data['remuneration_benefits'] = AccountTransaction::where('which_for','Salary Bonus')->where('user_id',Auth::id())->sum('amount');
        $data['repurchase_bonus'] = RepurchaseAccount::where('user_id',Auth::id())->sum('amount');
        return view($this->view_path."dashboard")->with($data);
    }


    private function calculate_direct_bonus(){
        $transactions = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
        ->where('user_id', Auth::id())
        ->sum('amount');

        return $transactions;
    }

    private function calculate_level_bonus(){
        $transactions = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
        ->where('user_id', Auth::id())
        ->sum('amount');

        return $transactions;
    }

    public function calculate_total_commission($type){
        $mlm_settings = MLMSettings::first();
        $total_deduction = $mlm_settings->tds + $mlm_settings->repurchase;
        $comission = $this->calculate_direct_bonus() + $this->calculate_level_bonus();
        $deduction = ($comission * $total_deduction) / 100; // 15% of the commission
        $final_commission = $comission - $deduction;

        $total_top_up_amount = TopUp::where('user_id',Auth::id())->sum('total_amount');
        $product_return = AccountTransaction::where('which_for','ROI Daily')->where('user_id',Auth::id())->sum('amount');
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

    private function get_total_income(){
        $lavel_bonus = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])->where('user_id',Auth::id())->sum('amount');
        $product_return = AccountTransaction::where('which_for','ROI Daily')->where('user_id',Auth::id())->sum('amount');
        $transactions = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
        ->where('user_id', Auth::id())
        ->sum('amount');

        return $transactions + $lavel_bonus + $product_return;
    }

    public function member_profile(){
        $data['title'] = 'Profile';
        return view($this->view_path.'profile.profile')->with($data);
    }

    public function update_profile(){
        $data['title'] = 'Profile';
        $data['user'] = Auth::user();
        $data['countries'] = LocationCountries::where('is_visible',1)->get();
        $data['nominee_states'] = LocationStates::where('country_id',99)->get();
        if(!empty(Auth::user()->nominee_state_id)){
            $data['nominee_cities'] = LocationCities::where('is_visible',1)->where('state_id',Auth::user()->nominee_state_id)->get();
        }

        if(!empty(Auth::user()->country)){
            $data['states'] = LocationStates::where('is_visible',1)->where('country_id',Auth::user()->country)->get();
        }

        if(!empty(Auth::user()->state)){
            $data['cities'] = LocationCities::where('is_visible',1)->where('state_id',Auth::user()->state)->get();
        }
        
        return view($this->view_path.'profile.edit_profile')->with($data);
    }

    public function process_update_profile(Request $request){
        $user = User::find($request->user_id);
        if ($request->hasFile('user_image')) {
            $img = $request->file('user_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/users_profile_picture');
            $img->move($directory, $filename);
            $filePath = "web_directory/users_profile_picture/".$filename;
            $user->user_image = $filePath;
        }
        $res = $user->update();
        if($res){
            return back()->with(['success'=>'Profile Picture Updated Successfully']);
        }else{
            return back()->with(['error'=>'Not Updated']);
        }
    }

    public function change_password(){
        $data['title'] = 'Change Password';
        return view($this->view_path.'profile.change_password')->with($data);
    }

    public function update_profile_details(Request $r){
        $validator = Validator::make($r->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            // 'name' => 'nullable',
            'father_or_husband_name' => 'required',
            'gender' => 'required',
            // 'phone' => 'required',
            'pin_code' => 'required',
            'shipping_address' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $user = User::find($r->user_id);
            // $user->name = $r->name;
            $user->father_or_husband_name = $r->father_or_husband_name;
            $user->date_of_birth = $r->date_of_birth;
            $user->gender = $r->gender;
            $user->marital_status = $r->marital_status;
            // $user->phone = $r->phone;
            $user->email = $r->email;
            $user->qualification = $r->qualification;
            $user->occupation = $r->occupation;
            $user->pin_code = $r->pin_code;
            $user->shipping_address = $r->shipping_address;
            $user->address = $r->address;
            $user->country = $r->country;
            $user->state = $r->state;
            $user->city = $r->city;
            $res = $user->update();
            if($res){
                return response()->json([
                    'status' => 1,
                    'massage' => 'Profile Details Updated Successfully',
                    'data' => $user
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'massage' => 'Profile Details Not Updated, Please try again',
                    'data' => []
                ]);
            }
        }
    }


    public function update_nominee_details(Request $r){
        $validator = Validator::make($r->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'nominee_name' => 'required',
            'nominee_relation' => 'required',
            'nominee_dob' => 'required',
            'nominee_address' => 'required',
            'nominee_state_id' => 'required',
            'nominee_city_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $user = User::find($r->user_id);
            $user->nominee_name = $r->nominee_name;
            $user->nominee_relation = $r->nominee_relation;
            $user->nominee_dob = $r->nominee_dob;
            $user->nominee_address = $r->nominee_address;
            $user->nominee_state_id = $r->nominee_state_id;
            $user->nominee_city_id = $r->nominee_city_id;
            $res = $user->update();
            if($res){
                return response()->json([
                    'status' => 1,
                    'massage' => 'Nominee Details Updated Successfully',
                    'data' => $user
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'massage' => 'Nominee Details Not Updated, Please try again',
                    'data' => []
                ]);
            }
        }
    }


    public function update_bank_details(Request $r){
        $validator = Validator::make($r->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'account_name' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|unique:users,account_number',
            'account_type' => 'required',
            'ifsc_code' => 'required',
            'pan_number' => 'required|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/|unique:users,pan_number',
            'upi_type' => 'required',
            'upi_number' => 'required|digits:10|regex:/^[6789]/'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $user = User::find($r->user_id);
            $user->account_name = $r->account_name;
            $user->bank_name = $r->bank_name;
            $user->account_number = $r->account_number;
            $user->account_type = $r->account_type;
            $user->ifsc_code = $r->ifsc_code;
            $user->pan_number = $r->pan_number;
            $user->upi_type = $r->upi_type;
            $user->upi_number = $r->upi_number;
            $res = $user->update();
            if($res){
                return response()->json([
                    'status' => 1,
                    'massage' => 'Bank Details Updated Successfully',
                    'data' => $user
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'massage' => 'Bank Details Not Updated, Please try again',
                    'data' => []
                ]);
            }
        }
    }

    public function process_change_password(Request $r){
        $validator = Validator::make($r->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $user = User::find($r->user_id);
            if(Hash::check($r->old_password, Auth::user()->password)){
                if($r->new_password == $r->confirm_password){
                    $user->password = bcrypt($r->new_password);
                    $user->decoded_password = $r->new_password;
                    $res = $user->update();

                    if($res){
                        return response()->json(['status'=>1,'massage'=>'Password Changed Successfully']);
                    }else{
                        return response()->json(['status'=>0,'massage'=>'Password Not Changed, Please try again']);
                    }
                }else{
                    return response()->json(['status'=>0,'massage'=>'Password & Confirm Password Not Matched']);
                }
            }else{
                return response()->json(['status'=>0,'massage'=>'Old Password Not Matched']);
            }  
        }
    }
}