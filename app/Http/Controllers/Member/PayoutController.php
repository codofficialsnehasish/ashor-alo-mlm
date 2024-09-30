<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payout;

use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    public function __construct(){
        $this->view_path = "site.user_dashboard.payouts.";
    }
    public function all_payouts(){
        $data['title'] = 'Payouts';
        $data['payouts'] = Payout::where('user_id',Auth::id())->orderBy('id','desc')->get();
        return view($this->view_path.'index')->with($data);
    }

    public function payout_details($id){
        $data['title'] = 'Payout Details';
        $data['payout'] = Payout::where('user_id',Auth::id())->where('id',$id)->first();
        return view($this->view_path.'payout_details')->with($data);
    }

    public function payout_statement($id){
        $data['title'] = 'Payout Statement';
        $data['payout'] = Payout::where('user_id',Auth::id())->where('id',$id)->first();
        return view($this->view_path.'payout_statement')->with($data);
    }
}
