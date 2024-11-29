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
use App\Models\Payout;
use App\Models\RemunerationBenefit;
use App\Models\SalaryBonus;

use Illuminate\Support\Facades\DB;

class Report_Controller extends Controller
{

    public function __construct(){
        $this->middleware('role_or_permission:Income Report', ['only' => ['income_report','generate_income_report']]);
        $this->middleware('role_or_permission:Investor Return Report', ['only' => ['investor_return_report','generate_investor_return_report']]);
        $this->middleware('role_or_permission:Direct Bonus Report', ['only' => ['direct_bonus_report','generate_direct_bonus_report','direct_bonus_full_details','generate_direct_bonus_full_details']]);
        $this->middleware('role_or_permission:Lavel Bonus Report', ['only' => ['level_bonus_report','generate_level_bonus_report','level_bonus_full_details','generate_level_bonus_full_details']]);
        $this->middleware('role_or_permission:TDS Report', ['only' => ['tds_report','generate_tds_report','tds_deduction_full_details','generate_tds_deduction_full_details']]);
        $this->middleware('role_or_permission:Repurchase Report', ['only' => ['repurchase_report','generate_repurchase_report']]);
        $this->middleware('role_or_permission:Product Return Report', ['only' => ['product_return_report','generate_product_return_report','product_return_full_details','generate_product_return_full_details']]);
        $this->middleware('role_or_permission:ID Activation Report', ['only' => ['id_activation_report','generate_id_activation_report']]);
        $this->middleware('role_or_permission:Payout Report', ['only' => ['payout_report','payout_report_details','view_payout_statement']]);
        $this->middleware('role_or_permission:Remuneration Report', ['only' => ['remuneration_report','generate_remuneration_report']]);
    }

    // Income Report

