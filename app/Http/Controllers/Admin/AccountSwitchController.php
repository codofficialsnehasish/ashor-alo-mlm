<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class AccountSwitchController extends Controller
{
    public function switch(Request $request, $userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            if($user->role == 'agent'){
                Cookie::queue('admin_travling_user_account', Auth::id());
                Auth::login($user);
                return redirect()->route('member-dashboard');
            }
            if($user->role == 'admin'){
                Auth::login($user);
                Cookie::queue(Cookie::forget('admin_travling_user_account'));
                return redirect()->route('customer.show');
            }
        }

        return redirect()->back()->withErrors(['User not found.']);
    }

}