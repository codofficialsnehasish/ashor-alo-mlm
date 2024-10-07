<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.legal_data.certificate.';

        $this->middleware('role_or_permission:Certificate Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:Certificate Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Certificate Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Certificate Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['title'] = 'Certificate';
        $data['certificates'] = Certificate::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Certificate';
        return view($this->view_path.'create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj = new Certificate();
        $obj->title = $request->title;

        if ($request->hasFile('certificate_image')) {
            $img = $request->file('certificate_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/certificates');
            $img->move($directory, $filename);
            $filePath = "web_directory/certificates/".$filename;
            $obj->image = $filePath;
        }

        $obj->is_visiable = $request->visiblity;
        $res = $obj->save();

        if($res){
            return redirect()->back()->with(['success'=>'Data Saved Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Saved. Try Again!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['title'] = 'Certificate';
        $data['item'] = Certificate::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obj = Certificate::find($id);
        $obj->title = $request->title;

        if ($request->hasFile('certificate_image')) {
            if ($obj->image && file_exists(public_path($obj->image))) {
                unlink(public_path($obj->image));
            }

            $img = $request->file('certificate_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/certificates');
            $img->move($directory, $filename);
            $filePath = "web_directory/certificates/".$filename;
            $obj->image = $filePath;
        }

        $obj->is_visiable = $request->visiblity;
        $res = $obj->update();

        if($res){
            return redirect()->back()->with(['success'=>'Data Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Updated. Try Again!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = Certificate::find($id);
        if ($obj->image && file_exists(public_path($obj->image))) {
            unlink(public_path($obj->image));
        }
        $res = $obj->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
