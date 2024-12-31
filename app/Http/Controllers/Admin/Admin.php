<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Lavel_masters;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Kyc;
use App\Models\TopUp; 
use App\Models\Payout;
use App\Models\Account;
use App\Models\ContactUs;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class Admin extends Controller
{

    //==================== Register Admin With API Token ======================

    public function register_user(){
        $obj = new User();
        $obj->name = "Snehasish Bhurisrestha";
        $obj->status = 1;
        $obj->role = "admin";
        $obj->email  = "admin@admin.com";
        $obj->password  = bcrypt("admin");
        $obj->token = generateToken();
        // $obj->api_access_key = createToken('AuthToken')->plainTextToken;
        $obj->save();
    }




    // ======================= Admin Login Methods =====================

    public function login(){
        $data['title'] = 'Login';
        return view("admin/authentication/login")->with($data);
    }

    public function checkuser(Request $r){
        if(Auth::attempt(["email"=>$r->email,"password"=>$r->pass])){
            $user = Auth::user();
            if($user->role == 'admin' && $user->status == 1 && $user->is_deleted == 0){
                return redirect(url('admin/dashboard'));
            }else{
                return redirect(url('/admin-login'))->with(["msg"=>"You don't have right Permission to Login"]);
            }
        }else{
            return redirect(url('/admin-login'))->with(["msg"=>"Invalid Login"]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function change_password(){
        $data['title'] = 'Change Password';
        return view("admin/authentication/change_pass")->with($data);
    }

    public function change_pass(Request $r){
        $cp = $r->cp;
        $np = $r->np;
        $conpass = $r->conpass;
        if (Hash::check($cp, Auth::user()->password)) {
            if($np == $conpass){
                $obj = User::find(Auth::user()->id);
                $obj->password = bcrypt($np);
                $obj->decoded_password = $np;
                $obj->update();
                Auth::logout();
                return redirect(url('/'));
            } else{
                return redirect(url('/changepass'))->with(["msg"=>"Not Matched Confirm Password"]);
            }
        } else {
            return redirect(url('/changepass'))->with(["msg"=>"Not Matched Current Password"]);
        }
    }
    // ==================== End of Admin login & logout Methods ====================



    //============================Dashboard======================

    public function dashboard(){
        $today = Carbon::now();
        $lastSaturday = $today->isSaturday() ? $today : $today->previous(Carbon::SATURDAY); // Get last Saturday's date
        $current_day = Carbon::now();
        
        $data['title'] = 'Dashboard';
        $data['customer_count'] = User::where("role","=","agent")->where('is_deleted', 0)->count();
        $data['active_count'] = User::where("role","=","agent")->where('status',1)->count();
        $data['todays_business'] = TopUp::whereDate("created_at",date('Y-m-d'))->sum('total_amount');
        $data['total_business'] = TopUp::all()->sum('total_amount');

        // $data['total_payment'] = Payout::where('paid_unpaid','1')->sum('total_payout');

        $lastFridayPayout = Payout::select(DB::raw('SUM(total_payout) as total_payout'))
                                    ->where('paid_unpaid', 1)
                                    ->where(DB::raw('WEEKDAY(end_date)'), 4) // Checks if the end_date is a Friday (4 = Friday in WEEKDAY)
                                    ->orderBy('end_date', 'desc')
                                    ->groupBy('start_date', 'end_date')
                                    ->first();

        $data['total_payment'] = $lastFridayPayout->total_payout + Payout::where('paid_unpaid','1')->sum('total_payout');


        $data['last_week_payment'] = Payout::whereBetween(DB::raw('DATE(created_at)'), [format_date_for_db($lastSaturday), format_date_for_db($current_day)])->sum('total_payout');
        $data['hold_amount'] = User::all()->sum('hold_balance');
        $account = Account::first();
        $data['tds'] = $account->tds_balance;
        $data['repurchase_wallet'] = $account->repurchase_balance;
        $data['service_charge'] = $account->service_charge_balance;
        // $data['active_customer_count'] = User::where("role","=","agent")->where('status',1)->count();
        // $data['inactive_customer_count'] = User::where("role","=","agent")->where('status',0)->count();
        // $data['lavel_count'] = Lavel_masters::all()->count();
        // $data['products_count'] = Products::all()->count();
        // $data['todays_orders'] = Orders::whereDate('created_at',date('Y-m-d'))->count();
        $data['pending_kyc'] = Kyc::where('is_confirmed',0)->count();
        $data['contac_us'] = ContactUs::all()->count();
        $root = User::whereNull('parent_id')->where('role','agent')->first();
        // return calculate_left_current_week_business($root->id);
        $data['current_week_business'] = calculate_left_current_week_business($root->id) + calculate_right_current_week_business($root->id);
        return view("admin/dashboard")->with($data);
    }

    //==========xxxxxxx=======End of Dashboard===========xxxxxx=======



}