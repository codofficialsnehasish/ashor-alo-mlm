<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Services\BinaryTreeService;
use App\Services\LevelBonusService;
use Illuminate\Validation\Rule;
use App\Models\User; 
use App\Models\TopUp; 
use App\Models\AccountTransaction;
use App\Models\MLMSettings;
use App\Models\TDSAccount;
use App\Models\RepurchaseAccount;
use App\Models\Account;
use App\Models\LocationCountries;
use App\Models\LocationStates;
use App\Models\LocationCities;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;


class Customers extends Controller
{
    protected $binaryTreeService;
    protected $levelBonusService;

    public function __construct(BinaryTreeService $binaryTreeService,LevelBonusService $levelBonusService){
        $this->binaryTreeService = $binaryTreeService;
        $this->levelBonusService = $levelBonusService;

        $this->middleware('role_or_permission:Member Show', ['only' => ['showcustomer']]);
        $this->middleware('role_or_permission:Member Create', ['only' => ['customer','addcustomer']]);
        $this->middleware('role_or_permission:Member Edit', ['only' => ['edit_customer','update_customer']]);
        $this->middleware('role_or_permission:Member Delete', ['only' => ['customerdel']]);
        $this->middleware('role_or_permission:Member Tree View', ['only' => ['tree_view','generateTreeHtml']]);
        $this->middleware('role_or_permission:Member Block', ['only' => ['block_user']]);
    }
    
    public function customer(){
        $data['title'] = 'Add Customer';
        return view("admin/customer/add")->with($data);
    }


    // public function showcustomer(Request $request,$id = null){
    //     $ids = User::where("is_seen_admin","=",0)->get("id");
    //     foreach($ids as $i){
    //         $custo = User::find($i->id);
    //         $custo->is_seen_admin = 1;
    //         $custo->update();
    //     }
    //     // $c = User::where("role","!=","admin")->orderBy('created_at', 'desc')->paginate(10);
    //     $c = User::where("role","!=","admin")->orderBy('created_at', 'desc')->get();
    //     $data['title'] = 'Customer';
    //     $data['customer'] = $c;
    //     $data['rootUsers'] = User::whereNull('parent_id')->where('role','agent')->get();
    //     return view("admin/customer/content")->with($data);
    // }

