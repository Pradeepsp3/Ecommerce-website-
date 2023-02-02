<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // place order
    public function placeOrder(Request $request){
        $invoice = Order::latest()->first();
        $invoice_no = $invoice->id;
        $userId = auth()->user()->id;
        $cartItems = Cart::all();
        foreach ($cartItems as $cartItem) {
            if ($cartItem->user_id == $userId) {
                $item = Item::find($cartItem->item_id);
                $product = Product::find($item->product_id);
                $user = Auth::user();
                $shipping = 150;
                // $category = Category::find($item->category_id);
                $cartId = $cartItem->id;
                $itemName = $product->product_name." ". $item->item_name;
                $deliveryAddress = $user->address.", ".$user->address2.", ".$user->city.", ".$user->state.", ".$user->country.", ".$user->zipcode;
                $contact_no = $user->phone;
                $totalAmount = ($item->price*$cartItem->quantity) + ($cartItem->quantity*$shipping);
                $paymentMode = "COD";
                $orderStatus = "Pending";
                $expectedDelivery = Carbon::now()->addDays(10)->tz('Asia/Kolkata')->format('l d-F-Y');
                $invoice_no += 1;

                // add to order Table
                $order = new Order();
                $order->invoice_no = "#E-Com-".$invoice_no;
                $order->user_id = $user->id;
                $order->cart_id = $cartId;
                $order->item_name = $itemName;
                $order->quantity = $cartItem->quantity;
                $order->delivery_address = $deliveryAddress;
                $order->contact_no = $contact_no;
                $order->total_amount = $totalAmount;
                $order->payment_mode = $paymentMode;
                $order->order_status = $orderStatus;
                $order->expected_delivery = $expectedDelivery;
                $order->created_at = Carbon::now()->tz('Asia/Kolkata')->toRfc850String();
                $order->updated_at = Carbon::now()->tz('Asia/Kolkata')->toRfc850String();
                $item->quantity -= $cartItem->quantity;
                $item->quantity -= $cartItem->quantity;
                $item->save();
                $cartDelete = Cart::find($cartItem->id);
                $cartDelete->delete();
                // return dd($cartDelete);

                $order->save();





            }

        //     }else{
        //         return redirect('/')->with(['orderAddedError'=>"Some Error Occured, Kindly Order After Some Times!"]);
        //     }
        }
        return redirect('/')->with(['orderAdded'=>"Thank you for Your Order! Order Added Successfully"]);
        // return dd($userId);

    }


    //view orders
    public function viewOrders($id){
        $orders = Order::where('User_id','=',$id)->get();
        return view('pages.listOrders')->with(['orders'=>$orders]);
        // return dd($orders);
    }
}