    public function income_report(){
        $data['title'] = 'Sell Report';
        // $data['items'] = TopUp::whereDate('start_date',date('Y-m-d'))->get();
        $data['items'] = TopUp::all();
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

    // End of Income Report

    // Investor Return Report

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

    // End of Investor Return Report


    // Direct Bonus Report

    public function direct_bonus_report(){
        $data['title'] = 'Direct Bonus Report';
        $data['items'] = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                        ->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('MIN(created_at) as first_transaction'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.direct_bonus_report')->with($data);
    }

    public function generate_direct_bonus_report(Request $r){
        $data['title'] = 'Direct Bonus Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('MIN(created_at) as first_transaction'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.direct_bonus_report')->with($data);
    }

    public function direct_bonus_full_details(Request $r){
        $data['title'] = 'Direct Full Report';
        $user_id = $r->userid;
        $data['items'] = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                        ->where('user_id',get_id_using_user_id($r->userid))
                        ->get();
        return view('admin.reports.direct_bonus_full_report',compact('user_id'))->with($data);
    }

    public function generate_direct_bonus_full_details(Request $r){
        $data['title'] = 'Direct Full Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $user_id = $r->userid;
        $data['items'] = AccountTransaction::whereIn('which_for', ['Direct Bonus', 'Direct Bonus on Hold'])
                        ->where('user_id',get_id_using_user_id($r->userid))
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();
        return view('admin.reports.direct_bonus_full_report',compact('user_id'))->with($data);
    }

    // End of Direct Bonus Report

    // Lavel Bonus Report

    public function level_bonus_report(){
        $data['title'] = 'Level Bonus Report';
        $data['items'] = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                        ->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('MIN(created_at) as first_transaction'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.level_bonus_report')->with($data);
    }

    public function generate_level_bonus_report(Request $r){
        $data['title'] = 'Level Bonus Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('MIN(created_at) as first_transaction'))
                        ->groupBy('user_id')
                        ->get();
        return view('admin.reports.level_bonus_report')->with($data);
    }

    public function level_bonus_full_details(Request $r){
        $data['title'] = 'Level Bonus Full Report';
        $user_id = $r->userid;
        $data['items'] = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                        ->where('user_id',get_id_using_user_id($r->userid))
                        ->get();
        return view('admin.reports.level_bonus_full_report',compact('user_id'))->with($data);
    }

    public function generate_level_bonus_full_details(Request $r){
        $data['title'] = 'Level Bonus Full Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $user_id = $r->userid;
        $data['items'] = AccountTransaction::whereIn('which_for', ['Level Bonus','Level Bonus on Hold'])
                        ->where('user_id',get_id_using_user_id($r->userid))
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();
        return view('admin.reports.level_bonus_full_report',compact('user_id'))->with($data);
    }

    // End of Lavel Bonus Report

    // TDS Report

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

    // End of TDS Report

    // Repurchase Report

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

    // End of Repurchase Report

    // Product Return Report

    public function product_return_report(){
        $data['title'] = 'Product Support Report';
        // $data['items'] = AccountTransaction::where('which_for', 'ROI Daily')->get();
        $data['items'] = AccountTransaction::where(function ($query) {
                                                $query->where('which_for', 'ROI Daily')
                                                    ->orWhere('which_for', 'ROI Dailys');
                                            })
                                            ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                                            ->groupBy('user_id')
                                            ->get();
        return view('admin.reports.product_return_report')->with($data);
    }

    public function generate_product_return_report(Request $r){
        $data['title'] = 'Product Support Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        // $data['items'] = AccountTransaction::where('which_for', 'ROI Daily')->orWhere('which_for', 'ROI Dailys')
        //                 ->select('user_id', DB::raw('SUM(amount) as total_amount'))
        //                 ->whereDate('created_at', '>=', $startDate)
        //                 ->whereDate('created_at', '<=', $endDate)
        //                 ->groupBy('user_id')
        //                 ->get();
        $data['items'] = AccountTransaction::where(function ($query) {
                                                $query->where('which_for', 'ROI Daily')
                                                    ->orWhere('which_for', 'ROI Dailys');
                                            })
                                            ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                                            ->whereDate('created_at', '>=', $startDate)
                                            ->whereDate('created_at', '<=', $endDate)
                                            ->groupBy('user_id')
                                            ->get();
        return view('admin.reports.product_return_report')->with($data);
    }

    public function product_return_full_details(Request $r){
        $data['title'] = 'Product Support Full Report';
        $user_id = $r->userid;
        $data['items'] = AccountTransaction::where(function ($query) {
                                                $query->where('which_for', 'ROI Daily')
                                                    ->orWhere('which_for', 'ROI Dailys');
                                            })
                                            ->where('user_id', get_id_using_user_id($r->userid))
                                            ->get();
        return view('admin.reports.product_return_full_report',compact('user_id'))->with($data);
    }

    public function generate_product_return_full_details(Request $r){
        $data['title'] = 'Product Support Full Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $user_id = $r->userid;
        $data['items'] = AccountTransaction::where(function ($query) {
                            $query->where('which_for', 'ROI Daily')
                                ->orWhere('which_for', 'ROI Dailys');
                        })
                        ->where('user_id',get_id_using_user_id($r->userid))
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();
        return view('admin.reports.product_return_full_report',compact('user_id'))->with($data);
    }

    // End of Product Return Report

    // ID Activation Report

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

    // End of ID Activation Report


    // Payout Report

    public function payout_report(){
        $data['title'] = 'Payout Report';
        // $data['items'] = Payout::all();
        $data['items'] = Payout::select('start_date','end_date',DB::raw('SUM(total_payout) as total_payout'),DB::raw('COUNT(DISTINCT user_id) as total_user_count'))
                                ->groupBy('start_date', 'end_date')
                                ->get();
        return view('admin.reports.payout_report')->with($data);
    }

    public function payout_report_details($start_date, $end_date){
        $data['title'] = 'Payout Report';
        // $data['items'] = Payout::where('start_date',$start_date)->where('end_date',$end_date)->where('total_payout','>',0)->get();
        // $data['items'] = Payout::where('start_date', $start_date)
        //                         ->where('end_date', $end_date)
        //                         ->where('total_payout', '>', 0)
        //                         ->whereHas('user', function ($query) {
        //                             $query->where('block', 0); // assuming 'is_blocked' is the field name
        //                         })
        //                         ->whereHas('kyc', function ($query) {
        //                             $query->where('is_completed', 1); // assuming 'is_completed' is the field name for KYC status
        //                         })
        //                         ->get();
        $data['items'] = Payout::where('start_date', $start_date)
                                ->where('end_date', $end_date)
                                ->where('total_payout', '>', 0)
                                ->whereHas('user', function ($query) {
                                    $query->where('block', 0) // Check if user is not blocked
                                        ->whereHas('kyc', function ($kycQuery) {
                                            $kycQuery->where('is_confirmed', 1); // Check if KYC is completed
                                        });
                                })
                                ->get();
        return view('admin.reports.payout_report_details')->with($data);
    }

    public function update_paid_unpaid_status(Request $request)
    {
        $item = Payout::find($request->item_id);
        // return $item;
        if ($item) {
            $item->paid_unpaid = $request->status;
            $item->save();
            return response()->json(['message' => 'Updated successfully']);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }


    public function view_payout_statement($id){
        $data['title'] = 'Payout Report';
        $data['payout'] = Payout::find($id);
        return view('admin.reports.payout_statement')->with($data);
    }

    // End of Payout Report

    public function paid_unpaid_payment_report(){
        $data['title'] = 'Paid Unpaid Payment Report';
        // $data['items'] = Payout::where('paid_unpaid','0')->get();
        $data['items'] = Payout::all();                      
        // $lastDates = Payout::select('start_date', 'end_date')
        //                     ->orderBy('end_date', 'desc')
        //                     ->first();

        // if ($lastDates) {
        //     $data['items'] = Payout::where('start_date', $lastDates->start_date)
        //         ->where('end_date', $lastDates->end_date)
        //         ->get();
        // } else {
        //     $data['items'] = collect();
        // }
        return view('admin.reports.unpaid_payment_report')->with($data);
    }

    public function generate_paid_unpaid_payment_report(Request $r){
        $data['title'] = 'Paid Unpaid Payment Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;

        if(!empty($r->status) && $r->status == 'paid'){
            $data['items'] = Payout::where('paid_unpaid','1')
                            ->whereDate('end_date', '>=', $startDate)
                            ->whereDate('start_date', '<=', $endDate)
                            ->get();
        }elseif(!empty($r->status) && $r->status == 'unpaid'){
            $data['items'] = Payout::where('paid_unpaid','0')
                                ->whereDate('end_date', '>=', $startDate)
                                ->whereDate('start_date', '<=', $endDate)
                                ->get();
        }elseif(!empty($r->status) && $r->status == 'all'){
            $data['items'] = Payout::whereDate('end_date', '>=', $startDate)
                                ->whereDate('start_date', '<=', $endDate)
                                ->get();
        }else{
            $data['items'] = Payout::all();
        }
        return view('admin.reports.unpaid_payment_report')->with($data);
    }

    public function less_than_two_hundred_commission_repoet(){
        $data['title'] = 'Commission Report of > 200';
        // $data['items'] = Payout::where('hold_wallet','!=','0.00')->get();
        $lastDates = Payout::select('start_date', 'end_date')
                            ->orderBy('end_date', 'desc')
                            ->first();

        if ($lastDates) {
            $data['items'] = Payout::where('start_date', $lastDates->start_date)
                ->where('end_date', $lastDates->end_date)
                ->where('hold_wallet', '!=', '0.00')
                ->get();
        } else {
            $data['items'] = collect();
        }

        return view('admin.reports.less_than_two_hundred_commission_repoet')->with($data);
    }


    // Remuneration Report

    public function remuneration_report(){
        $data['title'] = 'Remuneration Report';
        $data['items'] = SalaryBonus::leftJoin('remuneration_benefits','remuneration_benefits.id','salary_bonus.remuneration_benefit_id')
                                        ->get();
        return view('admin.reports.remuneration_report')->with($data);
    }

    public function generate_remuneration_report(Request $r){
        $data['title'] = 'Remuneration Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = SalaryBonus::leftJoin('remuneration_benefits','remuneration_benefits.id','salary_bonus.remuneration_benefit_id')
                        ->whereDate('start_date', '>=', $startDate)
                        ->whereDate('start_date', '<=', $endDate)
                        ->get();
        return view('admin.reports.remuneration_report')->with($data);
    }

    // End of Remuneration Report

}