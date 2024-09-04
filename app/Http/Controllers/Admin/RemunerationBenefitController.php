<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RemunerationBenefit;

class RemunerationBenefitController extends Controller
{

    public function __construct(){
        $this->view_path = 'admin.master_data.remuneration_benefit.';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Remuneration Benefit';
        $data['contents'] = RemunerationBenefit::all();
        return view($this->view_path."index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Remuneration Benefit';
        return view($this->view_path."create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rank' => 'required',
            'target' => 'required',
            'bonus' => 'required',
            'month_validity' => 'required',
        ]);
        $remuneration_benefit = new RemunerationBenefit();
        $remuneration_benefit->rank = $request->rank;
        $remuneration_benefit->target = $request->target;
        $remuneration_benefit->bonus = $request->bonus;
        $remuneration_benefit->month_validity = $request->month_validity;
        $remuneration_benefit->visiblity = $request->visiblity;
        $res = $remuneration_benefit->save();
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
        $data['title'] = 'Remuneration Benefit';
        $data['item'] = RemunerationBenefit::find($id);
        return view($this->view_path."edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rank' => 'required',
            'target' => 'required',
            'bonus' => 'required',
            'month_validity' => 'required',
        ]);
        $remuneration_benefit = RemunerationBenefit::find($id);
        $remuneration_benefit->rank = $request->rank;
        $remuneration_benefit->target = $request->target;
        $remuneration_benefit->bonus = $request->bonus;
        $remuneration_benefit->month_validity = $request->month_validity;
        $remuneration_benefit->visiblity = $request->visiblity;
        $res = $remuneration_benefit->update();
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
        $remuneration_benefit = RemunerationBenefit::find($id);
        $res = $remuneration_benefit->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