    // for testing pourpose
    public function showcustomer(Request $request){
        $data['title'] = 'Customer';
        // return $request->all();
        $query = $request->input('query', null);
        // return $query;
        if($request->query != null){
            $c = User::where("role", "!=", "admin")
                    ->where('is_deleted',0)
                    ->whereAny([
                        'name',
                        'email',
                        'phone',
                        'agent_id',
                        'user_id'
                    ], 'like', "%$query%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)->withQueryString();
        }else{
            $c = User::where("role","!=","admin")->orderBy('created_at', 'desc')->paginate(10);
        }

        $data['customer'] = $c;
        // return $data;
        // $data['rootUsers'] = User::whereNull('parent_id')->where('role','agent')->get();
        return view("admin/customer/content-copy-test")->with($data);
    }

    public function exportPdf(Request $request)
    {
        try {
            $query = $request->input('query');
            $customers = User::where("role", "!=", "admin")
                            ->where('is_deleted',0)
                            ->whereAny([
                                        'name',
                                        'email',
                                        'phone',
                                        'agent_id',
                                        'user_id'
                                    ], 'like', '%'.$query.'%')
                            ->orderBy('created_at', 'desc')->get();
            // return $customers;

            $pdf = Pdf::loadView('admin.pdf.customer', compact('customers'));
            return $pdf->download('customers.pdf');
        } catch (\Exception $e) {
            return back()->with('error','An error occurred while generating the PDF. '.$e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $query = $request->input('query');
            $customers = User::where("role", "!=", "admin")
                            ->where('is_deleted',0)
                            ->whereAny([
                                        'name',
                                        'email',
                                        'phone',
                                        'agent_id',
                                        'user_id'
                                    ], 'like', '%'.$query.'%')
                            ->orderBy('created_at', 'desc')->get();
            
            $headers = [
                'Name', 'Email', 'Phone', 'Agent ID', 'User ID', 'Created At'
            ];

            // Format data into an array
            $data = $customers->map(function ($customer) {
                return [
                    'Name' => $customer->name,
                    'Email' => $customer->email,
                    'Phone' => $customer->phone,
                    'Agent ID' => $customer->agent_id,
                    'User ID' => $customer->user_id,
                    'Created At' => $customer->created_at->format('Y-m-d H:i:s'),
                ];
            })->toArray();

            array_unshift($data, $headers);

            // Create an inline export class and use it to generate the Excel file
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

            // Download the Excel file
            return Excel::download($export, 'customers.xlsx');
        } catch (\Exception $e) {
            return back()->with('error','An error occurred while generating the Excel. '.$e->getMessage());
        }
    }

    // public function tree_view(){
    //     $data['title'] = 'Tree View';
    //     $data['rootUsers'] = User::whereNull('parent_id')->where('role','agent')->get();
    //     return view("admin.customer.tree_view")->with($data);
    // }

    //my generated tree view code
    public function tree_view($userId = null) {
        $title = 'Tree View';
        if(empty($userId)){
            $rootUsers = User::whereNull('parent_id')->where('role','agent')->get();
        }else{
            $rootUsers = User::where('role','agent')->where('user_id',$userId)->get();
        }
        $html = '';
        foreach ($rootUsers as $user){
            $html .= $this->generateTreeHtml($user);
        }
        return view('admin.customer.tree_view', compact('html','title'));
    }
    
    // private function generateTreeHtml($user, $currentDepth = 0){
    //     if ($currentDepth > 3) {
    //         return '';
    //     }

    //     $leftChild = $user ? $user->children->firstWhere('is_left', 1) : null;
    //     $rightChild = $user ? $user->children->firstWhere('is_right', 1) : null;

    //     $html = '<li>';
    //     if(!empty($user->user_id)){
    //         $html .= '<a href="' . route('customer.tree-view',$user ? $user->user_id : '') . '">
    //                     <div class="member-view-box n-ppost">
    //                         <div class="member-header">
    //                             <span></span>
    //                         </div>
    //                         <div class="member-image">
    //                             <img src="' . (!empty($user->user_image) ? asset($user->user_image) : asset('dashboard_assets/images/users/user-14.png')) . '" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;border: 3px solid ' . ($user && $user->status == 1 ? 'green' : 'red') . ';" alt="Member" class="rounded-circle">
    //                         </div>
    //                         <div class="member-footer">
    //                             <div class="name"><span>' . ($user ? $user->name : '') . '</span></div>
    //                             <div class="downline"><span>(' . ($user ? $user->user_id : '') . ')</span></div>
    //                         </div>
    //                     </div>
    //                     <div class="n-ppost-name">
    //                         <div class="element">
    //                             <label>Name :</label> <strong style="padding-left: 50px;">' . ($user ? $user->name : '') . '</strong>
    //                         </div>
    //                         <div class="left">
    //                             <div class="element">
    //                                 <label>Sponsor ID :</label> <strong>' . ($user ? $user->agent_id : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Joining Date :</label> <strong>' . ($user ? formated_date($user->created_at) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Register (Left) :</label> <strong>' . ($user ? register_left($user->id) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Activated (Left) :</label> <strong>' . ($user ? activated_left($user->id) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Total Left :</label> <strong>' . ($user ? total_left($user->id) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Curr. Left BV :</label> <strong>'.($user ? calculate_curr_left_business($user->id) : '').'</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Total Left BV :</label> <strong>'. ($user ? calculate_left_business($user->id) : '') .'</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Total User :</label> <strong>' . ($user ? total_user($user->id) : '') . '</strong>
    //                             </div>
    //                         </div>
    //                         <div class="right">
    //                             <div class="element">
    //                                 <label>Rank :</label> <strong></strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Confirm Date :</label> <strong></strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Register (Right) :</label> <strong>' . ($user ? register_right($user->id) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Activated (Right) :</label> <strong>' . ($user ? activated_right($user->id) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Total Right :</label> <strong>' . ($user ? total_right($user->id) : '') . '</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Curr. Right BV :</label> <strong>'.($user ? calculate_curr_right_business($user->id) : '').'</strong>
    //                             </div>
    //                             <div class="element">
    //                                 <label>Total Right BV :</label> <strong>'. ($user ? calculate_right_business($user->id) : '') .'</strong>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </a>';
    //     }
    //     else{ 
    //         $html .= '<a href="javascript:void(0);">
    //         <div class="member-view-box">
    //             <div class="member-header">
    //                 <span></span>
    //             </div>
    //             <div class="member-image">
    //                 <img src="'. asset('dashboard_assets/images/users/user-16.png') .'" style="width: 70px;height: 70px;border-radius: 50%;object-fit: cover;" alt="Member" class="rounded-circle">
    //             </div>
    //             <div class="member-footer">
    //                 <div class="name"><span> </span></div>
    //                 <div class="downline"><span> </span></div>
    //             </div>
    //         </div>
    //     </a>';
    //     }
    //     if($currentDepth != 3){
    //         $html .= '<ul class="active">'
    //                     . $this->generateTreeHtml($leftChild, $currentDepth + 1) .
    //                     $this->generateTreeHtml($rightChild, $currentDepth + 1) .
    //                 '</ul>
    //             </li>';
    //     }
    //     return $html;
    // }

    private function generateTreeHtml($user, $currentDepth = 0){
        if ($currentDepth > 3) {
            return '';
        }

        $leftChild = $user ? $user->children->firstWhere('is_left', 1) : null;
        $rightChild = $user ? $user->children->firstWhere('is_right', 1) : null;

        $html = '<li>';
        if(!empty($user->user_id) && $user->is_deleted != 1){
            $html .= '<a href="' . route('customer.tree-view',$user ? $user->user_id : '') . '" onmouseover="MemberDetails('. $user->user_id.')">
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
        }
        else{ 
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
    
    public function get_member_details_on_hover(Request $request){
        $user = User::where('user_id',$request->U_ID)->first();

        $html = '<div class="element">
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
                </div>';


        
        echo json_encode($html);
    }



    public function addcustomer(Request $r){
        $validator = Validator::make($r->all(), [
            'membername' => 'required|string|max:255',
            'mobile' => 'required|digits:10|regex:/^[6789]/|unique:users,phone',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:4',
            // 'agentid' => 'exists:users,user_id',
            'agentid' => [
                'required',
                function ($attribute, $value, $fail) {
                    $agentExists = \App\Models\User::where('user_id', $value)
                        ->where('is_deleted', 0)
                        ->exists();

                    if (!$agentExists) {
                        $fail('The selected agent does not exist or has been deleted.');
                    }
                },
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            try {
                $user = $this->binaryTreeService->addUser($r->all());
                // return response()->json(['success' => true, 'user' => $user]);
                return redirect()->back()->with(['success' => 'Registration Successfull']);
            } catch (\Exception $e) {
                // return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
                // return redirect()->back()->with(['error' => 'Registration Not Successfull']);
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
            // $obj = new User();
            // $obj->user_id = $r->mobile;
            // $obj->agent_id = $r->agentid;
            // $obj->name = $r->membername;
            // $obj->status = 0;
            // $obj->role = "agent";
            // $obj->email = $r->email;
            // $obj->phone = $r->mobile;
            // $obj->password  = bcrypt($r->password);
            // $obj->token = generateToken();
            // $res = $obj->save();
            // if($res){
            //     return redirect()->back()->with(['success' => 'Registration Successfull']);
            // }
        }
    }

    public function edit_customer(Request $r){
        $obj = User::find($r->id);
        $data['title'] = 'Edit Customer';
        $data['customer'] = $obj;
        $data['countries'] = LocationCountries::where('is_visible',1)->get();
        $data['nominee_states'] = LocationStates::where('country_id',99)->get();
        if(!empty($obj->nominee_state_id)){
            $data['nominee_cities'] = LocationCities::where('is_visible',1)->where('state_id',$obj->nominee_state_id)->get();
        }

        if(!empty($obj->country)){
            $data['states'] = LocationStates::where('is_visible',1)->where('country_id',$obj->country)->get();
        }

        if(!empty($obj->state)){
            $data['cities'] = LocationCities::where('is_visible',1)->where('state_id',$obj->state)->get();
        }
        return view("admin/customer/edit")->with($data);
    }

    public function update_customer(Request $r){
        $obj = User::find($r->customer_id);
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'digits:10',
                'regex:/^[6789]/',
                Rule::unique('users', 'phone')->ignore($obj->id, 'id'), // Ignore current record by ID
            ],
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:4',
            // 'agentid' => 'exists:users,user_id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $obj = User::find($r->customer_id);
            // $customer->reg_date = $r->date;
            $obj->name = $r->name;
            if($obj->phone != $r->phone){
                $obj->phone = $r->phone;
            }
            $obj->email = $r->email;
            $obj->status = $r->status;


            $obj->father_or_husband_name = $r->father_or_husband_name;
            $obj->date_of_birth = $r->date_of_birth;
            $obj->gender = $r->gender;
            $obj->marital_status = $r->marital_status;
            // $obj->phone = $r->phone;
            // $obj->email = $r->email;
            $obj->qualification = $r->qualification;
            $obj->occupation = $r->occupation;
            $obj->pin_code = $r->pin_code;
            $obj->shipping_address = $r->shipping_address;
            $obj->address = $r->address;
            $obj->country = $r->country ? $r->country : 0;
            $obj->state = $r->state ? $r->state : 0;
            $obj->city = $r->city ? $r->city : 0;

            // nominee details
            $obj->nominee_name = $r->nominee_name;
            $obj->nominee_relation = $r->nominee_relation;
            $obj->nominee_dob = $r->nominee_dob;
            $obj->nominee_address = $r->nominee_address;
            $obj->nominee_state_id = $r->nominee_state_id ? $r->nominee_state_id : 0 ;
            $obj->nominee_city_id = $r->nominee_city_id ? $r->nominee_city_id : 0 ;

            //account details
            $obj->account_name = $r->account_name;
            $obj->bank_name = $r->bank_name;
            $obj->account_number = $r->account_number;
            $obj->account_type = $r->account_type;
            $obj->ifsc_code = $r->ifsc_code;
            $obj->pan_number = $r->pan_number;
            $obj->upi_name = $r->upi_name;
            $obj->upi_type = $r->upi_type;
            $obj->upi_number = $r->upi_number;

            $res = $obj->update();
            if($res){
                return redirect()->back()->with(['success'=>'Data Updated Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function customerdel(Request $r){
        $user = User::find($r->id);

        // $parent = $user->parent;
        
        // Retrieve children of the user
        $leftChild = $user->children->firstWhere('is_left', 1);
        $rightChild = $user->children->firstWhere('is_right', 1);

        if($leftChild || $rightChild){
            return redirect()->back()->with(['error'=>'Cannot delete this user as they have children.']);
        }
 
        // // Reconnect children to the parent
        // if ($parent) {
        //     if ($leftChild) {
        //         $leftChild->parent_id = $parent->id;
        //         $leftChild->is_left = $user->is_left;
        //         $leftChild->is_right = $user->is_right;
        //         $leftChild->save();
        //     }

        //     if ($rightChild) {
        //         $rightChild->parent_id = $parent->id;
        //         $rightChild->is_right = $user->is_right;
        //         $rightChild->is_left = $user->is_left;
        //         $rightChild->save();
        //     }
        // }


        $user->is_deleted = 1;
        $result = $user->update();
        // $result = $custo->delete();
        if($result){
            return redirect()->back()->with(['success'=>'Data Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Query Error']);
        }
    }

    public function make_it_green(Request $r, AccountTransaction $transaction){
        $validator = Validator::make($r->all(), [
            'join_amount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $top_up = new TopUp();
            $top_up->user_id = $r->user_id;
            $top_up->start_date = now();
            $top_up->total_amount = $r->join_amount;
            $top_up->save();

            $custo = User::find($r->user_id);
            $custo->status = 1;
            $custo->joining_amount = $r->join_amount;
            $custo->join_amount_put_date = now();
            $result = $custo->update();

            //joining amount transaction
            $transactionAdded = $transaction->make_transaction(
                $custo->id,
                $r->join_amount,
                'Joining Amount',
                1
            );

            if(User::where('user_id',$custo->agent_id)->exists()){
                //Direct Bonus
                $mlm_settings = MLMSettings::first();
                $user_bonus = ($r->join_amount * ($mlm_settings->agent_direct_bonus/100));
                $tds_amount = $user_bonus * ($mlm_settings->tds/100);
                $repurchase_amount = $user_bonus * ($mlm_settings->repurchase/100);
                $user_bonus -= $tds_amount+$repurchase_amount;
                $agent = User::where('user_id',$custo->agent_id)->first();
                $agent->account_balance += $user_bonus;
                $agent->update();

                // Direct Bonus transaction
                $transactionAdded = $transaction->make_transaction(
                    $agent->id,
                    $user_bonus,
                    'Direct Bonus',
                    1
                );
                $account = Account::first();
                $account->tds_balance += $tds_amount;
                $account->repurchase_balance += $repurchase_amount;
                $account->update();
                TDSAccount::create([
                    'user_id'=>$agent->id,
                    'amount'=>$tds_amount,
                    'which_for'=>'Deducting from direct bonus',
                    'status'=>1
                ]);
                RepurchaseAccount::create([
                    'user_id'=>$agent->id,
                    'amount'=>$repurchase_amount,
                    'which_for'=>'Deducting from direct bonus',
                    'status'=>1
                ]);
            
            }


            // $this->levelBonusService->level_bonus($agent->agent_id,$r->join_amount);

            if($result){
                return redirect()->back()->with(['success'=>'ID Green Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }


    public function user_of_leaders(){
        $data['title'] = 'Users of Leader';
        $data['customer'] = array();
        return view('admin.customer.users_of_leader')->with($data);
    }

    public function get_users_of_leaders(Request $r){
        $validator = Validator::make($r->all(), [
            // 'user_id' => 'exists:users,user_id',
            'user_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = \App\Models\User::where('user_id', $value)
                        ->where('is_deleted', 0)
                        ->first();

                    if (!$user) {
                        $fail('The user does not exist or is deleted.');
                    }
                },
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $start_date = $r->start_date;
            $end_date = $r->end_date;

            $user = User::where('user_id',$r->user_id)->first();
            $left_side_members = getLeftSideMembers($user->id);
            $right_side_members = getRightSideMembers($user->id);

            // $data['members'] = $this->get_all_customers(Auth::user()->phone);
            $data['title'] = 'Users of Leader';
            $all_members = array_merge($left_side_members,$right_side_members);
            $data['customer'] = array_filter($all_members, function ($member) use ($start_date, $end_date) {
                // Ensure the member is not deleted
                if ($member['is_deleted'] != 0) {
                    return false;
                }

                // If both dates are empty, return all members
                if (empty($start_date) && empty($end_date)) {
                    return true;
                }
            
                // Check if the member's created_at date falls within the range
                return $member['created_at'] >= $start_date && $member['created_at'] <= $end_date;
            });
            return view('admin.customer.users_of_leader')->with($data);
        }
    }

    //==========xxxxxxx======= End of Customer ===========xxxxxx=======



    // blocking Agent
    public function block_user($id){
        $user = User::find($id);
        if($user){
            if($user->block == 1){
                $user->block = 0;
                $msg = 'User Unblocked Successfully';
            }else{
                $user->block = 1;
                $msg = 'User Blocked Successfully';
            }
            $res = $user->update();
            if($res){
                return redirect()->back()->with('success',$msg);
            }else{
                return redirect()->back()->with('error','Please Try Again Latter!');
            }
        }else{
            return redirect()->back()->with('error','User Not found');
        }
    }


    public function search_customers(Request $request){
        $query = $request->input('query');
    
        // Search customers by name or ID (you can customize this)
        $customers = User::where('name', 'like', "%$query%")
                            ->orWhere('user_id', 'like', "%$query%")
                            // ->limit(5)  // Limit number of suggestions
                            ->where('is_deleted',0)
                            ->distinct()
                            ->get(['user_id', 'name']); // Fetch only the necessary fields

        return response()->json([
            'suggestions' => $customers
        ]);
    }
}
