<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\User;
use App\Models\Orders;

class Product extends Controller
{
    public function __construct(){
        $this->view_path='site.user_dashboard.products.';
    }

    public function index(){
        $data['title'] = 'Products';
        $data['products'] = Products::where('is_visible',1)->get();
        return view($this->view_path.'content')->with($data);
    }

    public function show_all_order(){
        $data['title'] = 'Orders';
        $data['orders'] = Orders::where('buyer_id',Auth::id())->get();
        return view('site.user_dashboard.order.content')->with($data);
    }
}
