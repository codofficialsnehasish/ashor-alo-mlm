<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PhotoGallary;

class PhotoGallaryController extends Controller
{
    public function __construct(){
        $this->view_path = 'admin.photo_gallary.';
    }

    public function index()
    {
        $data['title'] = 'Photo Gallary';
        $data['photos'] = PhotoGallary::all();
        return view($this->view_path.'index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Photo Gallary';
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $request)
    {
        $obj = new PhotoGallary();
        $obj->title = $request->title;

        if ($request->hasFile('gallary_image')) {
            $img = $request->file('gallary_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/photo_gallary');
            $img->move($directory, $filename);
            $filePath = "web_directory/photo_gallary/".$filename;
            $obj->image_name = $filename;
            $obj->file_path = $filePath;
        }

        $obj->is_visiable = $request->visiblity;
        $res = $obj->save();
        if($res){
            return redirect()->back()->with(['success'=>'Data Saved Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Saved. Try Again!']);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['title'] = 'Photo Gallary';
        $data['item'] = PhotoGallary::find($id);
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $obj = PhotoGallary::find($id);
        $obj->title = $request->title;

        if ($request->hasFile('gallary_image')) {
            if ($obj->file_path && file_exists(public_path($obj->file_path))) {
                unlink(public_path($obj->file_path));
            }

            $img = $request->file('gallary_image');
            $filename = time(). '_' .$img->getClientOriginalName();
            $directory = public_path('web_directory/photo_gallary');
            $img->move($directory, $filename);
            $filePath = "web_directory/photo_gallary/".$filename;
            $obj->image_name = $filename;
            $obj->file_path = $filePath;
        }

        $obj->is_visiable = $request->visiblity;
        $res = $obj->update();
        if($res){
            return redirect()->back()->with(['success'=>'Data Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Data Not Updated. Try Again!']);
        }
    }

    public function destroy(string $id)
    {
        $photo_gallary = PhotoGallary::find($id);
        if ($photo_gallary->file_path && file_exists(public_path($photo_gallary->file_path))) {
            unlink(public_path($photo_gallary->file_path));
        }
        $res = $photo_gallary->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
