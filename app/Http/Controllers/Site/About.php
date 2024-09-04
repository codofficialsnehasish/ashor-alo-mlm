<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class About extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function about(){
        $data['title'] = 'Home';
        return view($this->view_path.'about')->with($data);
    }


}
