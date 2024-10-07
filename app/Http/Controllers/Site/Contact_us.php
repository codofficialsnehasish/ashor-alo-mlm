<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactUs;
use App\Models\General_settings;

class Contact_us extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function contact_us(){
        $data['title'] = 'Contact Us';
        $data['settings'] = General_settings::find(1);
        return view($this->view_path.'contact_us')->with($data);
    }

    public function process_contact_us_data(Request $r){
        $validator = Validator::make($r->all(), [
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'email_or_phone' => ['required', function ($attribute, $value, $fail) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^[6789]\d{9}$/', $value)) {
                    $fail('The :attribute must be a valid email or a valid phone number.');
                }
            }],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
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
