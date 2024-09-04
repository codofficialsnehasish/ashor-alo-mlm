<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PhotoGallary;

class Photo_Gallary extends Controller
{
    public function __construct(){
        $this->view_path='site.';
    }

    public function index()
    {
        $data['title'] = 'Photo Gallary';
        $data['photos'] = PhotoGallary::where('is_visiable',1)->get();
        return view($this->view_path.'photo_gallary')->with($data);
    }
}
