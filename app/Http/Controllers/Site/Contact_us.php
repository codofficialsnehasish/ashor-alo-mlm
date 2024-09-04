<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactUs;

class Contact_us extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function contact_us(){
        $data['title'] = 'Contact Us';
        return view($this->view_path.'contact_us')->with($data);
    }

    public function process_contact_us_data(Request $r){
        $cantact = new ContactUs();
        $cantact->name = $r->name;
        $cantact->email_or_phone = $r->email_or_phone;
        $cantact->massage = $r->message;
        $res = $cantact->save();
        if($res){
            return redirect()->back()->with(['success'=>'Massage Send Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Massage Not Send, Try Again']);
        }
    }
}
