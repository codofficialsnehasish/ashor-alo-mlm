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

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;

class BusinessReport extends Controller
{
    public function level_wise(Request $request){

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

        ksort($groupedBusiness);
        // return $groupedBusiness;

        $data['title'] = 'Level Wise Business Report of '.Auth::user()->name;
        $users = array_merge(getLeftSideMembers(Auth::id()),getRightSideMembers(Auth::id()));

        // $data['users'] = User::where("role","!=","admin")->orderBy('name', 'asc')->get();
        $data['users'] = $users;

        $data['pdf_link'] = route('member.business-report.level-wise-business-exportPdf',[Auth::user()->user_id]);
        $data['excel_link'] = route('member.business-report.level-wise-business-exportExcel',[Auth::user()->user_id]);

        return view('site.user_dashboard.reports.business_report.level_wise',compact('groupedBusiness'))->with($data);
    }

    public function level_wise_api(Request $request)
    {
        $customerTree = get_customer_tree($request->user()->user_id);

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
        $total_businesss = TopUp::whereIn('user_id', $buyer_ids)
            ->where('is_provide_direct', 1)
            ->orderBy('id', 'ASC')
            ->get();

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
            if (!isset($groupedBusiness[$level])) {
                $groupedBusiness[$level] = [];
            }
            $groupedBusiness[$level][] = $item;
        }

        ksort($groupedBusiness);
        // Prepare the response
        $total_amount = 0;
        $total_user_count = 0;
        $response = [];

        foreach ($groupedBusiness as $level => $businessData) {
            $level_total = 0;
            $level_data = [];
            foreach ($businessData as $index => $item) {
                $amount = $item['total_business']->total_amount ?? 0;
                $level_total += $amount;
                $total_amount += $amount;
                $total_user_count++;

                $level_data[] = [
                    'sl_no' => $index + 1,
                    'name' => $item['name'],
                    'user_id' => $item['user_id'],
                    'sponsor_id' => $item['sponsor_id'],
                    'reg_date' => formated_date($item['total_business']->start_date ?? '-', '-'),
                    'amount' => $amount,
                    'product' => get_products_by_order_id($item['total_business']->order_id ?? ''),
                ];
            }

            $response[] = [
                'level' => $level,
                'total_amount' => $level_total,
                'data' => $level_data,
            ];
        }

        $data = [
            'title' => 'Level Wise Business Report of ' . $request->user()->name,
            'pdf_link' => route('member.business-report.level-wise-business-exportPdf', [$request->user()->user_id]),
            'excel_link' => route('member.business-report.level-wise-business-exportExcel', [$request->user()->user_id]),
            'grouped_business' => $response,
            'users' => array_merge(getLeftSideMembers($request->user()->id),getRightSideMembers($request->user()->id)),
            'total_amount' => $total_amount,
            'total_user_count' => $total_user_count,
        ];

