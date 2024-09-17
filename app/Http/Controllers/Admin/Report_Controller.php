<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TopUp;
use App\Models\AccountTransaction;
use App\Models\MLMSettings;
use App\Models\TDSAccount;
use App\Models\RepurchaseAccount;

use Illuminate\Support\Facades\DB;

class Report_Controller extends Controller
{
    public function income_report(){
        $data['title'] = 'Sell Report';
        $data['items'] = TopUp::whereDate('start_date',date('Y-m-d'))->get();
        return view('admin.reports.income_report')->with($data);
    }

    public function generate_income_report(Request $r){
        $data['title'] = 'Sell Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = TopUp::whereDate('start_date', '>=', $startDate)
        ->whereDate('start_date', '<=', $endDate)->get();
        return view('admin.reports.income_report')->with($data);
    }

    public function investor_return_report(){
        $data['title'] = 'Investor Return Report';
        $data['items'] = TopUp::all();
        $data['mlm_settings'] = MLMSettings::first();
        return view('admin.reports.investor_return_report')->with($data);
    }

    public function generate_investor_return_report(Request $r){
        $data['title'] = 'Investor Return Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['mlm_settings'] = MLMSettings::first();
        $data['items'] = TopUp::whereDate('start_date', '>=', $startDate)
        ->whereDate('start_date', '<=', $endDate)->get();
        return view('admin.reports.investor_return_report')->with($data);
    }

    public function direct_bonus_report(){
        $data['title'] = 'Direct Bonus Report';
        $data['items'] = AccountTransaction::where('which_for', 'Direct Bonus')
                        ->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('MIN(created_at) as first_transaction'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.direct_bonus_report')->with($data);
    }

    public function generate_direct_bonus_report(Request $r){
        $data['title'] = 'Direct Bonus Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = AccountTransaction::where('which_for', 'Direct Bonus')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('MIN(created_at) as first_transaction'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.direct_bonus_report')->with($data);
    }

    public function level_bonus_report(){
        $data['title'] = 'Level Bonus Report';
        $data['items'] = AccountTransaction::where('which_for', 'Level Bonus')
                        // ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                        // ->groupBy('user_id')
                        ->get();
        return view('admin.reports.level_bonus_report')->with($data);
    }

    public function generate_level_bonus_report(Request $r){
        $data['title'] = 'Level Bonus Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = AccountTransaction::where('which_for', 'Level Bonus')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        // ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                        // ->groupBy('user_id')
                        ->get();
        return view('admin.reports.level_bonus_report')->with($data);
    }


    public function tds_report(){
        $data['title'] = 'TDS Report';
        $data['items'] = TDSAccount::select('user_id', DB::raw('SUM(amount) as amount'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.tds_report')->with($data);
    }

    public function generate_tds_report(Request $r){
        $data['title'] = 'TDS Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = TDSAccount::whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->select('user_id', DB::raw('SUM(amount) as amount'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.tds_report')->with($data);
    }

    public function tds_deduction_full_details(Request $r){
        $data['title'] = 'TDS Full Report';
        $user_id = $r->userid;
        $data['items'] = TDSAccount::where('user_id',get_id_using_user_id($r->userid))
                        ->get();
        return view('admin.reports.tds_full_report',compact('user_id'))->with($data);
    }

    public function generate_tds_deduction_full_details(Request $r){
        $data['title'] = 'TDS Full Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $user_id = $r->userid;
        $data['items'] = TDSAccount::where('user_id',get_id_using_user_id($r->userid))
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();
        return view('admin.reports.tds_full_report',compact('user_id'))->with($data);
    }

    public function repurchase_report(){
        $data['title'] = 'Repurchase Report';
        $data['items'] = RepurchaseAccount::all();
        return view('admin.reports.repurchase_report')->with($data);
    }

    public function generate_repurchase_report(Request $r){
        $data['title'] = 'Repurchase Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = RepurchaseAccount::whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();
        return view('admin.reports.repurchase_report')->with($data);
    }

    public function product_return_report(){
        $data['title'] = 'Product Return Report';
        $data['items'] = AccountTransaction::where('which_for', 'ROI Daily')->get();
        return view('admin.reports.product_return_report')->with($data);
    }

    public function generate_product_return_report(Request $r){
        $data['title'] = 'Product Return Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = AccountTransaction::where('which_for', 'ROI Daily')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();
        return view('admin.reports.product_return_report')->with($data);
    }

    public function id_activation_report(){
        $data['title'] = 'ID Activation Report';
        $data['items'] = User::where('role', 'agent')->where('status',1)->get();
        $data['admins'] = User::where('role','admin')->where('status',1)->get();
        return view('admin.reports.id_activation_report')->with($data);
    }

    public function generate_id_activation_report(Request $r){
        $data['title'] = 'ID Activation Report';
        $data['admins'] = User::where('role','admin')->where('status',1)->get();
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        if(!empty($r->activated_by)){
            $data['items'] = User::where('role', 'agent')
                            ->where('status',1)
                            ->where('join_by',$r->activated_by)
                            ->whereDate('join_amount_put_date', '>=', $startDate)
                            ->whereDate('join_amount_put_date', '<=', $endDate)
                            ->get();
        }else{
            $data['items'] = User::where('role', 'agent')
                            ->where('status',1)
                            ->whereDate('join_amount_put_date', '>=', $startDate)
                            ->whereDate('join_amount_put_date', '<=', $endDate)
                            ->get();
        }
        return view('admin.reports.id_activation_report')->with($data);
    }
}