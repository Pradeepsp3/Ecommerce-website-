<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //view login page
    public function loginpage()
    {
        $categories = Category::all();
        return view('auth.login')->with(['categories' => $categories]);
    }

    //view admin panel
    public function adminPanel()
    {
        $items = Item::all();
        $users = User::all();
        $orders = Order::all();
        $orderInProgress = 0;
        $deliveredOrders = 0;
        $totalItemsInStock = 0;
        foreach ($orders as $order) {
            if ($order->order_status != "Delivered") {
                $orderInProgress += 1;
            } else {
                $deliveredOrders += 1;
            }
        }
        foreach ($items as $item) {
            $totalItemsInStock += $item->quantity;
        }
        // foreach($users as $user){

        // }
        // return dd($orderInProgress);

        return view('admin', compact('items', 'users', 'orders', 'orderInProgress', 'deliveredOrders', 'totalItemsInStock'));
    }

    //view register page
    public function registerpage()
    {
        return view('auth.register');
    }

    //login user
    public function loginAttempt(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = User::where('email', $email)->first();

            Auth::login($user);

            if ($user->role_as != '2') {
                return redirect('admin')->with(['user' => $user]);
            } else {
                if (session()->get('cart_items') == null) {
                    return redirect('/')->with(['user' => $user]);
                } else {
                    // return dd(session()->get('cart_items'));
                    $sessionCarts = session()->get('cart_items');
                    $userId = Auth()->user()->id;
                    $cartItems = Cart::where('user_id', '=', $userId)->get();
                    $cartCount = $cartItems->count();
                    foreach ($sessionCarts as $sessionCart) {
                        // return dd($sessionCart['item_id']);
                        if ($cartCount == 0) {
                            // return dd($cartItems);
                            $cart = new Cart();
                            $cart->item_id = $sessionCart['item_id'];
                            $cart->user_id = $userId;
                            $cart->quantity = "1";
                            $item = Item::find($sessionCart['item_id']);
                            $item->quantity = $item->quantity - $cart->quantity;
                            $item->save();
                            $cart->save();
                        } else {
                            foreach ($cartItems as $cartItem) {
                                if ($cartItem->item_id == $sessionCart['item_id']) {
                                    $cartItem->quantity = $cartItem->quantity + $sessionCart['quantity'];
                                    $item = Item::find($cartItem->item_id);
                                    $item->quantity = $item->quantity - $sessionCart['quantity'];
                                    $item->save();
                                    $cartItem->save();
                                } else {
                                    $cart = new Cart();
                                    $cart->item_id = $sessionCart['item_id'];
                                    $cart->user_id = $userId;
                                    $cart->quantity = $sessionCart['quantity'];
                                    $item = Item::find($sessionCart['item_id']);
                                    $item->quantity = $item->quantity - $sessionCart['quantity'];
                                    $item->save();
                                    $cart->save();
                                }
                            }
                        }
                    }
                    session()->forget('cart_items');
                    session()->save();
                }
                return redirect('/')->with(['user' => $user]);
            }
        }else{
            return redirect()->back()->with(['loginError'=>"Kindly Enter the Valid Details..."]);
        }
    }

    //Register new user details
    public function registerUser(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);


        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect('/')->with(['user' => $user]);
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
