<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use PDF;
// use Illuminate\Support\Facades\File;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BuyProductController extends Controller
{
    // buy now button click
    public function buynow($id)
    {
        $item = Item::find($id);
        if (Auth::check()) {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            if ($user->address == "") {
                return redirect('myProfile/' . $user->id)->with(['profileMsgFromBuyNow' => "Kindly Fill All Details to Continue"]);
            } else {
                $itemId = $id;
                $userId = Auth()->user()->id;
                $cartItems = Cart::where('user_id', '=', $userId);
                $itemCount = $cartItems->where('item_id', '=', $itemId)->count();
                if ($itemCount >= 1) {
                    $itemsInCart = $cartItems->where('item_id', '=', $itemId)->get();
                    foreach ($itemsInCart as $item) {
                        $cartId = $item->id;
                        $cartValues = Cart::find($cartId);
                        $cartValues->item_id = $itemId;
                        $cartValues->user_id = $userId;
                        $cartValues->quantity += 1;
                        $cartValues->save();
                        return redirect('viewCart');
                    }
                } else {
                    $cart = new Cart();
                    $cart->item_id = $itemId;
                    $cart->user_id = $userId;
                    $cart->quantity = "1";
                    $cart->save();
                    return redirect('viewCart');
                }
            }
        } else {
            return redirect('login')->with(['loginfrombuynow' => "Kindly Login Before Continue"]);
        }
    }

    //add to cart
    public function addToCart(Request $request, $id)
    {
        if (Auth::check()) {

            $itemId = $id;
            $userId = Auth()->user()->id;
            $cartItems = Cart::where('user_id', '=', $userId);
            $itemCount = $cartItems->where('item_id', '=', $itemId)->count();
            if ($itemCount >= 1) {
                $itemsInCart = $cartItems->where('item_id', '=', $itemId)->get();
                foreach ($itemsInCart as $item) {
                    $cartId = $item->id;
                    $cartValues = Cart::find($cartId);
                    $cartValues->item_id = $itemId;
                    $cartValues->user_id = $userId;
                    $cartValues->quantity += 1;
                    $item = Item::find($itemId);
                    if ($item->quantity == 0) {
                        return redirect()->back()->with(['highCartValue' => "Item Stock Limit exceeds !!!"]);
                    } else {
                        $item->quantity -= 1;
                        $item->save();
                        $cartValues->save();
                        return redirect()->back();
                    }
                }
            } else {
                $cart = new Cart();
                $cart->item_id = $itemId;
                $cart->user_id = $userId;
                $cart->quantity = "1";
                $item = Item::find($itemId);
                $item->quantity = $item->quantity - $cart->quantity;
                $item->save();
                $cart->save();
                return redirect()->back();
            }
        } else {
            return redirect('login')->with(['loginfrombuynow' => "Kindly Login Before Continue"]);
        }
    }


    //subtract to cart
    public function subtractFromCart(Request $request, $id)
    {
        if (Auth::check()) {

            $itemId = $id;
            $userId = Auth()->user()->id;
            $cartItems = Cart::where('user_id', '=', $userId);
            $itemCount = $cartItems->where('item_id', '=', $itemId)->count();
            if ($itemCount >= 1) {
                $itemsInCart = $cartItems->where('item_id', '=', $itemId)->get();
                foreach ($itemsInCart as $item) {
                    $cartId = $item->id;
                    $cartValues = Cart::find($cartId);
                    $itemValue = Item::find($itemId);
                    $cartValues->item_id = $itemId;
                    $cartValues->user_id = $userId;
                    if ($cartValues->quantity <= 1) {
                        return redirect()->back()->with(['lowCartValue' => "Quantity for the product Will be Zero, Kindly Added the Neccessary Quantity"]);
                    } else {
                        $cartValues->quantity -= 1;
                        $cartValues->save();
                        $itemValue->quantity += 1;
                        $itemValue->save();
                        return redirect()->back();
                    }
                }
            } else {
                $cart = new Cart();
                $cart->item_id = $itemId;
                $cart->user_id = $userId;
                $cart->quantity = "1";
                $cart->save();
                return redirect()->back();
            }
        } else {
            return redirect('login')->with(['loginfrombuynow' => "Kindly Login Before Continue"]);
        }
    }
    // view cart page
    public function viewCart()
    {
        if (Auth::check()) {
            $categories = Category::all();
            $cartItems = Cart::all();
            $userId = Auth()->user()->id;
            $items = array();
            $cartCount = 0;
            foreach ($cartItems as $cartItem) {
                if ($cartItem->user_id == $userId) {
                    $item = Item::find($cartItem->item_id);
                    $item['cartQuantity'] = $cartItem->quantity;
                    $items[] = $item;
                    $cartCount += $cartItem->quantity;
                }
            }
            // return dd($items);
            $total = 0;
            $shipping = 150;
            $shipping *= $cartCount;
            return view('pages.viewCart')->with(['categories' => $categories, 'items' => $items, 'total' => $total, 'shipping' => $shipping, 'cartCount' => $cartCount]);
        } else {
            return redirect('login')->with(['loginfrombuynow' => "Kindly Login Before Continue"]);
        }
    }

    // Remove items from cart
    public function removeFromCart($id)
    {
        $itemId = $id;
        $cartItems = Cart::where('item_id', '=', $itemId)->get();
        foreach ($cartItems as $cartItem) {
            $item = Item::find($id);
            $item->quantity = $item->quantity + $cartItem->quantity;
            $item->save();
            $cartItem->delete();
            // return dd($cartItem->id);
            return back();
        }
    }

    //view checkout page
    public function viewCheckout($id)
    {
        if (Auth::check()) {
            $selectedCart = Cart::where('user_id', '=', $id)->count();
            if ($selectedCart == 0) {
                return redirect()->back()->with(['cartEmpty' => "Cart is Empty,Kindly Select the Neccessary Order."]);
            } else {

                $invoice = Order::orderBy('id', 'Desc')->first();
                // return dd($invoice->id);
                if ($invoice != "") {
                    $invoiceNo = $invoice->id + 1;
                } else {
                    $invoiceNo = 1;
                }
                $cartItems = Cart::all();
                $userId = Auth()->user()->id;
                $user = User::find($userId);
                $items = array();
                $cartCount = 0;
                $total = 0;
                foreach ($cartItems as $cartItem) {
                    if ($cartItem->user_id == $userId) {
                        $item = Item::find($cartItem->item_id);
                        $product = Product::find($item->product_id);
                        $category = Category::find($item->category_id);
                        $item['cartQuantity'] = $cartItem->quantity;
                        $item['productName'] = $product->product_name;
                        $item['categoryName'] = $category->category_name;
                        $items[] = $item;
                        $cartCount += $cartItem->quantity;
                    }
                }
                // return dd($items);
                $shipping = 150;
                $shipping *= $cartCount;
                return view('pages.checkout')->with(['invoiceNo' => $invoiceNo, 'items' => $items, 'total' => $total, 'shipping' => $shipping, 'cartCount' => $cartCount, 'user' => $user]);
            }
        } else {
            return redirect('login')->with(['loginfrombuynow' => "Kindly Login Before Continue"]);
        }
    }

    //view Invoice Details
    public function viewInvoice($id)
    {
        $order = Order::find($id);
        $user = User::find($order->user_id);
        $order['user_name'] = $user->name;
        $item = Item::find($order->item_id);
        $order['item_price'] = $item->price;
        $category = Category::find($item->category_id);
        $order['category_name'] = $category->category_name;
        $shipping = 150;
        return view('pages.viewInvoice')->with(['order' => $order, 'shipping' => $shipping,]);
        // return dd($order);

    }
}
