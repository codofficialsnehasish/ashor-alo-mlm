<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MonthlyReturn;
use App\Models\Categorie;
use App\Models\Products;

class MonthlyReturnMasterController extends Controller
{

    public function __construct(){
        $this->view_path = 'admin.master_data.monthly_return_master.';

        $this->middleware('role_or_permission:Monthly Return Master Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:Monthly Return Master Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Monthly Return Master Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Monthly Return Master Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Monthly Return';
        $data['contents'] = MonthlyReturn::where('is_deleted',0)->get();
        return view($this->view_path."index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Monthly Return';
        $data['categories'] = Categorie::where('visibility',1)->get();
        return view($this->view_path."create")->with($data);
    }

    public function get_products_by_category(Request $request){
        $products = Products::where('category_id',$request->category_id)->where('is_deleted',0)->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'form_amount' => 'required',
            'to_amount' => 'nullable',
            'percentage' => 'required',
            'category' => 'required',
            'product' => 'required',
            'return_percentage' => 'required',
        ]);
        $monthly_return = new MonthlyReturn();
        $monthly_return->category = $request->category;
        $monthly_return->product = $request->product;
        $monthly_return->form_amount = $request->form_amount;
        $monthly_return->to_amount = $request->to_amount;
        $monthly_return->percentage = $request->percentage;
        $monthly_return->return_persentage = $request->return_percentage;
        $monthly_return->visiblity = $request->visiblity;
        $res = $monthly_return->save();
        if($res){
            return back()->with(['success'=>'Data Stored Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Stored.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Monthly Return';
        $monthly_return = MonthlyReturn::find($id);
        $data['item'] = $monthly_return;
        $data['categories'] = Categorie::where('visibility',1)->get();
        $data['products'] = Products::where('category_id',$monthly_return->category)->get();
        return view($this->view_path."edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'form_amount' => 'required',
            'to_amount' => 'nullable',
            'percentage' => 'required',
            'category' => 'required',
            'product' => 'required',
            'return_percentage' => 'required',
        ]);
        $monthly_return = MonthlyReturn::find($id);
        $monthly_return->category = $request->category;
        $monthly_return->product = $request->product;
        $monthly_return->form_amount = $request->form_amount;
        $monthly_return->to_amount = $request->to_amount;
        $monthly_return->percentage = $request->percentage;
        $monthly_return->return_persentage = $request->return_percentage;
        $monthly_return->visiblity = $request->visiblity;
        $res = $monthly_return->update();
        if($res){
            return back()->with(['success'=>'Data Updated Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Updated.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $monthly_return = MonthlyReturn::find($id);
        $monthly_return->is_deleted = 1;
        $res = $monthly_return->update();
        // $res = $monthly_return->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
