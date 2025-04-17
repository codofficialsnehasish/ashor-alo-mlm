<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\General_settings;
use App\Models\Products;
use App\Models\Categorie;

class Products_controller extends Controller
{
    public function __construct() {
        $this->view_path = 'admin.products.';

        $this->middleware('role_or_permission:Product Show', ['only' => ['index']]);
        $this->middleware('role_or_permission:Product Create', ['only' => ['add_new','process']]);
        $this->middleware('role_or_permission:Product Edit', ['only' => ['edit','update_process']]);
        $this->middleware('role_or_permission:Product Delete', ['only' => ['delete']]);
    }

    public function index(){
        $data['title'] = 'Products';
        $data['products'] = Products::where('is_deleted',0)->get();
        return view($this->view_path.'contents')->with($data);
    }

    public function add_new(){
        $data['title'] = 'Products';
        $data['categories'] = Categorie::where('visibility',1)->get();
        return view($this->view_path.'add')->with($data);
    }

    public function process(Request $r){
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
            'cat_id' => 'required|exists:categories,id',
            'sku' => 'required|string|unique:product,sku',
            'product_price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $product = new Products();
            $product->title = $r->name;
            $product->slug = createSlug($r->name, Products::class);
            $product->sku = $r->sku;
            $product->category_id = $r->cat_id;
            $product->price = $r->product_price;
            $product->discount_rate = $r->discount_rate;
            // $product->no_discount = $r->no_discount;
            $product->gst_rate = $r->gst_rate;
            $product->discounted_price = $r->product_price - (($r->discount_rate / 100) * $r->product_price);
            $product->gst_amount = ($r->gst_rate / 100) * $product->discounted_price;
            $product->total_price = $r->total_price;
            $product->short_desc = $r->short_desc;
            $product->description = $r->description;
            $product->product_specification = $r->product_specification;
            if ($r->hasFile('product_image')) {
                $img = $r->file('product_image');
                $filename = time(). '_' .$img->getClientOriginalName();
                $directory = public_path('web_directory/product_images');
                $img->move($directory, $filename);
                $filePath = env('APP_URL')."web_directory/product_images/".$filename;
                $product->product_image = $filePath;
            }
            $product->weight = $r->weight;
            $product->is_featured = $r->is_featured;
            $product->is_visible = $r->is_visible;
            $product->is_addon = $r->is_addon;
            $product->is_dilse = $r->is_dilse;
            $product->is_special_product = $r->is_special_product;
            $res = $product->save();
            if($res){
                return redirect()->back()->with(['success'=>'Data added Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function edit(Request $r){
        $data['title'] = 'Products';
        $data['product'] = Products::find($r->id);
        $data['categories'] = Categorie::where('visibility',1)->get();
        return view($this->view_path.'edit')->with($data);
    }

    public function update_process(Request $r){
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string',
            'cat_id' => 'required|exists:categories,id',
            'product_price' => 'required|numeric',
            'product_id' => 'required|numeric|exists:product,id'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $product = Products::find($r->product_id);
            $product->title = $r->name;
            $product->slug = createSlug($r->name, Products::class);
            $product->sku = $r->sku;
            $product->category_id = $r->cat_id;
            $product->price = $r->product_price;
            $product->discount_rate = $r->discount_rate;
            // $product->no_discount = $r->no_discount;
            $product->gst_rate = $r->gst_rate;
            $product->discounted_price = $r->product_price - (($r->discount_rate / 100) * $r->product_price);
            $product->gst_amount = ($r->gst_rate / 100) * $product->discounted_price;
            $product->total_price = $r->total_price;
            $product->short_desc = $r->short_desc;
            $product->description = $r->description;
            $product->product_specification = $r->product_specification;
            if ($r->hasFile('product_image')) {
                $img = $r->file('product_image');
                $filename = time(). '_' .$img->getClientOriginalName();
                $directory = public_path('web_directory/product_images');
                $img->move($directory, $filename);
                $filePath = env('APP_URL')."web_directory/product_images/".$filename;
                $product->product_image = $filePath;
            }
            $product->weight = $r->weight;
            $product->is_featured = $r->is_featured;
            $product->is_visible = $r->is_visible;
            $product->is_addon = $r->is_addon;
            $product->is_dilse = $r->is_dilse;
            $product->is_special_product = $r->is_special_product;
            $res = $product->update();
            if($res){
                return redirect()->back()->with(['success'=>'Data Updated Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Query Error']);
            }
        }
    }

    public function delete(Request $r){
        $product = Products::find($r->id);
        $product->is_deleted = 1;
        $res = $product->update();
        // $res = $product->delete();
        if($res){
            return redirect()->back()->with(['success'=>'Data deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Query Error']);
        }
    }
}