        return response()->json([
            'status' => 'true',
            'data' => $data,
        ], 200);
    }


    public function generate_date_wise_level_report(Request $request){
        if(isset($request->user_id)){
            $user = User::where('user_id',$request->user_id)->first();
        }else{
            $user = Auth::user();
        }
        $customerTree = get_customer_tree($user->user_id);
        // $customerTree = get_customer_tree(Auth::user()->user_id);

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
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $total_businesss = TopUp::whereIn('user_id', $buyer_ids)
                                ->where('is_provide_direct',1)
                                ->whereDate('start_date', '>=', $startDate)
                                ->whereDate('start_date', '<=', $endDate)
                                ->orderBy('id','ASC')->get();

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

        ksort($groupedBusiness);
        // return $groupedBusiness;

        $data['title'] = 'Level Wise Business Report of '.$user->name.' from '.formated_date($startDate).' to '.formated_date($endDate);
        $users = array_merge(getLeftSideMembers(Auth::id()),getRightSideMembers(Auth::id()));
        // $data['users'] = User::where("role","!=","admin")->orderBy('name', 'asc')->get();
        $data['users'] = $users;
        $data['pdf_link'] = route('member.business-report.level-wise-business-exportPdf',[$user->user_id,$startDate,$endDate]);
        $data['excel_link'] = route('member.business-report.level-wise-business-exportExcel',[$user->user_id,$startDate,$endDate]);
        return view('site.user_dashboard.reports.business_report.level_wise',compact('groupedBusiness'))->with($data);
    }

    public function generate_date_wise_level_report_api(Request $request)
    {
        if(!isset($request->start_date) && !isset($request->end_date)){
            return response()->json(['status' => "false",'message' => 'Start Date & end Date is required'], 422);
        }
        if(isset($request->user_id)){
            $user = User::where('user_id',$request->user_id)->first();
        }else{
            $user = $request->user();
        }

        if (!$user) {
            return response()->json(['status' => "false",'message' => 'User not found'], 404);
        }

        $customerTree = get_customer_tree($user->user_id);

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


        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $total_businesss = TopUp::whereIn('user_id', $buyer_ids)
                                ->where('is_provide_direct',1)
                                ->whereDate('start_date', '>=', $startDate)
                                ->whereDate('start_date', '<=', $endDate)
                                ->orderBy('id','ASC')->get();

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
            if (!isset($groupedBusiness[$level])) {
                $groupedBusiness[$level] = [];
            }
            $groupedBusiness[$level][] = $item;
        }

        ksort($groupedBusiness);
        // Prepare the response
        $total_amount = 0;
        $total_user_count = 0;
        $response = [];

        foreach ($groupedBusiness as $level => $businessData) {
            $level_total = 0;
            $level_data = [];
            foreach ($businessData as $index => $item) {
                $amount = $item['total_business']->total_amount ?? 0;
                $level_total += $amount;
                $total_amount += $amount;
                $total_user_count++;

                $level_data[] = [
                    'sl_no' => $index + 1,
                    'name' => $item['name'],
                    'user_id' => $item['user_id'],
                    'sponsor_id' => $item['sponsor_id'],
                    'reg_date' => formated_date($item['total_business']->start_date ?? '-', '-'),
                    'amount' => $amount,
                    'product' => get_products_by_order_id($item['total_business']->order_id ?? ''),
                ];
            }

            $response[] = [
                'level' => $level,
                'total_amount' => $level_total,
                'data' => $level_data,
            ];
        }

        $data = [
            'title' => 'Level Wise Business Report of '.$user->name.' from '.formated_date($startDate).' to '.formated_date($endDate),
            'pdf_link' => route('member.business-report.level-wise-business-exportPdf', [$user->user_id,$startDate,$endDate]),
            'excel_link' => route('member.business-report.level-wise-business-exportExcel', [$user->user_id,$startDate,$endDate]),
            'grouped_business' => $response,
            'users' => array_merge(getLeftSideMembers($user->id),getRightSideMembers($user->id)),
            'total_amount' => $total_amount,
            'total_user_count' => $total_user_count,
        ];

        return response()->json([
            'status' => 'true',
            'data' => $data,
        ], 200);
    }

    public function level_wise_business_exportPdf($user_id=null,$start_date=null, $end_date=null)
    {
        // return "on member";
        try {
            if(isset($user_id)){
                $user = User::where('user_id',$user_id)->first();
            }else{
                $user = User::whereNull('parent_id')->where('role','agent')->first();
            }
    
            $customerTree = get_customer_tree($user->user_id);
    
            $levels = [];
            $levelData = build_customer_array($customerTree, $levels);

            $usersWithLevels = [];
            foreach ($levels as $levelKey => $customers) {
                $currentLevel = substr($levelKey, 5);
                foreach ($customers as $customer) {
                    $usersWithLevels[] = [
                        'id' => $customer['id'],
                        'level' => (int)$currentLevel,
                        'user_id' => $customer['user_id'],
                        'name' => $customer['name'],
                        'phone' => $customer['phone'],
                        'reg_date' => $customer['reg_date'],
                        'position' => $customer['position'],
                        'sponsor_id' => $customer['agent_id'],
                        'status' => $customer['status'],
                    ];
                }
            }
    
            $buyer_ids = array_column($usersWithLevels, 'id');

            if($start_date == null){
                $total_businesss = TopUp::whereIn('user_id', $buyer_ids)->where('is_provide_direct',1)->orderBy('id','ASC')->get();
            }else{
                $startDate = $start_date;
                $endDate = $end_date;
                $total_businesss = TopUp::whereIn('user_id', $buyer_ids)
                                        ->where('is_provide_direct',1)
                                        ->whereDate('start_date', '>=', $startDate)
                                        ->whereDate('start_date', '<=', $endDate)
                                        ->orderBy('id','ASC')->get();
            }

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
                if (!isset($groupedBusiness[$level])) {
                    $groupedBusiness[$level] = [];
                }
                $groupedBusiness[$level][] = $item;
            }

            ksort($groupedBusiness);
            if($start_date == null){
                $title = 'Level Wise Business Report of '.$user->name;
            }else{
                $title = 'Level Wise Business Report of '.$user->name.' from '.formated_date($startDate).' to '.formated_date($endDate);
            }

            $sanitizedTitle = preg_replace('/[^A-Za-z0-9\-]/', '_', $title);
            $pdf = Pdf::loadView('site.user_dashboard.reports.business_report.level-wisw-bisiness-pdf', compact('groupedBusiness','title'));
            return $pdf->download($sanitizedTitle.'.pdf');
        } catch (\Exception $e) {
            return back()->with('error','An error occurred while generating the PDF. '.$e->getMessage());
        }
    }

    public function level_wise_business_exportExcel($user_id=null,$start_date=null, $end_date=null)
    {
        try {
            if(isset($user_id)){
                $user = User::where('user_id',$user_id)->first();
            }else{
                $user = Auth::user();
            }
    
            $customerTree = get_customer_tree($user->user_id);
    
            $levels = [];
            $levelData = build_customer_array($customerTree, $levels);

            $usersWithLevels = [];
            foreach ($levels as $levelKey => $customers) {
                $currentLevel = substr($levelKey, 5);
                foreach ($customers as $customer) {
                    $usersWithLevels[] = [
                        'id' => $customer['id'],
                        'level' => (int)$currentLevel,
                        'user_id' => $customer['user_id'],
                        'name' => $customer['name'],
                        'phone' => $customer['phone'],
                        'reg_date' => $customer['reg_date'],
                        'position' => $customer['position'],
                        'sponsor_id' => $customer['agent_id'],
                        'status' => $customer['status'],
                    ];
                }
            }
    
            $buyer_ids = array_column($usersWithLevels, 'id');

            if($start_date == null){
                $total_businesss = TopUp::whereIn('user_id', $buyer_ids)->where('is_provide_direct',1)->orderBy('id','ASC')->get();
            }else{
                $startDate = $start_date;
                $endDate = $end_date;
                $total_businesss = TopUp::whereIn('user_id', $buyer_ids)
                                        ->where('is_provide_direct',1)
                                        ->whereDate('start_date', '>=', $startDate)
                                        ->whereDate('start_date', '<=', $endDate)
                                        ->orderBy('id','ASC')->get();
            }

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
                if (!isset($groupedBusiness[$level])) {
                    $groupedBusiness[$level] = [];
                }
                $groupedBusiness[$level][] = $item;
            }

            ksort($groupedBusiness);

            $headers = ['Sl. No.', 'Name', 'Sponsor ID', 'Level', 'Date', 'Amount', 'Product'];

            // Prepare the data for Excel export
            $data = [];
            $counter = 1;
            foreach ($groupedBusiness as $level => $business) {
                foreach ($business as $item) {
                    $data[] = [
                        'Sl. No.' => $counter++,
                        'Name' => $item['name'],
                        'Sponsor ID' => $item['sponsor_id'],
                        'Level' => 'Level '.$item['level'],
                        'Date' => $item['total_business']->start_date,
                        'Amount' => $item['total_business']->total_amount,
                        'Product' => get_products_by_order_id($item['total_business']->order_id),
                    ];
                }
            }

            array_unshift($data, $headers);  // Add headers to the beginning of the data

            // Create an inline export class to generate the Excel file
            $export = new class($data) implements FromArray {
                protected $data;

                public function __construct(array $data)
                {
                    $this->data = $data;
                }

                public function array(): array
                {
                    return $this->data;
                }
            };

            // Download the Excel file with a dynamic filename
            $title = 'Level Wise Business Report of ' . $user->name;
            if ($start_date && $end_date) {
                $title .= ' from ' . formated_date($start_date) . ' to ' . formated_date($end_date);
            }

            // Sanitize the title for a valid filename
            $sanitizedTitle = preg_replace('/[^A-Za-z0-9\-]/', '_', $title);

            return Excel::download($export, $sanitizedTitle . '.xlsx');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while generating the Excel. ' . $e->getMessage());
        }
    }


    public function tree_wise(Request $request){
        $userId = $request->input('query');
        $data['title'] = 'Tree Wise Business Report';
        if(empty($userId)){
            // return 0;
            $rootUser = User::where('user_id',Auth::user()->user_id)->first();
        }else{
            // return 1;
            $rootUser = User::where('role','agent')->where('user_id',$userId)->first();
        }
        return view('site.user_dashboard.reports.business_report.tree_wise',compact('rootUser'))->with($data);
    }


    public function tree_wise_api(Request $request,$user_id=null)
    {
        // return $user_id;
        $rootUser = empty($user_id) 
            ? User::where('user_id', $request->user()->user_id)->first()
            : User::where('role', 'agent')->where('user_id', $user_id)->first();

        if (!$rootUser) {
            return response()->json(['status' => "false",'message' => 'User not found'], 404);
        }

        $response = [
            'status' => "true",
            'data' => [
                'name' => $rootUser->name,
                'user_id' => $rootUser->user_id,
                'user_image' => !empty($rootUser->user_image) 
                    ? asset($rootUser->user_image) 
                    : asset('dashboard_assets/images/users/user-14.png'),
                'status' => $rootUser->status == 1 ? 'active' : 'inactive',
                'left_business' => calculate_left_business($rootUser->id),
                'right_business' => calculate_right_business($rootUser->id),
            ],
        ];

        return response()->json($response);
    }


}