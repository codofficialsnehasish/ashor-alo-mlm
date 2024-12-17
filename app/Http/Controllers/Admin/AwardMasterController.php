<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\AwardReword;
use Illuminate\Http\Request;

class AwardMasterController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.master_data.award_master.';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Award Reword';
        $data['contents'] = AwardReword::where('is_deleted',0)->get();
        return view($this->view_path."index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Award Reword';
        return view($this->view_path."create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rank' => 'required',
            'item_name' => 'required',
            'profile_image' => 'required',
        ]);
        $award_reword = new AwardReword();
        $award_reword->rank = $request->rank;
        $award_reword->item_name = $request->item_name;
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/award_image');
            $filePath = $directory . '/' . $filename;
            $img->move($directory, $filename);
            $filePath = env('APP_URL')."web_directory/award_image/".$filename;
            $award_reword->item_image = $filePath;
        }
        $award_reword->visiblity = $request->visiblity;
        $res = $award_reword->save();
        if($res){
            return back()->with(['success'=>'Data Stored Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Stored.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AwardReword $AwardReword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Award Reword';
        $data['item'] = AwardReword::find($id);
        return view($this->view_path."edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rank' => 'required',
            'item_name' => 'required',
        ]);
        $award_reword = AwardReword::find($id);
        $award_reword->rank = $request->rank;
        $award_reword->item_name = $request->item_name;
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/award_images');
            $filePath = $directory . '/' . $filename;
            $img->move($directory, $filename);
            $filePath = env('APP_URL')."web_directory/award_images/".$filename;
            $award_reword->item_image = $filePath;
        }
        $award_reword->visiblity = $request->visiblity;
        $res = $award_reword->update();
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
        $award_reword = AwardReword::find($id);
        $award_reword->is_deleted = 1;
        $res = $award_reword->update();
        // $res = $award_reword->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
