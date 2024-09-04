<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General_settings;
use App\Models\MLMSettings;

class Settings extends Controller
{
    public function __construct() {
        $this->view_path = 'admin.settings.';
    }

    //================================ Site Settings ======================

    public function content(){
        $obj = General_settings::find(1);
        $data['title'] = 'Settings';
        $data['general_settings'] = $obj;
        return view($this->view_path."content")->with($data);
    }

    public function add_content(Request $r){
        $obj = General_settings::find(1);
        $obj->application_name = $r->application_name;
        $obj->site_description = $r->site_description;
        $obj->copyright = $r->copyright;
        $imglogo = $r->file("logo");
        if(isset($imglogo)){
            $img_name = time().$imglogo->getClientOriginalName();
            $imglogo->move(public_path("site_data_images"),$img_name);
        }else{
            $img_name = $obj->logo;
        }
        $obj->logo = $img_name;

        $imgfavicon = $r->file("favicon");
        if(isset($imgfavicon)){
            $img_namefi = time().$imgfavicon->getClientOriginalName();
            $imgfavicon->move(public_path("site_data_images"),$img_namefi);
        }else{
            $img_namefi = $obj->fabicon;
        }
        $obj->fabicon = $img_namefi;

        $obj->contact_phone = $r->phone;
        $obj->contact_phone_opt = $r->phoneopt;
        $obj->contact_email = $r->email;
        $obj->contact_email_opt = $r->emailopt;
        $obj->contact_address = $r->address;
        $res = $obj->update();
        if($res){
            return redirect()->route('settings-contents')->with(['success'=>'Settings Updated Successfully']);
        }else{
            return redirect()->route('settings-contents')->with(['error'=>'Settings Not Updated']);
        }
    }

    //============================== MLM Settings ======================
    
    
    //============================== End of MLM Settings ======================
    
    public function mlm_settings(){
        $obj = MLMSettings::first();
        $data['title'] = 'MLM Settings';
        $data['mlm_settings'] = $obj;
        return view($this->view_path."mlm_settings")->with($data);
    }

    public function process_mlm_settings(Request $request){
        $obj = MLMSettings::first();
        $obj->minimum_purchase_amount = $request->minimum_parchase_amount;
        $obj->agent_direct_bonus = $request->agent_direct_bonus;
        $obj->tds = $request->tds;
        $obj->repurchase = $request->repurchase;
        $res = $obj->update();
        if($res){
            return back()->with(['success'=>'MLM Settings Updated Successfully']);
        }else{
            return back()->with(['error'=>'MLM Settings Not Updated']);
        }
    }

    //============================== End of MLM Settings ======================

    public function terms_and_conditions(){
        $obj = General_settings::find(1);
        $data['title'] = 'Terms & Conditions';
        $data['item'] = $obj->terms_and_conditions;
        return view('admin.legal_data.terms_and_conditions')->with($data);
    }

    public function process_policy(Request $r){
        $obj = General_settings::find(1);
        $obj->terms_and_conditions = $r->trams_and_conditions;
        $res = $obj->update();
        if($res){
            return back()->with(['success'=>'Terms & Conditions Updated Successfully']);
        }else{
            return back()->with(['error'=>'Terms & Conditions Not Updated']);
        }
    }
}
