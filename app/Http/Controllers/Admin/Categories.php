<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Categorie;

class Categories extends Controller
{
    public function __construct() {
        $this->view_path = 'admin.categories.';

        $this->middleware('role_or_permission:Category Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:Category Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Category Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Category Delete', ['only' => ['destroy']]);
    }

    public function index(){
        $data['title'] = 'Categories';
        $data['categories'] = Categorie::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create(){
        $data['title'] = 'Categories';
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $r){
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $category = new Categorie();
            $category->name = $r->name;
            $category->slug = createSlug($r->name, Categorie::class);
            $category->visibility = $r->is_visible;
            $res = $category->save();
            if($res){
                return redirect()->back()->with(['success'=>'Data added Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function edit(Request $r){
        $data['title'] = 'Categories';
        $data['categorie'] = Categorie::find($r->id);
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $r){
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $category = Categorie::find($r->category_id);
            if($category->name != $r->name){
                $category->name = $r->name;
                $category->slug = createSlug($r->name, Categorie::class);
            }
            $category->visibility = $r->is_visible;
            $res = $category->update();
            if($res){
                return redirect()->back()->with(['success'=>'Data Updated Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function destroy(Request $r){
        $category = Categorie::find($r->id);
        $res = $category->delete();
        if($res){
            return redirect()->back()->with(['success'=>'Data deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Query Error']);
        }
    }
}