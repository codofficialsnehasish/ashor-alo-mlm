<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User; 
use App\Models\Lavel_masters; 

class Lavel_master extends Controller
{
    public function __construct(){
        $this->view_path='admin.master_data.lavel_master.';
    }

    public function index(){
        $data['title'] = 'Level Content';
        $data['contents'] = Lavel_masters::all();
        return view($this->view_path."content")->with($data);
    }

    public function add_new(){
        $data['title'] = 'Add New Level';
        return view($this->view_path."add")->with($data);
    }

    public function process(Request $r){
        $validator = Validator::make($r->all(), [
            'lavel_name' => 'required|string|max:255',
            'level_number' => 'required|numeric',
            'lavel_persentage' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $lavel_masters = new Lavel_masters();
            $lavel_masters->lavel_name = $r->lavel_name;
            $lavel_masters->level_number = $r->level_number;
            $lavel_masters->lavel_persentage = $r->lavel_persentage;
            $lavel_masters->is_visiable = $r->is_visible;
            $res = $lavel_masters->save();
            if($res){
                return redirect()->back()->with(['success'=>'Data added successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function edit(Request $r){
        $data['title'] = 'Edit Level';
        $data['item'] = Lavel_masters::find($r->id);
        return view($this->view_path."edit")->with($data);
    }

    public function process_edit(Request $r){
        $validator = Validator::make($r->all(), [
            'lavel_name' => 'required|string|max:255',
            'level_number' => 'required|numeric',
            'lavel_persentage' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $lavel_masters = Lavel_masters::find($r->id);
            $lavel_masters->lavel_name = $r->lavel_name;
            $lavel_masters->level_number = $r->level_number;
            $lavel_masters->lavel_persentage = $r->lavel_persentage;
            $lavel_masters->is_visiable = $r->is_visible;
            $res = $lavel_masters->update();
            if($res){
                return redirect()->back()->with(['success'=>'Data Updated Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function delete(Request $r){
        $lavel_master = Lavel_masters::find($r->id);
        $res = $lavel_master->delete();
        if($res){
            return redirect()->back()->with(['success'=>'Data Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Query Error']);
        }
    }
}