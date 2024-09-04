<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginSignup extends Controller
{
    public function login_signup(){
        return view("site/login-signup");
    }

    public function logout(){
        Auth::logout();
        return redirect(url('/login'));
    }

    public function get_sponsor_name(Request $r){
        $validator = Validator::make($r->all(), [
            'sponsorid' => 'exists:users,user_id',
        ]);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator->errors());
            echo json_encode($validator->errors());
        }else{
            $user = User::where("user_id",'=',$r->sponsorid)->first();
            echo json_encode($user->name);
        }
    }

    public function process_signup(Request $r){
        $validator = Validator::make($r->all(), [
            'membername' => 'required|string|max:255',
            'mobile' => 'required|digits:10|regex:/^[6789]/|unique:users,phone',
            'password' => 'required|min:4|confirmed',
            'agentid' => 'exists:users,user_id',
        ]);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator->errors());
            echo json_encode($validator->errors());
        }else{
            $obj = new User();
            $obj->user_id = $r->mobile;
            $obj->agent_id = $r->agentid;
            $obj->name = $r->membername;
            $obj->status = 1;
            $obj->role = "agent";
            $obj->email = $r->email;
            $obj->phone = $r->mobile;
            $obj->password  = bcrypt($r->password);
            $obj->token = generateToken();
            $res = $obj->save();
            if($res){
                $data = array(
                    'msg'=>'Signup Successfully'
                );
                echo json_encode($data);
            }
        }
    }

    public function login_process(Request $r){
        $validator = Validator::make($r->all(), [
            'phone' => 'required|digits:10|regex:/^[6789]/|exists:users,phone',
            'password' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            if(User::where("phone","=",$r->phone)->count() > 0){
                $obj = User::where("phone","=",$r->phone)->first();
                if($obj->is_phone_verified == 0){
                    if(Auth::attempt(['phone'=>$r->phone,'password'=>$r->password])){
                        return redirect()->route('home');
                    }else{
                        return redirect()->back()->withErrors(['message' => 'Invalid Login']);
                    }
                    // if(Hash::check($pass, $obj->password)){
                    //     return redirect()->route('home');
                    // }else{
                    //     // return ["status"=>"false",'massage' => "Invalid Password"];
                    //     return redirect()->back()->withErrors(['message' => 'Invalid Password']);
                    // }
                }else{
                    return redirect()->back()->withErrors(['message' => 'Phone Number Not Verified']);
                }
            }
        }
    }

    public function member_register(){
        return view("site/member-signup");
    }
}
