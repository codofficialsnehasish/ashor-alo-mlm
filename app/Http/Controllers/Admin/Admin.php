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
            return redirect(url('admin/dashboard'));
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
        // $wallet = Wallets::all()->count();
        // $req = Requestt::all()->count();
        // $slider = Slider::all()->count();
        // $result = Results::where("date","=",date("d-m-Y"))->count();
        // $play_details = On_Game::where("date","=",date("Y-m-d"))->count();
        
        $data['title'] = 'Dashboard';
        $data['customer_count'] = User::where("role","=","agent")->count();
        $data['active_customer_count'] = User::where("role","=","agent")->where('status',1)->count();
        $data['inactive_customer_count'] = User::where("role","=","agent")->where('status',0)->count();
        $data['lavel_count'] = Lavel_masters::all()->count();
        $data['products_count'] = Products::all()->count();
        $data['todays_orders'] = Orders::whereDate('created_at',date('Y-m-d'))->count();
        $data['pending_kyc'] = Kyc::where('is_confirmed',0)->orWhere('is_confirmed',2)->count();
        return view("admin/dashboard")->with($data);
    }

    //==========xxxxxxx=======End of Dashboard===========xxxxxx=======



}