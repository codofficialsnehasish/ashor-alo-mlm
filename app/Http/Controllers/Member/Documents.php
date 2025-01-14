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
    
    public function welcome_letter(Request $request){
        if ($request->is('api/*')) {
            return response()->json([  
                'status' => "true",
                'data' => route('my-documents.welcome-letter.app',$request->user()->user_id)
            ], 200);
        }else{
            $data['title'] = 'Welcome Letter';
            return view($this->view_path.'welcome_letter')->with($data);
        }
    }

    public function id_card(Request $request){
        if ($request->is('api/*')) {
            return response()->json([  
                'status' => "true",
                'data' => route('my-documents.id-card.app',$request->user()->user_id)
            ], 200);
        }else{
            $data['title'] = 'ID Card';
            return view($this->view_path.'id_card')->with($data);
        }
    }


    public function welcome_letter_app($user_id){
        $data['title'] = 'Welcome Letter';
        $data['user'] = User::where('user_id',$user_id)->first();
        return view($this->view_path.'welcome_letter_app')->with($data);
    }

    public function id_card_app($user_id){
        $data['title'] = 'ID Card';
        $data['user'] = User::where('user_id',$user_id)->first();
        return view($this->view_path.'id_card_app')->with($data);
    }
}