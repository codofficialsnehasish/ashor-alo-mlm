<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Services\BinaryTreeService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authentication extends Controller
{
    protected $binaryTreeService;

    public function __construct(BinaryTreeService $binaryTreeService)
    {
        $this->view_path='site.authentication.';
        $this->binaryTreeService = $binaryTreeService;
    }

    public function login(){
        $data['title'] = 'Login';
        return view($this->view_path."login")->with($data);
    }

    public function signup(){
        $data['title'] = 'Sign Up';
        return view($this->view_path."signup")->with($data);
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
            // 'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:4|confirmed',
            'agentid' => 'required|exists:users,user_id',
        ]);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator->errors());
            echo json_encode($validator->errors());
        }else{
            // $obj = new User();
            // $obj->user_id = $r->mobile;
            // $obj->agent_id = $r->agentid;
            // $obj->name = $r->membername;
            // if($r->position == 'left'){
            //     $obj->is_left = 1;
            // }
            // if($r->position == 'right'){
            //     $obj->is_right = 1;
            // }
            // $obj->status = 0;
            // $obj->role = "agent";
            // $obj->email = $r->email;
            // $obj->phone = $r->mobile;
            // $obj->password  = bcrypt($r->password);
            // $obj->token = generateToken();
            // $res = $obj->save();
            try {
                $user = $this->binaryTreeService->addUser($r->all());
                // return redirect()->back()->with(['success' => 'Registration Successfull']);
                // Auth::attempt(['phone'=>$r->mobile,'password'=>$r->password]);
                $data = array(
                    // 'msg'=>'Signup Successfully'
                    // 'msg'=>array(
                    //     'title' => 'Signup Successfully',
                    //     'text' => 'Your ID is '.$user->user_id.' and password is '.$user->decoded_password,
                    // )
                    'msg'=>array(
                        'title' => 'Signup Successfully',
                        'text' => 'Hi,'.$user->name.' Your ID is '.$user->user_id.' and Password is '.$user->decoded_password,
                    )
                );
                echo json_encode($data);
            } catch (\Exception $e) {
                // return redirect()->back()->with(['error' => $e->getMessage()]);
                $data = array(
                    'msg'=>$e->getMessage()
                );
                echo json_encode($data);
            }
            // if($res){
            //     $data = array(
            //         'msg'=>'Signup Successfully'
            //     );
            //     echo json_encode($data);
            // }
        }
    }

    // Login Process With Phone Number
    // public function login_process(Request $r){
    //     $validator = Validator::make($r->all(), [
    //         'phone' => 'required|digits:10|regex:/^[6789]/|exists:users,phone',
    //         'password' => 'required|min:4',
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator->errors());
    //     }else{
    //         if(User::where("phone","=",$r->phone)->count() > 0){
    //             $obj = User::where("phone","=",$r->phone)->first();
    //             if($obj->is_phone_verified == 0){
    //                 if(Auth::attempt(['phone'=>$r->phone,'password'=>$r->password])){
    //                     // return redirect()->route('home');
    //                     return redirect(url('/member-dashboard'));
    //                 }else{
    //                     return redirect()->back()->withErrors(['message' => 'Invalid Login']);
    //                 }
    //             }else{
    //                 return redirect()->back()->withErrors(['message' => 'Phone Number Not Verified']);
    //             }
    //         }
    //     }
    // }

    // Login Process With User ID
    public function login_process(Request $r){
        $validator = Validator::make($r->all(), [
            'user_id' => 'required|digits:8|exists:users,user_id',
            'password' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $obj = User::where("user_id","=",$r->user_id)->first();
            if($obj->block == 0){
                if(Auth::attempt(['user_id'=>$r->user_id,'password'=>$r->password])){
                    // return redirect()->route('home');
                    return redirect(url('/member-dashboard'));
                }else{
                    return redirect()->back()->withErrors(['message' => 'Invalid Login']);
                }
            }else{
                return redirect()->back()->with('error','Your ID is Blocked');
            }
        }
    }

    public function member_register(){
        $data['title'] = 'Member Register';
        return view($this->view_path."member-signup")->with($data);
    }

    public function password_reset(){
        $data['title'] = 'Forger Password';
        return view($this->view_path.'password_reset')->with($data);
    }

    public function password_reset_process(Request $r){
        $validator = Validator::make($r->all(), [
            'phone' => 'required|digits:10|regex:/^[6789]/|exists:users,phone',
            // 'password' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            Cookie::queue('user_phone', $r->phone, 5);
            return $this->forget_password($r->phone);
        }
    }

    public function forget_password($phone){
        $data['title'] = 'Forger Password';
        $data['user_name'] = User::where('phone',$phone)->first()->name;
        return view($this->view_path.'forget_password')->with($data);
    }

    public function forget_password_process(Request $r){
        $validator = Validator::make($r->all(), [
            // 'phone' => 'required|digits:10|regex:/^[6789]/|exists:users,phone',
            'password' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $cookieValue = Cookie::get('user_phone');
            $obj = User::where('phone',$cookieValue)->first();
            $obj->password = bcrypt($r->password);
            $obj->decoded_password = $r->password;
            $res = $obj->save();
            Cookie::queue(Cookie::forget('user_phone'));
            if($res){
                return redirect(url('/login'))->with(['success'=>'Password Forgeted Successfully']);
            }else{
                return redirect(url('/login'))->with(['error'=>'Password Not Forgeted']);
            }
        }
    }
}
