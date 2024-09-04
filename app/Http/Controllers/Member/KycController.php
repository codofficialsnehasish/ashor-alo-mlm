<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Kyc;

class KycController extends Controller
{
    public function __construct(){
        $this->view_path = 'site.user_dashboard.kyc.';
    }

    //============================ User Part ====================
    public function index(){
        $data['title'] = 'KYC';
        $data['kyc'] = Kyc::where('user_id',Auth::id())->first();
        return view($this->view_path.'index')->with($data);
    }

    public function upload_kyc_data(Request $request){
        $validator = Validator::make($request->all(), [
            'identy_proof_type' => 'required',
            'address_proof_type' => 'required',
            'bank_proof_type' => 'required',
            'identityFile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'addressFile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bankFile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'panProofFile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $kyc = Kyc::where('user_id',Auth::id())->first();
            if(!empty($kyc)){
                // return back()->with(['error'=>'this user kyc already exists']);
                $kyc->identy_proof_type = $request->identy_proof_type;
                $kyc->address_proof_type = $request->address_proof_type;
                $kyc->bank_ac_proof_type = $request->bank_proof_type;
                if ($request->hasFile('identityFile')) {
                    $img = $request->file('identityFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $kyc->identy_proof = $filePath;
                    $kyc->identy_proof_status = 0;
                }
                if ($request->hasFile('addressFile')) {
                    $img = $request->file('addressFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $kyc->address_proof = $filePath;
                    $kyc->address_proof_status = 0;
                }
                if ($request->hasFile('bankFile')) {
                    $img = $request->file('bankFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $kyc->bank_ac_proof = $filePath;
                    $kyc->bank_ac_proof_status = 0;
                }
                if ($request->hasFile('panProofFile')) {
                    $img = $request->file('panProofFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $kyc->pan_card_proof = $filePath;
                    $kyc->pan_card_proof_status	 = 0;
                }
                $res = $kyc->update();
                if($res){
                    return back()->with(['success'=>'KYC Submitted Successfully.']);
                }else{
                    return back()->with(['error'=>'KYC not submitted. Please try again later.']);
                }
            }else{
                $newKyc = new Kyc();
                $newKyc->user_id = Auth::id();
                $newKyc->identy_proof_type = $request->identy_proof_type;
                $newKyc->address_proof_type = $request->address_proof_type;
                $newKyc->bank_ac_proof_type = $request->bank_proof_type;
                if ($request->hasFile('identityFile')) {
                    $img = $request->file('identityFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $newKyc->identy_proof = $filePath;
                }
                if ($request->hasFile('addressFile')) {
                    $img = $request->file('addressFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $newKyc->address_proof = $filePath;
                }
                if ($request->hasFile('bankFile')) {
                    $img = $request->file('bankFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $newKyc->bank_ac_proof = $filePath;
                }
                if ($request->hasFile('panProofFile')) {
                    $img = $request->file('panProofFile');
                    $filename = time(). '_' .$img->getClientOriginalName();
                    $directory = public_path('web_directory/kyc_proof');
                    $img->move($directory, $filename);
                    $filePath = "web_directory/kyc_proof/".$filename;
                    $newKyc->pan_card_proof = $filePath;
                }
                $res = $newKyc->save();
                if($res){
                    return back()->with(['success'=>'KYC Submitted Successfully.']);
                }else{
                    return back()->with(['error'=>'KYC not submitted. Please try again later.']);
                }
            }
        }
    }

    //============================= End Of User Part ==================




    //============================= Admin Part ===========================
    public function pending_kycs(){
        $data['title'] = 'Pending KYC';
        $data['kycs'] = Kyc::where('is_confirmed',0)->get();
        return view('admin.kyc.pending_kyc')->with($data);
    }

    public function all_kycs(){
        $data['title'] = 'All KYC';
        $data['kycs'] = Kyc::all();
        return view('admin.kyc.all_kyc')->with($data);
    }

    public function kyc_details(string $id){
        $kyc = Kyc::find($id);
        if($kyc->is_seen_by_admin == 0){
            $kyc->is_seen_by_admin = 1;
            $kyc->update();
        }
        $data['title'] = 'KYC Details';
        $data['kyc'] = $kyc;
        $data['user'] = User::find($kyc->user_id);
        return view('admin.kyc.kyc_details')->with($data);
    }

    public function update_kyc_status(Request $request){
        $kyc = Kyc::find($request->id);
        if($kyc){
            if($request->status_name == 'identy_proof_status'){
                $kyc->identy_proof_status = $request->status;
                $kyc->identy_proof_remarks = $request->remarks;
            }elseif($request->status_name == 'address_proof_status'){
                $kyc->address_proof_status = $request->status;
                $kyc->address_proof_remarks = $request->remarks;
            }elseif($request->status_name == 'bank_ac_proof_status'){
                $kyc->bank_ac_proof_status = $request->status;
                $kyc->bank_ac_proof_remarks = $request->remarks;
            }elseif($request->status_name == 'pan_card_proof_status'){
                $kyc->pan_card_proof_status = $request->status;
                $kyc->pan_card_proof_remarks = $request->remarks;
            }
            if($kyc->identy_proof_status==1 && $kyc->address_proof_status==1 && $kyc->bank_ac_proof_status==1 && $kyc->pan_card_proof_status==1){
                $kyc->is_confirmed = 1;
                $kyc->confirmed_date = now();
            }elseif($kyc->identy_proof_status==2 || $kyc->address_proof_status==2 || $kyc->bank_ac_proof_status==2 || $kyc->pan_card_proof_status==2){
                $kyc->is_confirmed = 2;
            }else{
                $kyc->is_confirmed = 0;
            }
            $res = $kyc->update();
            if($res){
                return response()->json(['status'=>1,'massage'=>'Status Updated Successfully']);
            }else{
                return response()->json(['status'=>0,'massage'=>'Status Not Updated']);
            }
        }else{
            return response()->json(['status'=>0,'massage'=>'Kyc Not found']);
        }
    }
}