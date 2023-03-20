<?php

use App\Models\Card;
use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyProductController;
use App\Http\Controllers\ViewProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $items = Item::all();
    foreach($items as $item){
        $product = Product::find($item->product_id);
        $item['product_name'] = $product->product_name;
        $category = Category::find($item->category_id);
        $item['category_name'] = $category->category_name;
    }
    $search = $request->input('search') ?? "";
    // return dd($search);
    if ($search != "") {
        $items = collect($items)->where('item_name','LIKE',"%$search%")->where('product_name','LIKE', "%$search%")->where('category_name','LIKE', "%$search%");
        return dd($items);
        if($items == null){
            return view('home')->with(['noItemFound'=>"No Products Found on Your Search"]);
        }
        // return dd($items);
        // $items = collect($items)->where('item_name','LIKE',$search);
        // return dd($items);
    } else {
        $items = Item::all();
    }
        $products = Product::all();
    $categories = Category::all();

    return view('home')->with(['products' => $products, 'categories' => $categories, 'items' => $items]);
});

// category select
Route::get('category/{id}',function($id){
    $items = Item::where('category_id','=',$id)->get();
    $products = Product::all();
    $categories = Category::all();
    return view('home')->with(['products' => $products, 'categories' => $categories, 'items' => $items]);
});

// home redirect
Route::get('home',function(){
    return redirect('/');
});

//auth controls
Route::get('login', [AuthController::class, 'loginpage']);
Route::get('loginAttempt', [AuthController::class, 'loginAttempt']);
Route::post('registerUser', [AuthController::class, 'registerUser']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('register', [AuthController::class, 'registerpage']);
Route::get('admin', [AuthController::class, 'adminPanel'])->middleware('admin');

//admin
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/addCategories', [ProductController::class, 'addCategories']);
    Route::post('/storeCategories', [ProductController::class, 'storeCategories']);
    Route::get('/addProducts', [ProductController::class, 'addProducts']);
    Route::post('/storeProducts', [ProductController::class, 'storeProducts']);
    Route::get('/addItems', [ProductController::class, 'addItems']);
    Route::get('/editItem/{id}', [ProductController::class, 'editItem']);
    Route::get('/editCategory/{id}', [ProductController::class, 'editCategory']);
    Route::get('/editProduct/{id}', [ProductController::class, 'editProduct']);
    Route::patch('/updateItem/{id}', [ProductController::class, 'updateItem']);
    Route::put('/updateCategory/{id}', [ProductController::class, 'updateCategory']);
    Route::patch('/updateProduct/{id}', [ProductController::class, 'updateProduct']);
    Route::post('/storeItems', [ProductController::class, 'storeItems']);
    Route::get('/viewCategories', [ProductController::class, 'viewCategories']);
    Route::get('/viewProducts', [ProductController::class, 'viewProducts']);
    Route::get('/viewItems', [ProductController::class, 'viewItems']);
    Route::get('/viewOrders', [ProductController::class, 'viewOrders']);
    Route::get('/ordersInProgress', [ProductController::class, 'ProcessingOrders']);
    Route::patch('/updateOrder/{id}', [ProductController::class, 'updateOrder']);
    Route::get('/ordersCompleted', [ProductController::class, 'completedOrders']);
    Route::get('/viewOrderDetails/{id}', [ProductController::class, 'viewOrderDetails']);
    Route::get('/viewUsers', [ProductController::class, 'viewUsers']);
    Route::get('/viewUserDetails/{id}', [ProductController::class, 'viewUserDetails']);
    Route::get('/addUsers', [ProductController::class, 'addUsers']);
    Route::post('/storeUser', [ProductController::class, 'storeUser']);
    Route::get('/deleteUser/{id}', [ProductController::class, 'deleteUser']);
    Route::get('/deleteItem', [ProductController::class, 'deleteItem']);
    Route::get('/deleteProduct', [ProductController::class, 'deleteProduct']);
    Route::get('/deleteCategory', [ProductController::class, 'deleteCategory']);
    Route::get('/itemsOnCart', [ProductController::class, 'itemsOnCart']);
    Route::get('/moveToStock/{id}',[ProductController::class, 'moveToStock']);
    Route::get('/addRoles', [ProductController::class, 'addRoles']);
    Route::post('/storeRoles', [ProductController::class, 'storeRoles']);
    Route::get('/viewRoles', [ProductController::class, 'viewRoles']);
    Route::get('/editRole/{id}', [ProductController::class, 'editRole']);
    Route::patch('/updateRole/{id}', [ProductController::class, 'updateRole']);
    Route::get('/deleteRole/{id}', [ProductController::class, 'deleteRole']);
    Route::get('/viewPermissions',[ProductController::class,'viewPermissions']);
    Route::post('/storePermission',[ProductController::class, 'storePermission']);
    Route::get('/editPermission/{id}',[ProductController::class, 'editPermission']);
    Route::patch('/updatePermission/{id}',[ProductController::class, 'updatePermission']);
    Route::get('/deletePermission/{id}',[ProductController::class,'deletePermission']);
    Route::get('/assignPermissions',[ProductController::class,'assignPermissions']);
    Route::post('/storePermissions',[ProductController::class, 'storePermissions']);
    Route::get('/deleteRolesPermission/{id}',[ProductController::class, 'deleteRolesPermissions']);

});

