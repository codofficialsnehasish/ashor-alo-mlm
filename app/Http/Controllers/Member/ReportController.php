<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TopUp;
use App\Models\AccountTransaction;
use App\Models\MLMSettings;
use App\Models\TDSAccount;
use App\Models\RepurchaseAccount;
use App\Models\RemunerationBenefit;
use App\Models\SalaryBonus;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    // Top Up Report

    public function topup_report(Request $request){
        if ($request->is('api/*')) {
            return response()->json([  
                'status' => "true",
                'data' => TopUp::where('user_id',$request->user()->id)->get()
            ], 200);
        }else{
            $data['title'] = 'Topup Report';
            $data['items'] = TopUp::where('user_id',Auth::id())->get();
            return view('site.user_dashboard.reports.top_up_report')->with($data);
        }
    }

    public function generate_topup_report(Request $r){
        $data['title'] = 'Topup Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = TopUp::whereDate('start_date', '>=', $startDate)
        ->whereDate('start_date', '<=', $endDate)->get();
        return view('site.user_dashboard.reports.top_up_report')->with($data);
    }

    public function remuneration_report(Request $request){
        if ($request->is('api/*')) {
            return response()->json([  
                'status' => "true",
                'data' => SalaryBonus::leftJoin('remuneration_benefits','remuneration_benefits.id','salary_bonus.remuneration_benefit_id')
                                        ->where('user_id',$request->user()->id)
                                        ->get()
            ], 200);
        }else{
            $data['title'] = 'Remuneration Report';
            $data['items'] = SalaryBonus::leftJoin('remuneration_benefits','remuneration_benefits.id','salary_bonus.remuneration_benefit_id')
                                            ->where('user_id',Auth::id())
                                            ->get();
            return view('site.user_dashboard.reports.remuneration_report')->with($data);
        }
    }

    public function dilse_plan_report(){
        $data['title'] = 'Dilse Plan Report';
        $data['items'] = TopUp::where('is_personal_business',1)->where('user_id',Auth::id())->get();
        $data['mlm_settings'] = MLMSettings::first();
        return view('site.user_dashboard.reports.dilse_plan_report')->with($data);
    }
}