<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Certificate extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function certificate(){
        $data['title'] = 'Certificate';
        return view($this->view_path.'certificate')->with($data);
    }

}