//order
Route::post('placeOrder', [OrderController::class, 'placeOrder']);
Route::get('myOrders/{id}', [OrderController::class, 'viewOrders']);
Route::get('addCard/{id}',[OrderController::class, 'addCard']);
Route::post('storeCardDetails',[OrderController::class, 'storeCardDetails']);

//items
Route::get('viewItem/{id}', [ViewProductController::class, 'viewItem']);


//buynow
Route::get('buynow/{id}', [BuyProductController::class, 'buynow']);
Route::get('viewCart', [BuyProductController::class, 'viewCart']);
Route::get('addToCart/{id}', [BuyProductController::class, 'addToCart']);
Route::get('subtractFromCart/{id}', [BuyProductController::class, 'subtractFromCart']);
Route::get('removeFromCart/{id}', [BuyProductController::class, 'removeFromCart']);
Route::get('checkout/{id}', [BuyProductController::class, 'viewCheckout']);
Route::get('viewInvoice/{id}', [BuyProductController::class, 'viewInvoice']);




// my profile
Route::get('myProfile/{id}', function ($id) {

    $user = User::find($id);
    $categories = Category::all();
    $cards = Card::where('user_id','=',$user->id)->get();
    return view('pages.myProfile')->with(['categories' => $categories, 'user' => $user,'cards' => $cards]);
    // return dd($user);
});

// update my profile
Route::patch('updateProfile/{id}', function (Request $request, $id) {
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
    ]);

    $user = User::find($id);
    $user->name = $request->input('name');
    $user->phone = $request->input('phone');
    $user->email = $request->input('email');
    $user->address = $request->input('address');
    $user->address2 = $request->input('address2');
    $user->city = $request->input('city');
    $user->state = $request->input('state');
    $user->country = $request->input('country');
    $user->zipcode = $request->input('zipcode');
    $user->save();

    return redirect('myProfile/' . $id)->with(['profileupdated' => "Profile Details Updated"]);
});


Route::get('test', function () {

    $roleId = auth()->user()->role_as;
    $rolesWithPermissions = App\Models\RolesWithPermission::where('roles_id',$roleId)->get()->pluck('permissions_id')->toArray();;
    // $rolesWithPermissions=$rolesWithPermissions->toArray();
    // $permissionIds = array();
    // foreach ($rolesWithPermissions as $item){
    //     $permissionIds[] = $item->permissions_id;
    // }

    // $item = Item::find(2);
    // session()->flush();
    // session()->save();
    // return dd(session()->get('cart_items'));
    return dd($rolesWithPermissions);
});
