<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProductController;

class ProductController extends Controller
{
    //addCategories view page
    public function addCategories(){
        return view('components.addCategories');
    }

    //addproducts view page
    public function addProducts(){

        $data = Category::all();
        // return dd($data);
        return view('components.addProducts')->with(['categories'=>$data]);
    }

    //additems view page
    public function addItems(){
        $category = Category::all();
        $data = Product::all();
        // return dd($data);
        return view('components.addItems')->with(['products'=>$data,'categories'=>$category]);
    }


    //store category in table
    public function storeCategories(Request $request){

        $request->validate([
            'category_name' => 'required',
        ]);

        $data = new Category();
        $data->category_name = $request->input('category_name');
        $data->save();

        return redirect('admin')->with(['categoryadd'=>"Category : ".$data->category_name." added successfully!"]);

    }

    //store products in table
    public function storeProducts(Request $request){
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
        ]);

        $data = new Product();
        $data->product_name = $request->input('product_name');
        $data->category_id = $request->category_id;
        // return dd($data);
        $data->save();

        return redirect('admin')->with(['productadd'=>"Product : ".$data->product_name." added successfully!"]);
    }

    //store items in table
    public function storeItems(Request $request){
        $request->validate([
            'item_name' =>'required',
            'category_id' =>'required',
            'product_id'=>'required',
            'description'=>'required',
            'image'=>'required',
            'price' =>'required',
        ]);

        $itemName = $request->input('item_name');
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        $image_name = Storage::putFileAs('images',$image, $itemName.'.'.$extension);
        $request->image->move(public_path('images'), $image_name);

        $data = new Item();
        $data->item_name = $itemName;
        $data->category_id = $request->category_id;
        $data->product_id = $request->product_id;
        $data->description = $request->input('description');
        $data->image = $image_name;
        $data->price = $request->input('price');
        $data->save();

        return redirect('admin')->with(['itemadd'=>"Item : ".$data->item_name." Added Successfully!"]);

    }

    // view categories
    public function viewCategories(){
        $data = Category::all();
        return view('components.viewCategories')->with(['categories'=>$data]);
    }

    // view products
    public function viewProducts(){
        $products = Product::all();
        $categories = Category::all();
        return view('components.viewProducts')->with(['products'=>$products,'categories'=>$categories]);
    }

    // view items
    public function viewItems(){
        $products = Product::all();
        $categories = Category::all();
        $items = Item::all();
        return view('components.viewItems')->with(['products'=>$products,'categories'=>$categories,'items'=>$items]);
    }

}
