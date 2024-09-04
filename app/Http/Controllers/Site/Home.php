<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Products;
use App\Models\General_settings;

class Home extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function home(){
        $data['title'] = 'Home';
        $data['products'] = Products::where('is_visible', 1)->limit(3)->get();
        return view($this->view_path.'home')->with($data);
    }

    public function site_terms_and_conditions(){
        $obj = General_settings::find(1);
        $data['item'] = $obj->terms_and_conditions;
        $data['title'] = 'Terms & Conditions';
        return view('site.terms_and_condition')->with($data);
    }

}
