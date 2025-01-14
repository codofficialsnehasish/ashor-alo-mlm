<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class User_management extends Controller
{
    public function __construct(){
        $this->view_path='site.user_dashboard.member_management.';
    }

    public function member_requests(){
        $data['title'] = 'Member Requests';
        $data['members'] = User::where('is_approved','=',0)
                            ->where('agent_id','=',Auth::user()->phone)
                            ->orderBy('id', 'asc')->get();
        return view($this->view_path."member_requests")->with($data);
    }

    public function approve_in_left(Request $r){
        $user = User::find($r->id);
        $user->is_left = 1;
        $user->is_approved = 1;
        $user->update();

        return redirect()->back()->with(['success'=>'Approved Successfully']);
    }

    public function approve_in_right(Request $r){
        $user = User::find($r->id);
        $user->is_right = 1;
        $user->is_approved = 1;
        $user->update();

        return redirect()->back()->with(['success'=>'Approved Successfully']);
    }

    private function get_customers_by_agent_id($agent_id) {
        return User::where('agent_id', $agent_id)->get();
    }
    
    private function get_all_customers($phone) {
        $customers = $this->get_customers_by_agent_id($phone);
        $all_customers = [];

        foreach ($customers as $customer) {
            $all_customers[] = $customer;
            $sub_customers = $this->get_all_customers($customer->phone);
            $all_customers = array_merge($all_customers, $sub_customers);
        }

        return $all_customers;
    }

    public function all_members(Request $request){
        $data['title'] = 'All Team';
        if ($request->is('api/*')) { $user_id = $request->user()->id; }else{ $user_id = Auth::id(); }
        $left_side_members = getLeftSideMembers($user_id);
        $right_side_members = getRightSideMembers($user_id);

        if ($request->is('api/*')) {
            $user = User::find($request->user()->id);
            return response()->json([
                'status' => "true",
                'data' => array_merge($left_side_members,$right_side_members)
            ], 200);
        }else{
            // $data['members'] = $this->get_all_customers(Auth::user()->phone);
            $data['members'] = array_merge($left_side_members,$right_side_members);
            return view($this->view_path."all_members")->with($data);
        }
    }

    public function direct(Request $request){
        if ($request->is('api/*')) {
            $user = User::find($request->user()->id);
            return response()->json([
                'status' => "true",
                'data' => User::where('agent_id',$user->user_id)->where('is_deleted', 0)->get()
            ], 200);
        }else{
            $data['title'] = 'Direct Members';
            $data['members'] = User::where('agent_id',Auth::user()->user_id)->where('is_deleted', 0)->get();
            return view($this->view_path."direct")->with($data);
        }
    }

    public function left_side_members(Request $request){
        $data['title'] = 'Left Side Members';
        // $data['members'] = User::where('agent_id','=',Auth::user()->phone)
        //                         ->where('is_left','=',1)
        //                         ->orderBy('id', 'asc')->get();

        // $all_customers = [];
        // $fetch_customers = function($phone) use (&$all_customers, &$fetch_customers) {
        //     $customers = User::where('agent_id', $phone)->where('is_left',1)->get();
        //     foreach ($customers as $customer) {
        //         $all_customers[] = $customer;
        //         $fetch_customers($customer->phone);
        //     }
        // };
        // $fetch_customers(Auth::user()->phone);
        // $data['members'] = $all_customers;
        if ($request->is('api/*')) {
            return response()->json([
                'status' => "true",
                'data' => getLeftSideMembers($request->user()->id)
            ], 200);
        }else{
            $data['members'] = getLeftSideMembers(Auth::id());
            return view($this->view_path."left_side_members")->with($data);
        }
    }

    public function right_side_members(Request $request){
        $data['title'] = 'Right Side Members';
        // $data['members'] = User::where('agent_id','=',Auth::user()->phone)
        //                         ->where('is_right','=',1)
        //                         ->orderBy('id', 'asc')->get();

        // $all_customers = [];
        // $fetch_customers = function($phone) use (&$all_customers, &$fetch_customers) {
        //     $customers = User::where('agent_id', $phone)->where('is_right',1)->get();
        //     foreach ($customers as $customer) {
        //         $all_customers[] = $customer;
        //         $fetch_customers($customer->phone);
        //     }
        // };
        // $fetch_customers(Auth::user()->phone);
        // $data['members'] = $all_customers;
        if ($request->is('api/*')) {
            return response()->json([
                'status' => "true",
                'data' => getRightSideMembers($request->user()->id)
            ], 200);
        }else{
            $data['members'] = getRightSideMembers(Auth::id());
            return view($this->view_path."right_side_members")->with($data);
        }
    }

    // public function tree_view(){
    //     $data['title'] = 'Tree View';
    //     $data['rootUsers'] = User::where('role','agent')->where('user_id',Auth::user()->user_id)->get();
    //     return view($this->view_path."tree_view")->with($data);
    // }

    public function tree_view($userId = null) {
        $title = 'Tree View';
        if(empty($userId)){
            $rootUsers = User::where('user_id',Auth::user()->user_id)->get();
        }else{
            $rootUsers = User::where('role','agent')->where('user_id',$userId)->get();
        }
        $html = '';
        foreach ($rootUsers as $user){
            $html .= $this->generateTreeHtml($user);
        }
        return view($this->view_path."tree_view", compact('html','title'));
    }
    
    /*private function generateTreeHtml($user, $currentDepth = 0){
        if ($currentDepth > 3) {
            return '';
        }

        $leftChild = $user ? $user->children->firstWhere('is_left', 1) : null;
        $rightChild = $user ? $user->children->firstWhere('is_right', 1) : null;

        $html = '<li>';
        if(!empty($user->user_id)){
            $html .= '<a href="' . route('member.tree-view',$user ? $user->user_id : '') . '">
                        <div class="member-view-box n-ppost">
                            <div class="member-header">
                                <span></span>
                            </div>
                            <div class="member-image">
                                <img src="' . (!empty($user->user_image) ? asset($user->user_image) : asset('dashboard_assets/images/users/user-14.png')) . '" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;border: 3px solid ' . ($user && $user->status == 1 ? 'green' : 'red') . ';" alt="Member" class="rounded-circle">
                            </div>
                            <div class="member-footer">
                                <div class="name"><span>' . ($user ? $user->name : '') . '</span></div>
                                <div class="downline"><span>(' . ($user ? $user->user_id : '') . ')</span></div>
                            </div>
                        </div>
                        <div class="n-ppost-name">
                            <div class="element">
                                <label>Name :</label> <strong style="padding-left: 50px;">' . ($user ? $user->name : '') . '</strong>
                            </div>
                            <div class="left">
                                <div class="element">
                                    <label>Sponsor ID :</label> <strong>' . ($user ? $user->agent_id : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Joining Date :</label> <strong>' . ($user ? formated_date($user->created_at) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Register (Left) :</label> <strong>' . ($user ? register_left($user->id) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Activated (Left) :</label> <strong>' . ($user ? activated_left($user->id) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Total Left :</label> <strong>' . ($user ? total_left($user->id) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Curr. Left BV :</label> <strong>'.($user ? calculate_curr_left_business($user->id) : '').'</strong>
                                </div>
                                <div class="element">
                                    <label>Total Left BV :</label> <strong>'. ($user ? calculate_left_business($user->id) : '') .'</strong>
                                </div>
                                <div class="element">
                                    <label>Total User :</label> <strong>' . ($user ? total_user($user->id) : '') . '</strong>
                                </div>
                            </div>
                            <div class="right">
                                <div class="element">
                                    <label>Rank :</label> <strong></strong>
                                </div>
                                <div class="element">
                                    <label>Confirm Date :</label> <strong></strong>
                                </div>
                                <div class="element">
                                    <label>Register (Right) :</label> <strong>' . ($user ? register_right($user->id) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Activated (Right) :</label> <strong>' . ($user ? activated_right($user->id) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Total Right :</label> <strong>' . ($user ? total_right($user->id) : '') . '</strong>
                                </div>
                                <div class="element">
                                    <label>Curr. Right BV :</label> <strong>'.($user ? calculate_curr_right_business($user->id) : '').'</strong>
                                </div>
                                <div class="element">
                                    <label>Total Right BV :</label> <strong>'. ($user ? calculate_right_business($user->id) : '') .'</strong>
                                </div>
                            </div>
                        </div>
                    </a>';
        }else{
            $html .= '<a href="javascript:void(0);">
            <div class="member-view-box">
                <div class="member-header">
                    <span></span>
                </div>
                <div class="member-image">
                    <img src="'. asset('dashboard_assets/images/users/user-16.png') .'" style="width: 70px;height: 70px;border-radius: 50%;object-fit: cover;" alt="Member" class="rounded-circle">
                </div>
                <div class="member-footer">
                    <div class="name"><span> </span></div>
                    <div class="downline"><span> </span></div>
                </div>
            </div>
        </a>';
        }
        if($currentDepth != 3){
            $html .= '<ul class="active">'
                        . $this->generateTreeHtml($leftChild, $currentDepth + 1) .
                        $this->generateTreeHtml($rightChild, $currentDepth + 1) .
                    '</ul>
                </li>';
        }
        return $html;
    }*/

    private function generateTreeHtml($user, $currentDepth = 0){
        if ($currentDepth > 3) {
            return '';
        }

        // $leftChild = $user ? $user->children->firstWhere('is_left', 1) : null;
        // $rightChild = $user ? $user->children->firstWhere('is_right', 1) : null;


        $leftChild = $user ? $user->children->where('is_left', 1)->where('is_deleted', 0)->first() : null;
        $rightChild = $user ? $user->children->where('is_right', 1)->where('is_deleted', 0)->first() : null;

        $html = '<li>';
        if(!empty($user->user_id) && $user->is_deleted != 1){
            $html .= '<a href="' . route('member.tree-view',$user ? $user->user_id : '') . '">
                        <div class="member-view-box n-ppost">
                            <div class="member-header">
                                <span></span>
                            </div>
                            <div class="member-image">
                                <img src="' . (!empty($user->user_image) ? asset($user->user_image) : asset('dashboard_assets/images/users/user-14.png')) . '" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;border: 3px solid ' . ($user && $user->status == 1 ? 'green' : 'red') . ';" alt="Member" class="rounded-circle">
                            </div>
                            <div class="member-footer">
                                <div class="name"><span>' . ($user ? $user->name : '') . '</span></div>
                                <div class="downline"><span>(' . ($user ? $user->user_id : '') . ')</span></div>
                            </div>
                        </div>
                    </a>';
        }else{
            $html .= '<a href="javascript:void(0);">
            <div class="member-view-box">
                <div class="member-header">
                    <span></span>
                </div>
                <div class="member-image">
                    <img src="'. asset('dashboard_assets/images/users/user-16.png') .'" style="width: 70px;height: 70px;border-radius: 50%;object-fit: cover;" alt="Member" class="rounded-circle">
                </div>
                <div class="member-footer">
                    <div class="name"><span> </span></div>
                    <div class="downline"><span> </span></div>
                </div>
            </div>
        </a>';
        }
        if($currentDepth != 3){
            $html .= '<ul class="active">'
                        . $this->generateTreeHtml($leftChild, $currentDepth + 1) .
                        $this->generateTreeHtml($rightChild, $currentDepth + 1) .
                    '</ul>
                </li>';
        }
        return $html;
    }

    // for API
    public function tree_view_array(Request $request, $q_user_id=null) {
        if(empty($q_user_id)){
            $rootUsers = User::where('user_id', $request->user()->user_id)->where('role', 'agent')->get();
        }else{
            if(User::where('user_id', $q_user_id)->exists()){
                $rootUsers = User::where('role','agent')->where('user_id',$q_user_id)->get();
            }else{
                return response()->json(['status' => "false",'massage' => 'User id not exists'], 422);
            }
        }
    
        $treeData = [];
        foreach ($rootUsers as $user) {
            $treeData[] = $this->generateTreeArray($user);
        }
    
        return response()->json([
            'status' => "true",
            'data' => $treeData,
        ]);
    }
    
    private function generateTreeArray($user, $currentDepth = 0) {
        if ($currentDepth > 3 || !$user) {
            return null;
        }
    
        $leftChild = $user->children->where('is_left', 1)->where('is_deleted', 0)->first();
        $rightChild = $user->children->where('is_right', 1)->where('is_deleted', 0)->first();
    
        return [
            'user_id' => $user->user_id,
            'name' => $user->name,
            'image' => !empty($user->user_image) ? asset($user->user_image) : asset('dashboard_assets/images/users/user-14.png'),
            'status' => $user->status == 1 ? 'active' : 'inactive',
            'left_child' => $this->generateTreeArray($leftChild, $currentDepth + 1),
            'right_child' => $this->generateTreeArray($rightChild, $currentDepth + 1),
        ];
    }
    // end of API

    public function level_view(){
        $data['title'] = 'Level View';
        $left_side_members = getLeftSideMembers(Auth::id());
        $right_side_members = getRightSideMembers(Auth::id());

        // $data['members'] = $this->get_all_customers(Auth::user()->phone);
        $data['members'] = array_merge($left_side_members,$right_side_members);
        return view($this->view_path."level_view")->with($data);
    }

    public function level_view_api(Request $request)
    {
        $left_side_members = getLeftSideMembers($request->user()->id);
        $right_side_members = getRightSideMembers($request->user()->id);

        // Combine left and right side members
        $all_members = array_merge($left_side_members, $right_side_members);

        // Build customer tree and levels
        $customerTree = get_customer_tree($request->user()->user_id);
        $levels = [];
        $level_data = build_customer_array($customerTree, $levels);

        $maxLevels = 40; // Maximum levels to include in the output
        $total_members = 0;
        $level_response = [];

        foreach ($levels as $level => $customers) {
            $currentLevel = substr($level, 5); // Extract level number
            if ($currentLevel <= $maxLevels) {
                $total_members += count($customers);
                // Customize each customer's data
                $customized_customers = array_map(function ($customer) {
                    return [
                        // 'id' => $customer['id'],
                        'reg_date' => $customer['reg_date'],
                        'id' => $customer['user_id'],
                        'name' => $customer['name'],
                        'position' => $customer['position'],
                        // 'phone' => $customer['phone'],
                        'sponsor_id' => $customer['agent_id'],
                        'status' => strip_tags($customer['status']), // Remove HTML tags from status
                    ];
                }, $customers);
                $level_response[] = [
                    'level' => $currentLevel,
                    'customers' => $customized_customers,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'total_members' => $total_members,
            'levels' => $level_response,
        ]);
    }




    public function register_member(){
        $data['title'] = 'Register Member';
        return view("site/user_dashboard/add_member/create")->with($data);
    }
}