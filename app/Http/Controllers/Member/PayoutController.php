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

    public function all_payouts(Request $request){
        if ($request->is('api/*')) {
            return response()->json([  
                'status' => "true",
                'data' => Payout::where('user_id',$request->user()->id)->orderBy('id','desc')->get()
            ], 200);
        }else{
            $data['title'] = 'Payouts';
            $data['payouts'] = Payout::where('user_id',Auth::id())->orderBy('id','desc')->get();
            return view($this->view_path.'index')->with($data);
        }
    }

    public function payout_details(Request $request,$id){
        if ($request->is('api/*')) {
            return response()->json([  
                'status' => "true",
                'statement_link' => route('payout.payout-statement.app',$id),
                'data' => Payout::where('user_id',$request->user()->id)->where('id',$id)->first()
            ], 200);
        }else{
            $data['title'] = 'Payout Details';
            $data['payout'] = Payout::where('user_id',Auth::id())->where('id',$id)->first();
            return view($this->view_path.'payout_details')->with($data);
        }
    }

    public function payout_statement($id){
        $data['title'] = 'Payout Statement';
        $data['payout'] = Payout::where('user_id',Auth::id())->where('id',$id)->first();
        return view($this->view_path.'payout_statement')->with($data);
    }

    public function payout_statement_app($id){
        $data['title'] = 'Payout Statement';
        $data['payout'] = Payout::where('id',$id)->first();
        return view($this->view_path.'payout_statement_app')->with($data);
    }

    public function payout_history(Request $request){
        if ($request->is('api/*')) {
            return response()->json([
                'status' => "true",
                'data' => Payout::where('user_id', $request->user()->id)
                    ->orderBy('id', 'desc')
                    ->get()
                    ->map(function ($payout, $index) {
                        return [
                            'iteration' => $index + 1,
                            'end_date' => formated_date($payout->end_date, '-'),
                            'total_payout' => $payout->total_payout,
                            'paid_date' => !empty($payout->paid_date) ? formated_date($payout->paid_date, '-') : '',
                            'paid_mode' => $payout->paid_mode,
                            'paid_unpaid' => strip_tags(paid_unpaid($payout->id)),
                        ];
                    })
            ], 200);            
        }else{
            $data['title'] = 'Payout History';
            $data['payouts'] = Payout::where('user_id',Auth::id())->orderBy('id','desc')->get();
            return view($this->view_path.'payout_history')->with($data);
        }
    }
}
