<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use App\Models\OrderProducts;
use App\Models\ProductSectorIncome;
use App\Models\TopUp; 
use App\Models\AccountTransaction;
use App\Models\MLMSettings;
use App\Models\TDSAccount;
use App\Models\RepurchaseAccount;
use App\Models\Account;
use App\Models\Categorie;

class Order extends Controller
{
    protected $transaction;
    public function __construct(AccountTransaction $transaction){
        $this->view_path = 'admin/order/';
        $this->transaction = $transaction;

        $this->middleware('role_or_permission:Order Show', ['only' => ['index','order_details']]);
        $this->middleware('role_or_permission:Order Create', ['only' => ['add_new','process','make_id_green']]);
        $this->middleware('role_or_permission:Order Edit', ['only' => ['edit','update_process','update_payment_status','update_payment_status']]);
        $this->middleware('role_or_permission:Order Delete', ['only' => ['delete']]);
    }

    public function index(){
        $data['title'] = 'Orders';
        // $data['orders'] = Orders::all();
        $data['orders'] = Orders::whereDoesntHave('orderItem.product', function ($query) {
            $query->where('is_addon', 1);
        })->get();
        return view($this->view_path."content")->with($data);
    }

    public function order_details(string $id){
        if (Orders::where('id', $id)->exists()) {
            $order = Orders::find($id);
            $title = 'Order Details';
            $buyer_details = User::find($order->buyer_id);
            $order_items = OrderProducts::where('order_id',$id)->get();
            return view($this->view_path . "order_details", compact('order_items','buyer_details','order','title'));
        } else {
            return redirect()->back()->with(['error', 'Order not found.']);
        }
    }

    public function add_new(){
        $data['title'] = 'Add Order';
        $data['users'] = User::where("role","!=","admin")->orderBy('name', 'asc')->get();
        $data['products'] = Products::where('is_visible',1)->get();
        $data['categories'] = Categorie::where('visibility',1)->get();
        return view($this->view_path."add")->with($data);
    }

    public function get_product_price(Request $r){
        // print_r($r->all());die;
        $total_price = 0;
        foreach($r->product_id as $id){
            $product = Products::find($id);
            $total_price += $product->price;
        }
        echo json_encode($total_price);
    }

