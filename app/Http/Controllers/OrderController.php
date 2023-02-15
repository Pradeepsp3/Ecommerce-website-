<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
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
    public function placeOrder(Request $request)
    {

        if($request->payment_mode == "COD"){
        // return dd();
        $userId = auth()->user()->id;
        $cartItems = Cart::all();
        foreach ($cartItems as $cartItem) {
            if ($cartItem->user_id == $userId) {
                $invoice = Order::orderBy('id','DESC')->first();
                // return dd($invoice->id);
                if ($invoice != null) {
                    $invoice_no = $invoice->id + 1;
                } else {
                    $invoice_no = 1;
                }
                $item = Item::find($cartItem->item_id);
                $product = Product::find($item->product_id);
                $user = Auth::user();
                $shipping = 150;
                // $category = Category::find($item->category_id);
                $cartId = $cartItem->id;
                $itemName = $product->product_name . " " . $item->item_name;
                $deliveryAddress = $user->address . ", " . $user->address2 . ", " . $user->city . ", " . $user->state . ", " . $user->country . ", " . $user->zipcode;
                $contact_no = $user->phone;
                $totalAmount = ($item->price * $cartItem->quantity) + ($cartItem->quantity * $shipping);
                $paymentMode = $request->paymentMode;
                $orderStatus = "Pending";
                $expectedDelivery = Carbon::now()->addDays(10)->tz('Asia/Kolkata')->format('l d-F-Y');

                // add to order Table
                $order = new Order();
                $order->invoice_no = "#E-Com-" . $invoice_no;
                $order->user_id = $user->id;
                $order->cart_id = $cartId;
                $order->item_id = $cartItem->item_id;
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
                $cartDelete = Cart::find($cartItem->id);
                $cartDelete->delete();
                // return dd($cartDelete);

                $order->save();
            }

            //     }else{
            //         return redirect('/')->with(['orderAddedError'=>"Some Error Occured, Kindly Order After Some Times!"]);
            //     }
        }
        return redirect('/')->with(['orderAdded' => "Thank you for Your Order! Order Added Successfully"]);
        // return dd($userId);
    }elseif($request->payment_mode == "CardPayment"){

        return dd(null);
        return redirect('addCard');

    }
    }


    //view orders
    public function viewOrders($id)
    {
        $orders = Order::where('user_id', '=', $id)->orderBy('id', 'desc')->get();
        foreach ($orders as $order) {
            $item = Item::find($order->item_id);
            $category = Category::find($item->category_id);
            $order['item_image'] = $item->image;
            $order['item_price'] = $item->price;
            $order['category_name'] = $category->category_name;
        }
        $total = 0;
        $shipping = 150;
        return view('pages.listOrders')->with(['orders' => $orders, 'total' => $total, 'shipping' => $shipping]);
        // return dd($orders);
    }

    //Add cards for payment
    public function addCard($id){

        return view('pages.addCard');
    }

    //Store Card Details
    public function storeCardDetails(Request $request){
        $user = Auth::user();
        $request->validate([
            'cardType' => 'required',
            'cardName' => 'required',
            'cardNumber' => 'required',
            'expiresAt' => 'required',
        ]);

        $card = new Card();
        $card->user_id = $user->id;
        $card->name_on_card = $request->cardName;
        $card->card_no = $request->cardNumber;
        $card->card_type = $request->cardType;
        $card->expires_at = $request->expiresAt;
        $card->save();

        return redirect('myProfile/'.$user->id)->with(['cardAdded' =>"Your $card->card_type Card Added Successfully..."]);
    }
}
