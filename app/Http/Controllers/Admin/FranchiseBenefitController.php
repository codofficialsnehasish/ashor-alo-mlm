<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\FranchiseBenefit;
use Illuminate\Http\Request;

class FranchiseBenefitController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.master_data.franchise_benefit.';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Franchise Benefit';
        $data['contents'] = FranchiseBenefit::where('is_deleted',0)->get();
        return view($this->view_path."index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Franchise Benefit';
        return view($this->view_path."create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'income' => 'required',
        ]);
        $franchise_benefit = new FranchiseBenefit();
        $franchise_benefit->name = $request->name;
        $franchise_benefit->amount = $request->amount;
        $franchise_benefit->income = $request->income;
        $franchise_benefit->visiblity = $request->visiblity;
        $res = $franchise_benefit->save();
        if($res){
            return back()->with(['success'=>'Data Stored Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Stored.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FranchiseBenefit $franchiseBenefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Franchise Benefit';
        $data['item'] = FranchiseBenefit::find($id);
        return view($this->view_path."edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'income' => 'required',
        ]);
        $franchise_benefit = FranchiseBenefit::find($id);
        $franchise_benefit->name = $request->name;
        $franchise_benefit->amount = $request->amount;
        $franchise_benefit->income = $request->income;
        $franchise_benefit->visiblity = $request->visiblity;
        $res = $franchise_benefit->update();
        if($res){
            return back()->with(['success'=>'Data Stored Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Stored.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $franchise_benefit = FranchiseBenefit::find($id);
        $franchise_benefit->is_deleted = 1;
        $res = $franchise_benefit->update();
        // $res = $franchise_benefit->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
