<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Hash;

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

    //edit category view page
    public function editCategory($id){
        $category = Category::find($id);
        return view('components.editCategory')->with(['category'=>$category]);
    }

    //edit product view page
    public function editProduct($id){
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        $categories = Category::all();
        $product['categoryName'] = $category->category_name;
        return view('components.editProduct')->with(['product'=>$product,'categories'=>$categories]);
    }

    //edit items view page
    public function editItem($id){
        $categories = Category::all();
        $products = Product::all();
        $item = Item::find($id);
        $itemCategory = Category::find($item->category_id);
        $itemProduct = Product::find($item->product_id);
        // return dd($data);
        return view('components.editItem')->with(['products'=>$products,'categories'=>$categories,'item'=>$item,'itemCategory'=>$itemCategory,'itemProduct'=>$itemProduct]);
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

    //update category
    public function updateCategory(Request $request, $id){

        $category = Category::find($id);

        $request->validate([
            'category_name' => 'required',
        ]);
        $category->category_name = $request->input('category_name');
        $category->save();

        return redirect('admin/viewCategories')->with(['categoryUpdated'=>"Category : ".$category->category_name." Updated successfully!"]);

    }

    //update product
    public function updateProduct(Request $request, $id){
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
        ]);

        $product = Product::find($id);
        $product->product_name = $request->input('product_name');
        $product->category_id = $request->category_id;
        // return dd($product);
        $product->save();

        return redirect('admin/viewProducts')->with(['productUpdated'=>"Product : ".$product->product_name." Updated successfully!"]);
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
            'quantity' =>'required',
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
        $data->quantity = $request->input('quantity');
        $data->save();

        return redirect('admin')->with(['itemadd'=>"Item : ".$data->item_name." Added Successfully!"]);

    }

    //update Items
    public function updateItem(Request $request, $id){
        $item = Item::find($id);

        if($request->has('image')){
            $itemName = $request->input('item_name');
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = Storage::putFileAs('images',$image, $itemName.'.'.$extension);
            $request->image->move(public_path('images'), $image_name);
        }else{
            $image_name = $item->image;
        }

        $item->item_name = $request->input('item_name');
        if($request->input('category_id') == ""){
        $item->category_id = $item->category_id;
    }else{
        $item->category_id = $request->input('category_id');
    }
    if($request->input('product_id') == ""){
        $item->product_id = $item->product_id;
    }else{
        $item->category_id = $request->input('category_id');
    }
        $item->description = $request->input('description');
        $item->image = $image_name;
        $item->price = $request->input('price');
        $item->quantity = $request->input('quantity');
        $item->save();
        return redirect('admin/viewItems')->with(['itemUpdated'=> "Item in Id: $item->id Updated Successfully!"]);

    }

    // view categories
    public function viewCategories(Request $request){
        $search = $request->input('search') ?? "";
        if($search != ""){
            $data = Category::where('category_name','Like',"%$search%")->get();
        }else{
        $data = Category::all();
    }
        return view('components.viewCategories')->with(['categories'=>$data]);
    }

    // view products
    public function viewProducts(Request $request){
        $search = $request->input('search') ?? "";
        if($search != ""){
            $products = Product::where('product_name','Like',"%$search%")->get();
            foreach($products as $product){
                $category = Category::find($product->category_id);
                $product['category_name'] = $category->category_name;
            }
        }else{
        $products = Product::all();
        foreach($products as $product){
            $category = Category::find($product->category_id);
            $product['category_name'] = $category->category_name;
        }
        }
        $categories = Category::all();
        return view('components.viewProducts')->with(['products'=>$products,'categories'=>$categories]);
    }

    // view items
    public function viewItems(Request $request){
        $search = $request->input('search') ?? "";
        if($search != ""){
            $items = Item::where('item_name','LIKE',"%$search%")->get();
        }else{
            $items = Item::all();
        }
        $products = Product::all();
        $categories = Category::all();
        return view('components.viewItems')->with(['products'=>$products,'categories'=>$categories,'items'=>$items]);
    }

    //view Orders Page
    public function viewOrders(){
        $orders = Order::all();
        foreach($orders as $order){
            $customer = User::find($order->user_id);
            $order['customer_name'] = $customer->name;
        }

        return view('components.viewOrders')->with(['orders'=>$orders]);
    }

    //processing Order
    public function processingOrders(){
        $orders = Order::all();
        foreach($orders as $order){
            $customer = User::find($order->user_id);
            $order['customer_name'] = $customer->name;
        }

        return view('components.processingOrders')->with(['orders'=>$orders]);
    }

    //update order
    public function updateOrder(Request $request,$id){
        $order= Order::find($id);
        $order->order_status = $request->orderStatus;
        if($order->order_status == "Delivered"){
            $order->expected_delivery = Carbon::now()->tz('Asia/Kolkata')->toRfc850String();
        }
        $order->updated_at = Carbon::now()->tz('Asia/Kolkata')->toRfc850String();
        $order->save();
        return redirect()->back()->with(['orderUpdated'=>"Order On: $order->invoice_no is Updated."]);
    }

    //view completed Orders Page
    public function completedOrders(){
        $orders = Order::all();
        foreach($orders as $order){
            $customer = User::find($order->user_id);
            $order['customer_name'] = $customer->name;
        }

        return view('components.completedOrders')->with(['orders'=>$orders]);
    }

    //view order details
    public function viewOrderDetails($id){
        $order = Order::find($id);
        $customer = User::find($order->user_id);
        $order['customer_name'] = $customer->name;
        return view('components.viewOrderDetails')->with(['order'=>$order]);
    }

    //delete Item
    public function deleteItem($id){
        $item = Item::find($id);
        $item->delete();
        return redirect('admin/viewItems')->with(['itemDeleted' => "Item on Id: $item->id Deleted Successfully!"]);
    }

    //delete product
    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/viewProducts')->with(['productDeleted' => "Product on Id: $product->id Deleted Successfully!"]);
    }

    //delete category
    public function deleteCategory($id){
        $category = Product::find($id);
        $category->delete();
        return redirect('admin/viewCategories')->with(['categoryDeleted' => "Product on Id: $category->id Deleted Successfully!"]);
    }

    //view Users
    public function viewUsers(Request $request){
        $filter = $request->role;
        if($filter == "1"){
            $users = User::where('role_as','=',"1")->get();
        }else if($filter == "0"){
            $users = User::where('role_as','=',"0")->get();
        }else{
        $users = User::all();
    }
        foreach( $users as $user){
            if($user->role_as == '1'){
                $user['role'] = "admin";
            }else{
                $user['role']= "customer";
            }
        }
        return view('components.viewUsers')->with(['users'=>$users]);
    }

    //add Users view page
    public function addUsers(){

        return view('components.addUsers');
    }

    //store User
    public function storeUser(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role_as = $request->role;
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('address');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->zipcode = $request->input('zipcode');
        $user->save();

        return redirect('admin')->with(['userAdded'=>"User $user->name Added Successfully!!!"]);

    }

    //view user details page
    public function viewUserDetails($id){
        $user = User::find($id);
        return view('components.viewUserDetails')->with(['user'=>$user]);
    }

    //delete User
    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/viewUsers')->with(['userDeleted'=>"User $user->name Deleted Successfully!!!"]);
    }

}

