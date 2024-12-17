<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User; 
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin/users/';

        $this->middleware('role_or_permission:User Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:User Create', ['only' => ['add_new','process']]);
        $this->middleware('role_or_permission:User Edit', ['only' => ['edit','update_process']]);
        $this->middleware('role_or_permission:User Delete', ['only' => ['delete']]);
    }

    public function index(){
        $data['title'] = 'Users';
        $data['users'] = User::where('role','admin')->where('is_deleted',0)->get();
        return view($this->view_path.'contents')->with($data);
    }

    public function add_new(){
        $data['title'] = 'Users';
        $data['roles'] = Role::all();
        return view($this->view_path.'add')->with($data);
    }

    public function process(Request $r){
        $validator = Validator::make($r->all(), [
            'name' => 'required|string',
            'email' => 'nullable|email|unique:users,email',
            'mobile' => 'required|digits:10|regex:/^[6789]/|unique:users,phone',
            'password' => 'required|min:8',
            'roles' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $user = new User();
            $user->name = $r->name;
            $user->role = 'admin';
            $user->status = $r->status;
            $user->email = $r->email;
            $user->phone = $r->mobile;
            $user->password = bcrypt($r->password);
            $user->decoded_password = $r->password;
            $user->syncRoles($r->roles);
            $res = $user->save();
            if($res){
                return back()->with(['success'=>'User Added Successfully']);
            }else{
                return back()->with(['success'=>'User Not Added']);
            }
        }
    }

    public function edit(Request $r){
        $data['title'] = 'Users';
        $data['user'] = User::find($r->id);
        $data['roles'] = Role::all();
        return view($this->view_path.'edit')->with($data);
    }

    public function update_process(Request $r){
        $user = User::find($r->id);
        $user->name = $r->name;
        $user->status = $r->status;
        $user->email = $r->email;
        $user->phone = $r->mobile;
        if(!empty($r->password)){
            $user->password = bcrypt($r->password);
            $user->decoded_password = $r->password;
        }
        $user->syncRoles($r->roles);
        $res = $user->update();
        if($res){
            return back()->with(['success'=>'User Updated Successfully']);
        }else{
            return back()->with(['success'=>'User Not Updated']);
        }
    }

    public function delete(Request $r){
        $user = User::find($r->id);
        $user->is_deleted = 1;
        $res = $user->update();
        // $res = $user->delete();
        if($res){
            return back()->with(['success'=>'User Deleted Successfully']);
        }else{
            return back()->with(['success'=>'User Not Deleted']);
        }
    }
}