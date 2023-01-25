<?php

use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    $items = Item::all();
    $products = Product::all();
    $categories = Category::all();
    return view('home')->with(['products'=>$products,'categories'=>$categories,'items'=>$items]);
});

//auth controls
Route::get('login', [AuthController::class,'loginpage']);
Route::get('loginAttempt',[AuthController::class,'loginAttempt']);
Route::post('registerUser',[AuthController::class,'registerUser']);
Route::get('logout',[AuthController::class,'logout']);
Route::get('register', [AuthController::class,'registerpage']);
Route::get('admin',[AuthController::class,'adminPanel'])->middleware('admin');

//admin
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/addCategories',[ProductController::class,'addCategories']);
    Route::post('/storeCategories',[ProductController::class,'storeCategories']);
    Route::get('/addProducts',[ProductController::class,'addProducts']);
    Route::post('/storeProducts',[ProductController::class,'storeProducts']);
    Route::get('/addItems',[ProductController::class,'addItems']);
    Route::post('/storeItems',[ProductController::class,'storeItems']);
    Route::get('/viewCategories',[ProductController::class,'viewCategories']);
    Route::get('/viewProducts',[ProductController::class,'viewProducts']);
    Route::get('/viewItems',[ProductController::class,'viewItems']);
});


//items
Route::get('viewItem/{id}',[ViewProductController::class,'viewItem']);