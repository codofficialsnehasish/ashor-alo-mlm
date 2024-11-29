<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\User;
use App\Models\OrderProducts;
use App\Models\Products;

class Checkout_Controller extends Controller
{
    public function __construct(){
        $this->view_path='site.user_dashboard.products.';
    }

    public function process_checkout(Request $r){
        $validator = Validator::make($r->all(), [
            'payment_proof.*' => 'nullable|mimes:jpeg,png|max:25600',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $order = new Orders();
            $order->buyer_id = Auth::user()->id;
            $order->price_subtotal = Carts::calculateTotalForUser(Auth::user()->id);
            $order->price_gst = 0.00;
            $order->price_shipping = 0.00;
            $order->discounted_price = 0.00;
            $order->price_total = Carts::calculateTotalForUser(Auth::user()->id);
            $order->payment_method = "Online";
            if ($r->hasFile('payment_proof')) {
                $img = $r->file('payment_proof');
                $filename = time(). '_' .$img->getClientOriginalName();
                $directory = public_path('web_directory/payment_proof');
                $img->move($directory, $filename);
                $filePath = env('APP_URL')."web_directory/payment_proof/".$filename;
                $order->payment_proof = $filePath;
            }
            $order->payment_status = "Under Checking";
            $order->order_status = "Order Placed";
            $order->placed_by = Auth::user()->name.'(User)';
            $order->save();
            update_order_number($order->id);
            $this->upload_order_products($order->id);
            Carts::clearCartForUser(Auth::id());
            return back()->with(["success"=>"Order Placed Successfully"]);
        }
    }

    private function upload_order_products($order_id){
        $cart_products = Carts::where('buyer_id',Auth::id())->get();
        foreach($cart_products as $p){
            $order_products = new OrderProducts();
            $order_products->order_id = $order_id;
            $order_products->buyer_id = Auth::user()->id;
            $order_products->product_id = $p->product_id;
            $prod = Products::find($p->product_id);
            $order_products->product_title = $prod->title;
            $order_products->product_unit_price = $prod->price;
            $order_products->product_quantity = $p->quantity;
            $order_products->product_currency = '₹';
            $order_products->product_gst_rate = 0.00;
            $order_products->product_gst = 0.00;
            $order_products->product_shipping_cost = 0.00;
            $order_products->product_total_price = $prod->price;
            $order_products->order_status = 'Processing';
            $order_products->save();
        }
    }

}