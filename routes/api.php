<?php

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', function (){
    $users = User::orderBy('id', 'ASC')->get();

    return UserResource::collection($users);
});

Route::get('/users/{id}', function ($id){
    // $users = User::find($id);

    return new UserResource(User::find($id));
});

Route::get('/items', function (){
    $items = Item::orderBy('id', 'ASC')->get();

    return ItemResource::collection($items);
});

Route::get('/items/{id}', function ($id){

    return new ItemResource(Item::find($id));
});