    public function process(Request $r){
        // return $r->all();die;
        $validator = Validator::make($r->all(), [
            'date' => 'required',
            'category' => 'required',
            'agent' => 'required|numeric|exists:users,id',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $order = new Orders();
            $order->buyer_id = $r->agent;
            $order->price_subtotal = $r->total_price;
            $order->price_gst = $r->gst_price;
            $order->price_shipping = $r->shipping_price;
            $order->discounted_price = $r->discounted_price;
            $order->price_total = $r->total_price;
            $order->payment_method = $r->payment_method;
            $order->payment_status = $r->payment_status;
            $order->order_status = "Order Placed";
            $order->placed_by = Auth::user()->name.'('.get_role(Auth::id()).')';
            $res = $order->save();

            foreach($r->product as $p){
                $order_products = new OrderProducts();
                $order_products->order_id = $order->id;
                $order_products->buyer_id = $r->agent;
                $order_products->product_id = $p;
                $prod = Products::find($p);
                $order_products->product_title = $prod->title;
                $order_products->product_unit_price = $prod->price;
                $order_products->product_quantity = 1;
                $order_products->product_currency = '₹';
                $order_products->product_gst_rate = 0.00;
                $order_products->product_gst = 0.00;
                $order_products->product_shipping_cost = 0.00;
                $order_products->product_total_price = $prod->price;
                $order_products->order_status = 'Processing';
                $order_products->save();
            }

            update_order_number($order->id);

            $this->make_id_green($r->category, $order->id,$r->agent,$r->total_price,$r->date);

            if($res){
                return redirect()->back()->with(['success'=>'Order Placed Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function edit(Request $r){
        $data['title'] = 'Edit Order';
        $data['order'] = Orders::find($r->id);
        $data['users'] = User::where("role","!=","admin")->orderBy('name', 'asc')->get();
        return view($this->view_path."edit")->with($data);
    }

    public function update_process(Request $r){
        $validator = Validator::make($r->all(), [
            'agent' => 'required|numeric|exists:users,id',
            'order_id' => 'required|numeric|exists:orders,id',
            'product_price' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $order = Orders::find($r->order_id);
            $order->buyer_id = $r->agent;
            $order->price_subtotal = $r->product_price;
            $order->price_gst = $r->gst_price;
            $order->price_shipping = $r->shipping_price;
            $order->discounted_price = $r->discounted_price;
            $order->price_total = $r->total_price;
            $order->payment_method = $r->payment_method;
            $order->payment_status = $r->payment_status;
            $res = $order->update();

            if($res){
                return redirect()->back()->with(['success'=>'Data updated successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function delete(Request $r){
        $order = Orders::find($r->id);
        if($order){
            $top_up = TopUp::where('order_id',$order->id)->delete();
            $res = $order->delete();
            if($res){
                return redirect()->back()->with(['success'=>'Order And Topup Deleted Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }


    public function invoice(Request $r){
        $order = Orders::find($r->order_id);
        $data['order'] = $order;
        $data['user'] = User::find($order->buyer_id);
        $data['order_products'] = OrderProducts::where('order_id',$r->order_id)->get();
        return view('admin.order.invoice')->with($data);
    }

    public function update_payment_status(Request $r){
        $order = Orders::find($r->order_id);
        $order->payment_status = $r->payment_status;
        if($r->payment_status == 'Paid'){
            $this->make_id_green(get_product_category_by_order_id($order->id), $order->id,$order->buyer_id,$order->price_total,date('Y-m-d'));
        }
        $res = $order->update();
        if($res){
            // echo json_encode(["status"=>1,"msg"=>"Payment Status Updated Successfully"]);
            return true;
        }else{
            // echo json_encode(["status"=>0,"msg"=>"Payment Status Not Updated"]);
            return false;
        }
    }

    public function update_order_status(Request $r){
        $order = Orders::find($r->order_id);
        $order->order_status = $r->order_status;
        if($r->order_status == 'Order Completed'){
            $order->status = 1;
            $order->delivered_date = now();
            // $this->make_id_green(get_product_category_by_order_id($order->id), $order->id,$order->buyer_id,$order->price_total,date('Y-m-d'));
            // $product_income = new ProductSectorIncome();
            // $product_income->user_id = $order->buyer_id;
            // $product_income->order_id  = $order->id;
            // $product_income->confirm_date = now();
            // $product_income->total_amount = $order->price_total;
            // $product_income->save();
        }
        $res = $order->update();
        if($res){
            return true;
        }else{
            return false;
        }
    }


    public function make_id_green($category, $order_id, $user_id, $total_amount, $date){

        //calculate accumulation business 
        $total_acumulation = get_accumulation_business($user_id, $category);

        $ROI = calculate_ROI($total_amount, $category, $order_id, $total_acumulation);
        // print_r($ROI);die;
        
        if(!empty($ROI)){
            $top_up = new TopUp();
            $top_up->entry_by = Auth::user()->name.'('.get_role(Auth::id()).')';
            $top_up->user_id = $user_id;
            $top_up->order_id = $order_id;
            $top_up->start_date = $date;
            $top_up->total_amount = $total_amount;
            $top_up->percentage = $ROI['percentage'];
            $top_up->return_percentage = $ROI['return_percentage'];
            $top_up->total_installment_month = $ROI['total_installment_month'];
            $top_up->total_paying_amount = $ROI['total_paying_amount'];
            $top_up->installment_amount_per_month = $ROI['installment_amount_per_month'];
            $top_up->is_provide_direct = $ROI['is_provide_direct'];
            $top_up->is_personal_business = $ROI['is_personal_business'];
            $top_up->is_special_business = $ROI['is_special_business'];
            $top_up->save();
    
            $custo = User::find($user_id);
            if($custo->status != 1){
                $custo->status = 1;
                $custo->joining_amount = $total_amount;
                $custo->join_amount_put_date = $date;
                $custo->join_by = Auth::user()->name.'('.get_role(Auth::id()).')';
                $result = $custo->update();
    
                //joining amount transaction
                $transactionAdded = $this->transaction->make_transaction(
                    $user_id,
                    $total_amount,
                    'Joining Amount',
                    1
                );
    
                /*if(User::where('user_id',$custo->agent_id)->exists()){
                    $agent = User::where('user_id',$custo->agent_id)->first();
                    if($agent->status == 1){
                        
                        //Direct Bonus
                        $mlm_settings = MLMSettings::first();
                        $user_bonus = ($total_amount * ($mlm_settings->agent_direct_bonus/100));
                        $tds_amount = $user_bonus * ($mlm_settings->tds/100);
                        $repurchase_amount = $user_bonus * ($mlm_settings->repurchase/100);
                        $user_bonus -= $tds_amount+$repurchase_amount;
                        if(check_limit($agent->id)){
                            if(get_user_limit($agent->id) > ($agent->account_balance + $user_bonus) ){
                                $agent->account_balance += $user_bonus;
                                // Direct Bonus transaction
                                $transactionAdded = $this->transaction->make_transaction(
                                    $agent->id,
                                    $user_bonus,
                                    'Direct Bonus',
                                    1
                                );
                            }else{
                                $gap = get_user_limit($agent->id) - $agent->account_balance;
                                $agent->account_balance += $gap;
                                $transactionAdded = $this->transaction->make_transaction(
                                    $agent->id,
                                    $gap,
                                    'Direct Bonus',
                                    1
                                );
                                $user_bonus = abs($user_bonus - $gap); 
                                $agent->hold_balance += $user_bonus;
                                $transactionAdded = $this->transaction->make_transaction(
                                    $agent->id,
                                    $user_bonus,
                                    'Direct Bonus on Hold',
                                    1
                                );
                            }
                        }else{
                            $agent->hold_balance += $user_bonus;
                            $transactionAdded = $this->transaction->make_transaction(
                                $agent->id,
                                $user_bonus,
                                'Direct Bonus on Hold',
                                1
                            );
                        }
                        $agent->update();
            
                        
                        $account = Account::first();
                        $account->tds_balance += $tds_amount;
                        $account->repurchase_balance += $repurchase_amount;
                        $account->update();
                        TDSAccount::create([
                            'user_id'=>$agent->id,
                            'amount'=>$tds_amount,
                            'which_for'=>'Deducting from Direct bonus',
                            'status'=>1
                        ]);
                        RepurchaseAccount::create([
                            'user_id'=>$agent->id,
                            'amount'=>$repurchase_amount,
                            'which_for'=>'Deducting from Direct bonus',
                            'status'=>1
                        ]);
                    }
                }*/

            }else{
                /*if(check_limit($custo->id)){
                    if(get_user_limit($custo->id) > ($custo->account_balance + $custo->hold_balance) ){
                        $custo->account_balance += $custo->hold_balance;
                        
                        $transactionAdded = $this->transaction->make_transaction(
                            $custo->id,
                            $custo->hold_balance,
                            'Previous Balance',
                            1
                        );
                        $custo->hold_balance = 0;
                    }else{
                        $gap = get_user_limit($custo->id) - $custo->account_balance;
                        $custo->account_balance += $gap;
                        $transactionAdded = $this->transaction->make_transaction(
                            $custo->id,
                            $gap,
                            'Previous Balance',
                            1
                        );
                        $custo->hold_balance = abs($custo->hold_balance - $gap); 
                    }
                }
                $custo->update();*/
            }
        }else{
            if($total_amount == 0 || $total_amount == 1){
                $custo = User::find($user_id);
                if($custo->status != 1){
                    $custo->status = 1;
                    $custo->joining_amount = $total_amount;
                    $custo->join_amount_put_date = $date;
                    $result = $custo->update();
                }
            }
        }
    }
}