<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Carts;
use App\Models\Products;

class Cart_Controller extends Controller
{
    public function __construct(){
        $this->view_path='site.user_dashboard.products.';
    }

    public function index(){
        $data['title'] = 'Cart';
        $data['cart_items'] = Carts::where('buyer_id',Auth::user()->id)->get();
        // $data['cart_total'] = Carts::leftJoin('product','cart.product_id','product.id')
        //                     ->where('buyer_id',Auth::user()->id)
        //                     ->sum('product.price');

        $cart = Carts::where('buyer_id',Auth::user()->id)->get();
        $cart_total_amount = 0;
        foreach($cart as $c){
            $price = get_product_price_by_id($c->product_id);
            $cart_total_amount += ($price * $c->quantity);
        }
        $data['cart_total'] = $cart_total_amount;
        $data['cart_count'] = Carts::where('buyer_id',Auth::user()->id)->count();
        return view($this->view_path.'cart')->with($data);
    }

    public function add_to_cart(Request $r){
        $cart = Carts::where('buyer_id',Auth::user()->id)->where('product_id',$r->product_id)->first();
        if(!empty($cart)){
            // $cart->variations = $r->quantity;
            $product = Products::find($r->product_id);
            $cart->quantity += $r->qty;
            // $cart->delivery_charge = $r->product_id;
            // $cart->total_delivery_charge = $r->product_id;
            $res = $cart->update();
            if($res){
                echo json_encode(array('status'=>1,'msg'=>$product->title." Updated to Cart Sussessfully"));
            }else{
                echo json_encode(array('status'=>0,'msg'=>$product->title." Not Updated to Cart"));
            }
        }else{
            $cart = new Carts();
            $cart->buyer_id = $r->user_id;
            $cart->product_id = $r->product_id;
            $product = Products::find($r->product_id);
            $cart->product_title = $product->title;
            // $cart->variations = $r->quantity;
            $cart->quantity = $r->qty;
            // $cart->delivery_charge = $r->product_id;
            // $cart->total_delivery_charge = $r->product_id;
            $res = $cart->save();
            if($res){
                echo json_encode(array('status'=>1,'msg'=>$product->title." Added to Cart Sussessfully"));
            }else{
                echo json_encode(array('status'=>0,'msg'=>$product->title." Not Added to Cart"));
            }
        }
    }

    public function fetch_cart_count(){
        $cart_data = Carts::where('buyer_id',Auth::user()->id)->count();
        return $cart_data;
    }

    public function delete_cart_data(Request $r){
        $cart_data = Carts::find($r->id);
        $res = $cart_data->delete();
        if($res){
            return redirect()->back()->with(["success"=>$cart_data->product_title." Deleted Successfully from cart"]);
        }else{
            return redirect()->back()->with(["success"=>$cart_data->product_title." Not Deleted from cart"]);
        }
    }

}