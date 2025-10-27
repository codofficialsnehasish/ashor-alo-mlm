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
        //  echo 'Server Timezone: ' . date_default_timezone_get() . '<br>';
        //  echo 'Current Server Time: ' . date('Y-m-d H:i:s');
        return view($this->view_path.'home')->with($data);
        // return view($this->view_path.'maintenance');
        



    }

    public function site_terms_and_conditions(){
        $obj = General_settings::find(1);
        $data['item'] = $obj->terms_and_conditions;
        $data['title'] = 'Terms & Conditions';
        return view('site.terms_and_condition')->with($data);
    }

    public function site_privacy_policy(){
        $data['title'] = 'Privacy Policy';
        return view('site.privacy_policy')->with($data);
    }

}
