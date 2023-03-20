<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ApiItemRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ApiProductRequest;
use App\Http\Requests\ApiCategoryRequest;

class ApiController extends Controller
{
    //*********************CATEGORY**********************/
    // view categories
    public function viewCategories()
    {
        try {

            $categories = Category::all();

            if (!$categories) {
                return response()->json([
                    'message' => 'Category Not Found',
                ], 404);
            }

            return response()->json($categories);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

    // view category
    public function viewCategory($id)
    {
        try {

            $category = Category::find($id);
            if (!$category) {
                return response()->json([
                    'message' => 'Category Not Found',
                ], 404);
            }

            return response()->json($category);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

    // add Category from api
    public function addCategory(ApiCategoryRequest $request)
    {

        try {

            // Create Category
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();

            // Return Json Response
            return response()->json([
                'message' => "Category successfully created",
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }

    }

    //edit category from api
    public function updateCategory(ApiCategoryRequest $request, $id)
    {

        try {

            //edit category
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category Not Found',
                ], 404);
            }

            $category->category_name = $request->category_name;
            $category->save();

            // Return Json Response
            return response()->json([
                'message' => "Category successfully Updated",
            ], 200);

        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }

    }

    // delete category from api
    public function deleteCategory($id)
    {
        try {

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category Not Found',
                ], 404);
            }

            $category->delete();

            // Return Json Response
            return response()->json([
                'message' => "Category successfully Deleted",
            ], 200);
        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }

    }

    //*********************PRODUCTS**********************/
    //view products
    public function viewProducts()
    {

        try {

            $products = Product::all();

            if (!$products) {
                return response()->json([
                    'message' => 'Products Not Found',
                ], 404);
            }

            return response()->json($products);

        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);

        }

    }

    //view certain product
    public function viewProduct($id)
    {

        try {

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Products Not Found',
                ], 404);
            }

            return response()->json($product);

        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);

        }
    }

    //add product
    public function addProduct(ApiProductRequest $request)
    {

        try {

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->save();

            return response()->json([
                "message" => "Product added successfully...",
            ], 200);

        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

    //update Product
    public function updateProduct(ApiProductRequest $request, $id)
    {

        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    "message" => "Product Not Found",
                ], 404);
            }

            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->save();

            return response()->json([
                "message" => "Product Updated Successfully!",
            ], 200);
        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

    //delete Product
    public function deleteProduct($id)
    {
        try {

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    "message" => "Product Not Found",
                ], 404);
            }

            $product->delete();

            return response()->json([
                "message" => "Product Deleted Successfully...",
            ], 200);

        } catch (\Exception $e) {

            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

    //*********************ITEMS*********************/
    // add Items
    public function addItem(ApiItemRequest $request)
    {
        try {

            $itemName = $request->item_name;
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = Storage::putFileAs('images', $image, $itemName . '.' . $extension);
            $request->image->move(public_path('images'), $image_name);

            $item = new Item();
            $item->item_name = $request->item_name;
            $item->product_id = $request->product_id;
            $item->category_id = $request->category_id;
            $item->description = $request->description;
            $item->image = $image_name;
            $item->price = $request->price;
            $item->quantity = $request->quantity;
            $item->save();

            return response()->json([
                'message' => "Item added successfully..."
            ], 200);

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

    //update Item
    public function updateItem(ApiItemRequest $request, $id){
        try{
            $item = Item::find($id);
            if(!$item){
                return response()->json([
                    'message' => "Item not found",
                ], 404);
            }

            $item->item_name = $request->item_name;
            $item->product_id = $request->product_id;
            $item->category_id = $request->category_id;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->quantity = $request->quantity;

            if($request->image){
            $itemName = $request->item_name;
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = Storage::putFileAs('images', $image, $itemName . '.' . $extension);
            $request->image->move(public_path('images'), $image_name);
            $item->image = $image_name;
            }

            $item->save();

            return response()->json([
                'message' => "Item Updated Successfully"
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }


    //delete Items
    public function deleteItems($id){
        try{
            $item = Item::find($id);
            if(!$item){
                return response()->json([
                    "message" => "Item not found",
                ], 404);
            }

            $item->delete();
            return response()->json([
                'message' => "Item deleted successfully",
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }

}
