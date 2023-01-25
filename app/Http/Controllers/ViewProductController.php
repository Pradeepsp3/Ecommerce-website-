<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ViewProductController extends Controller
{
    //item overview
    public function viewItem($id){
        $item = Item::find($id);
        $category = Category::find($item->category_id);
        $product = Product::find($item->product_id);
        return view('pages.itemView')->with(['item'=>$item,'category'=>$category,'product'=>$product]);
    }

}
