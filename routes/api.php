<?php

use App\Models\Item;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Users
Route::get('/users', function (){
    $users = User::orderBy('id', 'ASC')->get();

    return UserResource::collection($users);
});

Route::get('/user/{id}', function ($id){

    return new UserResource(User::find($id));
});





// categories
// Route::get('viewCategories',[ApiController::class, 'viewCategories']);
Route::get('viewCategories', function(){
    $category = Category::all();
    return CategoryResource::collection($category);
});

Route::get('viewCategory/{id}', function ($id){
    return new CategoryResource(Category::find($id));
});

Route::get('viewCategory/{id}',[ApiController::class, 'viewCategory']);

Route::post('/addCategory',[ApiController::class, 'addCategory']);

Route::patch('/updateCategory/{id}',[ApiController::class, 'updateCategory']);

Route::delete('/deleteCategory/{id}',[ApiController::class, 'deleteCategory']);


//products
// Route::get('viewProducts',[ApiController::class, 'viewProducts']);
Route::get('viewProducts', function (){
    $products = Product::all();
    return ProductResource::collection($products);
});

Route::get('viewProduct/{id}',[ApiController::class, 'viewProduct']);

Route::post('addProduct',[ApiController::class, 'addProduct']);

Route::patch('updateProduct/{id}',[ApiController::class, 'updateProduct']);

Route::delete('deleteProduct/{id}',[ApiController::class, 'deleteProduct']);


//items
Route::get('/items', function (){
    $items = Item::orderBy('id', 'ASC')->get();

    return ItemResource::collection($items);
});

Route::get('/item/{id}', function ($id){

    return new ItemResource(Item::find($id));
});

Route::post('addItem',[ApiController::class, 'addItem']);

Route::patch('updateItem/{id}',[ApiController::class, 'updateItem']);

Route::delete('deleteItem/{id}',[ApiController::class, 'deleteItem']);


