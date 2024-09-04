<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Products;

class ProductController extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function index(){
        $data['title'] = 'Product';
        $data['products'] = Products::where('is_visible',1)->get();
        return view($this->view_path.'product')->with($data);
    }
}
