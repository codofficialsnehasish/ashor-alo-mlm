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

class BusinessReport extends Controller
{
    public function level_wise(){

        $customerTree = get_customer_tree(Auth::user()->user_id);

        // Levels array to hold users grouped by level
        $levels = [];
        $levelData = build_customer_array($customerTree, $levels);

        // Collect all users with their level into a single array
        $usersWithLevels = [];
        foreach ($levels as $levelKey => $customers) {
            $currentLevel = substr($levelKey, 5); // Extract the level number from key
            foreach ($customers as $customer) {
                $usersWithLevels[] = [
                    'id' => $customer['id'],
                    'level' => (int)$currentLevel,
                    'user_id' => $customer['user_id'],
                    'name' => $customer['name'],
                    'reg_date' => $customer['reg_date'],
                    'position' => $customer['position'],
                    'sponsor_id' => $customer['agent_id'],
                    'status' => $customer['status'],
                ];
            }
        }

        $buyer_ids = array_column($usersWithLevels, 'id');
        // return count($buyer_ids);
        // return $buyer_ids;
        $total_businesss = TopUp::whereIn('user_id', $buyer_ids)->where('is_provide_direct',1)->orderBy('id','ASC')->get();

        // return count($total_businesss);
        // return $usersWithLevels;
        // return $total_businesss;

        $business = [];
        foreach ($total_businesss as $total_business) {
            $matchingUser = array_filter($usersWithLevels, function ($user) use ($total_business) {
                return $user['id'] == $total_business->user_id;
            });
            if (!empty($matchingUser)) {
                $business[] = array_merge(current($matchingUser), [
                    'total_business' => $total_business,
                ]);
            }
        }

        $groupedBusiness = [];
        foreach ($business as $item) {
            $level = $item['level'];
            // Initialize an array for the level if not already exists
            if (!isset($groupedBusiness[$level])) {
                $groupedBusiness[$level] = [];
            }
            // Add the current item to the level group
            $groupedBusiness[$level][] = $item;
        }

        // return $groupedBusiness;

        $data['title'] = 'Level Wise Business Report';
        return view('site.user_dashboard.reports.business_report.level_wise',compact('groupedBusiness'))->with($data);
    }


    public function tree_wise(){
        return view('site.user_dashboard.reports.business_report.tree_wise');
    }
}