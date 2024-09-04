<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class Documents extends Controller
{
    public function __construct(){
        $this->view_path = 'site.user_dashboard.my_docs.';
    }
    public function welcome_letter(){
        $data['title'] = 'Welcome Letter';
        return view($this->view_path.'welcome_letter')->with($data);
    }

    public function id_card(){
        $data['title'] = 'ID Card';
        return view($this->view_path.'id_card')->with($data);
    }
}