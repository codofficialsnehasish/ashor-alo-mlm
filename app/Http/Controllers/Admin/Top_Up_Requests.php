<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\General_settings;
use App\Models\Products;
use App\Models\TopUpRequests;

class Top_Up_Requests extends Controller
{
    public function __construct() {
        $this->admin_view_path = 'admin.top_up_requests.';
        $this->site_view_path = 'site.user_dashboard.top_up_requests.';
    }

    public function top_up_requests(){
        $data['title'] = 'Top Up Requests';
        $data['top_up_requests'] = TopUpRequests::where('is_approved',0)->where('is_cancelled',0)->get();
        return view($this->admin_view_path.'top_up_req')->with($data);
    }

    public function add_requests(){
        $data['title'] = 'Add Top Up Requests';
        return view($this->site_view_path.'add')->with($data);
    }

    public function process_requests(Request $r){
        $validator = Validator::make($r->all(), [
            'user_id' => 'required|exists:users,id',
            'ref_user_name' => 'required|string|max:255',
            'amount' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $top_up = new TopUpRequests();
            $top_up->user_id = $r->user_id;
            $top_up->ref_user_name = $r->ref_user_name;
            $top_up->topup_money = $r->amount;
            $top_up->comments = $r->comment;
            $res = $top_up->save();

            if($res){
                return redirect()->back()->with(["success"=>"Request Submit Successfully"]);
            }else{
                return redirect()->back()->with(["error"=>"Request not Submited"]);
            }
        }  
    }
}