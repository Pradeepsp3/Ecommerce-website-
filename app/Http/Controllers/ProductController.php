<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\RolesWithPermission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    $roleId = auth()->user()->role_as;
                    $rolesWithPermissions = RolesWithPermission::where('roles_id', $roleId)
                        ->get()
                        ->pluck('permissions_id')
                        ->toArray();
        return view('components.viewCategories',compact('rolesWithPermissions'))->with(['categories'=>$data]);
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
        $roleId = auth()->user()->role_as;
                    $rolesWithPermissions = RolesWithPermission::where('roles_id', $roleId)
                        ->get()
                        ->pluck('permissions_id')
                        ->toArray();
        $categories = Category::all();
        return view('components.viewProducts',compact('rolesWithPermissions'))->with(['products'=>$products,'categories'=>$categories]);
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
            $order->save();
        return redirect()->back()->with(['orderUpdated'=>"Order On: $order->invoice_no is Updated."]);
        }else{
        $order->updated_at = Carbon::now()->tz('Asia/Kolkata')->toRfc850String();
        $order->save();
        return redirect()->back()->with(['orderUpdated'=>"Order On: $order->invoice_no is Updated."]);
    }
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
        $roleId = auth()->user()->role_as;
        $rolesWithPermissions = RolesWithPermission::where('roles_id', $roleId)
            ->get()
            ->pluck('permissions_id')
            ->toArray();
        return view('components.viewUsers',compact('rolesWithPermissions'))->with(['users'=>$users]);
    }

    //add Users view page
    public function addUsers(){
        $roles = Role::all();
        $roleId = auth()->user()->role_as;
        $rolesWithPermissions = RolesWithPermission::where('roles_id', $roleId)
            ->get()
            ->pluck('permissions_id')
            ->toArray();
        return view('components.addUsers',compact('rolesWithPermissions'))->with(['roles'=>$roles]);
    }

    //store User
    public function storeUser(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
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

    //items on customer cart
    public function itemsOnCart(Request $request){
        $search = $request->input('search') ?? "";
        $carts = Cart::all();
        foreach($carts as $cart){
            $itemOnCart = Item::find($cart->item_id);
            if($search != ""){
                $items = Item::where('item_name','LIKE',"%$search%")->get();
                foreach($items as $item){
                if($item->item_name == $itemOnCart->item_name){
                    $cart['item_name'] = $item->item_name;
                    $cart['description'] = $item->description;
                }
            }
            }else{
                $cart['item_name'] = $itemOnCart->item_name;
                $cart['description'] = $itemOnCart->description;
            }



            $customer = User::find($cart->user_id);
            $cart['customer_name'] = $customer->name;
        }
        return view('components.itemsOnCart')->with(['carts'=>$carts]);
    }

    //move items from cart to stock
    public function moveToStock($id){
        $cart = Cart::find($id);
        $item = Item::find($cart->item_id);
        $item->quantity = $item->quantity + $cart->quantity;
        $item->save();
        $cart->delete();
        // return dd($cartItem->id);
        return back()->with(['movedToStock'=>"Item: $item->item_name with quantity: $cart->quantity Moved Successfully"]);
    }

    //add roles form page
    public function addRoles(){
        return view('components.addRoles');
    }

    //store role in table
    public function storeRoles(Request $request){

        $request->validate([
            'role_name' => 'required',
        ]);

        $role = new Role();
        $role->roles = $request->input('role_name');
        $role->save();

        return redirect('admin')->with(['roleAdd'=>"Role : ".$role->roles." added successfully!"]);

    }

    // view roles
    public function viewRoles(Request $request){
        $search = $request->input('search') ?? "";
        if($search != ""){
            $roles = Role::where('roles','Like',"%$search%")->get();
        }else{
        $roles = Role::all();
    }
        return view('components.viewRoles')->with(['roles'=>$roles]);
    }

    //edit role view page
    public function editRole($id){
        $role = Role::find($id);
        return view('components.editRoles')->with(['role'=>$role]);
    }

    //update role
    public function updateRole(Request $request, $id){

        $role = Role::find($id);

        $request->validate([
            'role_name' => 'required',
        ]);
        $role->roles = $request->input('role_name');
        $role->save();

        return redirect('admin/viewRoles')->with(['roleUpdated'=>"Role : ".$role->roles." Updated successfully!"]);

    }

    //delete role
    public function deleteRole($id){
        $role = Role::find($id);
        $role->delete();
        return redirect('admin/viewRoles')->with(['roleDeleted'=>"role $role->roles Deleted Successfully!!!"]);
    }


    //view and Add Permission
    public function viewPermissions(){
        $permissions = Permission::paginate(10);
        return view('components.viewPermissions', compact('permissions'));
    }

    //store Permissions
    public function storePermission(Request $request){

        $request->validate([
            'permission' => 'required',
        ]);

        $permission = new Permission();
        $permission->permissions = $request->input('permission');
        $permission->save();

        return redirect()->back()->with(['permissionAdded'=>"permission : ".$permission->permissions." added successfully!"]);

    }

    //edit permission view page
    public function editPermission($id){
        $permission = Permission::find($id);
        return view ('components.editPermission', compact('permission'));
    }

    //update permission
    public function updatePermission(Request $request, $id){
        $permission = Permission::find($id);
        $permission->permissions = $request->input('permission');
        $permission->save();
        return redirect('admin/viewPermissions')->with(['permissionUpdated'=>"permission : ".$permission->permissions." Updated Successfully!"]);
    }


    //delete Permissions
    public function deletePermissions($id){
        $permission = Permission::find($id);
        $permission->delete();

        return redirect('admin/viewPermissions')->with(['permissionDeleted'=>"permission : ".$permission->permissions." deleted successfully!"]);
    }

    //assign Permissions view Page
    public function assignPermissions(Request $request){

        if($request->roleId == ""){
            $roleId = null;
        }else{
            $roleId = $request->roleId;
        }
        $roles = Role::all();
        $permissions = Permission::all();
    //     $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    //  ->where("role_has_permissions.role_id",$getRole)
    //  ->get();
        // $rolesWithPermissions = RolesWithPermission::where("roles_id","=",$roleId)->get()->toArray();
        $rolesWithPermissions = Permission::join('roles_with_permissions', 'roles_with_permissions.permissions_id','=','permissions.id')->where("roles_with_permissions.roles_id",$roleId)->get();
        // return dd($rolesWithPermissions);
        return view('components.assignPermissions', compact('roles','permissions','rolesWithPermissions','roleId'));
    }

    //store Permissions
    public function storePermissions(Request $request){

        $roleId = $request->roleId;
        RolesWithPermission::where('roles_id',$roleId)->delete();
        $roles = Role::find($roleId);
        $roleName = $roles->roles;
        $permissionIds = array();
        if($request->addCategory == 1){
            array_push($permissionIds,"1");
        }
        if($request->viewCategory == 2){
            array_push($permissionIds,"2");
        }
        if($request->editCategory == 3){
            array_push($permissionIds,"3");
        }
        if($request->deleteCategory == 4){
            array_push($permissionIds,"4");
        }
        if($request->addProduct == 5){
            array_push($permissionIds,"5");
        }
        if($request->viewProduct == 6){
            array_push($permissionIds,"6");
        }
        if($request->editProduct == 7){
            array_push($permissionIds,"7");
        }
        if($request->deleteProduct == 8){
            array_push($permissionIds,"8");
        }
        if($request->addUser == 9){
            array_push($permissionIds,"9");
        }
        if($request->viewUser == 10){
            array_push($permissionIds,"10");
        }
        if($request->viewUserDetails == 13){
            array_push($permissionIds,"13");
        }
        if($request->editUser == 11){
            array_push($permissionIds,"11");
        }
        if($request->deleteUser == 12){
            array_push($permissionIds,"12");
        }
        // return dd($permissionIds);
        foreach($permissionIds as $permissionId){
            $rolesWithPermission = new RolesWithPermission();
            $rolesWithPermission->roles_id = $roleId;
            $rolesWithPermission->permissions_id = $permissionId;
            // return dd($PermissionId);
            $rolesWithPermission->save();
        }

        return redirect('admin/assignPermissions')->with(['permissionAssigned'=>"Permissions for $roleName Assigned successfully!"]);
    }

    //delete roles permission
    public function deleteRolesPermissions($id){

        RolesWithPermission::where('roles_id',$id)->delete();
        // return dd($rolesWithPermissions);
        // $rolesWithPermissions->delete();
         return redirect('admin/assignPermissions')->with(["deleteAllRolesPermissions"=>"Permissions for this Role are Deleted!!!"]);

    }
}

