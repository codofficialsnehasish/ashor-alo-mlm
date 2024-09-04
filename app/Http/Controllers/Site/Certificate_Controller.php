<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Certificate;

class Certificate_Controller extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function certificate(){
        $data['title'] = 'Certificate';
        $data['certificates'] = Certificate::where('is_visiable',1)->get();
        return view($this->view_path.'certificate')->with($data);
    }

}