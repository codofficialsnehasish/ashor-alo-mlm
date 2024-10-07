<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RemunerationBenefit;

class RemunerationBenefitController extends Controller
{

    public function __construct(){
        $this->view_path = 'admin.master_data.remuneration_benefit.';

        $this->middleware('role_or_permission:Remuneration Benefit Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:Remuneration Benefit Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Remuneration Benefit Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Remuneration Benefit Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['title'] = 'Remuneration Benefit';
        $data['contents'] = RemunerationBenefit::all();
        return view($this->view_path."index")->with($data);
    }

    public function create()
    {
        $data['title'] = 'Remuneration Benefit';
        return view($this->view_path."create")->with($data);
    }

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

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['title'] = 'Remuneration Benefit';
        $data['item'] = RemunerationBenefit::find($id);
        return view($this->view_path."edit")->with($data);
    }

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
