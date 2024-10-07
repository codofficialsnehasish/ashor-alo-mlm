<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function __construct() {
        $this->view_path = 'admin.contact_us.';

        $this->middleware('role_or_permission:ContactUs Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:ContactUs Delete', ['only' => ['destroy']]);
    }

    public function index(){
        $data['title'] = 'Contact Us';
        $data['contacts'] = ContactUs::all();
        return view($this->view_path."index")->with($data);
    }

    public function destroy(string $id){
        $contact = ContactUs::find($id);
        $res = $contact->delete();
        if($res){
            return redirect()->back()->with(['success'=>'Massage Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Massage Not Deleted']);
        }
    }
}
